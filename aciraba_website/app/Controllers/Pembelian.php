<?php

namespace App\Controllers;
use App\Models\PembelianModel;

class Pembelian extends BaseController
{
    protected $uri,$session,$breadcrumb,$sidetitle = "Pembelian";
	protected $datasessionparameter = [];	
	function __construct()
    {
		$db = db_connect();
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
		$this->pembelianModel = new PembelianModel($db);
		$this->session = \Config\Services::session();
        $this->session->start();
		if ($this->session->get("kodeunikmember") == ""){
			return redirect()->to('/auth');
		}
		array_push($this->datasessionparameter,
			$this->session->get("outlet"),
			$this->session->get("kodeunikmember"),
			$this->session->get("kodekomputer"),
		);
    }
	/* area algoritma pesanan pembelian */
	public function daftarpesananpembelian()
	{
		$this->breadcrumb  = array( 
			 "Daftar Pesanan Pembelian" => base_url()."pembelian/daftarpesananpembelian",
		);
		$data = [
			"titleheader"=>"DAFTAR PESANAN PEMBELIAN",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('backend/pembelian/kontendaftarpesananpembelian',$data);
	}
    /* area algoritma retur pembelian */
	public function daftarreturpembelian(){
		$this->breadcrumb  = array( 
			 "Daftar Retur Pembelian" => base_url()."pembelian/daftarreturpembelian",
		);
		$data = [
			"titleheader"=>"DAFTAR RETUR PEMBELIAN",
			"menuaktif" => "6",
			"submenuaktif" => "16",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/pembelian/kontendaftarreturpembelian',$data);
	}
	public function formreturpembelian()
	{
		$this->breadcrumb  = array( 
			 "Daftar Retur Pembelian" => base_url()."pembelian/daftarreturpembelian",
			 "Formulir Retur Pembelian" => base_url()."pembelian/formreturpembelian",
		);

		if ($this->uri->getSegment(3) != ''){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "33",
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
				"titleheader"=>"FORMULIR RETUR PEMBELIAN",
				"menuaktif" => "6",
				"submenuaktif" => "16",
				"breadcrumb"=>$this->breadcrumb,
				"sidetitle" => $this->sidetitle,
				"SEGMENT" => $this->uri->getSegment(2),
				"isedit" => 1,
				"kodesuplier" => $datajson->hasiljson[0]->dataquery[0]->KODESUPPLIER,
				"namasuplier" => $datajson->hasiljson[0]->dataquery[0]->NAMASUPPLIER,
				"alamatsuplier" => $datajson->hasiljson[0]->dataquery[0]->ALAMAT,
				"nomorreturedit" => $datajson->hasiljson[0]->dataquery[0]->NOTRXRETURBELI,
			];
			$this->pembelianModel->pindahdetailkelocalrb($datajson->hasiljson[0]->dataquery,$datajson->hasiljson[0]->totaldata,$this->datasessionparameter);
		}else{
			$data = [
				"titleheader"=>"FORMULIR RETUR PEMBELIAN",
				"menuaktif" => "6",
				"submenuaktif" => "16",
				"breadcrumb"=>$this->breadcrumb,
				"sidetitle" => $this->sidetitle,
				"SEGMENT" => $this->uri->getSegment(2),
				"isedit" => 0,
				"kodesuplier" => "",
				"namasuplier" => "",
				"alamatsuplier" => "",
				"nomorreturedit" => "",
			];
		}
		return view('backend/pembelian/kontentambahreturpembelian',$data);
	}
	public function jsondaftarreturpembelian(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "32",
			'DIMANA1' => service('request')->getPost('parameterpencarian'),
			'DIMANA2' => service('request')->getPost('katakunci'),
			'DIMANA3' => service('request')->getPost('tanggalawal'),
			'DIMANA4' => service('request')->getPost('tanggalakhir'),
			'DIMANA5' => $this->session->get("outlet"),
			'DIMANA6' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/jsondaftarreturpembelian", [
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
				$row[] = "<button onclick=\"hapusreturpembelian('".$datajson->hasiljson[0]->dataquery[$no]->NOTRXRETURBELI."','".formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALNOMINAL,'Rp ')."')\" class=\"btn btn-danger mr-2\"><i class=\"fas fa-trash\"></i></button> <a href=\"".base_url()."pembelian/formreturpembelian/".$datajson->hasiljson[0]->dataquery[$no]->BARISRETUR."\"<button class=\"btn btn-success\"><i class=\"fas fa-edit\"></i> Detail</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTRXRETURBELI;
				$row[] = str_replace("::"," ",$datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER);
				$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TOTALBARANG." Barang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALNOMINAL,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALPOTONGAN,'Rp ');
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
	public function jsontrxbeli(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '29',
			'DIMANA1' => service('request')->getPost('DIMANA1'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/jsontrxbeli", [
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
					'".$datajson->hasiljson[0]->dataquery[$no]->NOTA."',
					'".$datajson->hasiljson[0]->dataquery[$no]->KODEBARANG."',
					'".$datajson->hasiljson[0]->dataquery[$no]->NAMABARANG."',
					'".$datajson->hasiljson[0]->dataquery[$no]->JUMLAHBELI."',
					'1',
					'".$datajson->hasiljson[0]->dataquery[$no]->HARGABELI."',
					'0',
					'".$datajson->hasiljson[0]->dataquery[$no]->PPN."',
					'','','',
					'".$datajson->hasiljson[0]->dataquery[$no]->NAMATOP."',
					)\" class=\"btn btn-outline-success\"><i class=\"fas fa-check\"></i> Pilih Ini</button>";
				$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KODEBARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMABARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->JUMLAHBELI;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HPP,'Rp ');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->JUMLAHBELI * $datajson->hasiljson[0]->dataquery[$no]->HPP,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMATOP;
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
	public function simpanreturlocal(){
		$data = array();
		array_push($data,
		'',
		service('request')->getPost('NOTRXRETURBELI'),
		service('request')->getPost('NOTRXPEMBELIAN'),
		service('request')->getPost('KODEBARANG'),
		service('request')->getPost('NAMABARANG'),
		service('request')->getPost('JUMLAHBELI'),
		service('request')->getPost('JUMLAHRETUR'),
		service('request')->getPost('HARGABELI'),
		service('request')->getPost('POTONGAN'),
		service('request')->getPost('PPN'),
		service('request')->getPost('ASALOUTLET'),
		service('request')->getPost('ASALLOKASI'),
		service('request')->getPost('KETERANGAN'),
		service('request')->getPost('JENISTRX'),
		$this->session->get("outlet"),
		$this->session->get("kodeunikmember"),
		);
		return $simpan = $this->pembelianModel->addretur($data,$this->datasessionparameter);
	}
	public function returjuallocal(){
		$data = array();
		
		array_push($data,service('request')->getPost('KONDISI'));
		$datajson = json_decode($this->pembelianModel->daftarreturlocal($data,$this->datasessionparameter));
		$data = array();
		if ($datajson->adadata == "ada"){
			for ($no = 0; $no < $datajson->jumlahdata; $no++) {
				$row = [];
				$row[] = "<button onclick=\"hapusperbarangretur('".$datajson->datakeranjang[$no]->KODEBARANG."','".$datajson->datakeranjang[$no]->NAMABARANG."','".$datajson->datakeranjang[$no]->AI."')\" class=\"btn btn-danger btn-block\"><i class=\"fas fa-trash\"></i></button>";
				$row[] = "<input readonly id=\"noretur".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NOTRXRETURBELI."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"notapenjualan".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NOTRXPEMBELIAN."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"kodeitem".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->KODEBARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"namaitem".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input id=\"jumlahbeli".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->JUMLAHBELI."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"jumlahretur".$datajson->datakeranjang[$no]->KODEBARANG."".$no."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->JUMLAHRETUR."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"hargabeli".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HARGABELI."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"potongan".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->POTONGAN."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" id=\"ppn".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->PPN."\" class=\"form-control\">";
				$row[] = "<input readonly id=\"keoutlet".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->ASALOUTLET."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"kelokasi".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->ASALLOKASI."\" class=\"form-control-plaintext\">";
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
			service('request')->getPost('HARGABELI'),
			service('request')->getPost('POTONGAN'),
			service('request')->getPost('KETERANGAN'),
			service('request')->getPost('PPN'),
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('OUTLET'),
			$this->session->get("kodeunikmember"),
		);
		return $simpan = $this->pembelianModel->updatekeranjangretur($data,$this->datasessionparameter);
	}
	public function hapuskeranjangretur(){
		$proses = $this->pembelianModel->hapuskeranjangretur($this->datasessionparameter); if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapusperbarangretur(){
		$data = [
			'AI' => service('request')->getPost('AI'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEKOMPUTER' => $this->session->get("kodekomputer"),
		];
		$proses = $this->pembelianModel->hapusperbarangretur($data);
		if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function jsonambiltrxhutang(){
		
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "31",
			'DIMANA1' => service('request')->getPost('KODESUPLIER'),
			'DIMANA2' => service('request')->getPost('NOPOTONGHUTANG'),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/cekpotonghutang", [
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
				$row[] = "<input readonly id=\"noreturpkredit".$datajson->hasiljson[0]->dataquery[$no]->BARISAI."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->NOTRANSAKSI."\" class=\"form-control-plaintext\">";
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
	public function jsontambahreturdanpotonghutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ARRAYRETURBELI' => service('request')->getPost('ARRAYRETURBELI'),
			'ARRAYPOTONGHUTANG' => service('request')->getPost('ARRAYPOTONGHUTANG'),
			'POTONGHUTANGAKTIF' => service('request')->getPost('POTONGHUTANGAKTIF'),
			'NOTRXRETURBELI' =>service('request')->getPost('NOTRXRETURBELI'),
			'PETUGAS' => $this->session->get("pengguna_id"),
			'SUPPLIERID' =>service('request')->getPost('SUPPLIERID'),
			'TANGGALTRS' =>service('request')->getPost('TANGGALTRS'),
			'NOMORNOTA' =>service('request')->getPost('NOMORNOTA'),
			'TOTALBARANG' =>service('request')->getPost('TOTALBARANG'),
			'TOTALNOMINAL' =>service('request')->getPost('TOTALNOMINAL'),
			'TOTALPOTONGAN' =>service('request')->getPost('TOTALPOTONGAN'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'ISEDIT' =>service('request')->getPost('ISEDIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/tambahreturpembelian", [
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
	public function hapusreturpembelian(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTARETUR' => service('request')->getPost('NOTARETUR'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/hapusreturpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	/* area algoritma daftar pembelian */
	public function daftarpembelian(){
		$this->breadcrumb  = array( 
			 "Daftar Pembelian" => base_url()."pembelian/daftarpembelian",
		);
		$data = [
			"titleheader"=>"DAFTAR PEMBELIAN",
			"menuaktif" => "7",
			"submenuaktif" => "17",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/pembelian/kontendaftarpembelian',$data);
	}
	public function formpembelian()
	{
		if ($this->session->get("kodeunikmember") == ""){
			return redirect()->to('/auth');
		}
		$this->breadcrumb  = array( 
			"Daftar Pembelian" => base_url()."pembelian/daftarpembelian",
			"Tambah Pembelian" => base_url()."pembelian/formpembelian",
	   	);
		if ($this->uri->getSegment(3) != ''){
			$client = \Config\Services::curlrequest();
			$datapost = [
				'KONDISI' => "14",
				'DIMANA1' => $this->uri->getSegment(3),
				'DIMANA2' => $this->session->get("kodeunikmember"),
			];
			$json_data = $client->request("POST", BASEURLAPI."pembelian/detailpembelian", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$datajson = json_decode($json_data->getBody());
			$data = [
				"isedit"=> "true",
				"titleheader"=>"FORM PEMBELIAN [EDIT]",
				"menuaktif" => "7",
				"submenuaktif" => "17",
				"breadcrumb"=>$this->breadcrumb,
				"sidetitle" => $this->sidetitle,
				"SEGMENT" => $this->uri->getSegment(2),
				"notapembelian" => $datajson->hasiljson[0]->dataquery[0]->NOTA,
				"kodesuplier" => $datajson->hasiljson[0]->dataquery[0]->FK_SUPPLIER,
				"namasuplier" => $datajson->hasiljson[0]->dataquery[0]->NAMASUPPLIER,
				"alamat" => $datajson->hasiljson[0]->dataquery[0]->ALAMAT,
				"notelepon" => $datajson->hasiljson[0]->dataquery[0]->NOTELP,
				"tanggaltrx" => date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[0]->TANGGALTRS)),
				"keterangan" => $datajson->hasiljson[0]->dataquery[0]->KETERANGAN,
				"top" => $datajson->hasiljson[0]->dataquery[0]->TOP,
				"namatop" => $datajson->hasiljson[0]->dataquery[0]->NAMATOP,
				"kodeperusahaan" => $datajson->hasiljson[0]->dataquery[0]->DARISUBPERUSAHAAN,
				"namaperusahaan" => $datajson->hasiljson[0]->dataquery[0]->NAMAPERUSAHAAN,
				"biayalainlain" => $datajson->hasiljson[0]->dataquery[0]->BIAYALAINLAIN,
				"buttonsimpan" => 'Ubah Transkasi Pembelian',
			];
			$this->pembelianModel->pindahdetailkelocal($datajson->hasiljson[0]->dataquery,$datajson->hasiljson[0]->totaldata,$this->datasessionparameter);
		}else{
			$data = [
				"isedit"=> "false",
				"titleheader"=>"TAMBAH PEMBELIAN",
				"menuaktif" => "7",
				"submenuaktif" => "17",
				"breadcrumb"=>$this->breadcrumb,
				"sidetitle" => $this->sidetitle,
				"SEGMENT" => $this->uri->getSegment(2),
				"notapembelian" => "",
				"kodesuplier" => "",
				"namasuplier" => "",
				"alamat" => "",
				"notelepon" => "",
				"tanggaltrx" =>"",
				"keterangan" => "",
				"top" => "",
				"namatop" =>"",
				"kodeperusahaan" => "",
				"namaperusahaan" => "",
				"biayalainlain" => "",
				"buttonsimpan" => 'Simpan Transkasi Pembelian',
			];
		}
		return view('backend/pembelian/kontentambahpembelian',$data);
	}
	public function modaldaftarsuplier(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '11',
			'DIMANA1' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 50,
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/modaldaftarsuplier", [
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
				$row[] = "<button onclick=\"pilihsuplier('".$datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER."','".$datajson->hasiljson[0]->dataquery[$no]->ALAMAT."','".$datajson->hasiljson[0]->dataquery[$no]->NOTELP."','".$datajson->hasiljson[0]->dataquery[$no]->KODESUPPLIER."')\" class=\"btn btn-success\"><i class=\"fas fa-user\"></i> Pilih Ini</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KODESUPPLIER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->ALAMAT;
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
	public function pilihbarangpembelian(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '12',
			'DIMANA1' => $this->session->get("outlet"),
			'DIMANA2' => $this->session->get("kodeunikmember"),
			'DIMANA3' => service('request')->getPost('KATAKUNCI'),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/pilihbarangpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function tambahkekeranjang(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('NAMABARANG'),
			service('request')->getPost('STOKSEBELUM'),
			service('request')->getPost('JUMLAHBELI'),
			service('request')->getPost('DISPLAY'),
			service('request')->getPost('GUDANG'),
			service('request')->getPost('HARGASUPLIER'),
			service('request')->getPost('EXP'),
			service('request')->getPost('SUBTOTAL'),
			service('request')->getPost('DISKON1'),
			service('request')->getPost('DISKON2'),
			service('request')->getPost('PPN'),
			service('request')->getPost('ADISKON1'),
			service('request')->getPost('ADISKON2'),
			service('request')->getPost('SUBTOTALHPP'),
			service('request')->getPost('HPP'),
			service('request')->getPost('BEBANGAJI'),
			service('request')->getPost('BEBANPROMO'),
			service('request')->getPost('BEBANPACKING'),
			service('request')->getPost('BEBANTRANSPORT'),
			service('request')->getPost('HPPBEBAN'),
		);
		return $simpan = $this->pembelianModel->add($data, $this->datasessionparameter);
	}
	public function updatekeranjangpembelian(){
		$data = array();
		array_push(
			$data,
			service('request')->getPost('KODEBARANG'),
			service('request')->getPost('JUMLAHBELI'),
			service('request')->getPost('DISPLAY'),
			service('request')->getPost('GUDANG'),
			service('request')->getPost('HARGASUPLIER'),
			service('request')->getPost('EXP'),
			service('request')->getPost('SUBTOTAL'),
			service('request')->getPost('DISKON1'),
			service('request')->getPost('DISKON2'),
			service('request')->getPost('PPN'),
			service('request')->getPost('ADISKON1'),
			service('request')->getPost('ADISKON2'),
			service('request')->getPost('SUBTOTALHPP'),
			service('request')->getPost('HPP'),
			service('request')->getPost('BEBANGAJI'),
			service('request')->getPost('BEBANPROMO'),
			service('request')->getPost('BEBANPACKING'),
			service('request')->getPost('BEBANTRANSPORT'),
			service('request')->getPost('HPPBEBAN'),
		);
		return $simpan = $this->pembelianModel->updatekpembelian($data, $this->datasessionparameter);
	}
	public function daftarpembelianlocal(){
		$data = array();
		array_push($data,service('request')->getPost('KATAKUNCIPENCARIAN'));
		$datajson = json_decode($this->pembelianModel->daftarpembelianlocal($data, $this->datasessionparameter));
		$data = array();
		if ($datajson->adadata == "ada"){
			for ($no = 0; $no < $datajson->jumlahdata; $no++) {
				$row = [];
				$row[] = "<input id=\"namabarang".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input style=\"width:200px\" id=\"jumlahbeli".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->KODEBARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input style=\"width:80px\" id=\"stoksebelum".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->STOKSEBELUM."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."','hs')\" style=\"width:80px\" id=\"jumlahbelipembelian".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->JUMLAHBELI."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:80px\" id=\"stokdisplay".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->DISPLAY."\" class=\"form-control\">";
				$row[] = "<input readonly onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"stokgudang".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->GUDANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."','hs')\"style=\"width:120px\" id=\"hargasuplier".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HARGASUPLIER."\" class=\"form-control\">";
				$row[] = "<input style=\"width:120px\" id=\"exp".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->EXP."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."','shs')\" style=\"width:120px\" id=\"subtotal".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->SUBTOTAL."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"diskon1".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->DISKON1."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"diskon2".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->DISKON2."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"ppn".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->PPN."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"adiskon1".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->ADISKON1."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"adiskon2".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->ADISKON2."\" class=\"form-control\">";
				$row[] = "<input readonly onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"subtotalhpp".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->SUBTOTALHPP."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"hpp".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HPP."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"bebangaji".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->BEBANGAJI."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"bebanpromo".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->BEBANPROMO."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"bebanpacking".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->BEBANPACKING."\" class=\"form-control\">";
				$row[] = "<input onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"bebantransport".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->BEBANTRANSPORT."\" class=\"form-control\">";
				$row[] = "<input readonly onkeyup=\"catchEnter('".$no."')\" style=\"width:120px\" id=\"hppbeban".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->HPPBEBAN."\" class=\"form-control-plaintext\">";
				$row[] = "<input id=\"namabaranghidden".$datajson->datakeranjang[$no]->KODEBARANG."\" type=\"text\" value=\"".$datajson->datakeranjang[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<button onclick=\"hapusperbarang('".$datajson->datakeranjang[$no]->KODEBARANG."','".$datajson->datakeranjang[$no]->NAMABARANG."')\" class=\"btn btn-block btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button>";
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
	public function daftarpembeliantabel(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '13',
			'DIMANA1' => service('request')->getPost('KONDISIPENCARIAN'),
			'DIMANA2' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'DIMANA3' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA4' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA5' => $this->session->get("outlet"),
			'DIMANA6' => $this->session->get("kodeunikmember"),
			'DATAKE' => 0,
			'LIMIT' => 50,
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/daftarpembeliantabel", [
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
				$row[] = "<button onclick=\"onclickhapustranskasipembelian('".$datajson->hasiljson[0]->dataquery[$no]->NOTA."','".$datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER."','".$datajson->hasiljson[0]->dataquery[$no]->FK_SUPPLIER."')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i></button> <a href=".base_url()."pembelian/formpembelian/".$datajson->hasiljson[0]->dataquery[$no]->AIBARANGMASUK."><button  class=\"btn btn-success\"><i class=\"fas fa-list-alt\"></i> Detail</button></a>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTA;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALPEMBELIAN,'Rp ');
				$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMATOP;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->TOTALBELANJA." Barang";
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
	public function ubahhargajualsetelahbeli(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '34',
			'DIMANA1' => service('request')->getPost('NOTA'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/ubahhargajualsetelahbeli", [
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
				$row[] = "<input readonly id=\"kodeitem".$no."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->KODEBARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"namaitem".$no."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->NAMABARANG."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"unit".$no."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->SATUAN."\" class=\"form-control-plaintext\">";
				$row[] = "<input readonly id=\"hargabeli".$no."\" type=\"text\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->HARGABELI."\" class=\"form-control-plaintext\">";
				$row[] = "<input onkeyup=\"catchEnterAfB('".$no."')\" id=\"hargajual".$no."\" value=\"".$datajson->hasiljson[0]->dataquery[$no]->HARGAJUAL."\" type=\"text\" class=\"form-control\">";
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
	public function hapuspembelian(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTA' => service('request')->getPost('NOTA'),
			'LOKASI' =>  $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'PENGGUNAID' => $this->session->get("pengguna_id"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/hapuspembelian", [
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
	public function hapuskeranjang(){
		$proses = $this->pembelianModel->truncate($this->datasessionparameter); if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function hapusperbarang(){
		$data = [
			'KODEBARANG' => service('request')->getPost('BARANG_ID'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEKOMPUTER' => $this->session->get("kodekomputer"),
		];
		$proses = $this->pembelianModel->hapusperbarang($data);
		if($proses){ $jsonobj = '{"status":"true"}'; }else{ $jsonobj = '{"status":"false"}'; } return json_encode($jsonobj);
	}
	public function simpanpembelian(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'DETAILPEMBELIAN'=> service('request')->getPost('DETAILPEMBELIAN'),
			'NOTA'=> service('request')->getPost('NOTA'),
			'FK_SUPPLIER'=> service('request')->getPost('FK_SUPPLIER'),
			'TANGGALTRS'=> service('request')->getPost('TANGGALTRS'),
			'KETERANGAN'=> service('request')->getPost('KETERANGAN'),
			'TOP'=> service('request')->getPost('TOP'),
			'JATUHTEMPO'=> service('request')->getPost('JATUHTEMPO'),
			'PETUGAS'=>  $this->session->get("pengguna_id"),
			'TOTALPEMBELIAN'=> service('request')->getPost('TOTALPEMBELIAN'),
			'TOTALPEMBELIANBEBAN'=> service('request')->getPost('TOTALPEMBELIANBEBAN'),
			'TOTALHUTANG'=> (service('request')->getPost('TOP') == "KREDIT" ? service('request')->getPost('TOTALHUTANG') : "0" ),
			'BIAYALAINLAIN'=> service('request')->getPost('BIAYALAINLAIN'),
			'OUTLET'=>  $this->session->get("outlet"),
			'KODEUNIKMEMBER'=> $this->session->get("kodeunikmember"),
			'DARISUBPERUSAHAAN'=> service('request')->getPost('DARISUBPERUSAHAAN'),
			'NOMOR'=> service('request')->getPost('NOMOR'),
			'TOTALPPNMASUKAN'=> service('request')->getPost('TOTALPPNMASUKAN'),
			'NAMATOP'=> service('request')->getPost('NAMATOP'),
			'ISEDIT'=> service('request')->getPost('ISEDIT'),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/simpanpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	function ubahhargajualafb(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEITEM' => service('request')->getPost('KODEITEM'),
			'HARGAJUAL'=> service('request')->getPost('HARGAJUAL'),
			'OUTLET'=> $this->session->get("outlet"),
			'KODEUNIKMEMBER'=> $this->session->get("kodeunikmember"),
			
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/ubahhargajualafb", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	/* area algoritma history harga beli */
	public function daftarhistoryhargabeli(){	
		$this->breadcrumb  = array( 
			"Histori Harga Beli" => base_url()."pembelian/daftarhistoryhargabeli",
		);
		$data = [
			"titleheader"=>"HISTORI HARGA BELI",
			"menuaktif" => "7",
			"submenuaktif" => "18",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/pembelian/kontendaftarhistorihargabeli',$data);
	}
	public function hishargabeli(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '15',
			'DIMANA1' => service('request')->getPost('BERDASARKAN'),
			'DIMANA2' => service('request')->getPost('KATAKUNCI'),
			'DIMANA3' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA4' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA5' => $this->session->get("kodeunikmember"),
			'DIMANA6' => $this->session->get("outlet"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/hishargabeli", [
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
				$row[] = "<a href=\"".base_url()."pembelian/formpembelian/".$datajson->hasiljson[0]->dataquery[$no]->AIBARANGMASK."\"><button class=\"btn btn-success\"><i class=\"fas fa-cash-register\"></i> Lihat Transaksi</button></a>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KODEBARANG;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMABARANG;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->HARGABELI,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->JUMLAHBELI;
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[0]->TANGGALTRS));
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOMORNOTA;
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
	/* area algoritma hutang suplier */
	public function daftarhutangsuplier(){
		$this->breadcrumb  = array( 
			 "Hutang Ke Suplier" => base_url()."pembelian/daftarhutangsuplier",
		);
		$data = [
			"titleheader"=>"DAFTAR HUTANG PERUSAHAAN",
			"menuaktif" => "7",
			"submenuaktif" => "19",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/pembelian/kontendaftarhutangsuplier',$data);
	}
	public function formhutang()
	{
		$this->breadcrumb  = array( 
			 "Hutang Ke Suplier" => base_url()."pembelian/daftarhutangsuplier",
		);
		$data = [
			"titleheader"=>"DAFTAR HUTANG PERUSAHAAN",
			"menuaktif" => "7",
			"submenuaktif" => "19",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			"SEGMENT" => $this->uri->getSegment(2),
		];
		return view('backend/pembelian/kontenpembayaranhutang',$data);
	}
	public function filtermaubayarhutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "16",
			'DIMANA1' => service('request')->getPost('KODESUPLIER'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/filtermaubayarhutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function daftarhutangterpilih(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '17',
			'DIMANA1' => service('request')->getPost('KATAKUNCI'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
			'DIMANA3' => $this->session->get("outlet"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/daftarhutangterpilih", [
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
				$row[] = "<input class=\"form-control-plaintext\" type=\"text\" readonly value=\"".$datajson->hasiljson[0]->dataquery[$no]->NOTA."\">";
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
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
	public function transaksihutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'INFORMASIPIUTANG' => service('request')->getPost('INFORMASIPIUTANG'),
			'NOTRANSAKSI' => service('request')->getPost('NOTRANSAKSI'),
			'SUPPLIER_ID' => service('request')->getPost('SUPPLIER_ID'),
			'TANGGALTRS' => service('request')->getPost('TANGGALTRS'),
			'WAKTU' => service('request')->getPost('WAKTU'),
			'PETUGAS' => $this->session->get("pengguna_id"),
			'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'LOKASI' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'NOMOR' => service('request')->getPost('NOMOR'),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/transaksihutang", [
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
	public function ajaxdaftarhutang(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '18',
			'DIMANA1' => service('request')->getPost('KATAKUNCI'),
			'DIMANA2' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA3' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA4' => $this->session->get("kodeunikmember"),
			'DIMANA5' => $this->session->get("outlet"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/ajaxdaftarhutang", [
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
				$row[] = "<a href=".base_url()."pembelian/formpembelian/".$datajson->hasiljson[0]->dataquery[$no]->PK_BARANGMASUK."><button class=\"btn btn-success\"><i class=\"fas fa-list\"></i> Lihat Transaksi</button></a>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTA;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->FK_SUPPLIER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER;
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS));
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
	public function ajaxdaftarpembayaranhutang(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '19',
			'DIMANA1' => service('request')->getPost('KATAKUNCI'),
			'DIMANA2' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA3' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA4' => $this->session->get("kodeunikmember"),
			'DIMANA5' => $this->session->get("outlet"),
			'DATAKE' => 0,
			'LIMIT' => 100,
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/ajaxdaftarpembayaranhutang", [
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
				$row[] = "<button onclick=\"detailpembayaranhutang('".$datajson->hasiljson[0]->dataquery[$no]->NOTABAYAR."')\" class=\"btn btn-success mr-2\"><i class=\"fas fa-list\"></i> Detail</button> <button onclick=\"hapuspembayaranhutang('".$datajson->hasiljson[0]->dataquery[$no]->NOTABAYAR."','".$datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER."')\" class=\"btn btn-danger mr-2\"><i class=\"fas fa-trash\"></i> Hapus</button>";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTABAYAR;
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALTRS))." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTU;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALBAYAR,'Rp ');
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMAPENGGUNA;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->SUPPLIER_ID;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NAMASUPPLIER;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTARETURBELI;
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
	public function hapustransaksibhutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTAPEMBAYARANHUTANG' => service('request')->getPost('NOTAPEMBAYARANHUTANG'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'LOKASI' => $this->session->get("outlet"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/hapustransaksibhutang", [
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
	public function detailpembayaranhutang(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '20',
			'DIMANA1' => service('request')->getPost('NOTRANSAKSI'),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/detailpembayaranhutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function hapustransaksihutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRANSAKSI' => service('request')->getPost('NOTRANSAKSI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'LOKASI' => $this->session->get("outlet"),
			'SUBNOTA' => service('request')->getPost('SUBNOTA'),
			'BAYAR' => service('request')->getPost('BAYAR'),
		];
		$json_data = $client->request("POST", BASEURLAPI."pembelian/hapustransaksihutang", [
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
}