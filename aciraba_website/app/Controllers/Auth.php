<?php
namespace App\Controllers;

class Auth extends BaseController{
	protected $uri, $session,$breadcrumb,$sidetitle = "Auth Area",$hakakses = [];
	function __construct(){
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
    }
	public function index()	{
		return view('login_form');
	}
	public function getCsrfToken()
	{
		$csrfToken = csrf_hash();
		return $this->response->setJSON(['csrf_token' => $csrfToken]);
	}
	public function getCsrfTokens($count)
	{
		$csrfTokens = array();
		for ($i = 0; $i < $count; $i++) {
			$csrfTokens[] = csrf_hash();
		}
		return $this->response->setJSON(['csrf_tokens' => $csrfTokens]);
	}
	public function pendaftaranmember(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAOUTLET' => service('request')->getPost('NAMAOUTLET'),
			'NAMA' => service('request')->getPost('NAMA'),
			'NAMAPENGGUNA' => service('request')->getPost('NAMAPENGGUNA'),
			'PASSWORD' => service('request')->getPost('PASSWORD'),
			'KODEUNIKMEMBER' => service('request')->getPost('KODEUNIKMEMBER'),
			'EMAIL' => service('request')->getPost('EMAIL'),
			'WHATSAPP' => service('request')->getPost('WHATSAPP'),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/pendaftaranmember", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->aciaraba_json[0]);
	}
	public function prosesoutlet(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODEOUTLET' => service('request')->getPost('KODEOUTLET'),
			'NAMAOUTLET' => service('request')->getPost('NAMAOUTLET'),
			'ALAMAT' => service('request')->getPost('ALAMAT'),
			'LAT' => service('request')->getPost('LAT'),
			'LONG' => service('request')->getPost('LONG'),
			'NOTELP' => service('request')->getPost('NOTELP'),
			'APAKAHPUSAT' => service('request')->getPost('APAKAHPUSAT'),
			'PAJAKNEGARA' => service('request')->getPost('PAJAKNEGARA'),
			'PAJAKTOKO' => service('request')->getPost('PAJAKTOKO'),
		];
		$posts_data = $client->request("POST", BASEURLAPI."masterdata/prosesoutlet", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson);
	}
	public function proseslogin(){
		$datapost = [];
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NAMAPENGGUNA' => service('request')->getPost('login_username'),
			'PASSWORDWEB' => service('request')->getPost('login_password'),
			'KODEKOMPUTER' => service('request')->getPost('kodekomputer'),
			'OTP' => service('request')->getPost('otp'),
			'KODEUNIKMEMBER' => service('request')->getPost('kodeunikmember'),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/loginapps", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		if ($datajson->aciaraba_json[0]->success == true){
			$arraysession = [
				'kodeunikmember'=> $datajson->aciaraba_json[0]->data[0]->KODEUNIKMEMBER,
				'pengguna_id'	=> $datajson->aciaraba_json[0]->data[0]->PENGGUNA_ID,
				'namapengguna'	=> $datajson->aciaraba_json[0]->data[0]->NAMAPENGGUNA,
				'totaldeposit'	=> $datajson->aciaraba_json[0]->data[0]->TOTALDEPOSIT,
				'namaasli'		=> $datajson->aciaraba_json[0]->data[0]->NAMA,
				'notelp'		=> $datajson->aciaraba_json[0]->data[0]->NOTELP,
				'hakakses'		=> $datajson->aciaraba_json[0]->data[0]->HAKAKSESID,
				'fotourl'		=> $datajson->aciaraba_json[0]->data[0]->URLFOTO,
				'jsonmenu'		=> $datajson->aciaraba_json[0]->data[0]->JSONMENU,
				'punyaoutlet' 	=> $datajson->aciaraba_json[0]->data[0]->PUNYAOUTLET,
				'pajaknegara' 	=> $datajson->aciaraba_json[0]->data[0]->PAJAKNEGARA,
				'pajaktoko' 	=> $datajson->aciaraba_json[0]->data[0]->PAJAKTOKO,
				'outlet' 		=> $datajson->aciaraba_json[0]->data[0]->KODEOUTLET,
				'email' 		=> $datajson->aciaraba_json[0]->data[0]->EMAIL,
				'verif_wa' 		=> $datajson->aciaraba_json[0]->data[0]->VERIF_WA,
				'TOKENUSER' 	=> $datajson->aciaraba_json[0]->data[0]->TOKENKEY,
				'kodekomputer'	=> service('request')->getPost('kodekomputer'),
			];
			$this->session->set($arraysession);
		}
		return json_encode($datajson->aciaraba_json[0]);
	}
	public function logout(){
		$this->session->destroy();
		return redirect()->to('/auth');
	}
	public function aktivasilisensi(){
		return view('auth/aktivasilisensi',);
	}
	public function area403(){
		return view('auth/page_forbidden_403',);
	}
	public function area404_lisensi(){
		$data = [
			"pesan_lisensi" => $this->session->get("pesan_lisensi"),
			"code_lisensi" => $this->session->get("code_lisensi"),
		];
		return view('auth/page_lisensi_404',$data);
	}
	public function verifikasi_pengguna(){
		$data = [
			"namapengguna" => $this->session->get("namapengguna"),
			"namaasli" => $this->session->get("namaasli"),
			"kodeunikmember" => $this->session->get("kodeunikmember"),
			"notelp" => $this->session->get("notelp"),
		];
		return view('auth/page_verif_otp', $data);
	}
	public function mintaotp(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'JENISOTP' => service('request')->getPost('JENISOTP'),
			'NAMAPENGGUNA' => service('request')->getPost('NAMAPENGGUNA'),
			'NAMAASLI' => service('request')->getPost('NAMAASLI'),
			'NOTELP' => service('request')->getPost('NOTELP'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/mintaotp", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson);
	}
	public function verifikasikodeotp(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'JENISOTP' => service('request')->getPost('JENISOTP'),
			'TOKENOTP' => service('request')->getPost('TOKENOTP'),
			'NAMAPENGGUNA' => $this->session->get("namapengguna"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/nodeverifikasikodeotp", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson);
	}
	public function ubahoutlet(){
		$arraysession = [
			'outlet' => $this->uri->getSegment(3),
		];
		$this->session->set($arraysession);
		$url = $_SERVER['HTTP_REFERER'];
		return redirect()->to($url); 
	}
	public function outlet(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCIPENCARIAN' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/outlet", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		$jsontext = "[";
		for ($x = 0; $x < $datajson->hasiljson[0]->totaldataquery; $x++) {
			$jsontext .= '{"group": "'.$datajson->hasiljson[0]->dataquery[$x]->KODEOUTLET.'", "namaoutlet": "'.$datajson->hasiljson[0]->dataquery[$x]->NAMAOUTLET.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); /* menghilangkan koma terakhir */
		$jsontext .= "]";
		return json_encode($jsontext);
	}
	public function outletnoselect(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KATAKUNCIPENCARIAN' => service('request')->getPost('KATAKUNCIPENCARIAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/outlet", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function detailinformasioutlet(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEOUTLET' => service('request')->getPost('KODEOUTLET'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/detailinformasioutlet", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function hapusoutlet(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEOUTLET' => service('request')->getPost('KODEOUTLET'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/hapusoutlet", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function daftarpegawai(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PENCARIAN' => service('request')->getPost('PENCARIAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/daftarpegawai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function statuspegawai(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'IDPENGGUNA' =>service('request')->getPost('IDPENGGUNA'),
			'NAMAPENGGUNA' =>service('request')->getPost('NAMAPENGGUNA'),
			'NAMAOUTLET' =>service('request')->getPost('NAMAOUTLET'),
			'STATUSPENGGUNA' =>service('request')->getPost('STATUSPENGGUNA'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/statuspegawai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function ubahinformasipegawai(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'IDPENGGUNA' =>service('request')->getPost('IDPENGGUNA'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/ubahinformasipegawai", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function ubahpasswordproses(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'IDPENGGUNABARU' =>service('request')->getPost('IDPENGGUNABARU'),
			'PASSWORDKAMU' =>service('request')->getPost('PASSWORDKAMU'),
			'PASSWORDBARU' =>service('request')->getPost('PASSWORDBARU'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'IDPENGGUNAKAMU' => $this->session->get("pengguna_id"),
		];
		$posts_data = $client->request("POST", BASEURLAPI."auth/ubahpasswordproses", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($posts_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function hakakses(){
		$this->breadcrumb  = array( 
			"Daftar Member" => base_url()."masterdata/daftarmerchat",
			"Kelola Informasi" => base_url()."masterdata/informasimerchant",
		);
		$data = [
			"titleheader"=> "INFORMASI PEGAWAI / REKANAN",
			"menuaktif" => "",
			"submenuaktif" => "",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('auth/kelolahakakses',$data);
		
	}
	public function daftarhakakses(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."auth/daftarhakakses", [
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
				"data" => [],
			];
		}else{
			for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
				$json = $datajson->hasiljson[0]->data[$no]->JSONMENU;
				$datajsonbtn = json_decode($json);
				$row = [];
				$row[] = "<h3 class=\"text-center\">".$datajson->hasiljson[0]->data[$no]->NAMAHAKAKSES."</h3><br><button onclick=\"ubahhakases('".$datajson->hasiljson[0]->data[$no]->AI."','".$datajson->hasiljson[0]->data[$no]->NAMAHAKAKSES."','".base64_encode($datajson->hasiljson[0]->data[$no]->JSONMENU)."')\" class=\"btn btn-success btn-block\">Ubah Informasi</button>";
				$buttonsHtml = '';
				$buttonsHtml1 = '';
				foreach ($datajsonbtn->menuakses as $menu) {
					if ($menu->status == "1") {
						$buttonsHtml .= '
						<div class="col-6">
							<div class="alert alert-label-success">
								<div class="alert-icon">
									<i class="fa fa-check"></i>
								</div>
								<div class="alert-content">'.(isset($menu->keterangan) ? $menu->keterangan : $menu->menuke ).'</div>
							</div>
						</div>';
					}
					if ($menu->status == "0") {
						$buttonsHtml1 .= '
						<div class="col-6 mb-2">
							<div class="alert alert-label-danger">
								<div class="alert-icon">
									<i class="fa fa-close"></i>
								</div>
								<div class="alert-content">'.(isset($menu->keterangan) ? $menu->keterangan : $menu->menuke ).'</div>
							</div>
						</div>';
					}
				}
				$row[] = '
				<div class="">
					<div class="row" id="buttonsRow">
						' . $buttonsHtml . '
					</div>
				</div>';
				$row[] = '
				<div class="">
					<div class="row" id="buttonsRow">
						' . $buttonsHtml1 . '
					</div>
				</div>';
				$data[] = $row;
			}
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->hasiljson[0]->totaldata,
				"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
				"data" => $data,
			];
		}
		return json_encode($outputDT);
	}
	public function pilihstatuspegawai(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KATAKUNCI' => service('request')->getPost('KATAKUNCI'),
		];
		$json_data = $client->request("POST", BASEURLAPI."auth/daftarhakakses", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$jsontext = "[";
		for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
			$jsontext .= '{"kodeai": "'.$datajson->hasiljson[0]->data[$no]->AI.'", "namahakases": "'.$datajson->hasiljson[0]->data[$no]->NAMAHAKAKSES.'"},';	
		}
		$jsontext = substr_replace($jsontext, '', -1); 
		$jsontext .= "]";
		return json_encode($jsontext);
	}
}