<?php

namespace App\Controllers;

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class KasirModel extends Model
{
    protected $db;
	public function __construct(ConnectionInterface &$db) {
		$this->db =& $db;
	}
	function bacakeranjangkasir($datasessionparameter){
		$dataquery = $this->db->query("SELECT * FROM 01_tms_keranjang WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	}
	function daftarnotapending($data,$datasessionparameter){
		$dataquery = $this->db->query("SELECT KETERANGAN, SUM(QTY) as TOTALBARANG, SUM(QTY * HARGA_JUAL) as TOTALBELANJA FROM 01_tms_keranjang_pending WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' GROUP BY KETERANGAN");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		$jsonobj = '{"adadata":"ada","jumlahdata":'.$jumlahdata.',"datakeranjang":'.json_encode($datakeranjang).'}';
		return $jsonobj;
	}
    function add($data,$datasessionparameter) {
		$dataquery = $this->db->query("SELECT * FROM 01_tms_keranjang WHERE BARANG_ID = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."' LIMIT 1");
		$datakeranjang = $dataquery->getResultArray();
		$jumlahdata = count((array)$datakeranjang);
		if ($jumlahdata > 0 ){
			if ($this->db->query("UPDATE `01_tms_keranjang` SET `QTY` = '".$data[2]."' , HARGA_JUAL = '".$data[3]."' WHERE `BARANG_ID` = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
				$jsonobj = '{"status":"adadata","hargajual":'.$data[3].'}'; 
			}else{
				$jsonobj = '{"status":"false"}'; 
			}
			return json_encode($jsonobj);
		}else{
			if ($this->db->query("INSERT INTO 01_tms_keranjang (`AI`,`BARANG_ID`,`NAMA_BARANG`,`QTY`,`HARGA_JUAL`,`HARGA_BELI`,`POTONGANGLOBAL`,`DARIPERUSAHAAN`, `KETERANGAN`, `APAKAHVARIAN`,`STOKDAPATMINUS`,`JSONTAMBAHAN`,`BRAND_ID`,`PRINCIPAL_ID`,`HARGAASLI`,`HARGAASLISEMENTARA`,`OUTLET`,`KODEUNIKMEMBER`,`KODEKOMPUTER`) VALUES ('','".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."','".$data[7]."','".$data[6]."', '".$data[8]."', '".$data[9]."', '".$data[10]."', '".$data[11]."', '".$data[12]."', '".$data[13]."', '".$data[13]."','".$datasessionparameter[0]."', '".$datasessionparameter[1]."', '".$datasessionparameter[2]."') ON DUPLICATE KEY UPDATE QTY = QTY + '".$data[2]."'")){
				$jsonobj = '{"status":"true"}'; 
				return json_encode($jsonobj);
			}else{
				$jsonobj = '{"status":"false"}'; 
				return json_encode($jsonobj);
			}
		}
	}
	function copytabelkepending($data,$datasessionparameter){ 
		if ($this->db->query("INSERT INTO 01_tms_keranjang_pending SELECT '',BARANG_ID,NAMA_BARANG,QTY,HARGA_JUAL,HARGA_BELI,POTONGANGLOBAL,DARIPERUSAHAAN,KETERANGAN,APAKAHVARIAN,STOKDAPATMINUS,JSONTAMBAHAN,CATATANPERBARANG,BRAND_ID,PRINCIPAL_ID,HARGAASLI,HARGAASLISEMENTARA,OUTLET,KODEUNIKMEMBER,KODEKOMPUTER,STATUSBARANGPROSES FROM 01_tms_keranjang WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$this->db->query("UPDATE `01_tms_keranjang_pending` SET `KETERANGAN` = '".$data[0]."' WHERE `KETERANGAN` = 'TIDAK ADA KETERANGAN' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
			$this->db->query("DELETE FROM 01_tms_keranjang WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
			$jsonobj = '{"status":"true"}'; 
		}else{
			$jsonobj = '{"status":"false"}'; 
		}
		return json_encode($jsonobj);
	}
	function copytabelkekeranjang($data,$datasessionparameter){ 
		if ($this->db->query("INSERT INTO 01_tms_keranjang SELECT '',BARANG_ID,NAMA_BARANG,QTY,HARGA_JUAL,HARGA_BELI,POTONGANGLOBAL,DARIPERUSAHAAN,'TIDAK ADA KETERANGAN',APAKAHVARIAN,STOKDAPATMINUS,JSONTAMBAHAN,CATATANPERBARANG,BRAND_ID,PRINCIPAL_ID,HARGAASLI,HARGAASLISEMENTARA,OUTLET,KODEUNIKMEMBER,KODEKOMPUTER,STATUSBARANGPROSES FROM 01_tms_keranjang_pending WHERE KETERANGAN = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'")){
			$this->db->query("DELETE FROM 01_tms_keranjang_pending WHERE KETERANGAN = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
			$jsonobj = '{"status":"true"}'; 
		}else{
			$jsonobj = '{"status":"false"}'; 
		}
		return json_encode($jsonobj);
	}
	function hapusperbarang($data) {  return $this->db->table('01_tms_keranjang')->where($data)->delete(); }
	function truncate($datasessionparameter) { return $this->db->query("DELETE FROM 01_tms_keranjang WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'"); }
	function updatekasirsementara($data,$datasessionparameter){ 
		if ($data[5] == "YA"){
			$query = "UPDATE `01_tms_keranjang` SET `QTY` = '".$data[1]."' , HARGA_JUAL = '".$data[2]."', JSONTAMBAHAN = '".$data[3]."', CATATANPERBARANG = '".$data[4]."' WHERE `BARANG_ID` = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'";
		}else if ($data[5] == "UBAHHJNYA"){
			$query = "UPDATE `01_tms_keranjang` SET `QTY` = '".$data[1]."' , HARGA_JUAL = '".$data[2]."', HARGAASLISEMENTARA = '".$data[2]."' WHERE `BARANG_ID` = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'";
		}else{
			$query = "UPDATE `01_tms_keranjang` SET `QTY` = '".$data[1]."' , HARGA_JUAL = '".$data[2]."' WHERE `BARANG_ID` = '".$data[0]."' AND OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'";
		}
		return $this->db->query($query);
	}
	function grandtotalkasir($datasessionparameter){
		$dataquery = $this->db->query("SELECT COALESCE(SUM(HARGA_JUAL * QTY),0) as TOTALBELANJA  FROM 01_tms_keranjang WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$datakeranjang = $dataquery->getResultArray();
		return $jsonobj = '{"data":'.json_encode($datakeranjang).'}'; 
	}
	function pindahdetailkelocal($jsondatabarang,$totaldata, $datasessionparameter){
		$this->db->query("DELETE FROM 01_tms_keranjang WHERE OUTLET = '".$datasessionparameter[0]."' AND KODEUNIKMEMBER = '".$datasessionparameter[1]."' AND KODEKOMPUTER = '".$datasessionparameter[2]."'");
		$bulkinsert = "";
		for($a = 0; $a < $totaldata;$a++){
			$bulkinsert .= "('','".$jsondatabarang[$a]->BARANG_ID."', '".$jsondatabarang[$a]->NAMABARANG."', '".$jsondatabarang[$a]->STOKBARANGKELUAR."', '".$jsondatabarang[$a]->HARGAJUALKELUAR."', '".$jsondatabarang[$a]->HARGABELI."', '".$jsondatabarang[$a]->POTONGANGLOBAL."', '".$jsondatabarang[$a]->DARIPERUSAHAAN."', '".$jsondatabarang[$a]->CATATANPERBARANG."', '".$jsondatabarang[$a]->APAKAHVARIAN."', '".$jsondatabarang[$a]->STOKDAPATMINUS."', '".$jsondatabarang[$a]->JSONTAMBAHAN."', '".$jsondatabarang[$a]->CATATANPERBARANG."', '".$jsondatabarang[$a]->BRAND_ID."', '".$jsondatabarang[$a]->PRINCIPAL_ID."', '".$jsondatabarang[$a]->HARGAJUAL."', '".$jsondatabarang[$a]->HARGAJUALSEMENTARA."', '".$jsondatabarang[$a]->LOKASI."', '".$jsondatabarang[$a]->KODEUNIKMEMBER."','".$datasessionparameter[2]."','".$jsondatabarang[$a]->STATUSBARANGPROSES."'),";
		}
		$this->db->query("INSERT INTO 01_tms_keranjang (`AI`,`BARANG_ID`,`NAMA_BARANG`,`QTY`,`HARGA_JUAL`,`HARGA_BELI`,`POTONGANGLOBAL`,`DARIPERUSAHAAN`, `KETERANGAN`, `APAKAHVARIAN`,`STOKDAPATMINUS`,`JSONTAMBAHAN`,`CATATANPERBARANG`,`BRAND_ID`,`PRINCIPAL_ID`,`HARGAASLI`,`HARGAASLISEMENTARA`,`OUTLET`,`KODEUNIKMEMBER`,`KODEKOMPUTER`,`STATUSBARANGPROSES`) VALUES ".rtrim($bulkinsert, ','));
	}
}
