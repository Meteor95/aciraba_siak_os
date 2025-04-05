<?php

namespace App\Controllers;

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class PenyesuaianModel extends Model
{
    protected $db;
	public function __construct(ConnectionInterface &$db) {
		$this->db =& $db;
	}
	function add($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_trs_opname_detail WHERE KODEBARANG = '".$data[1]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' LIMIT 1");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		if ($jumlahdata > 0 ){
			if ($this->db->query("UPDATE `01_trs_opname_detail` SET `STOKOPNAME` = `STOKOPNAME` + '".$data[5]."' WHERE `KODEBARANG` = '".$data[1]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
				$jsonobj = '{"status":"adadata"}'; 
			}else{
				$jsonobj = '{"status":"false"}'; 
			}
			return json_encode($jsonobj);
		}else{
			if ($this->db->query("INSERT INTO `01_trs_opname_detail`(`AI`, `NOTAOPNAME`, `KODEBARANG`, `NAMABARANG`, `LOKASIOPNAME`, `STOKKOMPUTER`, `STOKOPNAME`, `KONDISIOPNAME`, `OUTLET`, `KODEUNIKMEMBER`, `HPP`, `INFORMASI`,`KODEKOMPUTER`) VALUES ('', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[8]."', '".$data[9]."', '".$data[10]."','".$datasessionparameter[2]."')")){
				$jsonobj = '{"status":"true"}'; 
				return json_encode($jsonobj);
			}else{
				$jsonobj = '{"status":"false"}'; 
				return json_encode($jsonobj);
			}
		}
	} 
	function daftaropnamelocal($data,$datasessionparameter){
		$dataquery = $this->db->query("SELECT * FROM 01_trs_opname_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	}
	function updatekeranjangopname($data,$datasessionparameter) {
		if ($this->db->query("UPDATE `01_trs_opname_detail` SET `STOKOPNAME` = '".$data[2]."', `INFORMASI` = '".$data[3]."' WHERE `KODEBARANG` = '".$data[1]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$jsonobj = '{"status":"true"}'; 
			return json_encode($jsonobj);
		}else{
			$jsonobj = '{"status":"false"}'; 
			return json_encode($jsonobj);
		}
	} 
	function hapusperbarang($data) {  return $this->db->table('01_trs_opname_detail')->where($data)->delete(); }
	function truncate($datasessionparameter) { return $this->db->query("DELETE FROM 01_trs_opname_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'"); }
	function addmutasi($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_trs_mutasibarang_detail WHERE KODEBARANG = '".$data[1]."' AND ASALOUTLET = '".$data[7]."' AND ASALLOKASIITEM = '".$data[9]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' LIMIT 1");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		if ($jumlahdata > 0 ){
			if ($this->db->query("UPDATE `01_trs_mutasibarang_detail` SET `STOKAWAL` = '".$data[4]."',`NOMINAL` = '".$data[6]."',`STOKMUTASI` = `STOKMUTASI` + '".$data[5]."' WHERE `KODEBARANG` = '".$data[1]."' AND ASALOUTLET = '".$data[7]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
				$jsonobj = '{"status":"adadata"}'; 
			}else{
				$jsonobj = '{"status":"false"}'; 
			}
			return json_encode($jsonobj);
		}else{
			if ($this->db->query("INSERT INTO `01_trs_mutasibarang_detail`(`AI`, `NOMORMUTASI`, `KODEBARANG`, `NAMABARANG`, `UNIT`, `STOKAWAL`, `STOKMUTASI`, `NOMINAL`, `ASALOUTLET`, `TUJUANOUTLET`, `ASALLOKASIITEM`, `TUJUANLOKASIITEM`, `OUTLET`, `KODEUNIKMEMBER`,`KODEKOMPUTER`) VALUES ('', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[8]."', '".$data[9]."', '".$data[10]."', '".$data[11]."', '".$data[12]."','".$datasessionparameter[2]."')")){
				$jsonobj = '{"status":"true"}'; 
				return json_encode($jsonobj);
			}else{
				$jsonobj = '{"status":"false"}'; 
				return json_encode($jsonobj);
			}
		}
	} 
	function daftarmutasilocal($data,$datasessionparameter){
		$dataquery = $this->db->query("SELECT * FROM 01_trs_mutasibarang_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	}
	function updatekeranjangmutasi($data,$datasessionparameter){
		if ($this->db->query("UPDATE `01_trs_mutasibarang_detail` SET `STOKMUTASI` = '".$data[0]."' WHERE `KODEBARANG` = '".$data[1]."' AND ASALOUTLET = '".$data[2]."' AND ASALLOKASIITEM = '".$data[3]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$jsonobj = '{"status":"true"}'; 
			return json_encode($jsonobj);
		}else{
			$jsonobj = '{"status":"false"}'; 
			return json_encode($jsonobj);
		}
	} 
	function hapusperbarangmutasi($data) {  return $this->db->table('01_trs_mutasibarang_detail')->where($data)->delete(); }
	function hapuskeranjangmutasi($datasessionparameter) { return $this->db->query("DELETE FROM 01_trs_mutasibarang_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'"); }
}
