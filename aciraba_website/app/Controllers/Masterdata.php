<?php

namespace App\Controllers;

class Masterdata extends BaseController{
	protected $uri,$session,$breadcrumb,$sidetitle = "Master Data";
	function __construct(){
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
    }
	public function panggilbarangglobal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '0',
			'DIMANA1' => '0',
			'DIMANA2' => service('request')->getPost('DIMANA2'),
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => service('request')->getPost('DIMANA4'),
			'DIMANA5' => "",
			'DIMANA6' => service('request')->getPost('DIMANA6'),
			'DIMANA7' => '1',
			'DIMANA8' => service('request')->getPost('DIMANA8'), /* untuk status aktif atau tidak */
			'DIMANA9' => '0',
			'DIMANA10' => service('request')->getPost('DIMANA10'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarbarang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->databarang[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->databarang[0]->totaldata; $no++) {
				$stokditampilkan = "";
				if (service('request')->getPost('DIMANA4') == "d"){
					$stokditampilkan = $datajson->databarang[0]->daftarbarang[$no]->DISPLAY;
				}else if (service('request')->getPost('DIMANA4') == "g") {
					$stokditampilkan = $datajson->databarang[0]->daftarbarang[$no]->GUDANG;
				}else if (service('request')->getPost('DIMANA4') == "r") {
					$stokditampilkan = $datajson->databarang[0]->daftarbarang[$no]->RETUR;
				}else{
					$stokditampilkan = $datajson->databarang[0]->daftarbarang[$no]->DISPLAY;
				}
				$row = [];
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->BARANG_ID;
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->NAMABARANG;
				$row[] = formatuang('IDR',$datajson->databarang[0]->daftarbarang[$no]->HARGAJUAL,'Rp ');
				$row[] = $stokditampilkan." ".$datajson->databarang[0]->daftarbarang[$no]->SATUAN;
				$row[] = "<div onclick=\"onclickplihbarang('".$datajson->databarang[0]->daftarbarang[$no]->BARANG_ID."','".$datajson->databarang[0]->daftarbarang[$no]->NAMABARANG."','".number_to_currency($datajson->databarang[0]->daftarbarang[$no]->HARGAJUAL,'IDR')."','".service('request')->getPost('KONDISIDARI')."')\"><button class=\"btn btn-primary\"><i class=\"fas fa-clipboard-check\"></i> Pilih Ini</button></div>";
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->databarang[0]->totaldata,
				"recordsFiltered" => $datajson->databarang[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	/* area algoritma daftar item */
	public function daftaritem(){
		$this->breadcrumb  = array( 
			"Daftar Item" => base_url()."masterdata/daftaritem",
		);
		$data = [
			"titleheader"=>"DAFTAR ITEM",
			"menuaktif" => "1",
			"submenuaktif" => "1",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"totalstok" => 0,
			"jenisbarang" => 0,
		];
		return view('backend/daftaritem/kontendaftaritem',$data);
	}
	public function jsonsuplierselect(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '15',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => '1',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => service('request')->getPost('DIMANA10'),
			'DATAKE' => '0',
			'LIMIT' => '100',
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarsuplierselect", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->datasuplier[0]->totaldata; $x++) {
			$jsontext .= '{"idsupplier": "'.$datajson->datasuplier[0]->daftarsuplier[$x]->KODESUPPLIER.'", "namasuplier": "'.$datajson->datasuplier[0]->daftarsuplier[$x]->NAMASUPPLIER.'", "telp": "'.$datajson->datasuplier[0]->daftarsuplier[$x]->NOTELP.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jsonkategoriselect(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '15',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => '2',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => service('request')->getPost('DIMANA10'),
			'DATAKE' => '0',
			'LIMIT' => '100',
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftakategoriselect", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->daftakategoriselect[0]->totaldata; $x++) {
			$jsontext .= '{"idkategori": "'.$datajson->daftakategoriselect[0]->daftarkategori[$x]->KATEGORIPARENT_ID.'", "namakategori": "'.$datajson->daftakategoriselect[0]->daftarkategori[$x]->NAMAKATEGORI.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function daftakategoriselectkasir(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAKATEGORI' => service('request')->getPost('NAMAKATEGORI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftakategoriselectkasir", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->daftakategoriselectkasir[0]->success == "false"){
			$jsontext = '{"success": "false"}';
		}else{
			$jsontext = '{"success": "true","totaldata": "'.$datajson->daftakategoriselectkasir[0]->totaldata.'","daftarkategori": [';
			for ($x = 0; $x < $datajson->daftakategoriselectkasir[0]->totaldata; $x++) {
				$jsontext .= '{"idkategori": "'.$datajson->daftakategoriselectkasir[0]->daftarkategori[$x]->KATEGORIPARENT_ID.'", "namakategori": "'.$datajson->daftakategoriselectkasir[0]->daftarkategori[$x]->NAMAKATEGORI.'", "logokategori": "'.$datajson->daftakategoriselectkasir[0]->daftarkategori[$x]->LOGOKATEGORI.'"},';	
			}
			$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
			$jsontext .= "]}";
		}
		return json_encode($jsontext);
	}
	public function kategoridompetdata(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' =>$this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/kategoridompetdata", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
	}
	public function jsonsatuanselect(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '15',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => '3',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => service('request')->getPost('DIMANA10'),
			'DATAKE' => '0',
			'LIMIT' => '100',
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarsatuanselect", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->daftarsatuanselect[0]->totaldata; $x++) {
			$jsontext .= '{"idsatuan": "'.$datajson->daftarsatuanselect[0]->daftarsatuan[$x]->NAMASATUAN.'", "namasatuan": "'.$datajson->daftarsatuanselect[0]->daftarsatuan[$x]->KETERANGAN.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jsonpilihperusahaan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAPERUSAHAAN' => service('request')->getPost('NAMAPERUSAHAAN'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarperusahaan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->daftarperusahaan[0]->totaldata; $x++) {
			$jsontext .= '{"kodepursahaan": "'.$datajson->daftarperusahaan[0]->daftarperusahaan[$x]->KODEPERUSAHAAN.'", "namaperusahaan": "'.$datajson->daftarperusahaan[0]->daftarperusahaan[$x]->NAMAPERUSAHAAN.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jenispembayarantransaksi(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAPARAMETER' => service('request')->getPost('NAMAPARAMETER'),
			'KODEUNIKMEMBER' =>$this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jenispembayarantransaksi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		$jsontext .= '{"kodetrx": "TUNAI", "namatrx": "Cash [Tunai]"},{"kodetrx": "KREDIT", "namatrx": "Kredit [Hutang]"},';
		for ($x = 0; $x < $datajson->jenispembayarantransaksi[0]->totaldata; $x++) {
			$jsontext .= '{"kodetrx": "'.$datajson->jenispembayarantransaksi[0]->jenispembayarantransaksi[$x]->BANK_ID.'", "namatrx": "'.$datajson->jenispembayarantransaksi[0]->jenispembayarantransaksi[$x]->NAMABANK.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1);
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jsonprincipal(){

		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAPRINCIPAL' => service('request')->getPost('NAMAPRINCIPAL'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarprincipal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->daftarprincipal[0]->totaldata; $x++) {
			$jsontext .= '{"kodeprincipal": "'.$datajson->daftarprincipal[0]->daftarprincipal[$x]->PRINCIPAL_ID.'", "namaperusahaan": "'.$datajson->daftarprincipal[0]->daftarprincipal[$x]->NAMA_PRINCIPAL.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jsonpilihbrand(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMABRAND' => service('request')->getPost('NAMABRAND'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarbrand", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->daftarbrand[0]->totaldata; $x++) {
			$jsontext .= '{"kodebrang": "'.$datajson->daftarbrand[0]->daftarbrand[$x]->BRAND_ID.'", "namabrand": "'.$datajson->daftarbrand[0]->daftarbrand[$x]->NAMA_BRAND.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jsonmemberselect(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODENAMAMEMBER' => service('request')->getPost('KODENAMAMEMBER'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jsonmemberselect", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->selectmember[0]->totaldata; $x++) {
			$jsontext .= '{"memberid": "'.$datajson->selectmember[0]->dataquery[$x]->MEMBER_ID.'", "namamember": "'.$datajson->selectmember[0]->dataquery[$x]->NAMA.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function jsontabeldaftaritem(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '0',
			'DIMANA1' => '0',
			'DIMANA2' => service('request')->getPost('DIMANA2'),
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => "s",
			'DIMANA5' => "",
			'DIMANA6' => service('request')->getPost('DIMANA6'),
			'DIMANA7' => '1',
			'DIMANA8' => service('request')->getPost('DIMANA8'), /* untuk status aktif atau tidak */
			'DIMANA9' => '0',
			'DIMANA10' => service('request')->getPost('DIMANA10'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarbarang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$no = 0;
		if ($datajson->databarang[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			$arraysession = [
				'jenisbarang'=> $datajson->databarang[0]->daftarbarang[0]->BARANG_ID,
			];
			$this->session->set($arraysession);
			for ($x = 1; $x <= $datajson->databarang[0]->totaldata; $x++) {
				$row = [];
				$row[] = "<a href=\"".base_url('masterdata/daftaritemdetail/'.urlencode($datajson->databarang[0]->daftarbarang[$no]->BARANG_ID))."\"><button class=\"btn btn-warning\"><i class=\"fas fa-edit\"></i></button></a> <button onclick=\"onclickdisableitem('".$datajson->databarang[0]->daftarbarang[$no]->BARANG_ID."','".$datajson->databarang[0]->daftarbarang[$no]->NAMABARANG."','".$datajson->databarang[0]->daftarbarang[$no]->AKTIF."')\" class=\"btn ".($datajson->databarang[0]->daftarbarang[$no]->AKTIF == 0 ? "btn-success" : "btn-danger")."\"> <i class=\"fas ".($datajson->databarang[0]->daftarbarang[$no]->AKTIF == 0 ? "fa-check" : "fa-stop-circle")."\"></i></button>";
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->DISPLAY;
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->GUDANG;
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->RETUR;
				$row[] = ($datajson->databarang[0]->daftarbarang[$no]->DISPLAY + $datajson->databarang[0]->daftarbarang[$no]->GUDANG + $datajson->databarang[0]->daftarbarang[$no]->RETUR);
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->BARANG_ID;
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->NAMABARANG;
				$row[] = "Rp ".number_format($datajson->databarang[0]->daftarbarang[$no]->HARGABELI, 2, ',', '.');
				$row[] = "Rp ".number_format($datajson->databarang[0]->daftarbarang[$no]->HARGAJUAL, 2, ',', '.');
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->NAMA_PRINCIPAL;
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->NAMAKATEGORI;
				$row[] = $datajson->databarang[0]->daftarbarang[$no]->NAMA_BRAND;
				$data[] = $row;
				$no++;
			} 
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->databarang[0]->totaldata,
				"recordsFiltered" => $datajson->databarang[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsonvoucherbarang(){
		
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISIAKSI' => service('request')->getPost('KONDISIAKSI'),/* digunakan untuk aksi delete atau select */
			'BARANGID' => service('request')->getPost('BARANGID'),
			'NAMAVOUCHER' => service('request')->getPost('NAMAVOUCHER'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarvoucherbarang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if (service('request')->getPost('KONDISIAKSI') == "hapusvoucher"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => "delete"
			];
			return json_encode($outputDT);
		}	
		if ($datajson->daftarvoucherbarang[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($x = 0; $x < $datajson->daftarvoucherbarang[0]->totaldata; $x++) {
				$row = [];
				$row[] = $datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->NAMAVOUCHER;
				$row[] = date("d-m-Y", strtotime($datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->AWALAKTIF));
				$row[] = date("d-m-Y", strtotime($datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->AKHIRAKTIF));
				$row[] = $datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->TIPEVOUCHER;
				$row[] = $datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->NOMINALRUPIAH;
				$row[] = $datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->NOMINALDISKON;
				$row[] = $datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->BATASTRANSAKSI." Trx";
				$row[] = number_to_currency($datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->MINIMALPEMBELIAN,'IDR');
				$row[] = "<div class=\"hapusvoucher\" onclick=\"onclickhapusvoucher('".$datajson->daftarvoucherbarang[0]->datadaftarvoucherbarang[$x]->NAMAVOUCHER."','hapusvoucher')\"><button class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus </button></div>";
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->daftarvoucherbarang[0]->totaldata,
				"recordsFiltered" => $datajson->daftarvoucherbarang[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function daftaritemdetail(){
		helper('url');
		$this->breadcrumb  = array( 
			"Daftar Item" => base_url()."masterdata/daftaritem",
			"Tambah Item" => base_url()."masterdata/daftaritemdetail",
		);
		$data = [
			"titleheader"=>"MASTER DATA",
			"menuaktif" => "1",
			"submenuaktif" => "1",
			"usedropzone" => true,
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
		];
		$data["BARANG_ID"] = "";
		$data["QRCODE_ID"] = "";
		$data["NAMABARANG"] = "";
		$data["BERAT_BARANG"] = "";
		$data["PARETO_ID"] = "";
		$data["NAMA_PRINCIPAL"] = "";
		$data["SUPPLER_ID"] = "";
		$data["KATEGORI_ID"] = "";
		$data["BRAND_ID"] = "";
		$data["KETERANGANBARANG"] = "";
		$data["HARGABELI"] = "";
		$data["HARGAJUAL"] = "";
		$data["SATUAN"] = "";
		$data["AKTIF"] = "";
		$data["KODEUNIKMEMBER"] = "";
		$data["APAKAHGROSIR"] = "";
		$data["STOKDAPATMINUS"] = "";
		$data["JENISBARANG"] = "";
		$data["PEMILIK"] = "";
		
		$data["ISGROSIR"] = "";
		$data["JUMLAHDATAHARGAGROSIR"] = "";
		$data["DATAHARGAGROSIR"] = "";
		$data["APAKAHBONUS"] = "";
		$data["JUMLAHDATABARANGTAMBAHAN"] = "";
		$data["DATAHARGATAMBAHAN"] = "";
		$data["TOTALGAMBAR"] = "0";
		$data["SEGMENT"] = $this->uri->getSegment(2);
		if ($this->uri->getSegment(3) != ""){
			$datajsoncitra = $this->daftarcitraitem(); /* return ajax fungsi ambil gambar dari database */
			$data["TOTALGAMBAR"] =  $datajsoncitra->manajemencitraitem[0]->totalcitraitem;
			$data["DAFTARCITRAITEM"] =  $datajsoncitra->manajemencitraitem[0]->datadaftarsatuan;
			$data["kodeitem"] = $this->uri->getSegment(3);
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "0",
				'DIMANA1' => "9",
				'DIMANA2' => urldecode($this->uri->getSegment(3)),
				'DIMANA3' => $this->session->get("outlet"),
				'DIMANA4' => $this->session->get("kodeunikmember"),
				'DIMANA5' => "8",
				'DIMANA6' => "10",
				'DIMANA7' => "12",
				'DIMANA8' => "",
				'DIMANA9' => "",
				'DIMANA10' => "",
				'DATAKE' => 0,
				'LIMIT' => 0,
			];
			$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarbarangdetail", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			$data["BARANG_ID"] = $datajson->databarang[0]->daftarbarang[0]->BARANG_ID;
			$data["QRCODE_ID"] = $datajson->databarang[0]->daftarbarang[0]->QRCODE_ID;
			$data["NAMABARANG"] = $datajson->databarang[0]->daftarbarang[0]->NAMABARANG;
			$data["BERAT_BARANG"] = $datajson->databarang[0]->daftarbarang[0]->BERAT_BARANG;
			$data["PARETO_ID"] = $datajson->databarang[0]->daftarbarang[0]->PARETO_ID;
			$data["NAMA_PRINCIPAL"] = $datajson->databarang[0]->daftarbarang[0]->NAMA_PRINCIPAL;
			$data["SUPPLER_ID"] = $datajson->databarang[0]->daftarbarang[0]->SUPPLER_ID;
			$data["NAMASUPPLIER"] = $datajson->databarang[0]->daftarbarang[0]->NAMASUPPLIER;
			$data["KATEGORI_ID"] = $datajson->databarang[0]->daftarbarang[0]->KATEGORI_ID;
			$data["NAMAKATEGORI"] = $datajson->databarang[0]->daftarbarang[0]->NAMAKATEGORI;
			$data["BRAND_ID"] = $datajson->databarang[0]->daftarbarang[0]->BRAND_ID;
			$data["NAMA_BRAND"] = $datajson->databarang[0]->daftarbarang[0]->NAMA_BRAND;
			$data["KETERANGANBARANG"] = $datajson->databarang[0]->daftarbarang[0]->KETERANGANBARANG;
			$data["HARGABELI"] = $datajson->databarang[0]->daftarbarang[0]->HARGABELI;
			$data["HARGAJUAL"] = $datajson->databarang[0]->daftarbarang[0]->HARGAJUAL;
			$data["SATUAN"] = $datajson->databarang[0]->daftarbarang[0]->SATUAN;
			$data["NAMASATUAN"] = $datajson->databarang[0]->daftarbarang[0]->KETERANGAN;
			$data["AKTIF"] = $datajson->databarang[0]->daftarbarang[0]->AKTIF;
			$data["KODEUNIKMEMBER"] = $datajson->databarang[0]->daftarbarang[0]->KODEUNIKMEMBER;
			$data["STOKDAPATMINUS"] = $datajson->databarang[0]->daftarbarang[0]->STOKDAPATMINUS;
			$data["JENISBARANG"] = $datajson->databarang[0]->daftarbarang[0]->JENISBARANG;
			$data["PEMILIK"] = $datajson->databarang[0]->daftarbarang[0]->PEMILIK;
			$data["NAMAPERUSAHAAN"] = $datajson->databarang[0]->daftarbarang[0]->NAMAPERUSAHAAN;
			
			$data["APAKAHGROSIR"] = $datajson->databarang[0]->daftarbarang[0]->APAKAHGROSIR;
			$data["JUMLAHDATAHARGAGROSIR"] =  $datajson->databarang[0]->totaldatabestbuygrosir;
			$data["DATAHARGAGROSIR"] =  $datajson->databarang[0]->bestbuygrosir;

			$data["APAKAHBONUS"] = $datajson->databarang[0]->daftarbarang[0]->APAKAHBONUS;
			$data["JUMLAHDATABARANGTAMBAHAN"] =  $datajson->databarang[0]->totaldatabarangtambahan;
			$data["DATAHARGATAMBAHAN"] =  $datajson->databarang[0]->bestbuytambahbarang;
		}
		return view('backend/daftaritem/kontentambahitem',$data);
	}
	public function tambahitemajax(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ISINSERT' => service('request')->getPost('ISINSERT'),
			/* send to node js API informasi dasar area*/
			'BARANG_ID' => service('request')->getPost('BARANG_ID'),
			'QRCODE_ID' => service('request')->getPost('QRCODE_ID'),
			'NAMABARANG' => service('request')->getPost('NAMABARANG'),
			'BERAT_BARANG' => service('request')->getPost('BERAT_BARANG'),
			'PARETO_ID' => service('request')->getPost('PARETO_ID'),
			'SUPPLER_ID' => service('request')->getPost('SUPPLER_ID'),
			'KATEGORI_ID' => service('request')->getPost('KATEGORI_ID'),
			'BRAND_ID' => service('request')->getPost('BRAND_ID'),
			'KETERANGANBARANG' => service('request')->getPost('KETERANGANBARANG'),
			'HARGABELI' => service('request')->getPost('HARGABELI'),
			'HARGAJUAL' => service('request')->getPost('HARGAJUAL'),
			'SATUAN' => service('request')->getPost('SATUAN'),
			'AKTIF' => service('request')->getPost('AKTIF'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'JASA' => service('request')->getPost('JASA'),
			'APAKAHGROSIR' => service('request')->getPost('APAKAHGROSIR'),
			'STOKDAPATMINUS' => service('request')->getPost('STOKDAPATMINUS'),
			'JENISBARANG' => service('request')->getPost('JENISBARANG'),
			'PEMILIK' => service('request')->getPost('PEMILIK'),
			/* send to node js API harga grosir*/
			'ISHARGAGROSIRAKTIF'=>service('request')->getPost('ISHARGAGROSIRAKTIF'),
            'JSONHARGAGROSIR'=>service('request')->getPost('JSONHARGAGROSIR'),
			'OUTLETSESSION'=>$this->session->get("outlet"),
			'ISBARANGTAMBAHAN'=>service('request')->getPost('ISBARANGTAMBAHAN'),
            'JSONBARANGTAMBAHAN'=>service('request')->getPost('JSONBARANGTAMBAHAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahbarangitem", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasilinserttambahitem[0]);
	}
	public function tambahitemajaxbulk(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'INFORMASIBARANG' => service('request')->getPost('INFORMASIBARANG'),
			'JUMLAHDATA' => service('request')->getPost('JUMLAHDATA'),
			'OUTLET' => $this->session->get("outlet"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahitemajaxbulk", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->hasiljson[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->hasiljson[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function tambahpecahstokjax(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'AI' => service('request')->getPost('AI'),
			'IDBARANGASAL' => service('request')->getPost('IDBARANGASAL'),
			'NAMAVOUCHER' => service('request')->getPost('NAMAVOUCHER'),
			'IDBARANGBARU' => service('request')->getPost('IDBARANGBARU'),
			'ASALPECAH' => service('request')->getPost('ASALPECAH'),
			'MENJADI' => service('request')->getPost('MENJADI'),
			'HARGAJUAL' => service('request')->getPost('HARGAJUAL'),
			'HARGABELI' => service('request')->getPost('HARGABELI'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'KASIR' => service('request')->getPost('KASIR'),
			'NAMABARANGSEBELUM' => service('request')->getPost('NAMABARANGSEBELUM'),
			'NAMABARANGSESUDAH' => service('request')->getPost('NAMABARANGSESUDAH'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/pecahsatuan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$no = 0;
		return json_encode($datajson->pecahsatuan[0]);
	}
	public function tambahvoucherjax(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'VOUCHER_ID' => service('request')->getPost('VOUCHER_ID'),
			'BARANGID' => service('request')->getPost('BARANGID'),
			'NAMAVOUCHER' => service('request')->getPost('NAMAVOUCHER'),
			'AWALAKTIF' => service('request')->getPost('AWALAKTIF'),
			'AKHIRAKTIF' => service('request')->getPost('AKHIRAKTIF'),
			'TIPEVOUCHER' => service('request')->getPost('TIPEVOUCHER'),
			'NOMINALRUPIAH' => service('request')->getPost('NOMINALRUPIAH'),
			'NOMINALDISKON' => service('request')->getPost('NOMINALDISKON'),
			'BATASTRANSAKSI' => service('request')->getPost('BATASTRANSAKSI'),
			'MINIMALPEMBELIAN' => service('request')->getPost('MINIMALPEMBELIAN'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'OUTLET' => service('request')->getPost('OUTLET'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahbarangvoucher", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$no = 0;
		if ($datajson->hasilinserttambahitem[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->hasilinserttambahitem[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->hasilinserttambahitem[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function rebuildstok(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEITEM' => service('request')->getPost('KODEITEM'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'NAMAITEM' => service('request')->getPost('NAMAITEM'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/rebuildstok", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$jsondecode = json_decode($json_data->getBody());
		$no = 0;
		if ($jsondecode->datajson[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$jsondecode->datajson[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$jsondecode->datajson[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function uploadcitra(){
		helper('form');
		$pesanaksi =array();
		$this->form_validation = \Config\Services::validation();
		$file = $this->request->getFile('userfile');
		$kodeunikmember = service('request')->getPost('kodeunikmember');
		$kodeitem = service('request')->getPost('kodeitem');
		$tanggalclient = service('request')->getPost('tanggalclient');
		$namaacak = 'ACIPAY_'.$kodeitem.'_'.$kodeunikmember.'_'.$tanggalclient.'_'.str_replace(' ','',$file->getName());
		$namaasli = $file->getName();
		if ($kodeitem == ""){
			array_push($pesanaksi,"GAGAL");
			array_push($pesanaksi,"Citra ".$namaasli. " Gagal diupload, silahkan hapus dan isikan informasi barang dengan benar termasuk KODEITEM, NAMA BARANG, SUPLIER dan lain lain");
		}else{
			$rules = [
				'userfile' => [
					'rules' => 'uploaded[userfile]|is_image[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png]|max_size[userfile,1024]',
					'errors' => [
						'uploaded' => 'Masukkan minimal 1 citra untuk produk ini',
						'mime_in' => 'Yang anda pilih bukan murni gambar',
						'max_size' => 'File yang anda masukkan terlalu besar, maksimal 1Mb',
					]
				],
			];
			if(!$this->validate($rules)){
				array_push($pesanaksi,"GAGAL");
				array_push($pesanaksi,"Citra ".$namaasli. " ". $this->form_validation->getError('userfile'));
			}else{
				if ($file->move('upload/citraitem/',$namaacak)){
					$client = \Config\Services::curlrequest();
					$datapost = [
						'KONDISI' => "tambah",
						'AI' => "",
						'KODEITEM' => $kodeitem,
						'FILENAME' => $namaacak,
						'GAMBARUTAMA' => "0",
						'KODEUNIKMEMBER' => $kodeunikmember,
					];
					$json_data = $client->request("POST", BASEURLAPI."masterdata/manajemencitraitem", [
						"headers" => [
							"Accept" => "application/json",
							"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
						],
						"form_params" => $datapost
					]);
					array_push($pesanaksi,"SUKSES");
					array_push($pesanaksi,"Citra ".$namaasli." berhasil di unggah ke server");
				}
			}
		}
		return json_encode($pesanaksi);
	}
	public function pilihcitrautama(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "update",
			'AI' => service('request')->getPost('IDCITRA'),
			'KODEITEM' => service('request')->getPost('KODEITEM'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/manajemencitraitem", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->manajemencitraitem[0]);
	}
	public function deletefilephp(){
		if( file_exists(BASEROOTFILE.'citraitem/'.service('request')->getPost('filehapus')) ) {
			unlink(BASEROOTFILE.'citraitem/'.service('request')->getPost('filehapus'));
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "hapus",
				'AI' => "",
				'KODEITEM' => service('request')->getPost('kodeitem'),
				'FILENAME' => service('request')->getPost('filehapus'),
				'GAMBARUTAMA' => "0",
				'KODEUNIKMEMBER' => service('request')->getPost('kodeunikmember'),
			];
			$json_data = $client->request("POST", BASEURLAPI."masterdata/manajemencitraitem", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			return json_encode($datajson->manajemencitraitem[0]);
		}
	}
	public function daftarcitraitem(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "list",
			'AI' => "",
			'KODEITEM' => $this->uri->getSegment(3),
			'FILENAME' => "",
			'GAMBARUTAMA' => "0",
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/manajemencitraitem", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		return json_decode($json_data->getBody());
	}
	/* area algoritma kartu stok */
	public function daftarkartustok(){
		$this->breadcrumb  = array( 
			"Kartu Stok" => base_url()."masterdata/daftarkartustok",
		);
		$data = [
			"titleheader"=>"KARTU STOK ITEM",
			"menuaktif" => "1",
			"submenuaktif" => "2",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		$data["SEGMENT"] = $this->uri->getSegment(2);
		return view('backend/daftaritem/kontenkartustok',$data);
	}
	public function jsonproseskartustok(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '14',
			'DIMANA1' => service('request')->getPost('KODEITEM'),
			'DIMANA2' => service('request')->getPost('ORDERBY'),
			'DIMANA3' => service('request')->getPost('JENISARUSBARANG'),
			'DIMANA4' => service('request')->getPost('DATAJENIS'),
			'DIMANA5' => service('request')->getPost('KONDISIPERIODE'),
			'DIMANA6' => service('request')->getPost('PERIODEAWAL'),
			'DIMANA7' => service('request')->getPost('PERIODEAKHIR'),
			'DIMANA8' => service('request')->getPost('OUTLET'),
			'DIMANA9' => service('request')->getPost('KODEUNIKMEMBER'),
			'DIMANA10' => '',
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/kartustok", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->kartustok[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->kartustok[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = $datajson->kartustok[0]->dataquery[$no]->NAMABARANG;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->NOTRANSAKSI;
				$row[] = date("d-m-Y H:i:s", strtotime($datajson->kartustok[0]->dataquery[$no]->TANGGALTRANSAKSI));
				$row[] = $datajson->kartustok[0]->dataquery[$no]->TIPE;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->KETERANGAN;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->MASUK;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->MUTASI;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->OPNAME;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->KELUAR;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->SALDO;
				$row[] = $datajson->kartustok[0]->dataquery[$no]->SALDOSEMUA;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->kartustok[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->kartustok[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	/* area algoritma diskon barang */
	public function daftardiskonitem(){
		
		$this->breadcrumb  = array( 
			"Daftar Diskon Item Stok" => base_url()."masterdata/daftardiskonitem",
	   	);
		$data = [
			"titleheader"=>"DAFTAR DISKON ITEM",
			"menuaktif" => "1",
			"submenuaktif" => "3",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			

		];
		return view('backend/daftaritem/kontendaftardiskon',$data);
	}
	public function jsontampildiskonbelanja(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '22',
			'DIMANA1' => service('request')->getPost('KODEITEM'),
			'DIMANA2' => service('request')->getPost('KODEUNIKMEMBER'),
			'DIMANA3' => service('request')->getPost('OUTLET'),
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => '',
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/diskonpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->diskonpenjualan[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->diskonpenjualan[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<div onclick=\"onclickhapus('". $datajson->diskonpenjualan[0]->dataquery[$no]->BARANG_ID."','".$datajson->diskonpenjualan[0]->dataquery[$no]->NAMABARANG."','".$this->session->get("kodeunikmember")."')\"><button class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button></div>";
				$row[] = $datajson->diskonpenjualan[0]->dataquery[$no]->BARANG_ID;
				$row[] = $datajson->diskonpenjualan[0]->dataquery[$no]->NAMABARANG;
				$row[] = number_to_currency($datajson->diskonpenjualan[0]->dataquery[$no]->MINBELITINGKAT1, 'IDR');
				$row[] = $datajson->diskonpenjualan[0]->dataquery[$no]->DISCNONMEMBER1 < 99 ? $datajson->diskonpenjualan[0]->dataquery[$no]->DISCNONMEMBER1.' %' : number_to_currency($datajson->diskonpenjualan[0]->dataquery[$no]->DISCNONMEMBER1,'IDR') ;
				$row[] = $datajson->diskonpenjualan[0]->dataquery[$no]->DISCMEMBER1 < 99 ? $datajson->diskonpenjualan[0]->dataquery[$no]->DISCMEMBER1.'%' : number_to_currency($datajson->diskonpenjualan[0]->dataquery[$no]->DISCMEMBER1,'IDR');
				$row[] = number_to_currency($datajson->diskonpenjualan[0]->dataquery[$no]->MINBELITINGKAT2, 'IDR');
				$row[] = $datajson->diskonpenjualan[0]->dataquery[$no]->DISCNONMEMBER2 < 99 ? $datajson->diskonpenjualan[0]->dataquery[$no]->DISCNONMEMBER2.' %' : number_to_currency($datajson->diskonpenjualan[0]->dataquery[$no]->DISCNONMEMBER2,'IDR');
				$row[] = $datajson->diskonpenjualan[0]->dataquery[$no]->DISCMEMBER2 < 99 ? $datajson->diskonpenjualan[0]->dataquery[$no]->DISCMEMBER2.' %' : number_to_currecy($datajson->diskonpenjualan[0]->dataquery[$no]->DISCMEMBER2,'IDR');
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->diskonpenjualan[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->diskonpenjualan[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function tambahdiskonitem(){
		
		$this->breadcrumb  = array( 
			"Daftar Diskon Item Stok" => base_url()."masterdata/daftardiskonitem",
			"Tambah DiskonItem" => base_url()."masterdata/tambahdiskonitem",
		);
		$data = [
			"titleheader"=>"TAMBAH DISKON ITEM",
			"menuaktif" => "1",
			"submenuaktif" => "3",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		$data["SEGMENT"] = $this->uri->getSegment(2);
		return view('backend/daftaritem/kontentambahdiskon',$data);
	}
	public function jsontambahdiskonbarang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'DISKONID' => service('request')->getPost('DISKONID'),
			'BARANGID' => service('request')->getPost('BARANGID'),
			'MINBELITINGKAT1' => service('request')->getPost('MINBELITINGKAT1'),
			'DISCMEMBER1' => service('request')->getPost('DISCMEMBER1'),
			'DISCNONMEMBER1' => service('request')->getPost('DISCNONMEMBER1'),
			'MINBELITINGKAT2' => service('request')->getPost('MINBELITINGKAT2'),
			'DISCMEMBER2' => service('request')->getPost('DISCMEMBER2'),
			'DISCNONMEMBER2' => service('request')->getPost('DISCNONMEMBER2'),
			'KATEGORI' => service('request')->getPost('KATEGORI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'OUTLET' => service('request')->getPost('OUTLET'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahdiskonpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->tambahdiskonpenjualan[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->tambahdiskonpenjualan[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->tambahdiskonpenjualan[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function jsonhapusdiskonbarang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEITEM' => service('request')->getPost('KODEITEM'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'NAMABARANG' => service('request')->getPost('NAMABARANG'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapusdiskonpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hapusdiskonpenjualan[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->hapusdiskonpenjualan[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->hapusdiskonpenjualan[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	/* area algoritma kupon diskon barang */
	public function daftarkuponbelanja(){
		$this->breadcrumb  = array( 
			"Kupon Belanja" => base_url()."masterdata/daftarkuponbelanja",
	   	);
		$data = [
			"titleheader"=>"DAFTAR KUPON BELANJA",
			"menuaktif" => "1",
			"submenuaktif" => "4",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarkupon',$data);
	}
	public function jsontampilvoucherbelanja(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '21',
			'DIMANA1' => service('request')->getPost('KODEVOUCHER'),
			'DIMANA2' => service('request')->getPost('OUTLET'),
			'DIMANA3' => service('request')->getPost('KODEUNIKMEMBER'),
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => $this->session->get("kodeunikmember"),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/kuponbelanja", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->kuponbelanja[0]->success == "false"){
			$outputDT = [
				"draw" => 0,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->kuponbelanja[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<div onclick=\"onclickhapus('". $datajson->kuponbelanja[0]->dataquery[$no]->NAMAVOUCHER ."','".$this->session->get("kodeunikmember")."')\"><button class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button></div>";
				$row[] = $datajson->kuponbelanja[0]->dataquery[$no]->NAMAVOUCHER;
				$row[] = date("d-m-Y", strtotime($datajson->kuponbelanja[0]->dataquery[$no]->AWALAKTIF));
				$row[] = date("d-m-Y", strtotime($datajson->kuponbelanja[0]->dataquery[$no]->AKHIRAKTIF));
				$row[] = $datajson->kuponbelanja[0]->dataquery[$no]->TIPEVOUCHER;
				$row[] = formatuang('IDR',$datajson->kuponbelanja[0]->dataquery[$no]->NOMINALRUPIAH,'Rp ');
				$row[] = $datajson->kuponbelanja[0]->dataquery[$no]->NOMINALDISKON." %";
				$row[] = $datajson->kuponbelanja[0]->dataquery[$no]->BATASTRANSAKSI;
				$row[] = formatuang('IDR',$datajson->kuponbelanja[0]->dataquery[$no]->MINIMALPEMBELIAN,'Rp ');
				$row[] = $datajson->kuponbelanja[0]->dataquery[$no]->OUTLET;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->kuponbelanja[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->kuponbelanja[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function tambahkuponbelanja(){
		
		$this->breadcrumb  = array( 
			"Kupon Belanja" => base_url()."masterdata/daftarkuponbelanja",
			"Tambah Kupon Belanja" => base_url()."masterdata/tambahkuponbelanja",
	   	);
		$data = [
			"titleheader"=>"TAMBAH KUPON BELANAJA",
			"menuaktif" => "1",
			"submenuaktif" => "4",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontentambahkupon',$data);
	}
	public function jsontambahkuponbelanja(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'VOUCHER_ID' => service('request')->getPost('VOUCHER_ID'),
			'NAMAVOUCHER' => service('request')->getPost('NAMAVOUCHER'),
			'AWALAKTIF' => service('request')->getPost('AWALAKTIF'),
			'AKHIRAKTIF' => service('request')->getPost('AKHIRAKTIF'),
			'TIPEVOUCHER' => service('request')->getPost('TIPEVOUCHER'),
			'NOMINALRUPIAH' => service('request')->getPost('NOMINALRUPIAH'),
			'NOMINALDISKON' => service('request')->getPost('NOMINALDISKON'),
			'BATASTRANSAKSI' => service('request')->getPost('BATASTRANSAKSI'),
			'MINIMALPEMBELIAN' => service('request')->getPost('MINIMALPEMBELIAN'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'OUTLET' => service('request')->getPost('OUTLET'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahkuponbelanja", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->tambahkuponbelanja[0]);
	}
	public function jsonhapuskuponbelanja(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAVOUCHER' => service('request')->getPost('NAMAVOUCHER'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapuskuponbelanja", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hapuskuponbelanja[0]);
	}
	/* area algoritma daftar suplier */
	public function daftarsuplier(){
		$this->breadcrumb  = array( 
			"Daftar Suplier" => base_url()."masterdata/daftarsuplier",
	   	);
		$data = [
			"titleheader"=> "DAFTAR SUPLIER ANDA",
			"menuaktif" => "2",
			"submenuaktif" => "5",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarsuplier',$data);
	}
	public function ajaxdaftarsuplier(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '19',
			'DIMANA1' => '',
			'DIMANA2' => '1',
			'DIMANA3' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => $this->session->get("kodeunikmember"),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastersuplier", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->mastersuplier[0]->success == "false"){
			$outputDT = [
				"draw" => 0,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->mastersuplier[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<button onclick=\"onclickhapussuplier('". $datajson->mastersuplier[0]->dataquery[$no]->KODESUPPLIER."','".$datajson->mastersuplier[0]->dataquery[$no]->NAMASUPPLIER."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button> <a href=\"".base_url('masterdata/detailsuplier/'.$datajson->mastersuplier[0]->dataquery[$no]->KODESUPPLIER)."\"><button class=\"btn btn-warning\"><i class=\"fas fa-edit\"></i></button>";
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->KODESUPPLIER;
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->NAMASUPPLIER;
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->PROVINSI;
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->KOTAKAB;
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->ALAMAT;
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->NOTELP;
				$row[] = $datajson->mastersuplier[0]->dataquery[$no]->EMAIL;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->mastersuplier[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->mastersuplier[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsontambahsuplier(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'SUPPLIER_AI' => service('request')->getPost('SUPPLIER_AI'),
			'KODESUPPLIER' => service('request')->getPost('KODESUPPLIER'),
			'NAMASUPPLIER' => service('request')->getPost('NAMASUPPLIER'),
			'NEGARA' => service('request')->getPost('NEGARA'),
			'PROVINSI' => service('request')->getPost('PROVINSI'),
			'KOTAKAB' => service('request')->getPost('KOTAKAB'),
			'KECAMATAN' => service('request')->getPost('KECAMATAN'),
			'ALAMAT' => service('request')->getPost('ALAMAT'),
			'NOTELP' => service('request')->getPost('NOTELP'),
			'NAMABANK' => service('request')->getPost('NAMABANK'),
			'NOREK' => service('request')->getPost('NOREK'),
			'ATASNAMA' => service('request')->getPost('ATASNAMA'),
			'EMAIL' => service('request')->getPost('EMAIL'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'ISINSERT' => service('request')->getPost('ISINSERT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahmastersuplier", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->tambahmastersuplier[0]);
	}
	public function jsonhapusdaftarsuplier(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'NAMASUPLIER' => service('request')->getPost('NAMASUPLIER'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapusmastersuplier", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hapusmastersuplier[0]);
	}
	public function detailsuplier(){
		helper('url');
		$this->breadcrumb  = array( 
			"Daftar Suplier" => base_url()."masterdata/daftarsuplier",
			"Tambah Suplier" => base_url()."masterdata/detailsuplier",
		);
		$data = [
			"titleheader"=> $this->uri->getSegment(3) == "" ? "TAMBAH SUPLIER BARU" : "UBAH DATA SUPLIER ",
			"menuaktif" => "2",
			"submenuaktif" => "5",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"kodeitem" => "",
		];
		$data['KODESUPPLIER'] = "";
		$data['NAMASUPPLIER'] = "";
		$data['NEGARA'] = "INDONESIA";
		$data['PROVINSI'] = "";
		$data['KOTAKAB'] = "";
		$data['KECAMATAN'] = "";
		$data['ALAMAT'] = "";
		$data['NOTELP'] = "";
		$data['EMAIL'] = "";
		$data['NAMABANK'] = "";
		$data['NOREK'] = "";
		$data['ATASNAMA'] = "";
		if ($this->uri->getSegment(3) != ""){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => '19',
				'DIMANA1' => '',
				'DIMANA2' => '1',
				'DIMANA3' => $this->uri->getSegment(3),
				'DIMANA4' => '',
				'DIMANA5' => '',
				'DIMANA6' => '',
				'DIMANA7' => '',
				'DIMANA8' => '',
				'DIMANA9' => '',
				'DIMANA10' => $this->session->get("kodeunikmember"),
				'DATAKE' => 0,
				'LIMIT' => 1,
			];
			$json_data = $client->request("POST", BASEURLAPI."masterdata/mastersuplier", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());	
			$data['KODESUPPLIER'] = $datajson->mastersuplier[0]->dataquery[0]->KODESUPPLIER;
			$data['NEGARA'] = "INDONESIA";
			$data['NAMASUPPLIER'] = $datajson->mastersuplier[0]->dataquery[0]->NAMASUPPLIER;
			$data['PROVINSI'] = $datajson->mastersuplier[0]->dataquery[0]->PROVINSI;
			$data['KOTAKAB'] = $datajson->mastersuplier[0]->dataquery[0]->KOTAKAB;
			$data['KECAMATAN'] = $datajson->mastersuplier[0]->dataquery[0]->KECAMATAN;
			$data['ALAMAT'] = $datajson->mastersuplier[0]->dataquery[0]->ALAMAT;
			$data['NOTELP'] = $datajson->mastersuplier[0]->dataquery[0]->NOTELP;
			$data['EMAIL'] = $datajson->mastersuplier[0]->dataquery[0]->EMAIL;
			$data['NAMABANK'] = $datajson->mastersuplier[0]->dataquery[0]->NAMABANK;
			$data['NOREK'] = $datajson->mastersuplier[0]->dataquery[0]->NOREK;
			$data['ATASNAMA'] = $datajson->mastersuplier[0]->dataquery[0]->ATASNAMA;
		}
		return view('backend/daftaritem/kontentambahsuplier',$data);
	}
	/* area algoritma daftar member */
	public function daftarmember(){
		$this->breadcrumb  = array( 
			"Daftar Suplier" => base_url()."masterdata/daftarmember",
		);
		$data = [
			"titleheader"=>"DAFTAR ANGGOTA ANDA",
			"menuaktif" => "2",
			"submenuaktif" => "6",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarmember',$data);
	}
	public function detailmember(){
		
		$this->breadcrumb  = array( 
			"Daftar Anggota" => base_url()."masterdata/daftarmember",
			"Detail Informasi Anggota" => base_url()."masterdata/detailmember",
		);
		$data = [
			"titleheader"=>"DAFTAR ANGGOTA ANDA",
			"menuaktif" => "2",
			"submenuaktif" => "6",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		$data['TOTALPENJUALAN'] = "0";
		$data['TOTALTRX'] = "0";
		$data['POIN'] = "0";
		$data['DEPOSIT'] = "0";
		$data['MEMBER_ID'] = "";
		$data['NAMAD'] = "";
		$data['NAMAB'] = "";
		$data['JK'] = "";
		$data['ALAMAT'] = "";
		$data['KOTA'] = "";
		$data['KODEPOS'] = "";
		$data['TELEPON'] = "";
		$data['EMAIL'] = "";
		$data['KETERANGAN'] = "";
		$data['LIMITJUMLAHPIUTANG'] = "";
		$data['BATASTAMBAHKREDIT'] = "";
		$data['MINIMALPOIN'] = "";
		$data['LIMIT_BRG'] = "";
		$data['PROVINSI'] = "";
		$data['JENIS'] = "";
		$data['GRUP'] = "";
		$data['STATUSAKTIF'] = "";
		$data['AKHIRAKTIFA'] = "";
		$data['PINTRX'] = "";
		$data['APIKEY'] = "";
		$data['MARKUP'] = "";
		$data['USERNAME'] = "";
		$data['PASSWORD'] = "";
		$data['KECAMATAN'] = "";
		$data['KODEUNIKMEMBER'] = $this->session->get("kodeunikmember");
		if ($this->uri->getSegment(3) != ""){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => '16',
				'DIMANA1' => $this->session->get("kodeunikmember"),
				'DIMANA2' => '3',
				'DIMANA3' => $this->uri->getSegment(3),
				'DIMANA4' => '',
				'DIMANA5' => '',
				'DIMANA6' => '',
				'DIMANA7' => '',
				'DIMANA8' => '',
				'DIMANA9' => '',
				'DIMANA10' => '',
				'DATAKE' => 0,
				'LIMIT' => 1,
			];
			$json_data = $client->request("POST", BASEURLAPI."masterdata/detailmember", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			$data['TOTALPENJUALAN'] = thousandsCurrencyFormat($datajson->detailmember[0]->dataquery[0]->OMSET);
			$data['TOTALTRX'] = thousandsCurrencyFormat($datajson->detailmember[0]->dataquery[0]->TOTALTRX);
			$data['POIN'] = thousandsCurrencyFormat($datajson->detailmember[0]->dataquery[0]->POINT);
			$data['DEPOSIT'] = thousandsCurrencyFormat($datajson->detailmember[0]->dataquery[0]->DEPOSIT);
			$data['MEMBER_ID'] = $datajson->detailmember[0]->dataquery[0]->MEMBER_ID;
			$ret = explode('::', $datajson->detailmember[0]->dataquery[0]->NAMA);
			$data['NAMAD'] = $ret[0];
			$data['NAMAB'] = empty($ret[1]) == true ? "" : $ret[1];
			$data['ALAMAT'] = $datajson->detailmember[0]->dataquery[0]->ALAMAT;
			$data['JK'] = $datajson->detailmember[0]->dataquery[0]->JK;
			$data['KOTA'] = $datajson->detailmember[0]->dataquery[0]->KOTA;
			$data['KODEPOS'] = $datajson->detailmember[0]->dataquery[0]->KODEPOS;
			$data['TELEPON'] = $datajson->detailmember[0]->dataquery[0]->TELEPON;
			$data['EMAIL'] = $datajson->detailmember[0]->dataquery[0]->EMAIL;
			$data['KETERANGAN'] = $datajson->detailmember[0]->dataquery[0]->KETERANGAN;
			$data['LIMITJUMLAHPIUTANG'] = $datajson->detailmember[0]->dataquery[0]->LIMITJUMLAHPIUTANG;
			$data['BATASTAMBAHKREDIT'] = $datajson->detailmember[0]->dataquery[0]->BATASTAMBAHKREDIT;
			$data['MINIMALPOIN'] = $datajson->detailmember[0]->dataquery[0]->MINIMALPOIN;
			$data['LIMIT_BRG'] = $datajson->detailmember[0]->dataquery[0]->LIMIT_BRG;
			$data['PROVINSI'] = $datajson->detailmember[0]->dataquery[0]->PROVINSI;
			$data['KECAMATAN'] = $datajson->detailmember[0]->dataquery[0]->KECAMATAN;
			$data['JENIS'] = $datajson->detailmember[0]->dataquery[0]->JENIS;
			$data['GRUP'] = $datajson->detailmember[0]->dataquery[0]->GRUP;
			$data['STATUSAKTIF'] = $datajson->detailmember[0]->dataquery[0]->STATUSAKTIF;
			$data['AKHIRAKTIFA'] = date("Y-m-d", strtotime($datajson->detailmember[0]->dataquery[0]->AKHIRAKTIF));
			$data['PINTRX'] = "";
			$data['APIKEY'] = $datajson->detailmember[0]->dataquery[0]->APIKEY;
			$data['MARKUP'] = $datajson->detailmember[0]->dataquery[0]->MARKUP;
			$data['USERNAME'] = $datajson->detailmember[0]->dataquery[0]->USERNAME;
			$data['PASSWORD'] = $datajson->detailmember[0]->dataquery[0]->PASSWORD;
			
		}
		return view('backend/daftaritem/kontentambahmember',$data);
	}
	public function jsonmembergroup(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '16',
			'DIMANA1' => empty(service('request')->getPost('KATAKUNCIPENCARIAN')) == true ? "" : service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => '2',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => $this->session->get("kodeunikmember"),
			'DIMANA10' => '',
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastermember", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->mastermember[0]->totaldataquerykategori; $x++) {
			$jsontext .= '{"group": "'.$datajson->mastermember[0]->dataquerykategori[$x]->GRUP.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function ajaxdaftarsalesman(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastersalesmankasir", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->mastersalesmankasir[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->mastersalesmankasir[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = $datajson->mastersalesmankasir[0]->dataquery[$no]->KODESALES;
				$row[] = str_replace("::"," ",$datajson->mastersalesmankasir[0]->dataquery[$no]->NAMA);
				$row[] = $datajson->mastersalesmankasir[0]->dataquery[$no]->ALAMAT;
				$row[] = "<div onclick=\"pilihsalesman('".$datajson->mastersalesmankasir[0]->dataquery[$no]->KODESALES."','".$datajson->mastersalesmankasir[0]->dataquery[$no]->NAMA."')\"><button class=\"btn btn-primary\"><i class=\"fas fa-clipboard-check\"></i> Pilih Ini</button></div>";
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->mastersalesmankasir[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->mastersalesmankasir[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function ajaxdaftarmemberkasir(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastermemberkasir", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->mastermemberkasir[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->mastermemberkasir[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = $datajson->mastermemberkasir[0]->dataquery[$no]->MEMBER_ID;
				$row[] = str_replace("::"," ",$datajson->mastermemberkasir[0]->dataquery[$no]->NAMA);
				$row[] = $datajson->mastermemberkasir[0]->dataquery[$no]->ALAMAT;
				$row[] = "<div onclick=\"pilihmemberkasir('".$datajson->mastermemberkasir[0]->dataquery[$no]->MEMBER_ID."','".str_replace("::"," ",$datajson->mastermemberkasir[0]->dataquery[$no]->NAMA)."','".$datajson->mastermemberkasir[0]->dataquery[$no]->BATASTAMBAHKREDIT."','".$datajson->mastermemberkasir[0]->dataquery[$no]->EMAIL."','".$datajson->mastermemberkasir[0]->dataquery[$no]->TELEPON."')\"><button class=\"btn btn-primary\"><i class=\"fas fa-clipboard-check\"></i> Pilih Ini</button></div>";
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->mastermemberkasir[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->mastermemberkasir[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function detailmemberterpilih(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastermemberkasir", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsonobj = '{"success":"true","MEMBER_ID":"'.$datajson->mastermemberkasir[0]->dataquery[0]->MEMBER_ID.'","NAMA":"'.$datajson->mastermemberkasir[0]->dataquery[0]->NAMA.'","ALAMAT":"'.$datajson->mastermemberkasir[0]->dataquery[0]->ALAMAT.'","KOTA":"'.$datajson->mastermemberkasir[0]->dataquery[0]->KOTA.'","EMAIL":"'.$datajson->mastermemberkasir[0]->dataquery[0]->EMAIL.'","TELEPON":"'.$datajson->mastermemberkasir[0]->dataquery[0]->TELEPON.'","AKHIRAKTIF":"'.$datajson->mastermemberkasir[0]->dataquery[0]->AKHIRAKTIF.'","STATUSAKTIF":"'.$datajson->mastermemberkasir[0]->dataquery[0]->STATUSAKTIF.'","POINT":"'.$datajson->mastermemberkasir[0]->dataquery[0]->POINT.'","LIMITJUMLAHPIUTANG":"'.$datajson->mastermemberkasir[0]->dataquery[0]->LIMITJUMLAHPIUTANG.'","TOTALDEPOSIT":"'.$datajson->mastermemberkasir[0]->dataquery[0]->TOTALDEPOSIT.'"}';
		return json_encode($jsonobj);
	}
	public function ajaxdaftarmember(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '16',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => service('request')->getPost('KONDISIQUERY'),
			'DIMANA3' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA4' => service('request')->getPost('STATUSMEMBER'),
			'DIMANA5' => service('request')->getPost('RANGEAWAL'),
			'DIMANA6' => service('request')->getPost('RANGEAKHIR'),
			'DIMANA7' => service('request')->getPost('MEMBERGROUP'),
			'DIMANA8' => '',
			'DIMANA9' => $this->session->get("kodeunikmember"),
			'DIMANA10' => service('request')->getPost('ISFILTERDATE'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastermember", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->mastermember[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			if (service('request')->getPost('DARIPANGGILBARANG') == "true"){
				for ($no = 0; $no < $datajson->mastermember[0]->totaldatadataquery; $no++) {
					$row = [];
					$row[] = $datajson->mastermember[0]->dataquery[$no]->MEMBER_ID;
					$row[] = str_replace("::"," ",$datajson->mastermember[0]->dataquery[$no]->NAMA);
					$row[] = $datajson->mastermember[0]->dataquery[$no]->ALAMAT;
					$row[] = "<div onclick=\"onclickplihmember('".$datajson->mastermember[0]->dataquery[$no]->MEMBER_ID."','".str_replace("::"," ",$datajson->mastermember[0]->dataquery[$no]->NAMA)."','".$datajson->mastermember[0]->dataquery[$no]->ALAMAT."','".service('request')->getPost('KONDISIDARI')."')\"><button class=\"btn btn-primary\"><i class=\"fas fa-clipboard-check\"></i> Pilih Ini</button></div>";
					$data[] = $row;
				}
			}else{
				for ($no = 0; $no < $datajson->mastermember[0]->totaldatadataquery; $no++) {
					$row = [];
					$row[] = "<button onclick=\"onclickdisablemember('". $datajson->mastermember[0]->dataquery[$no]->MEMBER_ID."','".$datajson->mastermember[0]->dataquery[$no]->NAMA."','".$datajson->mastermember[0]->dataquery[$no]->STATUSAKTIF."')\" class=\"btn ".($datajson->mastermember[0]->dataquery[$no]->STATUSAKTIF == 0 ? "btn-success" : "btn-danger")."\"><i class=\"fas ".($datajson->mastermember[0]->dataquery[$no]->STATUSAKTIF == 0 ? "fa-check" : "fa-stop-circle")."\"></i></button> <a href=\"".base_url('masterdata/detailmember/'.$datajson->mastermember[0]->dataquery[$no]->MEMBER_ID)."\"><button class=\"btn btn-warning\"><i class=\"fas fa-edit\"></i></button>";
					$row[] = $datajson->mastermember[0]->dataquery[$no]->MEMBER_ID;
					$row[] = str_replace("::"," ",$datajson->mastermember[0]->dataquery[$no]->NAMA);
					$row[] = $datajson->mastermember[0]->dataquery[$no]->GRUP;
					$row[] = $datajson->mastermember[0]->dataquery[$no]->ALAMAT;
					$row[] = $datajson->mastermember[0]->dataquery[$no]->TELEPON;
					$row[] = $datajson->mastermember[0]->dataquery[$no]->EMAIL;
					$row[] = formatuang('IDR',$datajson->mastermember[0]->dataquery[$no]->MINIMALPOIN,'Rp ');
					$row[] = formatuang('IDR',$datajson->mastermember[0]->dataquery[$no]->LIMITJUMLAHPIUTANG,'Rp ');
					$row[] = (date("Y-m-d", strtotime($datajson->mastermember[0]->dataquery[$no]->AKHIRAKTIF)) == "9999-12-31" ? "AON" : date("d-m-Y", strtotime($datajson->mastermember[0]->dataquery[$no]->AKHIRAKTIF)));
					$data[] = $row;
				}
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->mastermember[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->mastermember[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function statusmember(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEMEMBER' => service('request')->getPost('KODEMEMBER'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'NAMAMEMBER' => service('request')->getPost('NAMAMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/statusmember", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->statusmember[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->statusmember[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->statusmember[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function jsontambahmember(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'MEMBER_ID' => service('request')->getPost('MEMBER_ID'),
			'NAMA' => service('request')->getPost('NAMA'),
			'ALAMAT' => service('request')->getPost('ALAMAT'),
			'KOTA' => service('request')->getPost('KOTA'),
			'PROVINSI' => service('request')->getPost('PROVINSI'),
			'NEGARA' => service('request')->getPost('NEGARA'),
			'KODEPOS' => service('request')->getPost('KODEPOS'),
			'JK' => service('request')->getPost('JK'),
			'EMAIL' => service('request')->getPost('EMAIL'),
			'TELEPON' => service('request')->getPost('TELEPON'),
			'FAX' => service('request')->getPost('FAX'),
			'AKHIRAKTIF' => service('request')->getPost('AKHIRAKTIF'),
			'STATUSAKTIF' => service('request')->getPost('STATUSAKTIF'),
			'POINT' => service('request')->getPost('POINT'),
			'NOREK' => service('request')->getPost('NOREK'),
			'PEMILIKREK' => service('request')->getPost('PEMILIKREK'),
			'BANK' => service('request')->getPost('BANK'),
			'NPWP' => service('request')->getPost('NPWP'),
			'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'LIMITJUMLAHPIUTANG' => service('request')->getPost('LIMITJUMLAHPIUTANG'),
			'JENIS' => service('request')->getPost('JENIS'),
			'GRUP' => service('request')->getPost('GRUP'),
			'MINIMALPOIN' => service('request')->getPost('MINIMALPOIN'),
			'BATASTAMBAHKREDIT' => service('request')->getPost('BATASTAMBAHKREDIT'),
			'KEJARTARGET' => service('request')->getPost('KEJARTARGET'),
			'NAMAFILE' => service('request')->getPost('NAMAFILE'),
			'USERNAME' => service('request')->getPost('USERNAME'),
			'PASSWORD' => service('request')->getPost('PASSWORD'),
			'CATATAN' => service('request')->getPost('CATATAN'),
			'LIMITBARANGONLINE' => service('request')->getPost('LIMITBARANGONLINE'),
			'LOGO' => service('request')->getPost('LOGO'),
			'LIMIT_BRG' => service('request')->getPost('LIMIT_BRG'),
			'NISBACKUP' => service('request')->getPost('NISBACKUP'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'NOMOR' => service('request')->getPost('NOMOR'),
			'TOTALDEPOSIT' => service('request')->getPost('TOTALDEPOSIT'),
			'ISRESELLER' => service('request')->getPost('ISRESELLER'),
			'ANGKAKESUKAAN' => service('request')->getPost('ANGKAKESUKAAN'),
			'ISINSERT' => service('request')->getPost('ISINSERT'),
			'PINTRX' => service('request')->getPost('PINTRX'),
			'APIKEY' => service('request')->getPost('APIKEY'),
			'MARKUP' => service('request')->getPost('MARKUP'),
			'KECAMATAN' => service('request')->getPost('KECAMATAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahmember", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->tambahmember[0]);
	}
	/* area algoritma daftar sales */
	public function daftarsales(){
		$this->breadcrumb  = array( 
			"Daftar Sales" => base_url()."masterdata/daftarsales",
	   	);
		$data = [
			"titleheader"=>"DAFTAR SALES ANDA",
			"menuaktif" => "2",
			"submenuaktif" => "7",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarsales',$data);
	}
	public function ajaxdaftarales(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '20',
			'DIMANA1' => $this->session->get("kodeunikmember"),
			'DIMANA2' => '1',
			'DIMANA3' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => '',
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/mastersales", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->mastersales[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->mastersales[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<button onclick=\"onclickhapussales('". $datajson->mastersales[0]->dataquery[$no]->KODESALES."','".$datajson->mastersales[0]->dataquery[$no]->NAMA."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button> <a href=\"".base_url('masterdata/detailsales/'.$datajson->mastersales[0]->dataquery[$no]->KODESALES)."\"><button class=\"btn btn-warning\"><i class=\"fas fa-edit\"></i></button>";
				$row[] = $datajson->mastersales[0]->dataquery[$no]->KODESALES;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->NAMA;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->PROVINSI;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->KOTA;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->ALAMAT;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->TELEPON;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->EMAIL;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->BANK;
				$row[] = $datajson->mastersales[0]->dataquery[$no]->NOREK;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->mastersales[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->mastersales[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsontambahsales(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODESALES' => service('request')->getPost('KODESALES'),
			'NAMA' => service('request')->getPost('NAMA'),
			'ALAMAT' => service('request')->getPost('ALAMAT'),
			'KOTA' => service('request')->getPost('KOTA'),
			'PROVINSI' => service('request')->getPost('PROVINSI'),
			'NEGARA' => "INDONESIA",
			'KODEPOS' => "",
			'TELEPON' => service('request')->getPost('TELEPON'),
			'FAX' => "",
			'EMAIL' => service('request')->getPost('EMAIL'),
			'NOREK' => service('request')->getPost('NOREK'),
			'PEMILIKREK' => "",
			'BANK' => service('request')->getPost('BANK'),
			'KETERANGAN' => "",
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'ISINSERT' => service('request')->getPost('ISINSERT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahmastersales", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->tambahmastersales[0]);
	}
	public function jsonhapusdaftarssales(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODESALES' => service('request')->getPost('KODESALES'),
			'NAMASALES' => service('request')->getPost('NAMASALES'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapussales", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hapussales[0]);
	}
	public function detailsales(){
		helper('url');
		
		$this->breadcrumb  = array( 
			"Daftar Sales" => base_url()."masterdata/daftarsales",
			"Tambah Sales" => base_url()."masterdata/detailsales",
		);
		$data = [
			"titleheader"=> $this->uri->getSegment(3) == "" ? "TAMBAH SALES BARU" : "UBAH DATA SALES ",
			"menuaktif" => "2",
			"submenuaktif" => "7",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		$data['KODESALES'] = "";
		$data['NAMA'] = "";
		$data['PROVINSI'] = "";
		$data['KOTA'] = "";
		$data['ALAMAT'] = "";
		$data['TELEPON'] = "";
		$data['EMAIL'] = "";
		$data['BANK'] = "";
		$data['NOREK'] = "";
		if ($this->uri->getSegment(3) != ""){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => '20',
				'DIMANA1' => $this->session->get("kodeunikmember"),
				'DIMANA2' => '1',
				'DIMANA3' => $this->uri->getSegment(3),
				'DIMANA4' => '',
				'DIMANA5' => '',
				'DIMANA6' => '',
				'DIMANA7' => '',
				'DIMANA8' => '',
				'DIMANA9' => '',
				'DIMANA10' => '',
				'DATAKE' => 0,
				'LIMIT' => 1,
			];
			$json_data = $client->request("POST", BASEURLAPI."masterdata/mastersales", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());	
			$data['KODESALES'] = $datajson->mastersales[0]->dataquery[0]->KODESALES;
			$data['NAMA'] = $datajson->mastersales[0]->dataquery[0]->NAMA;
			$data['PROVINSI'] = $datajson->mastersales[0]->dataquery[0]->PROVINSI;
			$data['KOTA'] = $datajson->mastersales[0]->dataquery[0]->KOTA;
			$data['ALAMAT'] = $datajson->mastersales[0]->dataquery[0]->ALAMAT;
			$data['TELEPON'] = $datajson->mastersales[0]->dataquery[0]->TELEPON;
			$data['EMAIL'] = $datajson->mastersales[0]->dataquery[0]->EMAIL;
			$data['BANK'] = $datajson->mastersales[0]->dataquery[0]->BANK;
			$data['NOREK'] = $datajson->mastersales[0]->dataquery[0]->NOREK;
			$data['PEMILIKREK'] = $datajson->mastersales[0]->dataquery[0]->PEMILIKREK;
		}
		return view('backend/daftaritem/kontentambahsales',$data);
	}
	/* area algoritma daftar satuan item */
	public function daftarsatuan(){
		$this->breadcrumb  = array( 
			"Daftar Satuan Item" => base_url()."masterdata/daftarsatuan",
		);
		$data = [
			"titleheader"=>"DAFTAR SATUAN ITEM",
			"menuaktif" => "3",
			"submenuaktif" => "8",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarsatuan',$data);
	}
	public function jsondaftarsatuan(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '15',
			'DIMANA1' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => '3',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => $this->session->get("kodeunikmember"),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/datasatuan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->datasatuan[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->datasatuan[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<button id=\"onclickdeletesatuan".trim($datajson->datasatuan[0]->dataquery[$no]->NAMASATUAN)."\" onclick=\"onclickdeletesatuan('". $datajson->datasatuan[0]->dataquery[$no]->NAMASATUAN."','".$datajson->datasatuan[0]->dataquery[$no]->KETERANGAN."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = $datajson->datasatuan[0]->dataquery[$no]->NAMASATUAN;
				$row[] = $datajson->datasatuan[0]->dataquery[$no]->KETERANGAN;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->datasatuan[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->datasatuan[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsonhapussatuan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODESATUAN' => service('request')->getPost('KODESATUAN'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapussatuan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hapussatuan[0]);
	}
	public function jsontambahsatuan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODESATUAN' => service('request')->getPost('KODESATUAN'),
			'NAMASATUAN' => service('request')->getPost('NAMASATUAN'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahsatuan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->tambahsatuan[0]);
	}
	/* area algoritma daftar satuan item */
	public function daftarkategoribarang(){
		$this->breadcrumb  = array( 
			"Daftar Kategori Barang" => base_url()."masterdata/daftarkategoribarang",
	   	);
		$data = [
			"titleheader"=>"DAFTAR KATEGORI BARANAG",
			"menuaktif" => "3",
			"submenuaktif" => "9",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarkategoribarang',$data);
	}
	public function jsondaftarkategori(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '15',
			'DIMANA1' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => '2',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => $this->session->get("kodeunikmember"),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/datakategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->datakategori[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->datakategori[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<button id=\"hapuskategori".$datajson->datakategori[0]->dataquery[$no]->KATEGORIPARENT_ID."\" onclick=\"onclickdeletekategori('". $datajson->datakategori[0]->dataquery[$no]->KATEGORIPARENT_ID."','".$datajson->datakategori[0]->dataquery[$no]->NAMAKATEGORI."')\" class=\"btn btn-danger mr-2\"><i class=\"fas fa-trash\"></i> Hapus</button> <button onclick=\"panggilformbebanmanufaktur('". $datajson->datakategori[0]->dataquery[$no]->KATEGORIPARENT_ID."','".$datajson->datakategori[0]->dataquery[$no]->NAMAKATEGORI."','".$datajson->datakategori[0]->dataquery[$no]->BEBANGAJI."','".$datajson->datakategori[0]->dataquery[$no]->BEBANPACKING."','".$datajson->datakategori[0]->dataquery[$no]->BEBANPROMO."','".$datajson->datakategori[0]->dataquery[$no]->BEBANTRANSPORT."')\" class=\"btn btn-warning\"><i class=\"fas fa-object-group\"></i> Beban Manufaktur</button>";
				$row[] = $datajson->datakategori[0]->dataquery[$no]->KATEGORIPARENT_ID;
				$row[] = $datajson->datakategori[0]->dataquery[$no]->NAMAKATEGORI;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->datakategori[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->datakategori[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function ubahbebanmanufaktur(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEKATEGORI'=> service('request')->getPost('KODEKATEGORI'),
			'BEBANGAJI'=> service('request')->getPost('BEBANGAJI'),
			'BEBANPACKING'=>  service('request')->getPost('BEBANPACKING'),
			'BEBANPROMO'=>  service('request')->getPost('BEBANPROMO'),
			'BEBANTRANSPORT'=>  service('request')->getPost('BEBANTRANSPORT'),
			'KODEUNIKMEMBER'=> service('request')->getPost('KODEUNIKMEMBER'),
			'UPDATEBEBAN'=> '1',
			'NAMAKATEGORI'=> service('request')->getPost('NAMAKATEGORI'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapuskategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hapuskategori[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->hapuskategori[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->hapuskategori[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function jsonhapuskategori(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapuskategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hapuskategori[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->hapuskategori[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->hapuskategori[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function jsontambahkategori(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATEGORIPARENT_ID' => service('request')->getPost('KATEGORIPARENT_ID'),
			'NAMAKATEGORI' => service('request')->getPost('NAMAKATEGORI'),
			'LOGOKATEGORI' => service('request')->getPost('LOGOKATEGORI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahkategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->tambahkategori[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->tambahkategori[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->tambahkategori[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	
	/* area algoritma daftar metode pembayaran */
	public function daftarmetodepembayaran(){
		$this->breadcrumb  = array( 
			"Daftar Metode Pembayaran" => base_url()."masterdata/daftarmetodepembayaran",
	   	);
		$data = [
			"titleheader"=>"METODE PEMBAYARAN [BETA]",
			"menuaktif" => "3",
			"submenuaktif" => "10",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarmetodepembayaran',$data);
	}
	/* area algoritma daftar kategori member */
	public function daftarkategorimember(){
		$this->breadcrumb  = array( 
			"Daftar Kategori Member" => base_url()."masterdata/daftarkategorimember",
	   	);
		$data = [
			"titleheader"=>"DAFTAR KATEGORI MEMBER",
			"menuaktif" => "3",
			"submenuaktif" => "11",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/daftaritem/kontendaftarkategorimember',$data);
	}
	public function jsondaftarkategorianggota(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '17',
			'DIMANA1' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => '3',
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => $this->session->get("kodeunikmember"),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/datakategorianggota", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->datakategorianggota[0]->success == "false"){
			$outputDT = [
				"draw" => 0,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->datakategorianggota[0]->totaldatadataquery; $no++) {
				$row = [];
				$row[] = "<button id=\"hapuskategorimember".$datajson->datakategorianggota[0]->dataquery[$no]->KODEGRUP."\" onclick=\"onclickdeletekategori('". $datajson->datakategorianggota[0]->dataquery[$no]->KODEGRUP."','".$datajson->datakategorianggota[0]->dataquery[$no]->GRUP."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = $datajson->datakategorianggota[0]->dataquery[$no]->KODEGRUP;
				$row[] = $datajson->datakategorianggota[0]->dataquery[$no]->JENIS;
				$row[] = $datajson->datakategorianggota[0]->dataquery[$no]->GRUP;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->datakategorianggota[0]->totaldatadataquery,
				"recordsFiltered" => $datajson->datakategorianggota[0]->totaldatadataquery,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsonhapuskategorianggota(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/hapuskategorianggota", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hapuskategorianggota[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->hapuskategorianggota[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->hapuskategorianggota[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	public function jsontambahkategorianggota(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEGRUP' => service('request')->getPost('KODEGRUP'),
			'JENIS' => service('request')->getPost('JENIS'),
			'GRUP' => service('request')->getPost('GRUP'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/tambahkategorianggota", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->tambahkategorianggota[0]->success == "true"){
			$jsonobj = '{"status":"true","msg":"'.$datajson->tambahkategorianggota[0]->msg.'"}';
		}else{
			$jsonobj = '{"status":"false","msg":"'.$datajson->tambahkategorianggota[0]->msg.'"}';
		}
		return json_encode($jsonobj);
	}
	/* master pengguna */
	public function informasimerchant(){
		$this->breadcrumb  = array( 
			"Daftar Member" => base_url()."masterdata/daftarmerchat",
			"Kelola Informasi" => base_url()."masterdata/informasimerchant",
		);
		$data = [
			"titleheader"=> $this->session->get("hakakses") == "OW" ? "INFORMASI MERCHANT" : "INFORMASI PEGAWAI",
			"menuaktif" => "",
			"submenuaktif" => "",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('auth/penggunahakakses',$data);
	}
	public function simpanhakakses(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'NAMAHAKAKSES' => service('request')->getPost('NAMAHAKAKSES'),
			'JSONMENU' => service('request')->getPost('JSONMENU'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'AI' => service('request')->getPost('AI'),
		];
		$json_data = $client->request("POST", BASEURLAPI."auth/simpanhakakses", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function simpanpegawai(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PENGGUNA_ID' => service('request')->getPost('PENGGUNA_ID'),
			'NAMA' => service('request')->getPost('NAMA'),
			'NAMAOUTLET' => "",
			'NAMAPENGGUNA' => service('request')->getPost('NAMAPENGGUNA'),
			'PASSWORD' => service('request')->getPost('PASSWORD'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'URLFOTO' => service('request')->getPost('URLFOTO'),
			'HAKAKSESID' => "PEGAWAI",
			'ALAMAT' => service('request')->getPost('ALAMAT'),
			'NOTELP' => service('request')->getPost('NOTELP'),
			'NOREKENING' => service('request')->getPost('NOREKENING'),
			'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'TOTALDEPOSIT' => service('request')->getPost('TOTALDEPOSIT'),
			'IDHAKAKSES' => service('request')->getPost('IDHAKAKSES'),
			'PIN' => service('request')->getPost('PIN'),
			'LATLONG' => service('request')->getPost('LATLONG'),
			'EMAIL' => service('request')->getPost('EMAIL'),
			'TOKENKEY' => service('request')->getPost('TOKENKEY'),
			'STATUSAKTIF' => service('request')->getPost('STATUSAKTIF'),
			'NOMOR' => service('request')->getPost('NOMOR'),
			'STATUSUPDATE' => service('request')->getPost('STATUSUPDATE'),
		];
		$json_data = $client->request("POST", BASEURLAPI."auth/simpanpegawai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->registerapps[0]);
	}
	public function daftarpembayarannontunai(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'JENISNONTUNAI' => service('request')->getPost('JENISNONTUNAI'),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/daftarpembayarannontunai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson);
	}
	public function brand(){
		$this->breadcrumb  = array( 
			"Daftar Brand" => base_url()."masterdata/brand",
		);
		$data = [
			"titleheader"=>"DAFTAR BRAND",
			"menuaktif" => "3",
			"submenuaktif" => "15",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
		];
		return view('backend/daftaritem/kontendaftarbrand',$data);
	}
	public function jasondaftarbrand(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMABRAND' => service('request')->getPost('NAMABRAND'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jasondaftarbrand", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->jasondaftarbrand[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->jasondaftarbrand[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<button id=\"hapusid".$datajson->jasondaftarbrand[0]->dataquery[$no]->BRAND_ID."\" onclick=\"hapusbrand('".$datajson->jasondaftarbrand[0]->dataquery[$no]->BRAND_ID."','".$datajson->jasondaftarbrand[0]->dataquery[$no]->NAMA_BRAND."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus Brand</button>";
				$row[] = $datajson->jasondaftarbrand[0]->dataquery[$no]->BRAND_ID;
				$row[] = $datajson->jasondaftarbrand[0]->dataquery[$no]->NAMA_BRAND;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->jasondaftarbrand[0]->totaldata,
				"recordsFiltered" => $datajson->jasondaftarbrand[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsonhapusbrand(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'BRAND_ID' => service('request')->getPost('BRAND_ID'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jsonhapusbrand", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function jsontambahbrand(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'BRAND_ID' => service('request')->getPost('BRAND_ID'),
			'NAMA_BRAND' => service('request')->getPost('NAMA_BRAND'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jsontambahbrand", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function principal(){	
		$this->breadcrumb  = array( 
			"Daftar Principal" => base_url()."masterdata/principal",
		);
		$data = [
			"titleheader"=>"DAFTAR PRINCIPAL",
			"menuaktif" => "3",
			"submenuaktif" => "16",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
		];
		return view('backend/daftaritem/kontendaftarprincipal',$data);
	}
	public function jasondaftarprincipal(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMA_PRINCIPAL' => service('request')->getPost('NAMA_PRINCIPAL'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jasondaftarprincipal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->jasondaftarprincipal[0]->success == "false"){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->jasondaftarprincipal[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<button id=\"hapusprincipal".$datajson->jasondaftarprincipal[0]->dataquery[$no]->PRINCIPAL_ID."\" onclick=\"hapusprincipal('".$datajson->jasondaftarprincipal[0]->dataquery[$no]->PRINCIPAL_ID."','".$datajson->jasondaftarprincipal[0]->dataquery[$no]->NAMA_PRINCIPAL."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus Principal</button>";
				$row[] = $datajson->jasondaftarprincipal[0]->dataquery[$no]->PRINCIPAL_ID;
				$row[] = $datajson->jasondaftarprincipal[0]->dataquery[$no]->NAMA_PRINCIPAL;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->jasondaftarprincipal[0]->totaldata,
				"recordsFiltered" => $datajson->jasondaftarprincipal[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsontambahprincipal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PRINCIPAL_ID' => service('request')->getPost('PRINCIPAL_ID'),
			'NAMA_PRINCIPAL' => service('request')->getPost('NAMA_PRINCIPAL'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jsontambahprincipal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->jsontambahprincipal[0]);
	}
	public function jsonhapusprincipal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PRINCIPAL_ID' => service('request')->getPost('PRINCIPAL_ID'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jsonhapusprincipal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->jsonhapusprincipal[0]);
	}
	public function informasirow1dashboard(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '36',
			'DIMANA1' => $this->session->get("kodeunikmember"),
			'DIMANA2' => $this->session->get("outlet"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/informasirow1dashboard", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function informasirow2dashboard(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '37',
			'DIMANA1' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/informasirow2dashboard", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function selectvaluereport(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'DIMANA1' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."masterdata/selectvaluereport", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->hasiljson[0]->totaldata; $x++) {
			if (service('request')->getPost('DARI') == "COMBOREPORTCUSTOMER"){
				$jsontext .= '{"group": "'.$datajson->hasiljson[0]->dataquery[$x]->MEMBER_ID.'", "namaoutlet": "'.$datajson->hasiljson[0]->dataquery[$x]->NAMA.'"},';	
			}else if (service('request')->getPost('DARI') == "COMBOREPORTBARANG"){
				$jsontext .= '{"group": "'.$datajson->hasiljson[0]->dataquery[$x]->BARANG_ID.'", "namaoutlet": "'.$datajson->hasiljson[0]->dataquery[$x]->NAMABARANG.'"},';	
			}else if (service('request')->getPost('DARI') == "COMBOREPORTSUP"){
				$jsontext .= '{"group": "'.$datajson->hasiljson[0]->dataquery[$x]->KODESUPPLIER.'", "namaoutlet": "'.$datajson->hasiljson[0]->dataquery[$x]->NAMASUPPLIER.'"},';	
			}else if (service('request')->getPost('DARI') == "COMBOREPORTGROUPMEMBER"){
				$jsontext .= '{"group": "'.$datajson->hasiljson[0]->dataquery[$x]->KODEGRUP.'", "namaoutlet": "'.$datajson->hasiljson[0]->dataquery[$x]->JENIS.'"},';	
			}else if (service('request')->getPost('DARI') == "COMBOREPORTKATEGORI"){
				$jsontext .= '{"group": "'.$datajson->hasiljson[0]->dataquery[$x]->KATEGORIPARENT_ID.'", "namaoutlet": "'.$datajson->hasiljson[0]->dataquery[$x]->NAMAKATEGORI.'"},';	
			}
		}
		$jsontext = substr_replace($jsontext, '', -1);
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function outlet()
	{
		$this->breadcrumb  = array("Dashboard" => "masterdata",);
		$data = [
			"titleheader"=> "OUTLET TERDAFTAR",
			"menuaktif" => "0",
			"submenuaktif" => "0",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
		];
		return view('backend/outlet/indexoutlet',$data);
	}
	public function pembayaranlokal()
	{
		$this->breadcrumb  = array( 
			"Daftar Metode Pembayaran" => base_url()."masterdata/daftarmetodepembayaran",
			"Pencatatan Lokal" => base_url()."masterdata/pembayaranlokal",
	   	);
		$data = [
			"titleheader"=>"DAFTAR PENCATATAN TRANSAKSI LOKAL",
			"menuaktif" => "3",
			"submenuaktif" => "10",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/paymentgateway/pencatatanlokal',$data);
	}
	public function jasondaftarbankpencatatanlokal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMA_PENCATATAN' => service('request')->getPost('NAMA_PENCATATAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jasondaftarbankpencatatanlokal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->jasondaftarbankpencatatanlokal[0]->success == false){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->jasondaftarbankpencatatanlokal[0]->totaldata; $no++) {
				$row = [];
				if ($datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->JENISNONTUNAI == "PG"){
					$row[] = "";
				} else {
					$row[] = "<div style=\"text-align:center\"><button id=\"hapusbankpencatatan".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->BANK_ID."\" onclick=\"hapusbankpencatatan('".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->BANK_ID."','".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->NAMABANK."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button>
					<button onclick=\"ubahinformasi(
						'".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->BANK_ID."',
						'".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->NAMABANK."',
						'".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->PAJAKDEBIT."',
						'".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->PAJAKKREDIT."',
						'".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->URLLOGO."',
						'".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->JENISNONTUNAI."'
						)\" class=\"btn btn-primary\"><i class=\"fas fa-edit\"></i></button>
					</div>";
				}
				$row[] = "<img style=\"width:150px;height:60px;\" src=\"".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->URLLOGO."\">";
				$row[] = "<div class=\"centered-content\">".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->NAMABANK."<br><strong>[".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->BANK_ID."]</strong><br>".($datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->JENISNONTUNAI == "E" ? "Emoney" : "Bank Transfer" )."</div>";
				$row[] = "<div class=\"centered-content\">".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->PAJAKDEBIT.($datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->PAJAKDEBIT < 99 ? "%" : " IDR" )."</div>";
				$row[] = "<div class=\"centered-content\">".$datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->PAJAKKREDIT.($datajson->jasondaftarbankpencatatanlokal[0]->dataquery[$no]->PAJAKKREDIT < 99 ? "%" : " IDR" )."</div>";
				$data[] = $row;
			}			
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->jasondaftarbankpencatatanlokal[0]->totaldata,
				"recordsFiltered" => $datajson->jasondaftarbankpencatatanlokal[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function jsonhapusmetodepembayaran(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODE_PENCATATAN' => service('request')->getPost('KODE_PENCATATAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/jsonhapusmetodepembayaran", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->jsonhapusmetodepembayaran[0]);
	}
	public function simpaninformasimetodepembayaran(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODE_BANK' => service('request')->getPost('KODE_BANK'),
			'NAMA_BANK' => service('request')->getPost('NAMA_BANK'),
			'PAJAKDEBIT' => service('request')->getPost('PAJAKDEBIT'),
			'PAJAKKREDIT' => service('request')->getPost('PAJAKKREDIT'),
			'URLLOGO' => service('request')->getPost('URLLOGO'),
			'JENISMETHOD' => service('request')->getPost('JENISMETHOD'),
			'JENISISMPAN' => service('request')->getPost('JENISISMPAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."masterdata/nodesimpaninformasimetodepembayaran", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->simpaninformasimetodepembayaran[0]);
	}
}
