<?php

namespace App\Controllers;

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class PembelianModel extends Model
{
    protected $db;
	public function __construct(ConnectionInterface &$db) {
		$this->db =& $db;
	}
	function add($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_tms_keranjang_barangmasuk WHERE KODEBARANG = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' LIMIT 1");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		if ($jumlahdata > 0 ){
			if ($this->db->query("UPDATE `01_tms_keranjang_barangmasuk` SET `JUMLAHBELI` = `JUMLAHBELI` + '".$data[3]."' WHERE `KODEBARANG` = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
				$jsonobj = '{"status":"adadata"}'; 
			}else{
				$jsonobj = '{"status":"false"}'; 
			}
			return json_encode($jsonobj);
		}else{
			if ($this->db->query("INSERT INTO `01_tms_keranjang_barangmasuk` (`KODEBARANG`, `NAMABARANG`, `STOKSEBELUM`, `JUMLAHBELI`, `DISPLAY`, `GUDANG`, `HARGASUPLIER`, `EXP`, `SUBTOTAL`, `DISKON1`, `DISKON2`, `PPN`, `ADISKON1`, `ADISKON2`, `SUBTOTALHPP`, `HPP`, `BEBANGAJI`, `BEBANPROMO`, `BEBANPACKING`, `BEBANTRANSPORT`, `HPPBEBAN`, `OUTLET`,`KODEUNIKMEMBER`,`KODEKOMPUTER`) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[8]."', '".$data[9]."', '".$data[10]."', '".$data[11]."', '".$data[12]."', '".$data[13]."', '".$data[14]."', '".$data[15]."', '".$data[16]."', '".$data[17]."', '".$data[18]."', '".$data[19]."', '".$data[20]."','".$datasessionparameter[0]."','".$datasessionparameter[1]."','".$datasessionparameter[2]."')")){
				$jsonobj = '{"status":"true"}'; 
				return json_encode($jsonobj);
			}else{
				$jsonobj = '{"status":"false"}'; 
				return json_encode($jsonobj);
			}
		}
	} 
	function updatekpembelian($data,$datasessionparameter) {
		if ($this->db->query("UPDATE `01_tms_keranjang_barangmasuk` SET `JUMLAHBELI` = '".$data[1]."', `DISPLAY` = '".$data[2]."', `GUDANG` = '".$data[3]."', `HARGASUPLIER` = '".$data[4]."', `EXP` = '".$data[5]."', `SUBTOTAL` = '".$data[6]."', `DISKON1` = '".$data[7]."', `DISKON2` = '".$data[8]."', `PPN` = '".$data[9]."', `ADISKON1` = '".$data[10]."', `ADISKON2` = '".$data[11]."', `SUBTOTALHPP` = '".$data[12]."', `HPP` = '".$data[13]."', `BEBANGAJI` = '".$data[14]."', `BEBANPROMO` = '".$data[15]."', `BEBANPACKING` = '".$data[16]."', `BEBANTRANSPORT` = '".$data[17]."', `HPPBEBAN` = '".$data[18]."' WHERE `KODEBARANG` = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$jsonobj = '{"status":"true"}'; 
			return json_encode($jsonobj);
		}else{
			$jsonobj = '{"status":"false"}'; 
			return json_encode($jsonobj);
		}
	} 
	function daftarpembelianlocal($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_tms_keranjang_barangmasuk WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	}
	function hapusperbarang($data) {  return $this->db->table('01_tms_keranjang_barangmasuk')->where($data)->delete(); }
	function truncate($datasessionparameter) { return $this->db->query("DELETE FROM 01_tms_keranjang_barangmasuk WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'"); }
	function pindahdetailkelocal($jsondatabarang,$totaldata,$datasessionparameter){
		$this->db->query("DELETE FROM 01_tms_keranjang_barangmasuk WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$bulkinsert = "";
		for($a = 0; $a < $totaldata;$a++){
			$bulkinsert .= "('','".$jsondatabarang[$a]->KODEBARANG."','".$jsondatabarang[$a]->NAMABARANG."','0','".$jsondatabarang[$a]->JUMLAHBELI."','".$jsondatabarang[$a]->DISPLAY."','".$jsondatabarang[$a]->GUDANG."', '".$jsondatabarang[$a]->HARGABELI."', '".$jsondatabarang[$a]->EXP."', '".$jsondatabarang[$a]->JUMLAHBELI * $jsondatabarang[$a]->HARGABELI."', '".$jsondatabarang[$a]->DISKON1."', '".$jsondatabarang[$a]->DISKON2."', '".$jsondatabarang[$a]->PPN."', '".$jsondatabarang[$a]->AFTERDISKON1."', '".$jsondatabarang[$a]->AFTERDISKON2."','0', '0', '".$jsondatabarang[$a]->BEBANGAJI."', '".$jsondatabarang[$a]->BEBANPROMO."', '".$jsondatabarang[$a]->BEBANPACKING."', '".$jsondatabarang[$a]->BEBANTRANSPORT."', '".$jsondatabarang[$a]->HPPBEBAN."','".$datasessionparameter[0]."','".$datasessionparameter[1]."','".$datasessionparameter[2]."'),";
		}
		$this->db->query("INSERT INTO `01_tms_keranjang_barangmasuk`(`AI`, `KODEBARANG`, `NAMABARANG`, `STOKSEBELUM`, `JUMLAHBELI`, `DISPLAY`, `GUDANG`, `HARGASUPLIER`, `EXP`, `SUBTOTAL`, `DISKON1`, `DISKON2`, `PPN`, `ADISKON1`, `ADISKON2`, `SUBTOTALHPP`, `HPP`, `BEBANGAJI`, `BEBANPROMO`, `BEBANPACKING`, `BEBANTRANSPORT`, `HPPBEBAN`, `OUTLET`,`KODEUNIKMEMBER`,`KODEKOMPUTER`) VALUES ".rtrim($bulkinsert, ','));
	}
	/* RETUR PEMBELIAN AREA */
	function addretur($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_trs_returpembelian_detail WHERE KODEBARANG = '".$data[3]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' LIMIT 1");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		if ($jumlahdata > 0 ){
			if ($this->db->query("UPDATE `01_trs_returpembelian_detail` SET `JUMLAHRETUR` = `JUMLAHRETUR` + '".$data[6]."' WHERE `KODEBARANG` = '".$data[3]."' AND `NOTRXPEMBELIAN` = '".$data[2]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
				$jsonobj = '{"status":"adadata"}'; 
			}else{
				$jsonobj = '{"status":"false"}'; 
			}
			return json_encode($jsonobj);
		}else{
			if ($this->db->query("INSERT INTO `01_trs_returpembelian_detail`(`AI`, `NOTRXRETURBELI`, `NOTRXPEMBELIAN`, `KODEBARANG`, `NAMABARANG`, `JUMLAHBELI`, `JUMLAHRETUR`, `HARGABELI`, `POTONGAN`, `PPN`, `ASALOUTLET`, `ASALLOKASI`,`KETERANGAN`,`JENISTRX`, `OUTLET`, `KODEUNIKMEMBER`, `KODEKOMPUTER`) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[8]."', '".$data[9]."', '".$data[10]."', '".$data[11]."', '".$data[12]."', '".$data[13]."', '".$data[14]."', '".$data[15]."','".$datasessionparameter[2]."')")){
				$jsonobj = '{"status":"true"}'; 
				return json_encode($jsonobj);
			}else{
				$jsonobj = '{"status":"false"}'; 
				return json_encode($jsonobj);
			}
		}
	}
	function daftarreturlocal($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_trs_returpembelian_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	} 
	function updatekeranjangretur($data, $datasessionparameter) {
		if ($this->db->query("UPDATE `01_trs_returpembelian_detail` SET `JUMLAHRETUR` = '".$data[0]."', `HARGABELI` = '".$data[1]."', `POTONGAN` = '".$data[2]."', `KETERANGAN` = '".$data[3]."', `PPN` = '".$data[4]."' WHERE `KODEBARANG` = '".$data[5]."' AND OUTLET = '".$data[6]."' AND KODEUNIKMEMBER = '".$data[7]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$jsonobj = '{"status":"true"}'; 
			return json_encode($jsonobj);
		}else{
			$jsonobj = '{"status":"false"}'; 
			return json_encode($jsonobj);
		}
	} 
	function hapusperbarangretur($data) {  return $this->db->table('01_trs_returpembelian_detail')->where($data)->delete(); }
	function hapuskeranjangretur($datasessionparameter) { return $this->db->query("DELETE FROM 01_trs_returpembelian_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'"); }
	function pindahdetailkelocalrb($jsondatabarang,$totaldata,$datasessionparameter) {
		$this->db->query("DELETE FROM 01_trs_returpembelian_detail WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$bulkinsert = "";
		for($a = 0; $a < $totaldata;$a++){
			$bulkinsert .= "('','".$jsondatabarang[$a]->NOTRXRETURBELI."','".$jsondatabarang[$a]->NOTRXPEMBELIAN."','".$jsondatabarang[$a]->KODEBARANG."','".$jsondatabarang[$a]->NAMABARANG."','".$jsondatabarang[$a]->JUMLAHBELI."', '".$jsondatabarang[$a]->JUMLAHRETUR."', '".$jsondatabarang[$a]->HARGABELI."', '".$jsondatabarang[$a]->POTONGAN."','".$jsondatabarang[$a]->PPN."', '".$jsondatabarang[$a]->ASALOUTLET."', '".$jsondatabarang[$a]->ASALLOKASI."', '".$jsondatabarang[$a]->KETERANGAN."', '".$jsondatabarang[$a]->JENISTRX."', '".$jsondatabarang[$a]->OUTLET."','".$jsondatabarang[$a]->KODEUNIKMEMBER."','".$datasessionparameter[2]."'),";
		}
		$this->db->query("INSERT INTO `01_trs_returpembelian_detail`(`AI`, `NOTRXRETURBELI`, `NOTRXPEMBELIAN`, `KODEBARANG`, `NAMABARANG`, `JUMLAHBELI`, `JUMLAHRETUR`, `HARGABELI`, `POTONGAN`, `PPN`, `ASALOUTLET`, `ASALLOKASI`,`KETERANGAN`,`JENISTRX`, `OUTLET`, `KODEUNIKMEMBER`,`KODEKOMPUTER`)  VALUES ".rtrim($bulkinsert, ','));
	}
}
