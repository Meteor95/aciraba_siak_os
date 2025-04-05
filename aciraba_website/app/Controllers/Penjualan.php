<?php

namespace App\Controllers;
use App\Models\KasirModel;
use App\Models\PenjualanModel;

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;

class Penjualan extends BaseController{
    protected $uri,$kasirModel,$penjualanModel,$session,$breadcrumb,$sidetitle = "Penjualan";
	protected $datasessionparameter = [];	
	function __construct(){
		$db = db_connect();
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
		$this->kasirModel = new KasirModel($db);
		$this->penjualanModel = new PenjualanModel($db);
		$this->session = \Config\Services::session();
        $this->session->start();
		array_push($this->datasessionparameter,
			$this->session->get("outlet"),
			$this->session->get("kodeunikmember"),
			$this->session->get("kodekomputer"),
		);
    }
	public function notamenupenjualan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'AWALANOTA' => service('request')->getPost('AWALANOTA'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEKUMPUTERLOKAL' => service('request')->getPost('KODEKUMPUTERLOKAL'),
			'TANGGALSEKARANG' => service('request')->getPost('TANGGALSEKARANG'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/notamenupenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	/* area algoritma pesanan penjualan */
	public function daftarpesanan(){
		$this->breadcrumb  = array( 
			"Daftar Pesanan" => base_url()."penjualan/daftarpesanan",
		);
		$data = [
			"titleheader"=>"DAFTAR PESANAN",
			"menuaktif" => "4",
			"submenuaktif" => "12",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			
		];
		return view('backend/penjualan/kontendaftarpesanan',$data);
	}
	public function jsondaftarpesanan(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => service('request')->getPost('DIMANA2'),
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => service('request')->getPost('DIMANA4'),
			'DIMANA5' => service('request')->getPost('DIMANA5'),
			'DIMANA19' => service('request')->getPost('DIMANA19'),
			'DIMANA20' => service('request')->getPost('DIMANA20'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarpesanan", [
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
			$akandiganti = ["/", "#"];
			$dengan = ["", ""];
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = '<a href="'.base_url().'penjualan/daftarpesananmodedetail/'.$datajson->hasiljson[0]->dataquery[$no]->NOTANONFORMAT.'"><button class="btn btn-outline-success btn-icon"><i class="fas fa-info-circle"></i></button></a>';
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TGLKELUAR." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTU;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->FK_MEMBER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMA;
				$row[] = "Rp ".number_format($datajson->hasiljson[0]->dataquery[$no]->TOTALTRX, 2, ',', '.');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->STOKKELUAR." QTY";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ENUM_TIPETRANSAKSI;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ENUM_JENISTRANSAKSI;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->JENISTRANSAKSI;
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
	public function daftarpesananmodedapur(){
		
		$this->breadcrumb  = array( 
			"Daftar Pesanan" => base_url()."penjualan/daftarpesanan",
			"Mode Dapur" => base_url()."penjualan/daftarpesananmodedapur",
		);
		$data = [
			"titleheader"=>"DAFTAR PESANAN",
			"menuaktif" => "-1",
			"submenuaktif" => "12",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			
		];
		return view('backend/penjualan/kontendaftarpesanandapurmode',$data);
	}
	public function jsondaftarpesananmodedapur(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => service('request')->getPost('DIMANA4'),
			'DIMANA5' => service('request')->getPost('DIMANA5'),
			'DIMANA6' => service('request')->getPost('DIMANA6'),
			'DIMANA7' => service('request')->getPost('DIMANA7'),
			'DIMANA8' => service('request')->getPost('DIMANA8'),
			'DIMANA19' => service('request')->getPost('DIMANA19'),
			'DIMANA20' => service('request')->getPost('DIMANA20'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarpesananmodedapur", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasilgroupby);
	}
	public function daftarpesananmodedetail(){
		
		$this->breadcrumb  = array( 
			"Daftar Pesanan" => base_url()."penjualan/daftarpesanan",
			"Detail Pesanan ".$this->uri->getSegment(3) => base_url()."penjualan/daftarpesananmodedetail/".$this->uri->getSegment(3),
		);
		$data = [
			"titleheader"=>"DETAIL PESANAN",
			"menuaktif" => "4",
			"submenuaktif" => "12",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			
			"notanonformat" => $this->uri->getSegment(3),
		];
		return view('backend/penjualan/kontendaftarpesanandetail',$data);
	}
	public function jsondaftarpesananmodedetail(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => service('request')->getPost('KONDISI'),
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA6' => service('request')->getPost('DIMANA6'),
			'DIMANA19' => service('request')->getPost('DIMANA19'),
			'DIMANA20' => service('request')->getPost('DIMANA20'),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarpesanandetail", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
    /* area algoritma retur penjualan */
	public function daftarreturpenjualan(){
		$this->breadcrumb  = array( 
			"Daftar Retur Penjualan" => base_url()."penjualan/daftarreturpenjualan",
		);
		$data = [
			"titleheader"=>"DAFTAR RETUR PENJUALAN",
			"menuaktif" => "4",
			"submenuaktif" => "13",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			
		];
		return view('backend/penjualan/kontendaftarreturpenjualan',$data);
	}
	public function simpanreturlocal(){
		$data = array();
		array_push($data,
		'',
		service('request')->getPost('NOTRXRETUR'),
		service('request')->getPost('NOTRXPENJUALAN'),
		service('request')->getPost('KODEBARANG'),
		service('request')->getPost('NAMABARANG'),
		service('request')->getPost('JUMLAHBELI'),
		service('request')->getPost('JUMLAHRETUR'),
		service('request')->getPost('HARGABELI'),
		service('request')->getPost('HARGAJUAL'),
		service('request')->getPost('PPN'),
		service('request')->getPost('TUJUANOUTLET'),
		service('request')->getPost('TUJUANLOKASISSTOK'),
		service('request')->getPost('KETERANGAN'),
		service('request')->getPost('JENISTRX'),
		$this->session->get("outlet"),
		$this->session->get("kodeunikmember"),
		);
		return $simpan = $this->penjualanModel->add($data,$this->datasessionparameter);
	}
	public function hapusreturpenjualan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTARETURPENJUALAN' => service('request')->getPost('NOTARETURPENJUALAN'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/hapusreturpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function jsondaftarreturpenjualan(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "27",
			'DIMANA1' => service('request')->getPost('parameterpencarian'),
			'DIMANA2' => service('request')->getPost('katakunci'),
			'DIMANA3' => service('request')->getPost('tanggalawal'),
			'DIMANA4' => service('request')->getPost('tanggalakhir'),
			'DIMANA5' => $this->session->get("outlet"),
			'DIMANA6' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarreturpenjualan", [
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
				$row[] = "<button onclick=\"hapusreturpenjualan('".$datajson->hasiljson[0]->dataquery[$no]->NOTRXRETUR."','".formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALRETUR,'Rp ')."')\" class=\"btn btn-danger mr-2\"><i class=\"fas fa-trash\"></i></button> <a href=\"".base_url()."penjualan/tambahreturpenjualan/".$datajson->hasiljson[0]->dataquery[$no]->BARISRETUR."\"<button class=\"btn btn-success\"><i class=\"fas fa-edit\"></i> Detail</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTRXRETUR;
				$row[] = str_replace("::"," ",$datajson->hasiljson[0]->dataquery[$no]->NAMA);
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALRETUR));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TOTALBARANG." Barang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALRETUR,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->OUTLET;
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
    public function tambahreturpenjualan()	{
		
		$this->breadcrumb  = array( 
			"Daftar Retur Penjualan" => base_url()."penjualan/daftarreturpenjualan",
            "Tambah Retur Penjualan" => base_url()."penjualan/tambahreturpenjualan",
		);
		if ($this->uri->getSegment(3) != ''){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "28",
				'DIMANA1' => $this->uri->getSegment(3),
				'DIMANA2' => $this->session->get("outlet"),
				'DIMANA3' => $this->session->get("kodeunikmember"),
			];
			$json_data = $client->request("POST", BASEURLAPI."penjualan/formreturpenjualan", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			$data = [
				"titleheader"=>"UBAH RETUR PENJUALAN ",
				"menuaktif" => "4",
				"submenuaktif" => "13",
				"breadcrumb"=>$this->breadcrumb,
				"sidetitle" => $this->sidetitle,
				"SEGMENT" => $this->uri->getSegment(2),
				"isedit" => 1,
				"kodemember" => $datajson->hasiljson[0]->dataquery[0]->MEMBER_ID,
				"namamember" => $datajson->hasiljson[0]->dataquery[0]->NAMA,
				"alamatmember" => $datajson->hasiljson[0]->dataquery[0]->ALAMAT,
				"nomorreturedit" => $datajson->hasiljson[0]->dataquery[0]->NOTRXRETUR,
			];
			$this->penjualanModel->pindahdetailkelocal($datajson->hasiljson[0]->dataquery,$datajson->hasiljson[0]->totaldata, $this->datasessionparameter);
		}else{
			$data = [
				"titleheader"=>"TAMBAH RETUR PENJUALAN ",
				"menuaktif" => "4",
				"submenuaktif" => "13",
				"breadcrumb"=>$this->breadcrumb,
				"sidetitle" => $this->sidetitle,
				"SEGMENT" => $this->uri->getSegment(2),
				"isedit" => 0,
				"kodemember" => "",
				"namamember" => "",
				"alamatmember" => "",
				"nomorreturedit" => "",
			];
		}
		return view('backend/penjualan/kontentambahreturpenjualan',$data);
	}
	public function returpenjualandetailbarang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "26",
			'DIMANA1' => service('request')->getPost('KODEBARANG'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/ambiltrxjual", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function jsonambiltrxjual(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "25",
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/ambiltrxjual", [
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
				$row[] = "<button onclick=\"simpanreturlocal(
					'',
					'".$datajson->hasiljson[0]->dataquery[$no]->NOTAPENJUALAN."',
					'".$datajson->hasiljson[0]->dataquery[$no]->FK_BARANG."',
					'".$datajson->hasiljson[0]->dataquery[$no]->NAMABARANG."',
					'".$datajson->hasiljson[0]->dataquery[$no]->STOKBARANGKELUAR."',
					'1',
					'".$datajson->hasiljson[0]->dataquery[$no]->HARGABELI."',
					'".$datajson->hasiljson[0]->dataquery[$no]->HARGAJUAL."',
					'".$datajson->hasiljson[0]->dataquery[$no]->PPN."',
					'','','',
					'".$datajson->hasiljson[0]->dataquery[$no]->ENUM_JENISTRANSAKSI."',
					)\" class=\"btn btn-outline-success\"><i class=\"fas fa-check\"></i> Pilih Ini</button>";
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TGLKELUAR))." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTU;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->FK_BARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMABARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->STOKBARANGKELUAR;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HARGABELI,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HARGAJUAL,'Rp ');
				$row[] = formatuang('IDR',($datajson->hasiljson[0]->dataquery[$no]->STOKBARANGKELUAR * $datajson->hasiljson[0]->dataquery[$no]->HARGAJUAL),'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ENUM_JENISTRANSAKSI;
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
	public function returjuallocal(){
		$data = array();
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		array_push($data,service('request')->getPost('KONDISI'));
		$datajson = json_decode($this->penjualanModel->daftarreturlocal($data,$this->datasessionparameter));
		$data = array();
		if ($datajson->adadata == "ada"){
			for ($no = 0; $no < $datajson->jumlahdata; $no++) {
				$row = [];
				$row[] = "<button onclick=\"hapusperbarangretur('".$datajson->datakeranjang[$no]->KODEBARANG."','".$datajson->datakeranjang[$no]->NAMABARANG."','".$datajson->datakeranjang[$no]->AI."')\" class=\"btn btn-danger btn-block\"><i class=\"fas fa-trash\"></i></button>";
				$row[] = "<input readonly id=\"noretur".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NOTRXRETUR."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"notapenjualan".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NOTRXPENJUALAN."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"kodeitem".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->KODEBARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"namaitem".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"jumlahbeli".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->JUMLAHBELI."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"jumlahretur".$datajson->datakeranjang[$no]->KODEBARANG."".$no."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->JUMLAHRETUR."\" class=\"form-control\">";
				$row[] = "<input readonly id=\"hargajual".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HARGABELI."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"hargabeli".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HARGAJUAL."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"ppn".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->PPN."\" class=\"form-control\">";
				$row[] = "<input readonly id=\"keoutlet".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->TUJUANOUTLET."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"kelokasi".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->TUJUANLOKASISSTOK."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"keterangan".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->KETERANGAN."\" class=\"form-control\">";
				$row[] = "<input readonly id=\"jenistrx".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->JENISTRX."\" class=\"form-control-plaintext\">";
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
	public function updatekeranjangretur(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('JUMLAHBELI'),
			service('request')->getPost('HARGAJUAL'),
			service('request')->getPost('KETERANGAN'),
			service('request')->getPost('PPN'),
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('OUTLET'),
			$this->session->get("kodeunikmember"),
		);
		return $simpan = $this->penjualanModel->updatekeranjangretur($data,$this->datasessionparameter);
	}
	public function jsonambiltrxpiutang(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "19",
			'DIMANA1' => service('request')->getPost('MEMBERID'),
			'DIMANA2' => '2',
			'DIMANA5' => "False",
			'DIMANA6' => service('request')->getPost('NOPOTONGPIUTANG'),
			'DIMANA9' => $this->session->get("kodeunikmember"),
			'DIMANA10' => $this->session->get("outlet"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/cekpotongpiutang", [
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
				$row[] = "<input readonly id=\"noreturpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->TRANSAKSI_ID."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"jatuhtempopkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"".date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->JATUHTEMPO))."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"totalpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->TOTALKREDIT."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"sisapkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->SISAKREDIT."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnterpotong('".$no."')\"  id=\"potongpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"0\" class=\"form-control\">";
				$row[] = "<input readonly id=\"subtotalpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."".$no."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->SISAKREDIT."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnterpotong('".$no."')\" id=\"keteranganpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"\" class=\"form-control\">";
				$row[] = "<input readonly id=\"nominalbayarpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->BAYAR."\" class=\"form-control-plaintext\">";
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
	public function jsontambahreturdanpotongpiutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ARRAYRETURBELI' => service('request')->getPost('ARRAYRETURBELI'),
			'ARRAYPOTONGPIUTANG' => service('request')->getPost('ARRAYPOTONGPIUTANG'),
			'POTONGPIUTANGAKTIF' => service('request')->getPost('POTONGPIUTANGAKTIF'),
			'APAKAHEDIT' => service('request')->getPost('APAKAHEDIT'),
			'NOTRXRETUR' =>service('request')->getPost('NOTRXRETUR'),
			'PETUGAS' => $this->session->get("pengguna_id"),
			'IDPELANGGAN' =>service('request')->getPost('IDPELANGGAN'),
			'TANGGALRETUR' =>service('request')->getPost('TANGGALRETUR'),
			'NOMORNOTA' =>service('request')->getPost('NOMORNOTA'),
			'TOTALBARANG' =>service('request')->getPost('TOTALBARANG'),
			'TOTALRETUR' =>service('request')->getPost('TOTALRETUR'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'ISEDIT' =>service('request')->getPost('ISEDIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/tambahreturpenjualan", [
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
	/* area algoritma daftar penjualan */
	public function daftarpenjualan()	{
		$this->breadcrumb  = array( 
			 "Daftar Penjualan" => base_url()."penjualan/daftarpenjualan",
		);
		$data = [
			"menuaktif" => "5",
			"submenuaktif" => "14",
			"titleheader"=>"DAFTAR PENJUALAN ANDA",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		
		return view('backend/penjualan/kontendaftarpenjualan',$data);
	}
	public function ajaxdaftarpenjualan(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "3",
			'DIMANA1' => "",
			'DIMANA2' => "",
			'DIMANA3' => service('request')->getPost('DIMANA3'),
			'DIMANA4' => service('request')->getPost('DIMANA4'),
			'DIMANA5' => service('request')->getPost('DIMANA5'),
			'DIMANA6' => service('request')->getPost('DIMANA6'),
			'DIMANA7' => service('request')->getPost('DIMANA7'),
			'DIMANA8' => "",
			'DIMANA9' => $this->session->get("kodeunikmember"),
			'DIMANA10' => $this->session->get("outlet"),
			'DATAKE' => 0,
			'LIMIT' => 500,
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarpenjualanadmin", [
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
				$row[] = "<a href=\"".base_url()."penjualan/kasir/".$datajson->hasiljson[0]->dataquery[$no]->AITRX."\"><button class=\"btn btn-outline-success\"><i class=\"fas fa-cash-register\"></i></button></a> <button onclick=\"onclickhapustranskasi('".$datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN."','".$datajson->hasiljson[0]->dataquery[$no]->NAMAMEMBER."')\" class=\"btn btn-outline-danger\"><i class=\"fas fa-trash\"></i></button>";
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TGLKELUAR))." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTU;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->FK_MEMBER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAMEMBER;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALBELANJA,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TOTALBARANGKELUAR;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ENUM_JENISTRANSAKSI;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->LOKASI;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
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
	public function hapuspenjualan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PK_NOTAPENJUALAN' => service('request')->getPost('PK_NOTAPENJUALAN'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'LOKASI' => service('request')->getPost('LOKASI'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/hapuspenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function cetakulangtransaksikasir(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "4",
			'DIMANA1' => service('request')->getPost('KODEAI'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/detailkasirpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function kasir(){
		
		if ($this->uri->getSegment(3) != ''){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "4",
				'DIMANA1' => $this->uri->getSegment(3),
				'DIMANA2' => $this->session->get("kodeunikmember"),
			];
			$json_data = $client->request("POST", BASEURLAPI."penjualan/detailkasirpenjualan", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			$data = [
				"isedit"=> "true",
				"titleheader"=> "ACIRABA",
				"notapenjualan" => $datajson->hasiljson[0]->dataquery[0]->PK_NOTAPENJUALAN,
				"kodesalesman" => $datajson->hasiljson[0]->dataquery[0]->FK_SALESMAN,
				"namasalesman" => $datajson->hasiljson[0]->dataquery[0]->NAMASALESMAN,
				"kodemember" => $datajson->hasiljson[0]->dataquery[0]->FK_MEMBER,
				"namamember" => $datajson->hasiljson[0]->dataquery[0]->NAMAMEMBER,
				"tanggaltransaksi" => $datajson->hasiljson[0]->dataquery[0]->TGLKELUAR,
				"textbuttonbayar" => "TRX",
				"jenistransaksi" => $datajson->hasiljson[0]->dataquery[0]->ENUM_JENISTRANSAKSI,
				/*konfirmasi kasir*/
				"nominaltunai" => $datajson->hasiljson[0]->dataquery[0]->NOMINALTUNAI,
				"nominalkredit" => $datajson->hasiljson[0]->dataquery[0]->NOMINALKREDIT,
				"nominalkdebit" => $datajson->hasiljson[0]->dataquery[0]->NOMINALKARTUDEBIT,
				"nomorkartudebit" => $datajson->hasiljson[0]->dataquery[0]->NOMORKARTUDEBIT,
				"bankdebit" => $datajson->hasiljson[0]->dataquery[0]->BANKDEBIT,
				"nominalkkredit" => $datajson->hasiljson[0]->dataquery[0]->NOMINALKARTUKREDIT,
				"nomorkartukredit" => $datajson->hasiljson[0]->dataquery[0]->NOMORKARTUKREDIT,
				"bankkredit" => $datajson->hasiljson[0]->dataquery[0]->BANKKREDIT,
				"nominalemoney" => $datajson->hasiljson[0]->dataquery[0]->NOMINALEMONEY,
				"vendoremoney" => $datajson->hasiljson[0]->dataquery[0]->NAMAEMONEY,
				"nominalpotongan" => $datajson->hasiljson[0]->dataquery[0]->NOMINALPOTONGAN,
				"idpenjualan" => $this->uri->getSegment(3),
				"pajaktoko" => $this->session->get("pajaktoko"),
				"pajaknegara" => $this->session->get("pajaknegara"),
				"vpajaktoko" => $datajson->hasiljson[0]->dataquery[0]->PAJAKTOKO,
				"vpajaknegara" => $datajson->hasiljson[0]->dataquery[0]->PAJAKNEGARA,
				"tipetransaksi" => $datajson->hasiljson[0]->dataquery[0]->TIPETRANSAKSI,
				"keterangantransaksi" => $datajson->hasiljson[0]->dataquery[0]->KETERANGAN,
				/* pesanan meja / tempat */
				"kodepesan_psn" => $datajson->hasiljson[0]->dataquery[0]->KODEPESAN,
				"kodemenupesanan_psn" => $datajson->hasiljson[0]->dataquery[0]->KODEMENUPESANAN,
				"kodemeja_psn" => $datajson->hasiljson[0]->dataquery[0]->KODEMEJA,
				"pemesan_psn" => $datajson->hasiljson[0]->dataquery[0]->PEMESAN,
				"notelpn_psn" => $datajson->hasiljson[0]->dataquery[0]->NOTELEPON,
				"untukberapaorang_psn" => $datajson->hasiljson[0]->dataquery[0]->UNTUKBERAPAORANG,
				"tanggal_psn" => $datajson->hasiljson[0]->dataquery[0]->TANGGAL,
				"waktu_psn" => $datajson->hasiljson[0]->dataquery[0]->WAKTU,
				"tanggala_psn" => $datajson->hasiljson[0]->dataquery[0]->TANGGALAKHIR,
				"waktua_psn" => $datajson->hasiljson[0]->dataquery[0]->WAKTUAKHIR,
				"warnamemo_psn" => $datajson->hasiljson[0]->dataquery[0]->WARNAMEMO,
				"uangmuka_psn" => $datajson->hasiljson[0]->dataquery[0]->DP,
			];
			$this->kasirModel->pindahdetailkelocal($datajson->hasiljson[0]->dataquery,$datajson->hasiljson[0]->totaldata, $this->datasessionparameter);
		}else{
			$data = [
				"isedit"=> "false",
				"titleheader"=> "ACIRABA",
				"notapenjualan" => "",
				"kodesalesman" =>"SLS1",
				"namasalesman" => "Salesman Umum",
				"kodemember" => "1001",
				"namamember" => "Member Umum",
				"tanggaltransaksi" =>"",
				"textbuttonbayar" => "BAYAR",
				"jenistransaksi" => "",
				/*konfirmasi kasir*/
				"nominaltunai" => 0,
				"nominalkredit" => 0,
				"nominalkdebit" => 0,
				"nomorkartudebit" => "",
				"bankdebit" => "",
				"nominalkkredit" => 0,
				"nomorkartukredit" => "",
				"bankkredit" => "",
				"nominalemoney" => 0,
				"vendoremoney" => "",
				"nominalpotongan" => 0,
				"idpenjualan" => $this->uri->getSegment(3),
				"pajaktoko" => $this->session->get("pajaktoko"),
				"pajaknegara" => $this->session->get("pajaknegara"),
				"vpajaktoko" => 0,
				"vpajaknegara" => 0,
				"tipetransaksi" => 0,
				"keterangantransaksi" => "",
				/* pesanan meja / tempat */
				"kodepesan_psn" => "",
				"kodemenupesanan_psn" => "",
				"kodemeja_psn" => "",
				"pemesan_psn" => "",
				"notelpn_psn" => "",
				"untukberapaorang_psn" => "",
				"tanggal_psn" => "",
				"waktu_psn" => "",
				"tanggala_psn" => "",
				"waktua_psn" => "",
				"warnamemo_psn" => "",
				"uangmuka_psn" => "",
			];
		}
		return view('kasir/kontenkasir',$data);
	}
	public function detailbarangkeranjang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "35",
			'DIMANA1' => service('request')->getPost('BARANG_ID'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/detailbarangkeranjang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function ajaxdaftarbarang(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "1",
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => service('request')->getPost('DIMANA2'),
			'DIMANA3' => '',
			'DIMANA4' => '',
			'DIMANA5' => '',
			'DIMANA6' => '',
			'DIMANA7' => '',
			'DIMANA8' => '',
			'DIMANA9' => '',
			'DIMANA10' => '',
			'DIMANA11' => '',
			'DIMANA12' => '',
			'DIMANA13' => '',
			'DIMANA14' => '',
			'DIMANA15' => '',
			'DIMANA16' => '',
			'DIMANA17' => '',
			'DIMANA18' => '',
			'DIMANA19' => service('request')->getPost('DIMANA19'),
			'DIMANA20' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 50,
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarbarangkasir", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	/* area algoritma history hargajual */
	public function daftarhistoryhargajual(){
		$this->breadcrumb  = array( 
			"Daftar Penjualan" => base_url()."penjualan/daftarhistoryhargajual",
		);
		$data = [
			"menuaktif" => "5",
			"submenuaktif" => "15",
			"titleheader"=>"DAFTAR HISTORI HARGA JUAL",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/penjualan/kontendaftarhargajual',$data);
	}
	/* area algoritma daftar piutang */
	public function daftarpiutang()	{
		$this->breadcrumb  = array( 
			"Daftar Piutang" => base_url()."penjualan/daftarpiutang",
		);
		$data = [
			"menuaktif" => "5",
			"submenuaktif" => "16",
			"titleheader"=>"DAFTAR TRANSAKSI PIUTANG MEMBER",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('backend/penjualan/kontendaftarpiutang',$data);
	}
	public function tambahpiutangdagang()	{
		
		$this->breadcrumb  = array( 
			"Daftar Piutang" => base_url()."penjualan/daftarpiutang",
			"Tambah Piutang Dagang" => base_url()."penjualan/tambahpiutangdagang",
		);
		$data = [
			"menuaktif" => "5",
			"submenuaktif" => "16",
			"titleheader"=>"TAMBAH PIUTANG DAGANG",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => "bayarpiutang",
		];
		return view('backend/penjualan/kontentambahpiutangdagang',$data);
	}
	public function filtermaubayarpiutang(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "8",
			'DIMANA1' => service('request')->getPost('MEMBERID'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/filtermaubayarpiutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function daftarpiutangterpilih(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '7',
			'DIMANA1' => service('request')->getPost('KATAKUNCI'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
			'DIMANA3' => $this->session->get("outlet"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarpiutangterpilih", [
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
			$ai = 0;
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = "<input class=\"form-control-plaintext\" type=\"text\" readonly value=\"".$datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN."\">";
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TGLKELUAR));
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALKREDIT,'Rp ');
				$row[] = "<div id=\"sisakredit".$ai."\">".formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->SISAKREDIT,'Rp ')."</div>";
				$row[] = "<div class=\"input-group\"><input readonly id=\"pembayaran".$ai."\" type=\"text\" class=\"form-control\" placeholder=\"0\" value=\"0\"><div onclick=\"hitungpernota('".$ai."','1')\" class=\"input-group-append\"><span class=\"input-group-text\"><i class=\"fas fa-window-close\"></i></span></div></div>";
				$row[] = "<button onclick=\"hitungpernota('".$ai."','0')\" class=\"btn btn-block btn-warning\"><i class=\"fas fa-sticky-note\"></i> Hitung Per Nota</button>";
				$data[] = $row;
				$ai++;
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
	
	/* kasir local*/
	public function bacakeranjangkasir(){
		$data = array();
		return json_encode($this->kasirModel->bacakeranjangkasir($this->datasessionparameter));
	}
	public function daftarnotapending(){
		$data = array();
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		array_push($data,service('request')->getPost('KATAKUNCIPENCARIAN'));
		$datajson = json_decode($this->kasirModel->daftarnotapending($data,$this->datasessionparameter));
		$data = array();
		if ($datajson->adadata == "ada"){
			for ($no = 0; $no < $datajson->jumlahdata; $no++) {
				$row = [];
				$row[] = $datajson->datakeranjang[$no]->KETERANGAN;
				$row[] = $datajson->datakeranjang[$no]->TOTALBARANG." PCS";
				$row[] = formatuang('IDR',$datajson->datakeranjang[$no]->TOTALBELANJA,'Rp ');
				$row[] = "<button onclick=\"restorenotapending('".$datajson->datakeranjang[$no]->KETERANGAN."')\" class=\"btn btn-block btn-primary\"><i class=\"fas fa-box\"></i> Pilih Ini</button>";
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
	public function tambahkeranjang(){
		$data = array();
		$hargajual = service('request')->getPost('HARGA_JUAL');
		$client = \Config\Services::curlrequest();
		/* untuk membaca apakah harga ini sudah termasuk grosir atau tidak */
		$datapost = [
			'BARANG_ID' => service('request')->getPost('BARANG_ID'), 
			'QTY' => service('request')->getPost('QTY'), 
			'OUTLET' => $this->session->get("outlet"), 
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"), 
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/validasistok", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if (!$datajson->hasiljson[0]->success){
			$jsonobj = '{"status": "out_of_stok","msg":"'.$datajson->hasiljson[0]->msg.'"}';
			return json_encode($jsonobj);
		}else{
			$json_data = $client->request("POST", BASEURLAPI."penjualan/tambahkeranjangbestbuy", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			if ($datajson->tambahkeranjangbestbuy[0]->success == "true"){
				$hargajual = $datajson->tambahkeranjangbestbuy[0]->dataquery[0]->HARGABELIGROSIR;
			}
			array_push($data,
			service('request')->getPost('BARANG_ID'),
			service('request')->getPost('NAMA_BARANG'),
			service('request')->getPost('QTY'),
			$hargajual,
			service('request')->getPost('HARGA_BELI'),
			"0",
			service('request')->getPost('KETERANGAN'),
			service('request')->getPost('DARIPERUSAHAAN'),
			service('request')->getPost('APAKAHVARIAN'),
			service('request')->getPost('STOKDAPATMINUS'),
			service('request')->getPost('JSONTAMBAHAN'),
			service('request')->getPost('BRAND_ID'),
			service('request')->getPost('PRINCIPAL_ID'),
			service('request')->getPost('HARGAASLI'),
			);
			return $simpan = $this->kasirModel->add($data,$this->datasessionparameter);
		}
	}
	public function tambahkeranjangpending(){
		$data = array();
		array_push($data,service('request')->getPost('KETERANGANTRX'));
		return $simpan = $this->kasirModel->copytabelkepending($data,$this->datasessionparameter);
	}
	public function pendingkekeranjang(){
		$data = array();
		array_push($data,service('request')->getPost('KETERANGAN'));
		return $simpan = $this->kasirModel->copytabelkekeranjang($data,$this->datasessionparameter);
	}
	public function updatekasirsementara(){
		$data = array();
		$client = \Config\Services::curlrequest();
		$datapost = [
			'BARANG_ID' => service('request')->getPost('BARANG_ID'), 
			'QTY' => service('request')->getPost('QTY'), 
			'OUTLET' => $this->session->get("outlet"), 
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"), 
		];
		$hargajual = service('request')->getPost('HARGAJUAL');
		/* cek stok jika minus yang status barangnya TIDAK DAPAT MINUS ditola masuk keranjang */
		$json_data = $client->request("POST", BASEURLAPI."penjualan/validasistok", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if (!$datajson->hasiljson[0]->success){
			$jsonobj = '{"status": "out_of_stok","msg":"'.$datajson->hasiljson[0]->msg.'"}';
			return json_encode($jsonobj);
		}else{
			/* jika paksa update harga jual dari modal detail per barang keranjang atau dari keranjang langsung */
			if (service('request')->getPost('PAKSAUPDTE') == 0){
				$json_data = $client->request("POST", BASEURLAPI."penjualan/tambahkeranjangbestbuy", [
					"headers" => [
						"Accept" => "application/json",
						"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
					],
					"form_params" => $datapost
				]);
				$datajson = json_decode($json_data->getBody());
				if ($datajson->tambahkeranjangbestbuy[0]->success == "true"){
					$hargajual = $datajson->tambahkeranjangbestbuy[0]->dataquery[0]->HARGABELIGROSIR;
				}else{
					/* dari update detail per barang keranjang sementara */
					if (service('request')->getPost('DARIUBAHHJDETAIL') == "YA"){
						$hargajual = $hargajual;
					}else{
						if (service('request')->getPost('EDITGROSIRAKTIF') == "true"){
							$hargajual = $datajson->tambahkeranjangbestbuy[0]->dataquery[0]->HARGAJUAL;
						}else{
							$hargajual = $hargajual;
						}
					}
				}
			}
			array_push($data,service('request')->getPost('BARANG_ID'),service('request')->getPost('QTY'),$hargajual,service('request')->getPost('JSONVARIAN'),service('request')->getPost('KETERANGAN'),service('request')->getPost('DARIUBAHHJDETAIL'));
			$updatekasirsementara = $this->kasirModel->updatekasirsementara($data,$this->datasessionparameter);
			if($updatekasirsementara){ $jsonobj = '{"status":"true","hargajual":'.$hargajual.'}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj); 
		}
	}
	public function hapuskeranjang(){
		$proses = $this->kasirModel->truncate($this->datasessionparameter); if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapuskeranjangretur(){
		$proses = $this->penjualanModel->hapuskeranjangretur($this->datasessionparameter); if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapusperbarang(){
		$data = [
			'BARANG_ID' => service('request')->getPost('BARANG_ID'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEKOMPUTER' => $this->session->get("kodekomputer"),
		];
		$proses = $this->kasirModel->hapusperbarang($data);
		if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapusperbarangretur(){
		$data = [
			'AI' => service('request')->getPost('AI'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEKOMPUTER' => $this->session->get("kodekomputer"),
		];
		$proses = $this->penjualanModel->hapusperbarangretur($data);
		if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function grandtotalkasir(){
		return json_encode($this->kasirModel->grandtotalkasir($this->datasessionparameter));
	}
	public function simpantransaksi(){
		$data = array();
		$client = \Config\Services::curlrequest();
		$datapost = [
			'INFORMASIBARANG' => service('request')->getPost('INFORMASIBARANG'), 
			'ADADATA' => service('request')->getPost('ADADATA'), 
            'PK_NOTAPENJUALAN' => service('request')->getPost('PK_NOTAPENJUALAN'), 
            'FK_MEMBER' => service('request')->getPost('FK_MEMBER'), 
            'FK_SALESMAN' => service('request')->getPost('FK_SALESMAN'), 
            'ENUM_JENISTRANSAKSI' => service('request')->getPost('ENUM_JENISTRANSAKSI'), 
            'JATUHTEMPO' => service('request')->getPost('JATUHTEMPO'), 
            'LOKASI' => service('request')->getPost('LOKASI'), 
            'TGLKELUAR' => service('request')->getPost('TGLKELUAR'), 
            'WAKTU' => service('request')->getPost('WAKTU'), 
            'KASIR' => service('request')->getPost('KASIR'), 
            'NOMORNOTA' => service('request')->getPost('NOMORNOTA'), 
            'KETERANGAN' => service('request')->getPost('KETERANGAN'), 
            'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'), 
            'NOMINALTUNAI' => service('request')->getPost('NOMINALTUNAI'), 
            'NOMINALKREDIT' => service('request')->getPost('NOMINALKREDIT'), 
            'NOMINALKARTUDEBIT' => service('request')->getPost('NOMINALKARTUDEBIT'), 
            'NOMORKARTUDEBIT' => service('request')->getPost('NOMORKARTUDEBIT'), 
            'BANKDEBIT' => service('request')->getPost('BANKDEBIT'), 
            'NOMINALKARTUKREDIT' => service('request')->getPost('NOMINALKARTUKREDIT'), 
            'NOMORKARTUKREDIT' => service('request')->getPost('NOMORKARTUKREDIT'), 
            'BANKKREDIT' => service('request')->getPost('BANKKREDIT'), 
            'NOMINALEMONEY' => service('request')->getPost('NOMINALEMONEY'), 
            'NAMAEMONEY' => service('request')->getPost('NAMAEMONEY'), 
            'NOMINALPOTONGAN' => service('request')->getPost('NOMINALPOTONGAN'), 
            'NOMINALPAJAKKELUAR' => service('request')->getPost('NOMINALPAJAKKELUAR'), 
			'KEMBALIAN' => service('request')->getPost('KEMBALIAN'),
			'TOTALBELANJA' => service('request')->getPost('TOTALBELANJA'), 
			'ISEDITKASIR' => service('request')->getPost('ISEDITKASIR'), 
			'PAJAKTOKO' => service('request')->getPost('PAJAKTOKO'), 
			'PAJAKNEGARA' => service('request')->getPost('PAJAKNEGARA'), 
			'POTONGANGLOBAL' => service('request')->getPost('POTONGANGLOBAL'), 
			'TIPETRANSAKSI' => service('request')->getPost('TIPETRANSAKSI'),
			/* PESANAN API */
			'KODEPESAN' => service('request')->getPost('KODEPESAN'), 
			'KODEMENUPESANAN' => service('request')->getPost('KODEMENUPESANAN'), 
			'KODEMEJA' => service('request')->getPost('KODEMEJA'), 
			'PEMESAN' => service('request')->getPost('PEMESAN'), 
			'NOTELEPON' => service('request')->getPost('NOTELEPON'), 
			'UNTUKBERAPAORANG' => service('request')->getPost('UNTUKBERAPAORANG'), 
			'TOTALBELANJA' => service('request')->getPost('TOTALBELANJA'), 
			'DP' => service('request')->getPost('DP'), 
			'TANGGAL' => service('request')->getPost('TANGGAL'), 
			'WAKTUAWAL' => service('request')->getPost('WAKTUAWAL'), 
			'TANGGALAKHIR' => service('request')->getPost('TANGGALAKHIR'), 
			'WAKTUAKHIR' => service('request')->getPost('WAKTUAKHIR'), 
			'NOMOR' => service('request')->getPost('NOMOR'), 
			'WARNAMEMO' => service('request')->getPost('WARNAMEMO'), 
			'STATUSPESAN' => service('request')->getPost('STATUSPESAN'),  
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/simpantransaksi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson);
	}
	public function ajaxdaftarpenjualankasir(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '2',
			'DIMANA1' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA3' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA20' => $this->session->get("kodeunikmember"),
			'DATAKE' => service('request')->getPost('DATAKE'),
			'LIMIT' => service('request')->getPost('LIMIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/daftarpenjualandikasir", [
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
				$statustransaksi = ""; $colortextcss = ""; $textproses = "";
				if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES == -3 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == -3 AND $datajson->hasiljson[0]->dataquery[$no]->ENUM_JENISTRANSAKSI == "TUNAI"){
					$textproses = "TERBAYAR";
				}else if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES == -3 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == -3){
					$textproses = "TERSAJIKAN";
				}else if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES == -2 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == -2){
					$textproses = "YUK KIRIM KE PELANGGAN";
				}else if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES == 0 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == 0){
					$textproses = "BELUM PROSES [ANTRI]";
				}else if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES == -1 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == -1){
					$textproses = "SIAP SAJIKAN";
				}else if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES != $datajson->hasiljson[0]->dataquery[$no]->MINPROSES){
					$textproses = "PROSES";
				}
				if ($datajson->hasiljson[0]->dataquery[$no]->TIPETRANSAKSI == 0){
					$statustransaksi = "TERBAYAR";
					$colortextcss = "green";
				}
				if ($datajson->hasiljson[0]->dataquery[$no]->TIPETRANSAKSI == 1){
					$statustransaksi = "RESERVASI <br>".$textproses;
					$colortextcss = "orange";
				}
				if ($datajson->hasiljson[0]->dataquery[$no]->TIPETRANSAKSI == 2){
					$statustransaksi = "DINE-IN <br>".$textproses;
					$colortextcss = "blue";
				}
				if ($datajson->hasiljson[0]->dataquery[$no]->TIPETRANSAKSI == 3){
					$statustransaksi = "TAKE AWAY <br>".$textproses;
					$colortextcss = "purple";
				}
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->URUTANAIKELUAR;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN."<br><pre style=\"color:".$colortextcss."\">STATUS : ".$statustransaksi."</pre>";
				$row[] = formatuang('IDR',($datajson->hasiljson[0]->dataquery[$no]->TOTALBELANJA + $datajson->hasiljson[0]->dataquery[$no]->PAJAKTOKO + $datajson->hasiljson[0]->dataquery[$no]->PAJAKNEGARA),'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->WAKTUTRANSAKSI;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->WAKTUPEMBAYARAN;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KETERANGAN;
				$row[] = "<button onclick=\"cetakulangnota('".$datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN."','".$datajson->hasiljson[0]->dataquery[$no]->URUTANAIKELUAR."')\" class=\"btn btn-success\"><i class=\"fas fa-print\"></i> Cetak Nota</button> <a href=\"".base_url().'penjualan/kasir/'.$datajson->hasiljson[0]->dataquery[$no]->URUTANAIKELUAR."\"<button class=\"btn btn-warning\"><i class=\"fas fa-list-alt\"></i> Detail</button>";
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
	public function hishargajual(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '5',
			'DIMANA1' => service('request')->getPost('BERDASARKAN'),
			'DIMANA2' => service('request')->getPost('KATAKUNCI'),
			'DIMANA3' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA4' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA5' => $this->session->get("kodeunikmember"),
			'DIMANA6' => $this->session->get("outlet"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/hishargajual", [
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
				$row[] = "<a href=\"".base_url()."penjualan/kasir/".$datajson->hasiljson[0]->dataquery[$no]->AI_TRANSAKSIKELUAR."\"><button class=\"btn btn-success\"><i class=\"fas fa-cash-register\"></i> Lihat Transaksi</button></a>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->FK_BARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMABARANG;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HARGABELI,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HARGAJUAL,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMA;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TANGGALTRX;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN;
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
	public function ajaxdaftarpiutang(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '6',
			'DIMANA1' => service('request')->getPost('KATAKUNCI'),
			'DIMANA2' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA3' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA4' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/ajaxdaftarpiutang", [
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
				$row[] = "<a href=".base_url()."penjualan/kasir/".$datajson->hasiljson[0]->dataquery[$no]->AI_TRANSAKSIKELUAR."><button class=\"btn btn-success\"><i class=\"fas fa-list\"></i> Lihat Transaksi</button></a>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TRANSAKSI_ID;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->MEMBER_ID;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAMEMBER;
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TGLKELUAR));
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->JATUHTEMPO));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALKREDIT,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->SISAKREDIT,'Rp ');
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
	public function ajaxdaftarpembayaranpiutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '9',
			'DIMANA1' => service('request')->getPost('KATAKUNCI'),
			'DIMANA2' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA3' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA4' => $this->session->get("outlet"),
			'DIMANA5' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 500,
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/ajaxdaftarpembayaranpiutang", [
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
				$row[] = "<button onclick=\"detailpembayaranpiutang('".$datajson->hasiljson[0]->dataquery[$no]->NOTRANSAKSI."')\" class=\"btn btn-success mr-2\"><i class=\"fas fa-list\"></i> Detail</button><button onclick=\"hapustransaksipiutang('".$datajson->hasiljson[0]->dataquery[$no]->NOTRANSAKSI."','".str_replace("::"," ",$datajson->hasiljson[0]->dataquery[$no]->NAMAMEMBER)."')\" class=\"btn btn-danger mr-2\"><i class=\"fas fa-trash\"></i> Hapus </button><button class=\"btn btn-primary\"><i class=\"fas fa-print\"></i> Cetak</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTRANSAKSI;
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALBAYAR))." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTU;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALBAYAR,'Rp ');
				$row[] = str_replace("::"," ",$datajson->hasiljson[0]->dataquery[$no]->NAMAMEMBER);
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PENGGUNA_ID;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTARETUR;
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
	public function detailtransaksipiutang(){
		if ($this->session->get("kodeunikmember") == ""){
			$jsonobj = '{"apakahlogin":"false"}';
			return json_encode($jsonobj);
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '10',
			'DIMANA1' => service('request')->getPost('NOTRANSAKSI'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/detailtransaksipiutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function notamenuppiutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'AWALANOTA' => service('request')->getPost('AWALANOTA'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEKUMPUTERLOKAL' => service('request')->getPost('KODEKUMPUTERLOKAL'),
			'TANGGALSEKARANG' => service('request')->getPost('TANGGALSEKARANG'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/notamenupenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function transaksipiutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'INFORMASIPIUTANG' => service('request')->getPost('INFORMASIPIUTANG'),
			'TRANSAKSIID' => service('request')->getPost('NOTAPIUTANG'),
			'TANGGALBAYAR' => service('request')->getPost('TANGGALBAYAR'),
			'KASIR_ID' => $this->session->get("pengguna_id"),
			'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'NOTARETUR' => "",
			'NOMOR' => service('request')->getPost('NOMOR'),
			'LOKASI' => $this->session->get("outlet"),
			'WAKTU' => service('request')->getPost('WAKTU'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/transaksipiutang", [
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
	public function hapustransaksipiutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRANSAKSI' => service('request')->getPost('NOTRANSAKSI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'LOKASI' => $this->session->get("outlet"),
			'SUBNOTA' => service('request')->getPost('SUBNOTA'),
			'BAYAR' => service('request')->getPost('BAYAR'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/hapustransaksipiutang", [
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
	public function dashboard_penjualan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '38',
			'DIMANA1' => $this->session->get("outlet"),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/dashboard_penjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			$outputDT = [
				"draw" => 0,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$row = [];
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PK_NOTAPENJUALAN;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->WAKTU;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->JUMLAHBELANJA,'')." Barang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALBELANJA,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->LOKASI;
				$row[] = strtoupper($datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA);
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
	public function cetaknota(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'TGLKELUAR' => service('request')->getPost('TGLKELUAR'),
			'WAKTU' => service('request')->getPost('WAKTU'),
			'NAMAPENGGUNA' => strtoupper(service('request')->getPost('NAMAPENGGUNA')),
			'NAMAMEMBER' => strtoupper(service('request')->getPost('NAMAMEMBER')),
			'NOTAPENJUALAN' => service('request')->getPost('NOTAPENJUALAN'),
			'INFORMASIBARANG' => service('request')->getPost('INFORMASIBARANG'),
			'TOTALBELANJA' => service('request')->getPost('TOTALBELANJA'),
			'NOMINALBAYAR' => service('request')->getPost('NOMINALBAYAR'),
			'KEMBALIAN' => service('request')->getPost('KEMBALIAN'),
			'KODESOCKETPRINT' => service('request')->getPost('KODESOCKETPRINT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/escprinter", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return true;
	}
	public function cetaknotapesanan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'TGLKELUAR' => service('request')->getPost('TGLKELUAR'),
			'WAKTU' => strtoupper(service('request')->getPost('WAKTU')),
			'NAMAMEMBER' => strtoupper(service('request')->getPost('NAMAMEMBER')),
			'NOTAPENJUALAN' => service('request')->getPost('NOTAPENJUALAN'),
			'INFORMASIBARANG' => service('request')->getPost('INFORMASIBARANG'),
			'KODESOCKETPRINT' => service('request')->getPost('KODESOCKETPRINT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."penjualan/escprinterpesanan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return true;
        
	}
}