<?php

namespace App\Controllers;

class Kds extends BaseController{
	protected $session;
	function __construct(){
		$this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index(){
        $data = [
			"titleheader"=>"DAFTAR PESANAN ITEM",			
		];
        return view('resto/kds_index',$data);
    }
    public function loadkds(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'KODEPESANAN' => service('request')->getPost('KODEPESANAN'),
            'TANGGALAWAL' => service('request')->getPost('TANGGALAWAL'),
            'TANGGALAKHIR' => service('request')->getPost('TANGGALAKHIR'),
            'KETERANGAN' => service('request')->getPost('KETERANGAN'),
			'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KATEGORIID' => service('request')->getPost('KATEGORIID'),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/loadkds", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
    }
	public function sundulpesanan(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRANSKASI' => service('request')->getPost('NOTRANSKASI'),
            'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/sundulpesanan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
    }
	public function ubahstatuspesanan(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'BARANGID' => service('request')->getPost('BARANGID'),
			'STATUSPESAN' => service('request')->getPost('STATUSPESAN'),
			'NOTAPESANAN' => service('request')->getPost('NOTAPESANAN'),
            'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/ubahstatuspesanan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
    }
	public function tandaisemuaselesai(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'NOTAPESANAN' => service('request')->getPost('NOTAPESANAN'),
            'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'STATUS' => service('request')->getPost('STATUS'),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/tandaisemuaselesai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
    }
	public function filterbystatuspesanan(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'STATUSPROSES' => service('request')->getPost('STATUSPROSES'),
            'OUTLET' => $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."resto/filterbystatuspesanan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
    }	
	public function jadwalkds(){
		$data = [
			"titleheader"=>"JADWAL PESANAN ITEM",			
		];
        return view('resto/kds_jadwal',$data);
	}
}