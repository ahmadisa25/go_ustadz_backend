<?php

class PostController{
    
    public $connect_db;
    public $post_data;
    
    public function __construct($post_data){
        $this->post_data = $post_data;
        $this->connect_db = new mysqli("localhost", "id13148916_arena_admin", "<a8@zO9^no-woYiB", "id13148916_go_ustadz");

        if (!$this->connect_db) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        
    }
    
    public function checkAction(){
        switch ( $this->post_data['action_code']) {
            case 'near_ust':
                $this->getNearestUstadz();
                break;
            default:
                echo "Action tidak ditemukan. Silakan masukkan action yang lain";
                break;
        }
    }
    
    public function getNearestUstadz(){
        $query = 'SELECT ustadzs.id, ustadzs.nama, COUNT(orders.id) AS JUMLAH_ORDER FROM ustadzs
							   LEFT JOIN orders ON orders.server_id = ustadzs.id 
							   WHERE keahlian like "%'.$this->post_data['topic'].'%" 
							   and SIN(RADIANS((ustadzs.latitude_alamat -'.$this->post_data['user_lat'].')/2)) * SIN(RADIANS((ustadzs.latitude_alamat -'.$this->post_data['user_lat'].')/2)) + COS(ustadzs.latitude_alamat) * COS('.$this->post_data['user_lat'].') * SIN(RADIANS((ustadzs.longitude_alamat -'. $this->post_data['user_lon'].')/2)) * SIN(RADIANS((ustadzs.longitude_alamat -'.$this->post_data['user_lon'].')/2)) <= 5.050018906871166e-8 
							   GROUP BY ustadzs.id, ustadzs.nama 
							   ORDER BY JUMLAH_ORDER ASC LIMIT 1';
		
        if ($result = $this->connect_db->query($query)) {
            $row = $result->fetch_assoc();
            $result->free();
            $this->connect_db->close();
            echo json_encode($row);
        }
    }
}

?>