<?php

namespace App\Controllers;

class Acipay extends BaseController
{
    protected $uri,$session,$breadcrumb,$sidetitle = "Aciraba Payment";
	function __construct(){
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
		$this->session = \Config\Services::session();
        $this->session->start();
    }
	public function index(){
		$this->breadcrumb  = array("Dashboard" => "home",);
		$data = [
			"titleheader"=> "DASHBOARD ACIPAY - DOMPET DATA",
			"menuaktif" => "0",
			"submenuaktif" => "0",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"tutup_notif_koneksi" => $this->sidetitle,
			"lic_response" => $this->session->get("lic_response"),
			
		];
		return view('acipay/dashboard',$data);
	}
	public function provider(){
		$this->breadcrumb  = array("Dashboard" => "home",);
		$data = [
			"titleheader"=> "PROVIDER SERVER",
			"menuaktif" => "AMP",
			"submenuaktif" => "0",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"tutup_notif_koneksi" => $this->sidetitle,
			"email" => $this->session->get("email"),
			"lic_response" => $this->session->get("lic_response"),
		];
		return view('acipay/kontenacipayserver',$data);
	}
	public function kirimotp(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'EMAIL' => $this->session->get("email"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/kirimotp", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
	}
	public function bacaserver(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'TIPE' => service('request')->getPost('TIPE'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KATAKUNCI' => (empty(service('request')->getPost('KATAKUNCI')) ? "" : service('request')->getPost('KATAKUNCI') ),
			'DATAKE' => 0,
			'LIMIT' => 500,
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/bacaserver", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if (service('request')->getPost('TIPE') == "select2"){
			$jsontext = "[";
			for ($x = 0; $x < $datajson->respon[0]->totaldata; $x++) {
				$jsontext .= '{"idjalur": "'.$datajson->respon[0]->data[$x]->KODE_SERVER.'", "namajalur": "'.$datajson->respon[0]->data[$x]->NAMA_SERVER.'"},';	
			}
			$jsontext = substr_replace($jsontext, '', -1);
			$jsontext .= "]";
			return json_encode($jsontext);
		}else{
			if ($datajson->respon[0]->success == false){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => []
				];
			}else{
				for ($no = 0; $no < $datajson->respon[0]->totaldata; $no++) {
					$row = [];
					$row[] = "<button onclick=\"detailtopup('".$datajson->respon[0]->data[$no]->ID_SERVER."','".$datajson->respon[0]->data[$no]->NAMA_SERVER."','".$datajson->respon[0]->data[$no]->USERNAME."')\" class=\"btn btn-warning\"><i class=\"fas fa-upload\"></i> TopUp</button> <button onclick=\"detailinformasi('".$datajson->respon[0]->data[$no]->ID_SERVER."','".$this->session->get("kodeunikmember")."')\" class=\"btn btn-success\"><i class=\"fas fa-edit\"></i></button> <button onclick=\"hapusinformasi('".$datajson->respon[0]->data[$no]->ID_SERVER."','".$this->session->get("kodeunikmember")."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button>";
					$row[] = "KODE SERVER : ".$datajson->respon[0]->data[$no]->KODE_SERVER."<br>NAMA SERVER : ".$datajson->respon[0]->data[$no]->NAMA_SERVER;
					$row[] =formatuang('IDR',$datajson->respon[0]->data[$no]->SALDO,"Rp");
					$row[] = "IP Provider : ".$datajson->respon[0]->data[$no]->IP_PROVIDER."<br>End Point : ".$datajson->respon[0]->data[$no]->ENDPOINT."<br>Nama Vendor : ".$datajson->respon[0]->data[$no]->SOFTWARE_VENDOR;
					$row[] = "USERNAME API : ".replaceEvenCharactersWithAsterisk($datajson->respon[0]->data[$no]->USERNAME)."<br>KEY API :".replaceEvenCharactersWithAsterisk($datajson->respon[0]->data[$no]->API_KEY);
					$row[] = "WEBHOOK ID : ".replaceEvenCharactersWithAsterisk($datajson->respon[0]->data[$no]->WEBHOOKID)."<br>SECRET :".replaceEvenCharactersWithAsterisk($datajson->respon[0]->data[$no]->SECRETWEBHOOK);
					$row[] = $datajson->respon[0]->data[$no]->STATUS;
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->respon[0]->totaldata,
					"recordsFiltered" => $datajson->respon[0]->totaldata,
					"data" => $data
				];
			}
			return json_encode($outputDT);
		}
    }
    /* area algoritma kode non ppob */
	public function prabayar(){
		$this->breadcrumb  = array( 
			"Produk Acipay" => base_url()."acipay/prabayar",
		);
		$data = [
            "menuaktif" => "A1",
			"submenuaktif" => "S1",
			"titleheader"=>"DAFTAR PRODUK PRABAYAR",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"jenisproduk" => "REGULER",
		];
		return view('acipay/kontenproduk',$data);
	}
	public function pascabayar(){
		$this->breadcrumb  = array( 
			"Produk Acipay" => base_url()."acipay/pascabayar",
		);
		$data = [
            "menuaktif" => "A1",
			"submenuaktif" => "S1",
			"titleheader"=>"DAFTAR PRODUK PASCABAYAR",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            "jenisproduk" => "TAGIHAN",
		];
		return view('acipay/kontenproduk',$data);
	}
	public function duniapermainan(){
		$this->breadcrumb  = array( 
			"Produk Acipay" => base_url()."acipay/duniapermainan",
		);
		$data = [
            "menuaktif" => "A1",
			"submenuaktif" => "S1",
			"titleheader"=>"DAFTAR PRODUK DUNIA PERMAINAN",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            "jenisproduk" => "GAME",
		];
		return view('acipay/kontenproduk',$data);
	}
	public function tambahproduk(){
		$this->breadcrumb  = array( 
			"Produk Acipay" => base_url()."acipay/prabayar",
			"Tambah Acipay" => base_url()."acipay/tambahproduk",
		);
		$data = [
            "menuaktif" => "A1",
			"submenuaktif" => "S1",
			"titleheader"=>"INFORMASI PRODUK",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            
		];
		$data['SEGMENT3'] = ($this->uri->getSegment(3) == "" ? "" :  $this->uri->getSegment(3));
		if ($this->uri->getSegment(3) != ""){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "detailproduk",
				'PRODUK_ID' => $this->uri->getSegment(3),
				'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			];
			$json_data = $client->request("POST", BASEURLAPI."acipay/getformat", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			$data['BARANG_ID'] = $datajson->respon[0]->data[0]->BARANG_ID;
			$data['PRODUK_ID_VENDOR'] = $datajson->respon[0]->data[0]->PRODUK_ID_VENDOR;
			$data['NAMABARANG'] = $datajson->respon[0]->data[0]->NAMABARANG;
			$data['KATEGORI_ID'] = $datajson->respon[0]->data[0]->KATEGORI_ID;
			$data['NAMAKATEGORI'] = $datajson->respon[0]->data[0]->NAMAKATEGORI;
			$data['PARETO_ID'] = $datajson->respon[0]->data[0]->PARETO_ID;
			$data['NAMA_PRINCIPAL'] = $datajson->respon[0]->data[0]->NAMA_PRINCIPAL;
			$data['AKTIF'] = $datajson->respon[0]->data[0]->AKTIF;
			$data['POIN'] = $datajson->respon[0]->data[0]->POIN;
			$data['FILECITRA'] = ($datajson->respon[0]->data[0]->FILECITRA == "not_found" ? "" : $datajson->respon[0]->data[0]->FILECITRA);
			$data['HARGABELI'] = $datajson->respon[0]->data[0]->HARGABELI;
			$data['HARGAJUAL'] = $datajson->respon[0]->data[0]->HARGAJUAL;
			$data['HARGA_1'] = $datajson->respon[0]->data[0]->HARGA_1;
			$data['HARGA_2'] = $datajson->respon[0]->data[0]->HARGA_2;
			$data['SUPPLER_ID'] = $datajson->respon[0]->data[0]->SUPPLER_ID;
			$data['NAMA_SERVER'] = $datajson->respon[0]->data[0]->NAMA_SERVER;
			$data['MULTI'] = $datajson->respon[0]->data[0]->MULTI;
			$data['FORMAT'] = $datajson->respon[0]->data[0]->FORMAT;
			$data['KETERANGANBARANG'] = $datajson->respon[0]->data[0]->KETERANGANBARANG;
		}
		return view('acipay/kontentambahproduk',$data);
	}
    public function kategori(){
		$this->breadcrumb  = array( 
			"Produk Acipay" => base_url()."acipay/kategori",
		);
		$data = [
            "menuaktif" => "AOP",
			"submenuaktif" => "AOP1",
			"titleheader"=>"DAFTAR KATEGORI ACIPAY - DOMPET DATA",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            
		];
		$data["SEGMENT"] = $this->uri->getSegment(2);
		return view('acipay/kontenkategori',$data);
	}
	public function kategoriselect2(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/daftarkategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->respon[0]->totaldata; $x++) {
			$jsontext .= '{"idkategori": "'.$datajson->respon[0]->data[$x]->KATEGORI_ID.'", "namakategori": "'.$datajson->respon[0]->data[$x]->NAMAKATEGORI.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1);
		$jsontext .= "]";
		return json_encode($jsontext);
	}
    public function operator(){
		$this->breadcrumb  = array( 
			"Produk Acipay" => base_url()."acipay/produk",
		);
		$data = [
            "menuaktif" => "AOP",
			"submenuaktif" => "AOP2",
			"titleheader"=>"DAFTAR OPERATOR ACIPAY - DOMPET DATA",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            
		];
		return view('acipay/kontenoperator',$data);
	}
	public function daftarproduk(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
            'STATUS' => service('request')->getPost('STATUS'),
			'KUNCIKATEGORI' => service('request')->getPost('KUNCIKATEGORI'),
			'KUNCIOPERATOR' => service('request')->getPost('KUNCIOPERATOR'),
			'JENISPRODUK' => service('request')->getPost('JENISPRODUK'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 500,
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/daftarproduk", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->respon[0]->success == false){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->respon[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<a href=\"".base_url()."acipay/tambahproduk/".$datajson->respon[0]->data[$no]->BARANG_ID."\"><button class=\"btn btn-outline-success\"><i class=\"fas fa-edit\"></i></button></a> <button id=\"btnsinkron".$datajson->respon[0]->data[$no]->BARANG_ID."\" onclick=\"sinkronperbarang('".$datajson->respon[0]->data[$no]->VENDOR_ID."','".$datajson->respon[0]->data[$no]->FORMAT."','".$datajson->respon[0]->data[$no]->PRODUK_ID_VENDOR."','".$datajson->respon[0]->data[$no]->KATEGORI_ID."','". $datajson->respon[0]->data[$no]->NAMABARANG."','".$datajson->respon[0]->data[$no]->BARANG_ID."')\" class=\"btn btn-outline-primary\"><i class=\"fas fa-sync\"></i></button> <button onclick=\"hapusperproduk ('". $datajson->respon[0]->data[$no]->BARANG_ID."','".$datajson->respon[0]->data[$no]->NAMABARANG."','".$datajson->respon[0]->data[$no]->SUPPLER_ID."','".$datajson->respon[0]->data[$no]->BARIS."')\" id=\"btnhapus".$datajson->respon[0]->data[$no]->BARANG_ID."\" class=\"btn btn-outline-danger\"><i class=\"fas fa-trash\"></i></button>";
				$row[] = $datajson->respon[0]->data[$no]->BARANG_ID;
				$row[] = "KODE TRANSAKSI : ".$datajson->respon[0]->data[$no]->PRODUK_ID_VENDOR."<br>VENDOR SERVER : ".$datajson->respon[0]->data[$no]->SUPPLER_ID;
				$row[] = $datajson->respon[0]->data[$no]->NAMABARANG;
				if (service('request')->getPost('JENISPRODUK') == "TAGIHAN"){
					$row[] = formatuang('IDR',$datajson->respon[0]->data[$no]->ADMIN,"Rp");
					$row[] = formatuang('IDR',$datajson->respon[0]->data[$no]->KOMISI,"Rp");
				}else{
					$row[] = formatuang('IDR',$datajson->respon[0]->data[$no]->HARGABELI,"Rp");
					$row[] = formatuang('IDR',$datajson->respon[0]->data[$no]->HARGAJUAL,"Rp");
					$row[] = formatuang('IDR',$datajson->respon[0]->data[$no]->HARGA_1,"Rp");
					$row[] = formatuang('IDR',$datajson->respon[0]->data[$no]->HARGA_2,"Rp");
				}
				$row[] = $datajson->respon[0]->data[$no]->AKTIF == "0" ? '<span class="badge badge-label-danger badge-xl">PRODUK GANGGUAN</span>' : '<span class="badge badge-label-success badge-xl">PRODUK NORMAL</span>' ;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->respon[0]->totaldata,
				"recordsFiltered" => $datajson->respon[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
    }
	public function getformat(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'KATEGORI_ID' => service('request')->getPost('kategori_id'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/getformat", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function hapusperproduk(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'BARISKE' => service('request')->getPost('BARISKE'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/hapusperproduk", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function tambahprodukproses(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'ISEDIT' => service('request')->getPost('ISEDIT'),
			'PRODUK_ID' => service('request')->getPost('PRODUK_ID'),
			'PRODUK_SERVER' => service('request')->getPost('PRODUK_SERVER'),
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
			'APAKAHGROSIR' => service('request')->getPost('APAKAHGROSIR'),
			'STOKDAPATMINUS' => service('request')->getPost('STOKDAPATMINUS'),
			'JENISBARANG' => service('request')->getPost('JENISBARANG'),
			'PEMILIK' => service('request')->getPost('PEMILIK'),
			'APAKAHBONUS' => service('request')->getPost('APAKAHBONUS'),
			'FILECITRA' => service('request')->getPost('FILECITRA'),
			'URUTAN' => service('request')->getPost('URUTAN'),
			'HARGA_1' => service('request')->getPost('HARGA_1'),
			'HARGA_2' => service('request')->getPost('HARGA_2'),
			'HARGA_3' => service('request')->getPost('HARGA_3'),
			'MULTI' => service('request')->getPost('MULTI'),
			'POIN' => service('request')->getPost('POIN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/tambahprodukproses", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function simpanoperator(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'PRINCIPAL_ID' => service('request')->getPost('PRINCIPAL_ID'),
			'NAMA_PRINCIPAL' => service('request')->getPost('NAMA_PRINCIPAL'),
			'URL_CITRA' => service('request')->getPost('URL_CITRA'),
            'STATUS' => service('request')->getPost('STATUS'),
			'PREFIX' => service('request')->getPost('PREFIX'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'ISEDIT' => service('request')->getPost('ISEDIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/simpanoperator", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
    public function simpankategori(){
		
        $client = \Config\Services::curlrequest();
		$datapost = [
			'KATEGORI_ID' => service('request')->getPost('KATEGORI_ID'),
			'NAMAKATEGORI' => service('request')->getPost('NAMAKATEGORI'),
            'URL_CITRA' => service('request')->getPost('URL_CITRA'),
			'STATUS' => service('request')->getPost('STATUS'),
			'FORMAT' => service('request')->getPost('FORMAT'),
            'PLACEHOLDER' => service('request')->getPost('PLACEHOLDER'),
			'KETERANGAN' => htmlspecialchars(service('request')->getPost('KETERANGAN'), ENT_QUOTES, 'UTF-8'),
			'URUTAN' => service('request')->getPost('URUTAN'),
			'SLUG_URL' => service('request')->getPost('SLUG_URL'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'ISEDIT' => service('request')->getPost('ISEDIT'),
			'IDOPERATOR' => service('request')->getPost('IDOPERATOR'),
			'IDVENDOR' => service('request')->getPost('IDVENDOR'),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/simpankategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function daftarkategori(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/daftarkategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->respon[0]->success == false){
			$outputDT = [
				"draw" => 0,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->respon[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<button data-toggle=\"modal\" data-target=\"#modalsinkronproduk\" onclick=\"sinkronbarang(false,'".$datajson->respon[0]->data[$no]->KATEGORIPARENT_ID."','".$datajson->respon[0]->data[$no]->NAMAKATEGORI."','".$datajson->respon[0]->data[$no]->VENDOR_ID."','".$datajson->respon[0]->data[$no]->NAMA_SERVER."')\" class=\"btn btn-outline-success\"><i class=\"fas fa-sync\"></i></button> <button  onclick=\"ubahinformasi('".$datajson->respon[0]->data[$no]->KATEGORIPARENT_ID."','".$datajson->respon[0]->data[$no]->NAMAKATEGORI."','".$datajson->respon[0]->data[$no]->URL_CITRA."','".$datajson->respon[0]->data[$no]->STATUS."','".$datajson->respon[0]->data[$no]->FORMAT."','".$datajson->respon[0]->data[$no]->PLACEHOLDER."','".$datajson->respon[0]->data[$no]->KETERANGAN."','".$datajson->respon[0]->data[$no]->OPERATOR_ID."','".$datajson->respon[0]->data[$no]->NAMA_PRINCIPAL."','".$datajson->respon[0]->data[$no]->VENDOR_ID."','".$datajson->respon[0]->data[$no]->NAMA_SERVER."')\" class=\"btn btn-outline-primary\"><i class=\"fas fa-edit\"></i> Ubah</button> <button id=\"hapuskategori".$datajson->respon[0]->data[$no]->AI."\" onclick=\"deletekategori('".$datajson->respon[0]->data[$no]->KATEGORIPARENT_ID."','".$datajson->respon[0]->data[$no]->NAMAKATEGORI."','".$datajson->respon[0]->data[$no]->AI."')\" class=\"btn btn-outline-danger\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = 
				"<div class=\"rich-list-item\" style=\"padding:0px\">
					<div class=\"rich-list-prepend\">
						<div class=\"avatar\">
							<div class=\"avatar-display\">
								<img src=\"".$datajson->respon[0]->data[$no]->URL_CITRA."\">
							</div>
						</div>
					</div>
					<div class=\"rich-list-content\">
						<h4 class=\"rich-list-title\">NAMA KATEGORI : ".$datajson->respon[0]->data[$no]->KATEGORI_ID."</h4>
						<span class=\"rich-list-subtitle\">ID KATEGORI : ".$datajson->respon[0]->data[$no]->NAMAKATEGORI."</span>
					</div>
				</div>";
                $row[] = $datajson->respon[0]->data[$no]->NAMAKATEGORI;
				$row[] = $datajson->respon[0]->data[$no]->NAMA_SERVER;
				$row[] = $datajson->respon[0]->data[$no]->IP_PROVIDER;
				$row[] = $datajson->respon[0]->data[$no]->FORMAT;
				$row[] = $datajson->respon[0]->data[$no]->STATUS == "0" ? '<span class="badge badge-label-danger badge-xl">KATEGORI TIDAK AKTIF</span>' : '<span class="badge badge-label-success badge-xl">KATEGORI AKTIF</span>' ;
				$row[] = $datajson->respon[0]->data[$no]->PLACEHOLDER;
				$row[] = html_entity_decode($datajson->respon[0]->data[$no]->KETERANGAN, ENT_QUOTES, 'UTF-8');
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->respon[0]->totaldata,
				"recordsFiltered" => $datajson->respon[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
    }
	public function ajaxoperatordt(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/ajaxoperatordt", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->respon[0]->success){
			for ($no = 0; $no < $datajson->respon[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<button onclick=\"ubahinformasi('".$datajson->respon[0]->data[$no]->PRINCIPAL_ID."','".$datajson->respon[0]->data[$no]->NAMA_PRINCIPAL."','".$datajson->respon[0]->data[$no]->PREFIX."','".$datajson->respon[0]->data[$no]->STATUS."','".$datajson->respon[0]->data[$no]->URL_CITRA."','".$datajson->respon[0]->data[$no]->AI."')\" class=\"btn btn-outline-primary\"><i class=\"fas fa-edit\"></i> Pilih Ini</button> <button id=\"hapusoperatorid".$datajson->respon[0]->data[$no]->AI."\" onclick=\"deleteoperator('".$datajson->respon[0]->data[$no]->PRINCIPAL_ID."','".$datajson->respon[0]->data[$no]->NAMA_PRINCIPAL."','".$datajson->respon[0]->data[$no]->AI."')\" class=\"btn btn-outline-danger\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = $datajson->respon[0]->data[$no]->PRINCIPAL_ID;
                $row[] = $datajson->respon[0]->data[$no]->NAMA_PRINCIPAL;
				$row[] = $datajson->respon[0]->data[$no]->PREFIX;
				$row[] = $datajson->respon[0]->data[$no]->STATUS == "0" ? '<span class="badge badge-label-danger badge-xl">OPERATOR TIDAK AKTIF</span>' : '<span class="badge badge-label-success badge-xl">OPERATOR AKTIF</span>' ;
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->respon[0]->totaldata,
				"recordsFiltered" => $datajson->respon[0]->totaldata,
				"data" => $data
			];
		}else{
			$outputDT = [
				"draw" => 0,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}
		return json_encode($outputDT);
    }
	public function hapusoperator(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'OPERATOR_ID' => service('request')->getPost('OPERATOR_ID'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/hapusoperator", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function hapuskategori(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'KATEGORI_ID' => service('request')->getPost('KATEGORI_ID'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/hapuskategori", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function pilihoperator(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/ajaxoperatordt", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->respon[0]->totaldata; $x++) {
			$jsontext .= '{"idoperator": "'.$datajson->respon[0]->data[$x]->PRINCIPAL_ID.'", "namaoperator": "'.$datajson->respon[0]->data[$x]->NAMA_PRINCIPAL.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1);
		$jsontext .= "]";
		return json_encode($jsontext);
    }
    public function sinkronproduk(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'SERVERID' => service('request')->getPost('SERVERID'),
			'CMD' => "produk",
			'JENISPRODUK' => service('request')->getPost('JENISPRODUK'),
			'SKU_EXACT' => service('request')->getPost('SKU_EXACT'),
			'SKU_FILTER' => service('request')->getPost('SKU_FILTER'),
			'KATEGORI_ID' => service('request')->getPost('KATEGORI_ID'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/sinkronproduk", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->respon[0]);
    }
	public function dafartranskasi(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISIMODEL' => service('request')->getPost('KONDISIMODEL'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMNER'),
			'AGEN' => service('request')->getPost('AGEN'),
			'LOKASI' => service('request')->getPost('LOKASI'),
			'KATAKUNCIPENCARIAN' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'PARAMETERPENCARIAN' => service('request')->getPost('PARAMETERPENCARIAN'),
			'STATUSTRANSKASI' => service('request')->getPost('STATUSTRANSKASI'),
			'STATUSMEMBER' => service('request')->getPost('STATUSMEMBER'),
			'TANGGALAWAL' => service('request')->getPost('TANGGALAWAL'),
			'TANGGALAKHIR' => service('request')->getPost('TANGGALAKHIR'),
			'STATUSDATA' => service('request')->getPost('STATUSDATA'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/dafartranskasi", [
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
				$kondisistatus = '<span class="badge badge-label-danger badge-xl">ERR</span>';
				switch ($datajson->hasiljson[0]->data[$no]->STATUSTRX) {
					case "0":
						$kondisistatus = '<span class="badge badge-label-primary badge-xl">PENDING</span>';
						break;
					case "1":
						$kondisistatus = '<span class="badge badge-label-success badge-xl">SUKSES</span>';
						break;
					case "2":
						$kondisistatus = '<span class="badge badge-label-danger badge-xl">GAGAL</span>';
						break;
				} 
				$row = [];
				$row[] = "<button data-toggle=\"modal\" data-target=\"#kirimulang\" onclick=\"kirimulangfn('".$datajson->hasiljson[0]->data[$no]->TRANSKASI_ID."','".$datajson->hasiljson[0]->data[$no]->APISERVER_ID."','".$datajson->hasiljson[0]->data[$no]->TUJUAN."','".$datajson->hasiljson[0]->data[$no]->PRODUK_ID_SERVER."')\" class=\"btn btn-outline-success\"><i class=\"fas fa-share-square\"></i> Cek</button>  <button onclick=\"hapustransaksiacipay('".$datajson->hasiljson[0]->data[$no]->TRANSKASI_ID."','".$datajson->hasiljson[0]->data[$no]->NAMA_PRODUK."')\" class=\"btn btn-outline-danger\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = $kondisistatus;
				$row[] = $datajson->hasiljson[0]->data[$no]->TRANSKASI_ID;
                $row[] = $datajson->hasiljson[0]->data[$no]->TUJUAN." [".$datajson->hasiljson[0]->data[$no]->PRODUK_ID_SERVER."]";
				$row[] = $datajson->hasiljson[0]->data[$no]->NAMA_PRODUK;
				$row[] = $datajson->hasiljson[0]->data[$no]->AGEN;
				$row[] = $datajson->hasiljson[0]->data[$no]->PENGIRIM;
				$row[] = $datajson->hasiljson[0]->data[$no]->SN;
				$row[] = $datajson->hasiljson[0]->data[$no]->TANGGALTRXF;
				$row[] = $datajson->hasiljson[0]->data[$no]->TANGGALUPDATEF;
				$row[] = $datajson->hasiljson[0]->data[$no]->HARGA_BELI > $datajson->hasiljson[0]->data[$no]->HARGA_KEAGEN ? "0" : "1" ;
				$row[] = $datajson->hasiljson[0]->data[$no]->KETERANGAN;
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
	public function transkasiacipay(){
		$this->breadcrumb  = array( 
			"Transaksi Hari Ini" => base_url()."acipay/transkasiacipay",
		);
		$data = [
            "menuaktif" => "A1",
			"submenuaktif" => "S2",
			"titleheader"=>"TRANSAKSI HARI INI",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            
		];
		return view('acipay/transaksi/kontendaftartransaksi',$data);
	}
	public function hapuspenjualan(){
		if ($this->session->get("kodeunikmember") == ""){
			return redirect()->to('/auth');
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'TRANSAKSIID' => service('request')->getPost('TRANSAKSIID'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODENIKMEMBER' => service('request')->getPost('KODENIKMEMBER'),
			'NAMAPRODUK' => service('request')->getPost('NAMAPRODUK'),
		];
		$json_data = $client->request("POST", BASEURLAPI."acipay/hapustransaksi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$arrne = [['csrfName' => csrf_token()],['csrfHash' => csrf_hash()]];
		$jsonbaru = array_merge($datajson->hasiljson, $arrne);
		return json_encode($jsonbaru);
	}
	public function transkasiacipaybackend(){
		$this->breadcrumb  = array( 
			"Trx Hari Ini" => base_url()."acipay/transkasiacipay",
			"Trx Baru" => base_url()."acipay/transkasiacipaybackend",
		);
		$data = [
            "menuaktif" => "A1",
			"submenuaktif" => "S2",
			"titleheader"=>"TRANSAKSI BARU",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
            
		];
		return view('acipay/transaksi/kontentranskasibackend',$data);
	}
	public function transaksikedealer(){
		if ($this->session->get("kodeunikmember") == ""){
			return redirect()->to('/auth');
		}
		$client = \Config\Services::curlrequest();
		$routernodejs = "";
		if (service('request')->getPost('KONDISI') == "FIXTRX"){
			$routernodejs = "penjualan/transaksidigital";
			$datapost = [
				'KONDISI' => service('request')->getPost('KONDISI'),
				'IDSERVER' => service('request')->getPost('IDSERVER'),
				'TRANSKASI_ID' => service('request')->getPost('TRANSKASI_ID'),
				'ANTRIAN_ID' => service('request')->getPost('ANTRIAN_ID'),
				'TAGIHAN' => service('request')->getPost('TAGIHAN'),
				'KODEPRODUK' => service('request')->getPost('KODEPRODUK'),
				'NAMA_PRODUK' => service('request')->getPost('NAMA_PRODUK'),
				'HARGA_BELI' => service('request')->getPost('HARGA_BELI'),
				'HARGA_KEAGEN' => service('request')->getPost('HARGA_KEAGEN'),
				'HARGA_JUALKEPELANGGAN' => service('request')->getPost('HARGA_JUALKEPELANGGAN'),
				'KOMISI' => service('request')->getPost('KOMISI'),
				'TUJUAN' => service('request')->getPost('TUJUAN'),
				'NOMORPELANGGAN' => service('request')->getPost('NOMORPELANGGAN'),
				'KETERANGAN' => service('request')->getPost('KETERANGAN'),
				'PENGIRIM' => service('request')->getPost('PENGIRIM'),
				'STATUSTRX' => service('request')->getPost('STATUSTRX'),
				'AGEN' => service('request')->getPost('AGEN'),
				'VIA' => service('request')->getPost('VIA'),
				'PEMBAYARAN' => service('request')->getPost('PEMBAYARAN'),
				'JENIS_TRANSAKSI' => service('request')->getPost('JENIS_TRANSAKSI'),
				'PERULANGAN' => service('request')->getPost('PERULANGAN'),
				'SALDO_SEBELUM' => service('request')->getPost('SALDO_SEBELUM'),
				'SALDO_SESUDAH' => service('request')->getPost('SALDO_SESUDAH'),
				'NOMORNOTA' => service('request')->getPost('NOMORNOTA'),
				'LOKASI' => service('request')->getPost('LOKASI'),
				'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
				'SESSIONKODE' => service('request')->getPost('SESSIONKODE'),
				'SATPAMTRX' => service('request')->getPost('SATPAMTRX'),
			];
		}else if (service('request')->getPost('KONDISI') == "CEKID"){
			$routernodejs = "acipay/cekvalidasitujuan";
			$datapost = [
				'CMD' => service('request')->getPost('KONDISI'),
				'TUJUAN' => service('request')->getPost('TUJUAN'),
				'IDSERVER' => service('request')->getPost('IDSERVER'),
			];
		}else if (service('request')->getPost('KONDISI') == "CEKTAGIHAN"){
			$routernodejs = "acipay/cektagihan";
			$datapost = [
				'CMD' => service('request')->getPost('KONDISI'),
				'SKUKODE' => service('request')->getPost('SKUKODE'),
				'IDSERVER' => service('request')->getPost('IDSERVER'),
				'TUJUAN' => service('request')->getPost('TUJUAN'),
				'REFID' => service('request')->getPost('REFID'),
			];
		}else{
			$routernodejs = "acipay/transaksikedealer";
			$datapost = [
				'KONDISI' => service('request')->getPost('KONDISI'),
				'PREFIX' => service('request')->getPost('PREFIX'),
				'IDPRODUK' => service('request')->getPost('IDPRODUK'),
				'PENCARIANPRODUK' => service('request')->getPost('PENCARIANPRODUK'),
			];
		}
		$json_data = $client->request("POST", BASEURLAPI.$routernodejs, [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$arrne = [['csrfName' => csrf_token()],['csrfHash' => csrf_hash()]];
		$jsonbaru = array_merge($datajson->hasiljson, $arrne);
		return json_encode($jsonbaru);
	}
	public function cektransaksi(){
		if ($this->session->get("kodeunikmember") == ""){
			return redirect()->to('/auth');
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'IDSERVER' => service('request')->getPost('IDSERVER'),
			'TRANSKASI_ID' => service('request')->getPost('TRANSKASI_ID'),
			'TUJUAN' => service('request')->getPost('TUJUAN'),
			'KODEPRODUK' => service('request')->getPost('KODEPRODUK'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/cektransaksi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$arrne = [['csrfName' => csrf_token()],['csrfHash' => csrf_hash()]];
		$jsonbaru = array_merge($datajson->hasiljson, $arrne);
		return json_encode($jsonbaru);
	}
}