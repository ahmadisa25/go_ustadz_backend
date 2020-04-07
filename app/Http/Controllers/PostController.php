<?php

class PostController{
    
    public $connect_db;
    public $post_data;
    
    public function __construct(array $post_data){
        $this->post_data = $post_data;
        $this->connect_db = new mysqli("localhost", "id13148916_arena_admin", "<a8@zO9^no-woYiB", "id13148916_go_ustadz");

        if (!$this->connect_db) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        
    }
    
    public function checkParams(array $required_keys, string $callback) {
        $err="";
        foreach($required_keys as $rk){
            if(empty($this->post_data[$rk])){
                $err = "Parameter ".$rk." harus diisi";
                break;
            } 
        }
        if(!$err){
            call_user_func(array($this, $callback));
        } else{
            echo json_encode(['msg' => $err]);
        }
    }
    
    public function checkAction(){
        switch ($this->post_data['action_code']) {
            case 'near_ust':
                $required_keys = ['topic', 'user_lat', 'user_lon'];
                $this->checkParams($required_keys, 'getNearestUstadz');
                break;
            case 'crt_ord':
                $required_keys = ['client_id', 'server_id', 'paket_id', 'topic_id'];
                $this->checkParams($required_keys, 'createOrders');
                break;
            case 'lgn':
                $required_keys = ['email', 'password'];
                $this->checkParams($required_keys, 'login');
                break;
             case 'reg':
                $required_keys = ['email', 'password', 'nama', 'telepon', 'latitude_alamat', 'longitude_alamat', 'tanggal_lahir', 'pekerjaan'];
                $this->checkParams($required_keys, 'register');
                break;
            default:
                echo "Action tidak ditemukan. Silakan masukkan action yang lain";
                break;
        }
    }
    
    public function login(){
        $email = $this->post_data['email'];
        $userpass = $this->post_data['password'];
        $query= "SELECT * FROM users WHERE email = '$email'";
        $result = $this->connect_db->query($query);
        $res = $result->fetch_assoc();
         if (mysqli_num_rows($result) > 0) {
            if (password_verify($userpass, $res['password'])) {
               echo json_encode($res);
            }else {
                echo json_encode(['msg' => 'Login gagal. Silakan cek email dan password anda kembali']);
            }
        } else {
            echo json_encode(['msg' => 'Login gagal. Silakan cek email dan password anda kembali']);
        }
    }
    
    public function register(){
        $nama = $this->post_data['nama'];
        $email = $this->post_data['email'];
        $password = password_hash($this->post_data['password'], PASSWORD_BCRYPT);
        $telepon = $this->post_data['telepon'];
        $tl = $this->post_data['tanggal_lahir'];
        $pekerjaan = $this->post_data['pekerjaan'];
        $latitude_alamat = $this->post_data['latitude_alamat'];
        $longitude_alamat = $this->post_data['longitude_alamat'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO users (nama, email, password, telepon, latitude_alamat, longitude_alamat, tanggal_lahir, pekerjaan, created_at) VALUES ('$nama', '$email', '$password', '$telepon', '$latitude_alamat', '$longitude_alamat', '$tl', '$pekerjaan', '$date')";
        $result = $this->connect_db->query($query);
        if($result === TRUE){
            echo json_encode(['msg' => 'Pendaftaran akun berhasil dilakukan']);
        } else{
            //var_dump($this->connect_db->error);
            echo json_encode(['msg' =>  'Pendaftaran akun gagal dilakukan']);
        }
    }
    
    public function createOrders(){
        $client = $this->post_data['client_id'];
        $server = $this->post_data['server_id'];
        $paket = $this->post_data['paket_id'];
        $topic = $this->post_data['topic_id'];
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO orders (client_id, server_id, paket_id, topic_id, created_at) VALUES ('$client', '$server', '$paket', '$topic', '$date')";
        $result = $this->connect_db->query($query);
        if($result === TRUE){
            echo json_encode(['msg' => 'Order berhasil dilakukan']);
        } else{
            var_dump($this->connect_db->error);
            echo json_encode(['msg' =>  'Order gagal dilakukan']);
        }
    }
    
    public function getNearestUstadz(){
        $query = 'SELECT ustadzs.id, ustadzs.nama, ustadzs.nama_institusi_pendidikan_terakhir,  COUNT(orders.id) AS JUMLAH_ORDER FROM ustadzs
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
        } else{
            echo json_encode(['msg' => "Ustadz tidak ditemukan"]);
        }
    }
}

?>