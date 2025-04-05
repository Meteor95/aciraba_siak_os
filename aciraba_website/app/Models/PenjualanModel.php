<?php

namespace App\Controllers;

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class PenjualanModel extends Model
{
    protected $db;
	public function __construct(ConnectionInterface &$db) {
		$this->db =& $db;
	}
	function add($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_trs_returpenjualan_detail WHERE KODEBARANG = '".$data[3]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' LIMIT 1");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		if ($jumlahdata > 0 ){
			if ($this->db->query("UPDATE `01_trs_returpenjualan_detail` SET `JUMLAHRETUR` = `JUMLAHRETUR` + '".$data[6]."' WHERE `KODEBARANG` = '".$data[3]."' AND `NOTRXPENJUALAN` = '".$data[2]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
				$jsonobj = '{"status":"adadata"}'; 
			}else{
				$jsonobj = '{"status":"false"}'; 
			}
			return json_encode($jsonobj);
		}else{
			if ($this->db->query("INSERT INTO `01_trs_returpenjualan_detail`(`AI`, `NOTRXRETUR`, `NOTRXPENJUALAN`, `KODEBARANG`, `NAMABARANG`, `JUMLAHBELI`, `JUMLAHRETUR`, `HARGABELI`, `HARGAJUAL`, `PPN`, `TUJUANOUTLET`, `TUJUANLOKASISSTOK`,`KETERANGAN`,`JENISTRX`, `OUTLET`, `KODEUNIKMEMBER`, `KODEKOMPUTER`) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[8]."', '".$data[9]."', '".$data[10]."', '".$data[11]."', '".$data[12]."', '".$data[13]."', '".$data[14]."', '".$data[15]."','".$datasessionparameter[2]."')")){
				$jsonobj = '{"status":"true"}'; 
				return json_encode($jsonobj);
			}else{
				$jsonobj = '{"status":"false"}'; 
				return json_encode($jsonobj);
			}
		}
	}
	function daftarreturlocal($data,$datasessionparameter){
		$dataquery = $this->db->query("SELECT * FROM 01_trs_returpenjualan_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	} 
	function updatekeranjangretur($data,$datasessionparameter) {
		if ($this->db->query("UPDATE `01_trs_returpenjualan_detail` SET `JUMLAHRETUR` = '".$data[0]."', `HARGAJUAL` = '".$data[1]."', `KETERANGAN` = '".$data[2]."', `PPN` = '".$data[3]."' WHERE `KODEBARANG` = '".$data[4]."' AND OUTLET = '".$data[5]."' AND KODEUNIKMEMBER = '".$data[6]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$jsonobj = '{"status":"true"}'; 
			return json_encode($jsonobj);
		}else{
			$jsonobj = '{"status":"false"}'; 
			return json_encode($jsonobj);
		}
	} 
	function hapusperbarangretur($data) {  return $this->db->table('01_trs_returpenjualan_detail')->where($data)->delete(); }
	function hapuskeranjangretur($datasessionparameter) { return $this->db->query("DELETE FROM 01_trs_returpenjualan_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'"); }
	function pindahdetailkelocal($jsondatabarang,$totaldata, $datasessionparameter){
		$this->db->query("DELETE FROM 01_trs_returpenjualan_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$bulkinsert = "";
		for($a = 0; $a < $totaldata;$a++){
			$bulkinsert .= "('','".$jsondatabarang[$a]->NOTRXRETUR."','".$jsondatabarang[$a]->NOTRXPENJUALAN."','".$jsondatabarang[$a]->KODEBARANG."','".$jsondatabarang[$a]->NAMABARANG."','".$jsondatabarang[$a]->JUMLAHBELI."', '".$jsondatabarang[$a]->JUMLAHRETUR."', '".$jsondatabarang[$a]->HARGABELI."', '".$jsondatabarang[$a]->HARGAJUAL."','".$jsondatabarang[$a]->PPN."', '".$jsondatabarang[$a]->TUJUANOUTLET."', '".$jsondatabarang[$a]->TUJUANLOKASISSTOK."', '".$jsondatabarang[$a]->KETERANGAN."', '".$jsondatabarang[$a]->JENISTRX."', '".$jsondatabarang[$a]->OUTLET."','".$jsondatabarang[$a]->KODEUNIKMEMBER."','".$datasessionparameter[2]."'),";
		}
		$this->db->query("INSERT INTO `01_trs_returpenjualan_detail`(`AI`, `NOTRXRETUR`, `NOTRXPENJUALAN`, `KODEBARANG`, `NAMABARANG`, `JUMLAHBELI`, `JUMLAHRETUR`, `HARGABELI`, `HARGAJUAL`, `PPN`, `TUJUANOUTLET`, `TUJUANLOKASISSTOK`, `KETERANGAN`, `JENISTRX`, `OUTLET`, `KODEUNIKMEMBER`, `KODEKOMPUTER`)  VALUES ".rtrim($bulkinsert, ','));
	}
}
