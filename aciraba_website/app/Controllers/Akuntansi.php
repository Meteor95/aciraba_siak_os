<?php

namespace App\Controllers;

class Akuntansi extends BaseController
{
    protected $session,$breadcrumb,$sidetitle = "Akuntansi",$awalperiode,$akhirperiode;
	function __construct(){
		$request = \Config\Services::request();
		$this->uri = $request->getUri()->setSilent();
		$this->awalperiode = date('Y') . '-01-01';
        $this->akhirperiode = date('Y') . '-12-31';
    }
	public function index()
	{
		$this->breadcrumb  = array( "Beranda SIAK Aciraba" => base_url()."akuntansi",);
		$data = [
			"menuaktif" => "0",
			"submenuaktif" => "0",
			"titleheader"=>"LAPORAN GENERAL SIAK ACIRABA",
			"breadcrumb"=> $this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontendasboardakuntansi',$data);
	}
	/* area algoritma kode akun akuntansi */
	public function kodeakunakuntansi()
	{
		$kodesubperusahaan = ($this->uri->getSegment(3) == "" ? "0" : $this->uri->getSegment(3));
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODESUBPERUSAHAAN' => $kodesubperusahaan,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/kodecoa", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$namaperusahaan = (isset($datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN : "" );
		$this->breadcrumb  = array( 
			"Kode Akun Akuntansi" => base_url()."akuntansi/kodeakunakuntansi",
		);
		$informasidata = json_decode(json_encode($datajson->hasiljson[0]->data),true);
		$data = [
			"kodesubperusahaan" => $kodesubperusahaan,
			"namaperusahaan" => $namaperusahaan,
			"informasidata" => $informasidata,
			"menuaktif" => "1",
			"submenuaktif" => "1",
			"titleheader"=>"DAFTAR KODE AKUN ".$namaperusahaan,
			"breadcrumb"=> $this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontendaftarkodeakunakuntansi',$data);
	}
	public function ajaxhapuskodecoa(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'IDCOA' => service('request')->getPost('IDCOA'),
			'KODECOA' => service('request')->getPost('KODECOA'),
			'NAMACOA' => service('request')->getPost('NAMACOA'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeajaxhapuskodecoa", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatkodeakun(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ID' => service('request')->getPost('id'),
			'KODEUNIKMEMBER' => service('request')->getPost('kodeunikmember'),
			'JENISAKUN' => service('request')->getPost('jenisakun'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/formatkodeakun", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function ajaxtambahcoagrup(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ID' => (service('request')->getPost('ID') == 0 ? 0 : service('request')->getPost('ID') ),
			'PARENT_ID' => service('request')->getPost('PARENTID'),
			'KODE_COA_GROUP' => service('request')->getPost('KODEAKUN'),
			'NAMA_COA_GROUP' => service('request')->getPost('NAMAAKUNGROUP'),
			'DEFAULTINPUT' => service('request')->getPost('DEFAULTINPUT'),
			'JENISAKUN' => service('request')->getPost('JENISAKUN'),
			'SALDOAWAL' => service('request')->getPost('SALDOAWAL'),
			'KASBANK' => service('request')->getPost('KASBANK'),
			'KETERANGAN' => '',
			'ISDELETE' => 'true',
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'ISEDIT' => service('request')->getPost('ISEDIT'),
			//edit ledger
			'SAWALDEFAULTINPUT' => service('request')->getPost('SAWALDEFAULTINPUT'),
			'EDITLEDGER' => service('request')->getPost('EDITLEDGER'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'NAMASUBPERUSAHAAN' => service('request')->getPost('NAMASUBPERUSAHAAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/simpankodeakungrup", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function daftarentrijurnal()
	{
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi",
			"Entri Jurnal" => base_url()."akuntansi/daftarentrijurnal",
		);
		$data = [
			"menuaktif" => "1",
			"submenuaktif" => "2",
			"titleheader"=>"Daftar Entri Jurnal Akuntansi",
			"breadcrumb"=> $this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontendaftarjurnal',$data);
	}
	public function entrijurnal()
	{
		$client = \Config\Services::curlrequest();
		$notransaksi="";$tgltrx="";$subperusahaan="0";$namasubperusahaan="";$narasi="";$total_debit="0";$total_kredit="0";
		if ($this->uri->getSegment(3) != ""){
			$datapost = [
				'NOTRANSAKI' => $this->uri->getSegment(3),
				'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			];
			$json_data = $client->request("POST", BASEURLAPI."siak/nodeviewjurnal", [
				"headers" => [
					"Accept" => "application/json",
					"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
				],
				"form_params" => $datapost
			]);
			$nodeviewjurnal=json_decode($json_data->getBody());
			$notransaksi=$this->uri->getSegment(3);
			$tgltrx=date('d-m-Y', strtotime($nodeviewjurnal->daftarentrijurnal[0]->wakturansaksi));
			$subperusahaan=$nodeviewjurnal->daftarentrijurnal[0]->subperusahaan;
			$namasubperusahaan=$nodeviewjurnal->daftarentrijurnal[0]->namasubperusahaan;
			$narasi=$nodeviewjurnal->daftarentrijurnal[0]->narasi;
			$total_debit=$nodeviewjurnal->daftarentrijurnal[0]->total_debit;
			$total_kredit=$nodeviewjurnal->daftarentrijurnal[0]->total_kredit;
		}
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => $subperusahaan,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/ambilperiode", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->ambilperiode[0]->success == true){
			$this->awalperiode = $datajson->ambilperiode[0]->informasiperiode[0]->PERIODEAWAL;
			$this->akhirperiode = $datajson->ambilperiode[0]->informasiperiode[0]->PERIODEAKHIR;
		}
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi",
			"Daftar Entri Jurnal" => base_url()."akuntansi/daftarentrijurnal",
			"Entri Jurnal" => base_url()."akuntansi/entrijurnal",
		);
		$data = [
			"awalperiode" => $this->awalperiode,
			"akhirperiode" => $this->akhirperiode,
			"notransaksi" => $notransaksi,
			"tgltrx" => $tgltrx,
			"subperusahaan" => $subperusahaan,
			"namasubperusahaan" => $namasubperusahaan,
			"narasi" => $narasi,
			"total_debit" => $total_debit,
			"total_kredit" => $total_kredit,
			"menuaktif" => "1",
			"submenuaktif" => "2",
			"titleheader"=>"Daftar Entri Jurnal Akuntansi",
			"breadcrumb"=> $this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenentrijurnal',$data);
	}
	function getcoaentrijurnal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODESUBPERUSAHAAN' => service('request')->getPost('KODESUBPERUSAHAAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/kodecoa", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]->data);
	}
	function detailjurnalitemedit(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRX' => service('request')->getPost('NOTRX'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeviewjurnalitem", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->daftarentrijurnal[0]->success == false) return json_encode(['data' => []]);
		return json_encode(['data' => $datajson->daftarentrijurnal]);
	}
	function simpanentrijurnal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'INFORMASIENTRIJURNAL' => service('request')->getPost('INFORMASIENTRIJURNAL'),
			'DIENTRIOLEH' => $this->session->get("namapengguna"),
			'STATUSJURNAL' => 0,
			'NOTRXEDIT' => service('request')->getPost('NOTRXEDIT'),
			'JENISJURNAL' => service('request')->getPost('JENISJURNAL'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/entrijurnalumum", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	function verifentri(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'DIVERIFOLEH' =>  $this->session->get("namapengguna"),
			'NOTRXEDIT' => service('request')->getPost('NOTRXEDIT'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'STATUSUBAH' => service('request')->getPost('STATUSUBAH'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeverifentrijurnal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->nodeverifentrijurnal[0]);
	}
	public function jsontabelentrijurnal(){
		
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRANSAKI' => service('request')->getPost('NOTRANSAKI'),
			'WAKTUAWAL' => service('request')->getPost('WAKTUAWAL'),
			'WAKTUAKHIR' => service('request')->getPost('WAKTUAKHIR'),
			'NARASI' => service('request')->getPost('NARASI'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'JENISJURNALTRANSAKSI' => service('request')->getPost('JENISJURNALTRANSAKSI'),
			'OUTLET' =>  $this->session->get("outlet"),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'BARISKE' => 0,
			'LIMIT' => 500,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/daftarentrijurnal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$no = 0;
		if ($datajson->daftarentrijurnal[0]->success == false){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($x = 1; $x <= $datajson->daftarentrijurnal[0]->totaldata; $x++) {
				$row = [];
				if ($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->STATUSJURNAL == 0){
					$labelstatus = "<strong><span style=\"color:red\">JURNAL DIPERIKSA</span></strong>";
				} else {
					$labelstatus = "<strong><span style=\"color:green\">JURNAL DITERIMA</span></strong>";
				}
				$ubahJurnalButton = '';
				if ($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->STATUSJURNAL == 0) {
					$ubahJurnalButton = "<a href=\"".base_url().'akuntansi/entrijurnal/'.$datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NOTRX."\" class=\"btn btn-success mr-2\">Ubah Jurnal</a> <button onclick=\"hapusjurnal('".$datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NOTRX."','".$datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->SUBPERUSAHAAN."')\" class=\"btn btn-danger\">Hapus Jurnal</button>";
				}
				$row[] = date('d-m-Y H:i:s', strtotime($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->WAKTUTRX));
				$row[] = $datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NOTRX."<br>".$labelstatus;
				$row[] = $datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NARASI;
				$row[] = number_format($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->DEBIT_TOTAL, 2, ',', '.');
				$row[] = number_format($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->KREDIT_TOTAL, 2, ',', '.');
				$row[] = "<a href=\"".base_url().'akuntansi/viewjurnal/'.$datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NOTRX."\" class=\"btn btn-primary mr-2\">Detail Jurnal</a>".$ubahJurnalButton;
				$data[] = $row;
				$no++;
			}			
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->daftarentrijurnal[0]->totaldata,
				"recordsFiltered" => $datajson->daftarentrijurnal[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function viewjurnal($notrxjurnal = null)
	{
		if ($notrxjurnal == ""){
			return redirect()->to('akuntansi/daftarentrijurnal');
		}
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRANSAKI' => $notrxjurnal,
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeviewjurnal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi",
			"Daftar Entri Jurnal" => base_url()."akuntansi/daftarentrijurnal",
			"Nomor ".$notrxjurnal => base_url()."akuntansi/viewjurnal/".$notrxjurnal,
		);
		$data = [
			"waktutrx" => date('d-m-Y H:i:s', strtotime($datajson->daftarentrijurnal[0]->wakturansaksi)),
			"total_debit" => number_format($datajson->daftarentrijurnal[0]->total_debit, 2, ',', '.'),
			"total_kredit" => number_format($datajson->daftarentrijurnal[0]->total_kredit, 2, ',', '.'),
			"narasi" => $datajson->daftarentrijurnal[0]->narasi,
			"dientrioleh" => $datajson->daftarentrijurnal[0]->dientrioleh,
			"diubaholeh" => $datajson->daftarentrijurnal[0]->diubaholeh,
			"statusjurnal" => $datajson->daftarentrijurnal[0]->statusjurnal,
			"subperusahaan" => $datajson->daftarentrijurnal[0]->subperusahaan,
			"notrxjurnal" => $notrxjurnal,
			"menuaktif" => "1",
			"submenuaktif" => "2",
			"titleheader"=>"RINCIAN JURNAL NOMOR ".$notrxjurnal,
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontendetailentrijurnal',$data);
	}
	public function jsonviewjurnal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOTRANSAKI' => service('request')->getPost('NOTRANSAKI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeviewjurnal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$no = 0;
		if ($datajson->daftarentrijurnal[0]->success == false){
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			];
		}else{
			for ($x = 1; $x <= $datajson->daftarentrijurnal[0]->totaldata; $x++) {
				$row = [];
				$row[] = ($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->DEBITKREDIT == "D" ? "Debit" : "Kredit");
				$row[] = "[".$datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->KODE_COA_GROUP."] - ".$datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NAMA_COA_GROUP;
				$row[] = "<div style=\"text-align:right\">".($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->DEBITKREDIT == "D" ? number_format($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NOMINAL_JURNAL, 2, ',', '.') : "0" )."</div>";
				$row[] = "<div style=\"text-align:right\">".($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->DEBITKREDIT == "K" ? number_format($datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NOMINAL_JURNAL, 2, ',', '.') : "0" )."</div>";
				$row[] = $datajson->daftarentrijurnal[0]->daftarentrijurnal[$no]->NARASIITEM;
				$data[] = $row;
				$no++;
			} 
			$outputDT = [
				"draw" => 1,
				"recordsTotal" => $datajson->daftarentrijurnal[0]->totaldata,
				"recordsFiltered" => $datajson->daftarentrijurnal[0]->totaldata,
				"data" => $data
			];
		}
		return json_encode($outputDT);
	}
	public function hapusjurnal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'NOMORTRX' => service('request')->getPost('NOMORTRX'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodehapusjurnal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->daftarentrijurnal[0]);
	}
	public function kasdanbank()
	{
		$kasmasuk=0;$kaskeluar=0;$totalkassaatini=0;
		$client = \Config\Services::curlrequest();
		$datapost = [
			'AWALTANGGAL' => date('Y-m-1'),
			'AKHIRTANGGAL' => date('Y-t-m'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => 0,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/kasbanktotal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->kasmasukbulanini[0]->success){ $kasmasuk = $datajson->kasmasukbulanini[0]->informasientrijurnal[0]->NOMINAL_JURNAL;  }
		if ($datajson->kaskeluarbulanini[0]->success){ $kaskeluar = $datajson->kaskeluarbulanini[0]->informasientrijurnal[0]->NOMINAL_JURNAL; }
		if ($datajson->totalkasbulanini[0]->success){ $totalkassaatini = $datajson->totalkasbulanini[0]->informasientrijurnal[0]->NOMINAL_JURNAL; }
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Kas dan Bank" => base_url()."akuntansi/kasdanbank",
		);
		$data = [
			"kasmasuk" => formatuang('IDR',$kasmasuk,"Rp"),
			"kaskeluar" => formatuang('IDR',$kaskeluar,"Rp"),
			"sisakasbank" => formatuang('IDR',($kasmasuk - $kaskeluar),"Rp"),
			"totalkassaatini" => formatuang('IDR',$totalkassaatini,"Rp"),
			"menuaktif" => "1",
			"submenuaktif" => "4",
			"titleheader"=>"DAFTAR KAS DAN BANK PERUSAHAAN",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontendaftarkasdanbank',$data);
	}
	public function ajaxkasbanktotal(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'AWALTANGGAL' => date('Y-m-1'),
			'AKHIRTANGGAL' => date('Y-m-t'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/kasbanktotal", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson);
	}
	public function kasbankmasukeluar()
	{	
		if ($this->uri->getSegment(3) != "kasmasuk" && $this->uri->getSegment(3) != "kaskeluar"){
			return redirect()->to('akuntansi/kasdanbank');
		}
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Kas dan Bank" => base_url()."akuntansi/kasdanbank",
			($this->uri->getSegment(3) == "kasmasuk" ? "Terima" : "Kirim" )." Uang / Dana" => base_url()."akuntansi/kasdanbank/kasmasuk",
		);
		$data = [
			"jenistransaksi" => $this->uri->getSegment(3),
			"menuaktif" => "1",
			"submenuaktif" => "4",
			"titleheader"=>"ENTRI JURNAL KAS ".($this->uri->getSegment(3) == "kasmasuk" ? "MASUK" : "KELUAR" ),
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenentrikasmasukkeluar',$data);
	}
	public function kasbanktransfer()
	{	
		if ($this->uri->getSegment(3) != "kastransfer"){
			return redirect()->to('akuntansi/kasdanbank');
		}
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Kas dan Bank" => base_url()."akuntansi/kasdanbank",
			($this->uri->getSegment(3) == "kasmasuk" ? "Terima" : "Kirim" )." Uang / Dana" => base_url()."akuntansi/kasdanbank/kasmasuk",
		);
		$data = [
			"jenistransaksi" => $this->uri->getSegment(3),
			"menuaktif" => "1",
			"submenuaktif" => "4",
			"titleheader"=>"ENTRI JURNAL KAS ".($this->uri->getSegment(3) == "kasmasuk" ? "MASUK" : "KELUAR" ),
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenentrikastransfer',$data);
	}
	public function bukubesar()
	{
		$akuncoa = $this->uri->getSegment(3);
		$subperusahaan = $this->uri->getSegment(4);
		$namaperusahaan = urldecode($this->uri->getSegment(5));
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODESUBPERUSAHAAN' => $subperusahaan,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/kodecoa", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$informasidata = json_decode(json_encode($datajson->hasiljson[0]->data),true);
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi",
			"Daftar COA" => base_url()."akuntansi/kodeakunakuntansi",
			"Buku Besar" => base_url()."akuntansi/bukubesar/".$akuncoa,
		);
		$data = [
			"kodesubperusahaan" => $subperusahaan,
			"namaperusahaan" => $namaperusahaan,
			"akuncoa" => $akuncoa,
			"informasidata" => $informasidata,
			"menuaktif" => "20",
			"submenuaktif" => "21",
			"titleheader"=>"BUKU BESAR JURNAL",
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenbukubesarjurnal',$data);
	}
	public function bukubesarajax(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'COAID' => service('request')->getPost('KODECOA'),
			'AWALTANGGAL' => service('request')->getPost('AWALTANGGAL'),
			'AKHIRTANGGAL' => service('request')->getPost('AKHIRTANGGAL'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodebukubesarajax", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->detailjurnal[0]->success == false) return json_encode(['data' => []]);
		return json_encode(['data' => $datajson]);
	}
	public function jurnalumum()
	{	
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => 0,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/ambilperiode", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->ambilperiode[0]->success == true){
			$this->awalperiode = $datajson->ambilperiode[0]->informasiperiode[0]->PERIODEAWAL;
			$this->akhirperiode = $datajson->ambilperiode[0]->informasiperiode[0]->PERIODEAKHIR;
		}
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KODESUBPERUSAHAAN' => 0,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/kodecoa", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$namaperusahaan = (isset($datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN : "" );
		$kodesubperusahaan = (isset($datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN : 0 );
		$informasidata = json_encode($datajson->hasiljson[0]->data);
		$data = json_decode($informasidata, true);
		$newData = ["ID" => "ALL", "KODE_COA_GROUP" => "ALL", "PARENT_ID" => -1, "NAMA_COA_GROUP" => "Tampilkan Semua Kode COA", "DEFAULTINPUT" => "ALL", "JENISAKUN" => "LEDGER", "SALDOAWAL" => 0, "SALDOAWALDC" => "", "ISDELETE" => "false", "LEVEL" => 1, "KASBANK" => "false", "NAMAPERUSAHAAN" => $namaperusahaan, "children" => []];
		array_unshift($data, $newData);
		$informasidata = json_encode($data);
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Kas dan Bank" => base_url()."akuntansi/kasdanbank",
			($this->uri->getSegment(3) == "kasmasuk" ? "Terima" : "Kirim" )." Uang / Dana" => base_url()."akuntansi/kasdanbank/kasmasuk",
		);
		$data = [
			"kodesubperusahaan" => $kodesubperusahaan,
			"namaperusahaan" => $namaperusahaan,
			"informasidata" => $informasidata,
			"awalperiode" => date('d-m-Y', strtotime($this->awalperiode)),
			"akhirperiode" => date('d-m-Y', strtotime($this->akhirperiode)),
			"jenistransaksi" => $this->uri->getSegment(3),
			"menuaktif" => "20",
			"submenuaktif" => "22",
			"titleheader"=> "Laporan Jurnal Umum<br>Periode Pembukuan ".date('d-m-Y', strtotime($this->awalperiode))." s.d ".date('d-m-Y', strtotime($this->akhirperiode)),
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenlaporanjurnalumum',$data);
	}
	public function jurnalumumajax(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'COAID' => service('request')->getPost('KODECOA'),
			'AWALTANGGAL' => service('request')->getPost('AWALTANGGAL'),
			'AKHIRTANGGAL' => service('request')->getPost('AKHIRTANGGAL'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodejurnalumumajax", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->jurnalumum[0]->success == false) return json_encode(['data' => []]);
		return json_encode(['data' => $datajson]);
	}
	public function neracasaldo(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => 0,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/ambilperiode", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$namaperusahaan = (isset($datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN : "" );
		$kodesubperusahaan = (isset($datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN : 0 );
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Neraca Saldo" => base_url()."akuntansi/neracasaldo",
		);
		$data = [
			"kodesubperusahaan" => $kodesubperusahaan,
			"namaperusahaan" => $namaperusahaan,
			"awalperiode" => date('m-Y', strtotime($this->awalperiode)),
			"akhirperiode" => date('m-Y', strtotime($this->akhirperiode)),
			"jenistransaksi" => $this->uri->getSegment(3),
			"menuaktif" => "20",
			"submenuaktif" => "23",
			"titleheader"=> "Laporan Neraca Saldo<br>Periode Pembukuan ".date('d-m-Y', strtotime($this->awalperiode))." s.d ".date('d-m-Y', strtotime($this->akhirperiode)),
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenlaporanneracasaldo',$data);
	}
	public function neracasaldoajax(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ID' => 0,
			'AWALTANGGAL' => service('request')->getPost('AWALTANGGAL'),
			'AKHIRTANGGAL' => service('request')->getPost('AKHIRTANGGAL'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'TANPANOL' => service('request')->getPost('TANPANOL'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeneracasaldo", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson);
	}
	public function neracakeuangan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => 0,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/ambilperiode", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$namaperusahaan = (isset($datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN : "" );
		$kodesubperusahaan = (isset($datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN : 0 );
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Neraca Keuangan" => base_url()."akuntansi/neracakeuangan",
		);
		$data = [
			"kodesubperusahaan" => $kodesubperusahaan,
			"namaperusahaan" => $namaperusahaan,
			"awalperiode" => date('m-Y', strtotime($this->awalperiode)),
			"akhirperiode" => date('m-Y', strtotime($this->akhirperiode)),
			"jenistransaksi" => $this->uri->getSegment(3),
			"menuaktif" => "20",
			"submenuaktif" => "24",
			"titleheader"=> "Laporan Neraca Keuangan<br>Periode Pembukuan ".date('d-m-Y', strtotime($this->awalperiode))." s.d ".date('d-m-Y', strtotime($this->akhirperiode)),
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenlaporanneracakeuangan',$data);
	}
	public function neracakeuanganajax(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ID' => 0,
			'AWALTANGGAL' => service('request')->getPost('AWALTANGGAL'),
			'AKHIRTANGGAL' => service('request')->getPost('AKHIRTANGGAL'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'TANPANOL' => service('request')->getPost('TANPANOL'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodeneracakeuangan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson);
	}
	public function labarugi(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'SUBPERUSAHAAN' => 2200001,
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/ambilperiode", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$namaperusahaan = (isset($datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->NAMAPERUSAHAAN : "" );
		$kodesubperusahaan = (isset($datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN) ? $datajson->hasiljson[0]->data[0]->KODEPERUSAHAAN : 0 );
		$this->breadcrumb  = array( 
			"Akuntansi" => base_url()."akuntansi/",
			"Laba Rugi Perusahaan" => base_url()."akuntansi/labarugi",
		);
		$data = [
			"kodesubperusahaan" => $kodesubperusahaan,
			"namaperusahaan" => $namaperusahaan,
			"awalperiode" => date('d-m-Y', strtotime($this->awalperiode)),
			"akhirperiode" => date('d-m-Y', strtotime($this->akhirperiode)),
			"jenistransaksi" => $this->uri->getSegment(3),
			"menuaktif" => "20",
			"submenuaktif" => "25",
			"titleheader"=> "Laporan Laba Rugi<br>Periode Pembukuan ".date('d-m-Y', strtotime($this->awalperiode))." s.d ".date('d-m-Y', strtotime($this->akhirperiode)),
			"breadcrumb"=>$this->breadcrumb,
            "sidetitle" => $this->sidetitle,
		];
		return view('akuntansi/kontenlaporanlabarugi',$data);
	}
	public function labarugiajax(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'ID' => 0,
			'AWALTANGGAL' => service('request')->getPost('AWALTANGGAL'),
			'AKHIRTANGGAL' => service('request')->getPost('AKHIRTANGGAL'),
			'SUBPERUSAHAAN' => service('request')->getPost('SUBPERUSAHAAN'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'TANPANOL' => service('request')->getPost('TANPANOL'),
		];
		$json_data = $client->request("POST", BASEURLAPI."siak/nodelabarugi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson);
	}
}
