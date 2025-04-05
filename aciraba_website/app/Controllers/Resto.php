<?php

namespace App\Controllers;
use App\Models\KasirModel;
use App\Models\PenjualanModel;

class Resto extends BaseController{
    protected $kasirModel,$penjualanModel,$session,$breadcrumb,$sidetitle = "Penjualan";
	
	function __construct(){
		$db = db_connect();
		$this->kasirModel = new KasirModel($db);
		$this->penjualanModel = new PenjualanModel($db);
		$this->session = \Config\Services::session();
        $this->session->start();
    }
	/* area algoritma pesanan penjualan */
	public function daftarmeja(){
		$this->breadcrumb  = array( 
			"Kelola Pesanan" => base_url()."resto/daftarmeja",
		);
		$data = [
			"titleheader"=>"DAFTAR PESANAN ITEM",
			"menuaktif" => "-1",
			"submenuaktif" => "20",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
			
		];
		return view('backend/resto/kontendaftarmeja',$data);
	}
	public function ajaxpanggilmeja(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => "1000",
			'DIMANA1' => service('request')->getPost('LANTAI'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/ajaxpanggilmeja", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function ajaxpanggillantai(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'DIMANA1' => $this->session->get("outlet"),
			'DIMANA2' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/ajaxpanggillantai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function ajaxdetailpesanan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEMEJA' => service('request')->getPost('KODEMEJA'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'PROSESDARI' => service('request')->getPost('PROSESDARI'),
			'TANGGALAWAL' => service('request')->getPost('TANGGALAWAL'),
			'TANGGALAKHIR' => service('request')->getPost('TANGGALAKHIR'),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/ajaxdetailpesanan", [
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
				if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES == -3 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == -3){
					$row[] = "<button class=\"btn btn-warning\"><i class=\"fa-solid fa-hand-sparkles\"></i> Selesai</button> <a href=\"".base_url().'penjualan/kasir/'.$datajson->hasiljson[0]->dataquery[$no]->AI_TRANSAKSIKELUAR."\"> <button class=\"btn btn-success\"><i class=\"fas fa-edit\"></i> Lihat Pesan</button></a>";
				}else if ($datajson->hasiljson[0]->dataquery[$no]->MAXPROSES > 0 AND $datajson->hasiljson[0]->dataquery[$no]->MINPROSES == 0){
					$row[] = "<button onclick=\"batalkanpesanantempat('".service('request')->getPost('PROSESDARI')."','".$datajson->hasiljson[0]->dataquery[$no]->KODEMENUPESANAN."','".$datajson->hasiljson[0]->dataquery[$no]->PEMESAN."','".date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGAL))."')\" class=\"btn btn-danger\"><i class=\"fas fa-edit\"></i> Batal Pesan</button> <a href=\"".base_url().'penjualan/kasir/'.$datajson->hasiljson[0]->dataquery[$no]->AI_TRANSAKSIKELUAR."\"> <button class=\"btn btn-success\"><i class=\"fas fa-edit\"></i> Lihat Pesan</button></a>";
				}else{
					$row[] = "<button class=\"btn btn-secondary\"><i class=\"fa-solid fa-hand-sparkles\"></i> Proses</button> <a href=\"".base_url().'penjualan/kasir/'.$datajson->hasiljson[0]->dataquery[$no]->AI_TRANSAKSIKELUAR."\"> <button class=\"btn btn-success\"><i class=\"fas fa-edit\"></i> Lihat Pesan</button></a>";
				}
				$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGAL))." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTU." s.d ".date("d-m-Y", strtotime($datajson->hasiljson[0]->dataquery[$no]->TANGGALAKHIR))." ".$datajson->hasiljson[0]->dataquery[$no]->WAKTUAKHIR;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->KODEMEJA." [".$datajson->hasiljson[0]->dataquery[$no]->KODEPESAN."]";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->PEMESAN." [".$datajson->hasiljson[0]->dataquery[$no]->KODEMENUPESANAN."]";
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->NOTELEPON;
				$row[] = $datajson->hasiljson[0]->dataquery[$no]->UNTUKBERAPAORANG." Orang";
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->dataquery[$no]->TOTALBELANJA,'Rp ');
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
	public function ajaxfullcalendarevent(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '1001',
			'DIMANA1' => service('request')->getPost('TANGGALAWAL'),
			'DIMANA2' => service('request')->getPost('TANGGALAKHIR'),
			'DIMANA3' => $this->session->get("outlet"),
			'DIMANA4' => $this->session->get("kodeunikmember"),

		];
		$json_data = $client->request("POST", BASEURLAPI."resto/ajaxfullcalendarevent", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function updatestatuspemesanan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PROSESDARI' => service('request')->getPost('PROSESDARI'),
			'KODEMEJA' => service('request')->getPost('KODEMEJA'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),

		];
		$json_data = $client->request("POST", BASEURLAPI."resto/updatestatuspemesanan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function hapusinformasimeja(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEMEJA' => service('request')->getPost('KODEMEJA'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),

		];
		$json_data = $client->request("POST", BASEURLAPI."resto/hapusinformasimeja", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function simpaninformasimeja(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEMEJA' => service('request')->getPost('KODEMEJA'),
			'NAMAMEJA' => service('request')->getPost('NAMAMEJA'),
			'GAMBAR' => service('request')->getPost('GAMBAR'),
			'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'LANTAI' => service('request')->getPost('LANTAI'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'JAMBUKA' => service('request')->getPost('JAMBUKA'),
			'JAMTUTUP' => service('request')->getPost('JAMTUTUP'),
			'ISEDIT' => service('request')->getPost('ISEDIT'),

		];
		$json_data = $client->request("POST", BASEURLAPI."resto/simpaninformasimeja", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function panggildetailmakanan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KONDISI' => '1002',
			'DIMANA1' => service('request')->getPost('KODEPESANAN'),
			'DIMANA2' => $this->session->get("outlet"),
			'DIMANA3' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/panggildetailmakanan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
}