<?php

namespace App\Http\Processors;

use DB;
use App\Ustadz;

class UstadzProcessor {

	function __construct(int $id, String $topic) {
		$this->ustadz = Ustadz::findOrFail($id); 
		$this->topic = $topic;
		//yang menerima ID user dan topic dari API itu Controller, nanti diproses disini.
	}

	public function getNearestUstadz() {
		$user_lat = $this->ustadz->latitude_alamat;
		$user_long = $this->ustadz->longitude_alamat;
		$query = 'SELECT ustadzs.id, ustadzs.nama, COUNT(orders.id) AS JUMLAH_ORDER FROM ustadzs
							   LEFT JOIN ORDERS ON orders.server_id = ustadzs.id 
							   WHERE keahlian like "%'.$this->topic.'%" 
							   and SIN(RADIANS((ustadzs.latitude_alamat -'.$user_lat.')/2)) * SIN(RADIANS((ustadzs.latitude_alamat -'.$user_lat.')/2)) + COS(ustadzs.latitude_alamat) * COS('.$user_lat.') * SIN(RADIANS((ustadzs.longitude_alamat -'. $user_long.')/2)) * SIN(RADIANS((ustadzs.longitude_alamat -'.$user_long.')/2)) <= 5.050018906871166e-8 
							   and MONTH(orders.created_at) = MONTH(CURRENT_DATE) 
							   and YEAR(orders.created_at) = YEAR(CURRENT_DATE)  
							   GROUP BY ustadzs.id, ustadzs.nama 
							   ORDER BY JUMLAH_ORDER ASC LIMIT 1';
		$ustadz = DB::select($query);
		return $ustadz;
		//TODO: Cari ustadz yang deket lokasinya dengan $this->user pake Haversine
	}

}

?>