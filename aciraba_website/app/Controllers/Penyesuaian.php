<?php

namespace App\Controllers;
use App\Models\PenyesuaianModel;
use Config\Services;

class Penyesuaian extends BaseController
{
    protected $uri,$session,$breadcrumb,$sidetitle = "Penyesuaian";
	protected $datasessionparameter = [];	
	public function __construct()
    {
		$db = db_connect();
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
		$this->penyesuaianModel = new PenyesuaianModel($db);
		$this->session = \Config\Services::session();
        $this->session->start();
		array_push($this->datasessionparameter,
			$this->session->get("outlet"),
			$this->session->get("kodeunikmember"),
			$this->session->get("kodekomputer"),
		);
    }
	/* area algoritma pesanan pembelian */
	public function stokopname(){
		$this->breadcrumb  = array( 
			"Daftar Stok Opname" => base_url()."penyesuaian/stokopname",
		);
		$data = [
			"titleheader"=>"DAFTAR PENYESUIAN STOK",
			"menuaktif" => "8",
			"submenuaktif" => "-1",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/penyesuaian/kontendaftarstokopname',$data);
	}
	public function formpenyesuianstok(){
		$this->breadcrumb  = array( 
			"Daftar Penyesuaian Stok" => base_url()."penyesuaian/stokopname",
			"Transaksi Penyesuaian Stok" => base_url()."penyesuaian/formpenyesuianstok",
		);
		$data = [
			"titleheader"=>"FORM PENYESUIAN STOK",
			"menuaktif" => "8",
			"submenuaktif" => "-1",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/penyesuaian/kontendaftarpenyesuaianstok',$data);
	}
	public function daftaropnamelocal(){
		$data = array();
		
		array_push($data,service('request')->getPost('KATAKUNCIPENCARIAN'));
		$datajson = json_decode($this->penyesuaianModel->daftaropnamelocal($data,$this->datasessionparameter));
		$data = array();
		if ($datajson->adadata == "ada"){
			$kondisiopname = "";
			for ($no = 0; $no < $datajson->jumlahdata; $no++) {
				if ($datajson->datakeranjang[$no]->KONDISIOPNAME == "T"){$kondisiopname = "Stok Akhir [+]";}else if ($datajson->datakeranjang[$no]->KONDISIOPNAME == "K"){$kondisiopname = "Stok Akhir [-]";}else{$kondisiopname = "Stok Diganti";}
				$row = [];
				$row[] = "<button onclick=\"hapusperbarang('".$datajson->datakeranjang[$no]->KODEBARANG."','".$datajson->datakeranjang[$no]->NAMABARANG."')\" class=\"btn btn-danger btn-block\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = "<input readonly id=\"kodeitem".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->KODEBARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"namabarang".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"lokasi".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".($datajson->datakeranjang[$no]->LOKASIOPNAME == "D" ? "Display" : "Gudang")."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"stokdigital".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->STOKKOMPUTER."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"stokfisik".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->STOKOPNAME."\" class=\"form-control\">";
				$row[] = "<input readonly id=\"kondisi".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$kondisiopname."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"harga".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HPP."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"keterangan".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->INFORMASI."\" class=\"form-control\">";
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->jumlahdata,
				"recordsFiltered" => $datajson->jumlahdata,
				"data" => $data
			];
		}else{
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}
		return json_encode($outputDT);
	}
	public function tambahkekeranjangopname(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('NOTAOPNAME'),
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('NAMABARANG'),
			service('request')->getPost('LOKASIOPNAME'),
			service('request')->getPost('STOKKOMPUTER'),
			service('request')->getPost('STOKOPNAME'),
			service('request')->getPost('KONDISIOPNAME'),
			service('request')->getPost('OUTLET'),
			service('request')->getPost('KODEUNIKMEMBER'),
			service('request')->getPost('HPP'),
			service('request')->getPost('INFORMASI'),
		);
		return $simpan = $this->penyesuaianModel->add($data,$this->datasessionparameter);
	}
	public function updatekeranjangopname(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('NOTAOPNAME'),
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('STOKOPNAME'),
			service('request')->getPost('INFORMASI'),
		);
		return $simpan = $this->penyesuaianModel->updatekeranjangopname($data,$this->datasessionparameter);
	}
	public function hapusperbarang(){
		$data = [
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEKOMPUTER' => $this->session->get("kodekomputer"),
		];
		$proses = $this->penyesuaianModel->hapusperbarang($data);
		if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapuskeranjang(){
		$proses = $this->penyesuaianModel->truncate($this->datasessionparameter); if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function simpantransaksiopname(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'DETAILOPNAME'=> service('request')->getPost('DETAILOPNAME'),
			'NOTAOPNAME'=> service('request')->getPost('NOTAOPNAME'),
			'TOTALBARANG'=> service('request')->getPost('TOTALBARANG'),
			'TOTALSURPLUS'=> service('request')->getPost('TOTALSURPLUS'),
			'TOTALMINUS'=> service('request')->getPost('TOTALMINUS'),
			'TOTALOPANAME'=> service('request')->getPost('TOTALOPANAME'),
			'OUTLET'=>  $this->session->get("outlet"),
			'KODEUNIKMEMBER'=> $this->session->get("kodeunikmember"),
			'NOMOR'=> service('request')->getPost('NOMOR'),
			'KETERANGAN'=> service('request')->getPost('KETERANGAN'),
			'PETUGAS'=>  $this->session->get("pengguna_id"),
			'TANGGALTRS'=>  service('request')->getPost('TANGGALTRS'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penyesuaian/simpantransaksiopname", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function daftarpenyesuaianstok(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '21',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => service('request')->getPost('DIMANA2'),
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => service('request')->getPost('DIMANA4'),
			'DIMANA5' => service('request')->getPost('DIMANA5'),
			'DIMANA6' => $this->session->get("outlet"),
			'DIMANA7' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 50,
		];
		$json_data = $client->request("POST", BASEURLAPI."penyesuaian/daftarpenyesuaianstok", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<button onclick=\"daftardetailopname('".$datajson->hasiljson[0]->dataquery[$no]->NOTAOP."')\" class=\"btn btn-success\"><i class=\"fas fa-list-alt\"></i> Detail</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTAOP."<br>[".ucwords($datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA)."]";
				$row[] = number_format($datajson->hasiljson[0]->dataquery[$no]->TOTALBARANG,2,',','.')." Barang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALMINUS,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALSURPLUS,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALOPANAME,'Rp ');
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->OUTLET;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KETERANGAN;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->hasiljson[0]->totaldata,
				"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function daftardetailopname(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '22',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => service('request')->getPost('DIMANA2'),
			'DIMANA3' => $this->session->get("outlet"),
			'DIMANA4' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penyesuaian/daftardetailopname", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KODEBARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMABARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->LOKASIOPNAME == "D" ? "Lokasi Opname Display [".$datajson->hasiljson[0]->dataquery[$no]->KONDISIOPNAME."] " : "Lokasi Opname Gudang [".$datajson->hasiljson[0]->dataquery[$no]->KONDISIOPNAME."] " ;
				$row[] = number_format($datajson->hasiljson[0]->dataquery[$no]->STOKKOMPUTER,2,',','.')." Barang";
				$row[] = number_format($datajson->hasiljson[0]->dataquery[$no]->STOKOPNAME,2,',','.')." Barang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HPP,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->INFORMASI;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->hasiljson[0]->totaldata,
				"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
    /* area algoritma retur pembelian */
	public function mutasibarang(){
		$this->breadcrumb  = array( 
			"Daftar Mutasi Item" => base_url()."pembelian/mutasibarang",
		);
		$data = [
			"titleheader"=>"DAFTAR MUTASI BARANG",
			"menuaktif" => "9",
			"submenuaktif" => "-1",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/penyesuaian/kontendaftarmutasiitem',$data);
	}
	public function ajaxdaftarmutasi(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '23',
			'DIMANA1' => $this->session->get("outlet"),
			'DIMANA2' => $this->session->get("kodeunikmember"),
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => service('request')->getPost('DIMANA4'),
			'DIMANA5' => service('request')->getPost('DIMANA5'),
			'DIMANA6' => service('request')->getPost('DIMANA6'),
			'DIMANA7' => service('request')->getPost('DIMANA7'),
			'DIMANA8' => service('request')->getPost('DIMANA8'),
			'DIMANA9' => service('request')->getPost('DIMANA9'),
			'DIMANA10' => service('request')->getPost('DIMANA10'),
			'DIMANA11' => service('request')->getPost('DIMANA11'),
			'DATAKE' => 0,
			'LIMIT' => 50,
		];
		$json_data = $client->request("POST", BASEURLAPI."penyesuaian/ajaxdaftarmutasi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<button onclick=\"panggildetailmutasi('".$datajson->hasiljson[0]->dataquery[$no]->NOTRX."')\" class=\"btn btn-success\"><i class=\"fas fa-list-alt\"></i> Detail</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTRX;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TOTALMUTASIDATA." Barang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALNOMINALMUTASI,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->hasiljson[0]->totaldata,
				"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function formmutasiitem()
	{
		$this->breadcrumb  = array( 
			"Daftar Mutasi Item" => base_url()."pembelian/mutasibarang",
		);
		$data = [
			"titleheader"=>"FORMULIR MUTASI BARANG",
			"menuaktif" => "9",
			"submenuaktif" => "-1",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/penyesuaian/kotentambahmutasiitem',$data);
	}
	public function tambahkekeranjangmutasi(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('NOMORMUTASI'),
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('NAMABARANG'),
			service('request')->getPost('UNIT'),
			service('request')->getPost('STOKAWAL'),
			service('request')->getPost('STOKMUTASI'),
			service('request')->getPost('NOMINAL'),
			service('request')->getPost('ASALOUTLET'),
			service('request')->getPost('TUJUANOUTLET'),
			service('request')->getPost('ASALLOKASIITEM'),
			service('request')->getPost('TUJUANLOKASIITEM'),
			service('request')->getPost('OUTLET'),
			service('request')->getPost('KODEUNIKMEMBER'),
		);
		return $simpan = $this->penyesuaianModel->addmutasi($data,$this->datasessionparameter);
	}
	public function daftarmutasilocal(){
		$data = array();
		
		array_push($data,service('request')->getPost('KATAKUNCIPENCARIAN'));
		$datajson = json_decode($this->penyesuaianModel->daftarmutasilocal($data,$this->datasessionparameter));
		$data = array();
		if ($datajson->adadata == "ada"){
			for ($no = 0; $no < $datajson->jumlahdata; $no++) {
				$row = [];
				$row[] = "<button onclick=\"hapusperbarang('".$datajson->datakeranjang[$no]->KODEBARANG."','".$datajson->datakeranjang[$no]->NAMABARANG."','".$datajson->datakeranjang[$no]->AI."')\" class=\"btn btn-danger btn-block\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = "<input readonly id=\"kodeitem".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->KODEBARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"namabarang".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"unit".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->UNIT."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"stokawal".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->STOKAWAL."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"stokmutasi".$datajson->datakeranjang[$no]->KODEBARANG."".$no."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->STOKMUTASI."\" class=\"form-control\">";
				$row[] = "<input readonly id=\"nominal".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NOMINAL."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"asaloutlet".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->ASALOUTLET."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"tujuanoutlet".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->TUJUANOUTLET."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"asallokasi".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->ASALLOKASIITEM."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"tujuanlokasi".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->TUJUANLOKASIITEM."\" class=\"form-control-plaintext\">";
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->jumlahdata,
				"recordsFiltered" => $datajson->jumlahdata,
				"data" => $data
			];
		}else{
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}
		return json_encode($outputDT);
	}
	public function hapusperbarangmutasi(){
		$data = [
			'AI' => service('request')->getPost('AI'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEKOMPUTER' => $this->session->get("kodekomputer"),
		];
		$proses = $this->penyesuaianModel->hapusperbarangmutasi($data);
		if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapuskeranjangmutasi(){
		$proses = $this->penyesuaianModel->hapuskeranjangmutasi($this->datasessionparameter); if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function updatekeranjangmutasi(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('STOKMUTASI'),
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('ASALOUTLET'),
			service('request')->getPost('ASALLOKASIITEM'),
		);
		return $simpan = $this->penyesuaianModel->updatekeranjangmutasi($data,$this->datasessionparameter);
	}
	public function simpanmutasi(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'DETAILMUTASI'=> service('request')->getPost('DETAILMUTASI'),
			'NOMORMUTASI'=> service('request')->getPost('NOMORMUTASI'),
			'PETUGAS' => $this->session->get("pengguna_id"),
			'TANGGALTRS'=> service('request')->getPost('TANGGALTRS'),
			'OUTLET'=> $this->session->get("outlet"),
			'KODEUNIKMEMBER'=> $this->session->get("kodeunikmember"),
			'NOMOR'=>  service('request')->getPost('NOMOR'),
			'KETERANGAN'=> service('request')->getPost('KETERANGAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penyesuaian/simpanmutasi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function daftardetailmutasi(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '24',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penyesuaian/daftardetailmutasi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KODEBARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMABARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->UNIT;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->STOKAWAL;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->STOKMUTASI;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->NOMINAL,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ASALOUTLET;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ASALLOKASIITEM;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TUJUANOUTLET;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TUJUANLOKASIITEM;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->STOKMUTASI * $datajson->hasiljson[0]->dataquery[$no]->NOMINAL,'Rp ');
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->hasiljson[0]->totaldata,
				"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
}