<?php

namespace App\Controllers;

class Laporan extends BaseController{
	protected $session,$sidetitle = "LAPORAN";
	function __construct(){
		$this->session = \Config\Services::session();
        $this->session->start();
		helper('form');
    }
	public function masteritem(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Master" => base_url()."laporan/masteritem",
		);
		$data = [
			"titleheader"=>"LAPORAN MASTER ITEM",
			"menuaktif" => "10",
			"submenuaktif" => "21",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/master/dashboard',$data);
	}
	public function mastersup(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Master" => base_url()."laporan/mastersup",
		);
		$data = [
			"titleheader"=>"LAPORAN MASTER SUPLIER",
			"menuaktif" => "10",
			"submenuaktif" => "22",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/master/dashboard_suplier',$data);
	}
	public function mastermember(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Master" => base_url()."laporan/mastermember",
		);
		$data = [
			"titleheader"=>"LAPORAN MASTER MEMBER",
			"menuaktif" => "10",
			"submenuaktif" => "23",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/master/dashboard_member',$data);
	}
	public function penjualan(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/penjualan",
		);
		$data = [
			"titleheader"=>"LAPORAN PENJUALAN",
			"menuaktif" => "11",
			"submenuaktif" => "24",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/penjualan/dashboard',$data);
    }
	public function returpenjualan(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/returpenjualan",
		);
		$data = [
			"titleheader"=>"LAPORAN RETUR PENJUALAN",
			"menuaktif" => "11",
			"submenuaktif" => "25",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/penjualan/dashboard_returpenjualan',$data);
    }
	public function pembelian(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/pembelian",
		);
		$data = [
			"titleheader"=>"LAPORAN PEMBELIAN",
			"menuaktif" => "12",
			"submenuaktif" => "26",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/pembelian/dashboard',$data);
    }
	public function returpembelian(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/returpembelian",
		);
		$data = [
			"titleheader"=>"LAPORAN RETUR PEMBELIAN",
			"menuaktif" => "12",
			"submenuaktif" => "27",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/pembelian/dashboard_returpembelian',$data);
    }
	public function hutang(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/hutang",
		);
		$data = [
			"titleheader"=>"LAPORAN HUTANG TOKO",
			"menuaktif" => "13",
			"submenuaktif" => "0",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/hutang/dashboard',$data);
    }
	public function piutang(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/piutang",
		);
		$data = [
			"titleheader"=>"LAPORAN PIUTANG MEMBER",
			"menuaktif" => "14",
			"submenuaktif" => "0",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/piutang/dashboard',$data);
    }
	public function formatlaporanmaster(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODENAMABARANG' => service('request')->getPost('KODENAMABARANG'),
            'KODEPERUSAHAAN' => service('request')->getPost('KODEPERUSAHAAN'),
			'KODEPINCIPAL' => service('request')->getPost('KODEPINCIPAL'),
			'KODEUSUPLIER' => service('request')->getPost('KODEUSUPLIER'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KODEBRAND' => service('request')->getPost('KODEBRAND'),
			'KODEOUTLET' => service('request')->getPost('KODEOUTLET'),
			'STOKAWAL' => service('request')->getPost('STOKAWAL'),
			'STOKAKHIR' => service('request')->getPost('STOKAKHIR'),
			'LOKASISTOK' => service('request')->getPost('LOKASISTOK'),
			'STATUSBARANG' => service('request')->getPost('STATUSBARANG'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanmaster", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "masteritem_informasibarang" || service('request')->getPost('KONDISI') == "masteritem_stokopname" || service('request')->getPost('KONDISI') == "masteritem_daftaritem"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
				];
			}
		}else{
			$sumhargabeli = 0; $sumhargajual = 0; $sumdisplay = 0; $sumgudang = 0; $sumretur = 0; $sumsubtotalstok = 0;
			if (service('request')->getPost('KONDISI') == "masteritem_informasibarang"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->BARANG_ID;
					$row[] = $datajson->hasiljson[0]->data[$no]->QRCODE_ID;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMABARANG;
					$row[] = $datajson->hasiljson[0]->data[$no]->SATUAN;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->HARGABELI,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->HARGAJUAL,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISPLAY,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->GUDANG,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->RETUR,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->SUBTOTALSTOK,'');
					$sumhargabeli = $sumhargabeli + $datajson->hasiljson[0]->data[$no]->HARGABELI;
					$sumhargajual = $sumhargajual + $datajson->hasiljson[0]->data[$no]->HARGAJUAL;
					$sumdisplay = $sumdisplay + $datajson->hasiljson[0]->data[$no]->DISPLAY;
					$sumgudang = $sumgudang + $datajson->hasiljson[0]->data[$no]->GUDANG;
					$sumretur = $sumretur + $datajson->hasiljson[0]->data[$no]->RETUR;
					$sumsubtotalstok = $sumsubtotalstok + $datajson->hasiljson[0]->data[$no]->SUBTOTALSTOK;
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"sumhargabeli" => formatuang('IDR',$sumhargabeli,'Rp '),
					"sumhargajual" => formatuang('IDR',$sumhargajual,'Rp '),
					"sumdisplay" => formatuang('IDR',$sumdisplay,''),
					"sumgudang" => formatuang('IDR',$sumgudang,''),
					"sumretur" => formatuang('IDR',$sumretur,''),
					"sumsubtotalstok" => formatuang('IDR',$sumsubtotalstok,''),
					"totalpersedianpokok" => formatuang('IDR',($sumhargabeli * $sumsubtotalstok),'Rp '),
					"totalpersedianjual" => formatuang('IDR',($sumhargajual * $sumsubtotalstok),'Rp '),
					"perkiraanlaba" => formatuang('IDR',($sumhargajual * $sumsubtotalstok) - ($sumhargabeli * $sumsubtotalstok),'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "masteritem_stokopname"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->BARANG_ID;
					$row[] = $datajson->hasiljson[0]->data[$no]->QRCODE_ID;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMABARANG;
					$row[] = $datajson->hasiljson[0]->data[$no]->SATUAN;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISPLAY,'');
					$row[] = "";
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->GUDANG,'');
					$row[] = "";
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->RETUR,'');
					$row[] = "";
					$sumdisplay = $sumdisplay + $datajson->hasiljson[0]->data[$no]->DISPLAY;
					$sumgudang = $sumgudang + $datajson->hasiljson[0]->data[$no]->GUDANG;
					$sumretur = $sumretur + $datajson->hasiljson[0]->data[$no]->RETUR;
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"sumdisplay" => formatuang('IDR',$sumdisplay,''),
					"sumgudang" => formatuang('IDR',$sumgudang,''),
					"sumretur" => formatuang('IDR',$sumretur,''),
				];
			}else if (service('request')->getPost('KONDISI') == "masteritem_daftaritem"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					//$row[] = ROOTPATH.'images\logo_aciraba.png';
					$row[] = $datajson->hasiljson[0]->data[$no]->BARANG_ID;
					$row[] = "NAMA : ".$datajson->hasiljson[0]->data[$no]->NAMABARANG."<br>SUPLIER : ".$datajson->hasiljson[0]->data[$no]->NAMASUPPLIER."<br>HARGABELI : ".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->HARGABELI,'Rp ')."<br>HARGAJUAL : ".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->HARGAJUAL,'Rp ');
					$row[] = $datajson->hasiljson[0]->data[$no]->SATUAN;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMA_PRINCIPAL;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMAKATEGORI;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMA_BRAND;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISPLAY,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->GUDANG,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->RETUR,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->SUBTOTALSTOK,'');
					$sumhargabeli = $sumhargabeli + $datajson->hasiljson[0]->data[$no]->HARGABELI;
					$sumhargajual = $sumhargajual + $datajson->hasiljson[0]->data[$no]->HARGAJUAL;
					$sumdisplay = $sumdisplay + $datajson->hasiljson[0]->data[$no]->DISPLAY;
					$sumgudang = $sumgudang + $datajson->hasiljson[0]->data[$no]->GUDANG;
					$sumretur = $sumretur + $datajson->hasiljson[0]->data[$no]->RETUR;
					$sumsubtotalstok = $sumsubtotalstok + $datajson->hasiljson[0]->data[$no]->SUBTOTALSTOK;
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"sumhargabeli" => formatuang('IDR',$sumhargabeli,'Rp '),
					"sumhargajual" => formatuang('IDR',$sumhargajual,'Rp '),
					"sumdisplay" => formatuang('IDR',$sumdisplay,''),
					"sumgudang" => formatuang('IDR',$sumgudang,''),
					"sumretur" => formatuang('IDR',$sumretur,''),
					"sumsubtotalstok" => formatuang('IDR',$sumsubtotalstok,''),
					"totalpersedianpokok" => formatuang('IDR',($sumhargabeli * $sumsubtotalstok),'Rp '),
					"totalpersedianjual" => formatuang('IDR',($sumhargajual * $sumsubtotalstok),'Rp '),
					"perkiraanlaba" => formatuang('IDR',($sumhargajual * $sumsubtotalstok) - ($sumhargabeli * $sumsubtotalstok),'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporanmastersup(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
            'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
			'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanmastersup", [
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
			if (service('request')->getPost('KONDISI') == "master_informasisuplier"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->KODESUPPLIER;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMASUPPLIER;
					$row[] = "NEGARA : ".$datajson->hasiljson[0]->data[$no]->NEGARA."<br>"."PROVINSI : ".$datajson->hasiljson[0]->data[$no]->PROVINSI."<br>"."KOTA / KABUPATAEN : ".$datajson->hasiljson[0]->data[$no]->PROVINSI."<br>"."KECAMATAN : ".$datajson->hasiljson[0]->data[$no]->KECAMATAN."<br>"."ALAMAT : ".$datajson->hasiljson[0]->data[$no]->ALAMAT;
					$row[] = "NO SELULER : ".$datajson->hasiljson[0]->data[$no]->NOTELP."<br>"."ALAMAT SUREL : ".$datajson->hasiljson[0]->data[$no]->EMAIL;
					$row[] = "NAMA BANK : ".$datajson->hasiljson[0]->data[$no]->NAMABANK."<br>"."NO REKENING".$datajson->hasiljson[0]->data[$no]->NOREK."<br>"."ATAS NAMA : ".$datajson->hasiljson[0]->data[$no]->ATASNAMA;
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
				];
			}else if (service('request')->getPost('KONDISI') == "master_aktiviassuplier"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->FK_SUPPLIER;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMASUPPLIER;
					$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALTRS));
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTA;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMATOP;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPEMBELIAN,'Rp ');
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
				];
			}else if (service('request')->getPost('KONDISI') == "master_logsuplier"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->KODESUPPLIER;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMASUPPLIER;
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTRANSAKSI;
					$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->data[$no]->TGLTRANSAKSI));
					$row[] = $datajson->hasiljson[0]->data[$no]->PROSESAPA;
					$row[] = $datajson->hasiljson[0]->data[$no]->KETERANGAN;
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporanmastermember(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEMEMBER' => service('request')->getPost('KODEMEMBER'),
            'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
			'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'STATUSTRANSAKSI' => service('request')->getPost('STATUSTRANSAKSI'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanmastermember", [
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
			if (service('request')->getPost('KONDISI') == "master_informasimember"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->MEMBER_ID;
					$row[] = str_replace("::"," ",$datajson->hasiljson[0]->data[$no]->NAMA);
					$row[] = "NEGARA : ".$datajson->hasiljson[0]->data[$no]->NEGARA."<br>PROVINSI : ".$datajson->hasiljson[0]->data[$no]->PROVINSI."<br>KOTA / KABUPATEN : ".$datajson->hasiljson[0]->data[$no]->KOTA."<br>KECAMATAN : ".$datajson->hasiljson[0]->data[$no]->KECAMATAN."<br>ALAMAT : ".$datajson->hasiljson[0]->data[$no]->ALAMAT."<br>KODE POS : ".$datajson->hasiljson[0]->data[$no]->KODEPOS;
					$row[] = "EMAIL : ".$datajson->hasiljson[0]->data[$no]->EMAIL."<br>TELEPON : ".$datajson->hasiljson[0]->data[$no]->TELEPON."<br>BANK : ".$datajson->hasiljson[0]->data[$no]->BANK."<br>NOMOR REKENING : ".$datajson->hasiljson[0]->data[$no]->NOREK."<br>PEMILIK REKENING : ".$datajson->hasiljson[0]->data[$no]->PEMILIKREK."<br>NPWP : ".$datajson->hasiljson[0]->data[$no]->NPWP;
					$row[] = "MASA AKTIF SAMPAI : ".($datajson->hasiljson[0]->data[$no]->AKHIRAKTIF == "0000-00-00" ? "AON" : date("d-m-Y", strtotime($datajson->hasiljson[0]->data[$no]->AKHIRAKTIF)))."<br>POINT : ".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->POINT,'')."<br>LIMIT PIUTANG : ".$datajson->hasiljson[0]->data[$no]->LIMITJUMLAHPIUTANG."<br>JENIS MEMBER : ".$datajson->hasiljson[0]->data[$no]->JENIS."<br>GRUP MEMBER : ".$datajson->hasiljson[0]->data[$no]->GRUP."<br>MINIMAL TRX / POINT : ".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->MINIMALPOIN,'Rp ')."<br>BATAS MAX PIUTANG : ".$datajson->hasiljson[0]->data[$no]->BATASTAMBAHKREDIT." HARI";
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
				];
			}else  if (service('request')->getPost('KONDISI') == "master_aktiviasmemebr"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->FK_MEMBER;
					$row[] = str_replace("::"," ",$datajson->hasiljson[0]->data[$no]->NAMA);
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALBELANJA,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->POINT,'');
					$row[] = $datajson->hasiljson[0]->data[$no]->JUMLAH_TUNAI." Transaksi";
					$row[] = $datajson->hasiljson[0]->data[$no]->JUMLAH_KREDIT." Transaksi";
					$row[] = $datajson->hasiljson[0]->data[$no]->JUMLAH_KARTU." Transaksi";
					$row[] = $datajson->hasiljson[0]->data[$no]->JUMLAH_SPLITCASH." Transaksi";
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
				];
			}
		}
		return json_encode($outputDT);
	}
	public function laporandetailmember(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Master" => base_url()."laporan/masteritem",
		);
		$data = [
			"titleheader"=>"LAPORAN MASTER ITEM",
			"menuaktif" => "10",
			"submenuaktif" => "21",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
		];
		$client = \Config\Services::curlrequest();
		$dateawal = explode("-", $this->request->getPost('laporan_penjualan_tanggalwal'));
		$formattedDateAwal = $dateawal[2] . "-" . $dateawal[1] . "-" . $dateawal[0];
		$dateakhir = explode("-", $this->request->getPost('laporan_penjualan_tanggalakhir'));
		$formattedDateAkhir = $dateakhir[2] . "-" . $dateakhir[1] . "-" . $dateakhir[0];
		$datapost = [
			'KODEMEMBER' => $this->request->getPost('pilihmember'),
			'PERIODEAWAL' => $formattedDateAwal,
			'PERIODEAKHIR' => $formattedDateAkhir,
			'STATUSTRANSAKSI' => $this->request->getPost('rb_statusbarangtambahitem'),
			'OUTLET' => $this->session->get("outlet"),
			'KONDISI' => "master_detailmember",
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanmastermember", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		$STATUSINFORMASIPEMBAYARAN = "";
		$dataarray = $datajson->hasiljson[0]->data[0];
		$data["MEMBER_ID"] = $datajson->hasiljson[0]->data[0]->MEMBER_ID;
		$data["NAMA"] = $datajson->hasiljson[0]->data[0]->NAMA;
		$data["JENIS"] = $datajson->hasiljson[0]->data[0]->JENIS;
		$data["GRUP"] = $datajson->hasiljson[0]->data[0]->GRUP;
		$data["KETERANGAN"] = $datajson->hasiljson[0]->data[0]->KETERANGAN;
		$data["ALAMAT"] = $datajson->hasiljson[0]->data[0]->ALAMAT." ".$datajson->hasiljson[0]->data[0]->KECAMATAN." ".$datajson->hasiljson[0]->data[0]->KOTA." ".$datajson->hasiljson[0]->data[0]->PROVINSI." ".$datajson->hasiljson[0]->data[0]->NEGARA." ".$datajson->hasiljson[0]->data[0]->KODEPOS;
		$data["INFORMASIPEMBAYARAN"] = "EMAIL : ".$datajson->hasiljson[0]->data[0]->EMAIL."<br>TELEPON : ".$datajson->hasiljson[0]->data[0]->TELEPON."<br>BANK : ".$datajson->hasiljson[0]->data[0]->BANK."<br>NOMOR REKENING : ".$datajson->hasiljson[0]->data[0]->NOREK."<br>PEMILIK REKENING : ".$datajson->hasiljson[0]->data[0]->PEMILIKREK."<br>NPWP : ".$datajson->hasiljson[0]->data[0]->NPWP;
		if ($datajson->hasiljson[0]->data[0]->EMAIL != "" && $datajson->hasiljson[0]->data[0]->TELEPON != "" && $datajson->hasiljson[0]->data[0]->BANK != "" && $datajson->hasiljson[0]->data[0]->NOREK != "" && $datajson->hasiljson[0]->data[0]->PEMILIKREK != ""){
			$STATUSINFORMASIPEMBAYARAN = "LENGKAP";
		}
		$data["STATUSINFORMASIPEMBAYARAN"] = $STATUSINFORMASIPEMBAYARAN;
		$data["SALDODOMPETDATA"] = formatuang('IDR',$datajson->hasiljson[0]->data[0]->TOTALDEPOSIT,'Rp ');
		$data["POINTRX"] = formatuang('IDR',$datajson->hasiljson[0]->data[0]->POINT,'');
		$data["MINIMALPOIN"] = formatuang('IDR',$datajson->hasiljson[0]->data[0]->MINIMALPOIN,'');
		$data["LIMITJUMLAHPIUTANG"] = formatuang('IDR',$datajson->hasiljson[0]->data[0]->LIMITJUMLAHPIUTANG,'Rp ');
		$data["BATASTAMBAHKREDIT"] = $datajson->hasiljson[0]->data[0]->BATASTAMBAHKREDIT;
		$data["AKHIRAKTIF"] = $datajson->hasiljson[0]->data[0]->AKHIRAKTIF;
		$data["STATUSAKTIF"] = $datajson->hasiljson[0]->data[0]->STATUSAKTIF;
		$data["BANNER"] = ($datajson->hasiljson[0]->data[0]->STATUSAKTIF == "1" ? base_url()."images/banner/banner-profil.jpeg" : "https://digitalmarketingskill.com/wp-content/uploads/elementor/thumbs/Disabled-Facebook-Ad-Account-pgl98e18rijzxr2lp63ki523h8kn5g8ljoeeo7p7d4.png");
		$data["DATAPOST"] = $datapost;
		return view('laporan/master/format_detailmember',$data);
	}
	public function formatlaporanpenjualannodatatables(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'IDPELANGGAN' => service('request')->getPost('IDPELANGGAN'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'GROUPELANGGAN' => service('request')->getPost('GROUPELANGGAN'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatlaporanpenjualan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'IDPELANGGAN' => service('request')->getPost('IDPELANGGAN'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'GROUPELANGGAN' => service('request')->getPost('GROUPELANGGAN'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "penjualanperfaktur"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"subtotal" => formatuang('IDR','0','Rp '),
					"pajaktoko" => formatuang('IDR','0','Rp '),
					"pajaknegara" => formatuang('IDR','0','Rp '),
					"potonganglobal" => formatuang('IDR','0','Rp '),
					"jumlah" => formatuang('IDR','0','Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "penjualanperbarang"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"jumlahitem" => formatuang('IDR','0','Rp '),
					"totaljual" => formatuang('IDR','0','Rp '),
					"totalbeli" => formatuang('IDR','0','Rp '),
					"totallaba" => formatuang('IDR','0','Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "penjualanperkasir" || service('request')->getPost('KONDISI') == "penjualanperpelanggan"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"tunai" => formatuang('IDR','0','Rp '),
					"uangmuka" => formatuang('IDR','0','Rp '),
					"kredit" => formatuang('IDR','0','Rp '),
					"kdebit" => formatuang('IDR','0','Rp '),
					"kkredit" => formatuang('IDR','0','Rp '),
					"emoney" => formatuang('IDR','0','Rp '),
					"grandtotal" => formatuang('IDR','0','Rp '),
				];
			}
		}else{
			$jumlahitem = 0; $subtotal = 0; $pajaktoko = 0; $pajaknegara = 0; $potonganglobal = 0; $jumlah = 0; $totaljual = 0; $totalbeli = 0; $totallaba = 0; $tunai = 0; $uangmuka = 0; $kredit = 0; $kdebit = 0; $kkredit = 0; $emoney = 0; $resrtunai = 0; $resrkredit = 0; $reskartudebit = 0; $reskartukredit = 0; $reskartuemoney = 0; $grandtotaljenistrasnaksi = 0;
			if (service('request')->getPost('KONDISI') == "penjualanperfaktur"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$totaltransaksi = 0;
					$totaltransaksi = ($datajson->hasiljson[0]->data[$no]->SUBTOTAL + $datajson->hasiljson[0]->data[$no]->PAJAKTOKOC + $datajson->hasiljson[0]->data[$no]->PAJAKNEGARAC - $datajson->hasiljson[0]->data[$no]->POTONGANGLOBALC);
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->PK_NOTAPENJUALAN;
					$row[] = $datajson->hasiljson[0]->data[$no]->TGLKELUAR." ".$datajson->hasiljson[0]->data[$no]->WAKTU;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMA;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->JUMLAHITEM,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->SUBTOTAL,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->PAJAKTOKO,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->PAJAKNEGARA,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->POTONGANGLOBAL,'Rp ');
					$row[] = formatuang('IDR',$totaltransaksi,'Rp ');
					$data[] = $row;
					$jumlahitem = $jumlahitem + $datajson->hasiljson[0]->data[$no]->JUMLAHITEM;
					$subtotal = $subtotal + $datajson->hasiljson[0]->data[$no]->SUBTOTAL;
					$pajaktoko = $pajaktoko + $datajson->hasiljson[0]->data[$no]->PAJAKTOKO;
					$pajaknegara = $pajaknegara + $datajson->hasiljson[0]->data[$no]->PAJAKNEGARA;
					$potonganglobal = $potonganglobal + $datajson->hasiljson[0]->data[$no]->POTONGANGLOBAL;
					$jumlah = $jumlah + $totaltransaksi;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,''),
					"subtotal" => formatuang('IDR',$subtotal,'Rp '),
					"pajaktoko" => formatuang('IDR',$pajaktoko,'Rp '),
					"pajaknegara" => formatuang('IDR',$pajaknegara,'Rp '),
					"potonganglobal" => formatuang('IDR',$potonganglobal,'Rp '),
					"jumlah" => formatuang('IDR',$jumlah,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "penjualanperbarang"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$pajaktoko =0;$pajaknegara = 0;$potonganglobal = 0;$hj =0; $hb = 0;
					$row = [];
					$pajaktoko = $datajson->hasiljson[0]->data[$no]->PAJAKTOKO;
					$pajaknegara = $datajson->hasiljson[0]->data[$no]->PAJAKNEGARA;
					$potonganglobal = $datajson->hasiljson[0]->data[$no]->POTONGANGLOBAL;
					$hj = ($datajson->hasiljson[0]->data[$no]->JUMLAHITEM * $datajson->hasiljson[0]->data[$no]->HARGAJUAL) + $pajaktoko + $pajaknegara - $potonganglobal;
					$hb = ($datajson->hasiljson[0]->data[$no]->JUMLAHITEM * $datajson->hasiljson[0]->data[$no]->HARGABELI);
					$row[] = $datajson->hasiljson[0]->data[$no]->FK_BARANG;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMABARANG;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMAKATEGORI;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->JUMLAHITEM,'');
					$row[] = formatuang('IDR',$hj,'Rp ');
					$row[] = formatuang('IDR',$hb,'Rp ');
					$row[] = formatuang('IDR',$hj - $hb,'Rp ');
					$data[] = $row;
					$jumlahitem = $jumlahitem + $datajson->hasiljson[0]->data[$no]->JUMLAHITEM;
					$totaljual = $totaljual + $hj;
					$totalbeli = $totalbeli + $hb;
					$totallaba = $totallaba + ($hj - $hb);
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,'Rp '),
					"totaljual" => formatuang('IDR',$totaljual,'Rp '),
					"totalbeli" => formatuang('IDR',$totalbeli,'Rp '),
					"totallaba" => formatuang('IDR',$totallaba,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "penjualanperpelanggan"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->FK_MEMBER;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMA;
					$row[] = $datajson->hasiljson[0]->data[$no]->ALAMAT;
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT),'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->UANGMUKA + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINALKREDIT,'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT),'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT),'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT),'Rp ');
					$data[] = $row;
					$tunai = $tunai + ($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT);
					$uangmuka = $uangmuka + $datajson->hasiljson[0]->data[$no]->UANGMUKA + + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT;
					$kredit = $kredit + $datajson->hasiljson[0]->data[$no]->NOMINALKREDIT;
					$kdebit = $kdebit + ($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT);
					$kkredit = $kkredit + ($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT);
					$emoney = $emoney + ($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT);
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"tunai" => formatuang('IDR',$tunai,'Rp '),
					"uangmuka" => formatuang('IDR',$uangmuka,'Rp '),
					"kredit" => formatuang('IDR',$kredit,'Rp '),
					"kdebit" => formatuang('IDR',$kdebit,'Rp '),
					"kkredit" => formatuang('IDR',$kkredit,'Rp '),
					"emoney" => formatuang('IDR',$emoney,'Rp '),
					"grandtotal" => formatuang('IDR',($tunai+$uangmuka+$kredit+$kdebit+$kkredit+$emoney),'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "penjualanperkasir"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->KASIR;
					$row[] = strtoupper($datajson->hasiljson[0]->data[$no]->NAMAPENGGUNA);
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT),'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->UANGMUKA + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINALKREDIT,'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT),'Rp ')."<hr>"."<button class=\"btn btn-block btn-primary\">CEK DETAIL</button>";;
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT),'Rp ')."<hr>"."<button class=\"btn btn-block btn-primary\">CEK DETAIL</button>";;
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT),'Rp ')."<hr>"."<button class=\"btn btn-block btn-primary\">CEK DETAIL</button>";;
					$tunai = $tunai + ($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT);
					$uangmuka = $uangmuka + $datajson->hasiljson[0]->data[$no]->UANGMUKA + + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT;
					$kredit = $kredit + $datajson->hasiljson[0]->data[$no]->NOMINALKREDIT;
					$kdebit = $kdebit + ($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT);
					$kkredit = $kkredit + ($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT);
					$emoney = $emoney + ($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT);
					$row[] = formatuang('IDR',(($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT) + ($datajson->hasiljson[0]->data[$no]->UANGMUKA + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT) + ($datajson->hasiljson[0]->data[$no]->NOMINALKREDIT) + ($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT) + ($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT) + ($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT)),'Rp ');
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"tunai" => formatuang('IDR',$tunai,'Rp '),
					"uangmuka" => formatuang('IDR',$uangmuka,'Rp '),
					"kredit" => formatuang('IDR',$kredit,'Rp '),
					"kdebit" => formatuang('IDR',$kdebit,'Rp '),
					"kkredit" => formatuang('IDR',$kkredit,'Rp '),
					"emoney" => formatuang('IDR',$emoney,'Rp '),
					"grandtotal" => formatuang('IDR',($tunai+$uangmuka+$kredit+$kdebit+$kkredit+$emoney),'Rp '),
				];				
			}else if (service('request')->getPost('KONDISI') == "penjualanperjenistransaksi"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					if ($datajson->hasiljson[0]->data[$no]->JENIS == "TRANSAKSI UANG MUKA RESERVASI"){
						$row[] = "<div style='text-align: right;'><strong>".$datajson->hasiljson[0]->data[$no]->JENIS."</strong></div>";
						$row[] = "<strong>".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINAL,'Rp ')."</strong>";
						$grandtotaljenistrasnaksi = $datajson->hasiljson[0]->data[$no]->NOMINAL + $grandtotaljenistrasnaksi;
					}else if ($datajson->hasiljson[0]->data[$no]->JENIS == "TOTAL TRANSAKSI TUNAI"){
						$row[] = "<div style='text-align: right;'><strong>".$datajson->hasiljson[0]->data[$no]->JENIS."</strong></div>";
						$row[] = "<strong>".formatuang('IDR',($datajson->hasiljson[0]->data[1]->NOMINAL + $datajson->hasiljson[0]->data[2]->NOMINAL),'Rp ')."</strong>";
					}else if ($datajson->hasiljson[0]->data[$no]->JENIS == "TOTAL TRANSAKSI PIUTANG / KREDIT"){
						$row[] = "<div style='text-align: right;'><strong>".$datajson->hasiljson[0]->data[$no]->JENIS."</strong></div>";
						$row[] = "<strong>".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINAL,'Rp ')."</strong>";
					}else if ($datajson->hasiljson[0]->data[$no]->JENIS == "TOTAL TRANSAKSI KARTU DEBIT"){
						$row[] = "<div style='text-align: right;'><strong>".$datajson->hasiljson[0]->data[$no]->JENIS."</strong></div>";
						$row[] = "<strong>".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINAL,'Rp ')."</strong>";
					}else if ($datajson->hasiljson[0]->data[$no]->JENIS == "TOTAL TRANSKASI KARTU KREDIT"){
						$row[] = "<div style='text-align: right;'><strong>".$datajson->hasiljson[0]->data[$no]->JENIS."</strong></div>";
						$row[] = "<strong>".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINAL,'Rp ')."</strong>";
					}else if ($datajson->hasiljson[0]->data[$no]->JENIS == "TOTAL TRANSAKSI EMONEY"){
						$row[] = "<div style='text-align: right;'><strong>".$datajson->hasiljson[0]->data[$no]->JENIS."</strong></div>";
						$row[] = "<strong>".formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINAL,'Rp ')."</strong>";
					}else{
						$row[] = $datajson->hasiljson[0]->data[$no]->JENIS;
						$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINAL,'Rp ');
						$grandtotaljenistrasnaksi = $datajson->hasiljson[0]->data[$no]->NOMINAL + $grandtotaljenistrasnaksi;
					}
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"grandtotaljenistrasnaksi" => formatuang('IDR',$grandtotaljenistrasnaksi,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "penjualanpertanggal"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->data[$no]->TGLKELUARTRX));
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->STOKBARANGKELUAR,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->PAJAKTOKO,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->PAJAKNEGARA,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->POTONGANGLOBAL,'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT),'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->UANGMUKA + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->NOMINALKREDIT,'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT),'Rp ')."<hr>"."<button class=\"btn btn-block btn-primary\">CEK DETAIL</button>";;
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT),'Rp ')."<hr>"."<button class=\"btn btn-block btn-primary\">CEK DETAIL</button>";;
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT),'Rp ')."<hr>"."<button class=\"btn btn-block btn-primary\">CEK DETAIL</button>";;
					$jumlahitem = $jumlahitem + $datajson->hasiljson[0]->data[$no]->STOKBARANGKELUAR;
					$pajaktoko = $pajaktoko + $datajson->hasiljson[0]->data[$no]->PAJAKTOKO;
					$pajaknegara = $pajaknegara + $datajson->hasiljson[0]->data[$no]->PAJAKNEGARA;
					$potonganglobal = $potonganglobal + $datajson->hasiljson[0]->data[$no]->POTONGANGLOBAL;
					$tunai = $tunai + ($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT);
					$uangmuka = $uangmuka + $datajson->hasiljson[0]->data[$no]->UANGMUKA + + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT;
					$kredit = $kredit + $datajson->hasiljson[0]->data[$no]->NOMINALKREDIT;
					$kdebit = $kdebit + ($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT);
					$kkredit = $kkredit + ($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT);
					$emoney = $emoney + ($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT);
					$row[] = formatuang('IDR',(($datajson->hasiljson[0]->data[$no]->NOMINALTUNAI + $datajson->hasiljson[0]->data[$no]->NOMINALTUNAISPLIT) + ($datajson->hasiljson[0]->data[$no]->UANGMUKA + $datajson->hasiljson[0]->data[$no]->DPPESANTEMPAT) + ($datajson->hasiljson[0]->data[$no]->NOMINALKREDIT) + ($datajson->hasiljson[0]->data[$no]->NOMINALKDEBIT + $datajson->hasiljson[0]->data[$no]->NOMINALKDEBITSPLIT) + ($datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDIT + $datajson->hasiljson[0]->data[$no]->NOMINALKARTUKREDITSPLIT) + ($datajson->hasiljson[0]->data[$no]->NOMINALEMONEY + $datajson->hasiljson[0]->data[$no]->NOMINALEMONEYSPLIT)),'Rp ');
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,''),
					"pajaktoko" => formatuang('IDR',$pajaktoko,'Rp '),
					"pajaknegara" => formatuang('IDR',$pajaknegara,'Rp '),
					"potonganglobal" => formatuang('IDR',$potonganglobal,'Rp '),
					"tunai" => formatuang('IDR',$tunai,'Rp '),
					"uangmuka" => formatuang('IDR',$uangmuka,'Rp '),
					"kredit" => formatuang('IDR',$kredit,'Rp '),
					"kdebit" => formatuang('IDR',$kdebit,'Rp '),
					"kkredit" => formatuang('IDR',$kkredit,'Rp '),
					"emoney" => formatuang('IDR',$emoney,'Rp '),
					"grandtotal" => formatuang('IDR',($tunai+$uangmuka+$kredit+$kdebit+$kkredit+$emoney),'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporanreturpenjualannodatatables(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'IDPELANGGAN' => service('request')->getPost('IDPELANGGAN'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanreturpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatlaporanreturpenjualan(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'IDPELANGGAN' => service('request')->getPost('IDPELANGGAN'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanreturpenjualan", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "returpenjualanperfaktur"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"totalitem" => formatuang('IDR',0,''),
					"totalppn" => formatuang('IDR',0,''),
					"totalhb" => formatuang('IDR',0,''),
					"totalhj" => formatuang('IDR',0,''),
					"subtotalhb" =>formatuang('IDR',0,''),
					"subtotalhj" => formatuang('IDR',0,''),
					"subtotalselisih" => formatuang('IDR',0,''),
				];
			}
		}else{
			$totalitem = 0; $totalppn = 0; $subtotalhb =0; $subtotalhj = 0;$subtotalselisih = 0;
			if (service('request')->getPost('KONDISI') == "returpenjualanperfaktur"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$hasilselisih = $datajson->hasiljson[0]->data[$no]->TOTALJUALRETUR - $datajson->hasiljson[0]->data[$no]->TOTALHPPRETUR;
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTRXRETUR;
					$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALRETUR));
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMA." [".$datajson->hasiljson[0]->data[$no]->IDPELANGGAN."]";
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALSTOKRETUR,'');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPPN,'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->TOTALHPPRETUR),'Rp ');
					$row[] = formatuang('IDR',($datajson->hasiljson[0]->data[$no]->TOTALJUALRETUR),'Rp ');
					$row[] = formatuang('IDR',($hasilselisih < 0 ? $hasilselisih * -1 : $hasilselisih ),'Rp ');
					$totalitem = $totalitem + $datajson->hasiljson[0]->data[$no]->TOTALSTOKRETUR;
					$totalppn = $totalppn + $datajson->hasiljson[0]->data[$no]->TOTALPPN;
					$subtotalhb = $subtotalhb + $datajson->hasiljson[0]->data[$no]->TOTALHPPRETUR;
					$subtotalhj = $subtotalhj + $datajson->hasiljson[0]->data[$no]->TOTALJUALRETUR;
					$subtotalselisih = $subtotalselisih + ($hasilselisih < 0 ? $hasilselisih * -1 : $hasilselisih );
					$data[] = $row;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"totalitem" => formatuang('IDR',$totalitem,''),
					"totalppn" => formatuang('IDR',$totalppn,'Rp '),
					"subtotalhb" => formatuang('IDR',$subtotalhb,'Rp '),
					"subtotalhj" => formatuang('IDR',$subtotalhj,'Rp '),
					"subtotalselisih" => formatuang('IDR',$subtotalselisih,'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporandetaimembertabel(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'KODEMEMBER' => service('request')->getPost('KODEMEMBER'),
            'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
			'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'STATUSTRANSAKSI' => service('request')->getPost('STATUSTRANSAKSI'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporandetaimembertabel", [
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
				$row = [];
				$row[] = $datajson->hasiljson[0]->data[$no]->PK_NOTAPENJUALAN;
				$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->data[$no]->TGLKELUAR));
				$row[] = $datajson->hasiljson[0]->data[$no]->NAMABARANG;
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->STOKBARANGKELUAR,'');
				$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->HARGAJUAL,'Rp ');
				$row[] = $datajson->hasiljson[0]->data[$no]->LOKASI;
				$row[] = $datajson->hasiljson[0]->data[$no]->ENUM_JENISTRANSAKSI;
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
	public function persediaanitem(){
		$this->breadcrumb  = array( 
			"Beranda" => base_url(),
			"Penjualan" => base_url()."laporan/penjualan",
		);
		$data = [
			"titleheader"=>"LAPORAN PERSEDIAAN ITEM",
			"menuaktif" => "0",
			"submenuaktif" => "0",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
        return view('laporan/penjualan/dashboard',$data);
    }
	public function formatlaporanpembeliannodatatables(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatlaporanpembelian(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "pembelianperfaktur"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"jumlahitem" => formatuang('IDR',0,''),
					"diskon1" => formatuang('IDR',0,'Rp '),
					"diskon2" => formatuang('IDR',0,'Rp '),
					"ppn" => formatuang('IDR',0,'Rp '),
					"adiskon1" => formatuang('IDR',0,'Rp '),
					"adiskon2" => formatuang('IDR',0,'Rp '),
					"totalpembelian" => formatuang('IDR',0,'Rp '),
					"totalbeban" => formatuang('IDR',0,'Rp '),
					"totalhutang" => formatuang('IDR',0,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "pembelianperbarang" || service('request')->getPost('KONDISI') == "pembelianpertanggal"){
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,''),
					"diskon1" => formatuang('IDR',$diskon1,'Rp '),
					"diskon2" => formatuang('IDR',$diskon2,'Rp '),
					"ppn" => formatuang('IDR',$ppn,'Rp '),
					"adiskon1" => formatuang('IDR',$adiskon1,'Rp '),
					"adiskon2" => formatuang('IDR',$adiskon2,'Rp '),
					"totalpembelian" => formatuang('IDR',$totalpembelian,'Rp '),
				];
			}
		}else{
			$jumlahitem = 0; $diskon1 = 0; $diskon2 = 0; $ppn = 0; $adiskon1 = 0; $adiskon2 = 0; $totalpembelian = 0; $totalbeban = 0; $totalhutang = 0;
			if (service('request')->getPost('KONDISI') == "pembelianperfaktur"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTA;
					$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALTRS));
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMASUPPLIER);
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMAPENGGUNA);
					$row[] = $datajson->hasiljson[0]->data[$no]->TOTALBELI." Item";
					$row[] = "KODE TOP : ".$datajson->hasiljson[0]->data[$no]->TOP."<br>NAMA TOP : ".$datajson->hasiljson[0]->data[$no]->NAMATOP;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISKON1,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISKON2,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPPNMASUKAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->ADISKON1,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->ADISKON2,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPEMBELIAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPEMBELIANBEBAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALHUTANG,'Rp ');
					$data[] = $row;
					$jumlahitem = $jumlahitem + $datajson->hasiljson[0]->data[$no]->TOTALBELI;
					$diskon1 = $diskon1 + $datajson->hasiljson[0]->data[$no]->DISKON1;
					$diskon2 = $diskon2 + $datajson->hasiljson[0]->data[$no]->DISKON2;
					$ppn = $ppn + $datajson->hasiljson[0]->data[$no]->TOTALPPNMASUKAN;
					$adiskon1 = $adiskon1 + $datajson->hasiljson[0]->data[$no]->ADISKON1;
					$adiskon2 = $adiskon2 + $datajson->hasiljson[0]->data[$no]->ADISKON2;
					$totalpembelian = $totalpembelian + $datajson->hasiljson[0]->data[$no]->TOTALPEMBELIAN;
					$totalbeban = $totalbeban + $datajson->hasiljson[0]->data[$no]->TOTALPEMBELIANBEBAN;
					$totalhutang = $totalhutang + $datajson->hasiljson[0]->data[$no]->TOTALHUTANG;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,''),
					"diskon1" => formatuang('IDR',$diskon1,'Rp '),
					"diskon2" => formatuang('IDR',$diskon2,'Rp '),
					"ppn" => formatuang('IDR',$ppn,'Rp '),
					"adiskon1" => formatuang('IDR',$adiskon1,'Rp '),
					"adiskon2" => formatuang('IDR',$adiskon2,'Rp '),
					"totalpembelian" => formatuang('IDR',$totalpembelian,'Rp '),
					"totalbeban" => formatuang('IDR',$totalbeban,'Rp '),
					"totalhutang" => formatuang('IDR',$totalhutang,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "pembelianperbarang" || service('request')->getPost('KONDISI') == "pembelianpertanggal"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					if (service('request')->getPost('KONDISI') == "pembelianperbarang") $row[] = "KODE ITEM : ".$datajson->hasiljson[0]->data[$no]->KODEBARANG."<br>NAMA ITEM : <strong>".$datajson->hasiljson[0]->data[$no]->NAMABARANG."</strong><br>KATEGORI : ".$datajson->hasiljson[0]->data[$no]->NAMAKATEGORI;
					if (service('request')->getPost('KONDISI') == "pembelianpertanggal") $row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALTRS));;
					$row[] = $datajson->hasiljson[0]->data[$no]->TOTALBELI." Item";
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISKON1,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->DISKON2,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPPNMASUKAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->ADISKON1,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->ADISKON2,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPEMBELIAN,'Rp ');
					$data[] = $row;
					$jumlahitem = $jumlahitem + $datajson->hasiljson[0]->data[$no]->TOTALBELI;
					$diskon1 = $diskon1 + $datajson->hasiljson[0]->data[$no]->DISKON1;
					$diskon2 = $diskon2 + $datajson->hasiljson[0]->data[$no]->DISKON2;
					$ppn = $ppn + $datajson->hasiljson[0]->data[$no]->TOTALPPNMASUKAN;
					$adiskon1 = $adiskon1 + $datajson->hasiljson[0]->data[$no]->ADISKON1;
					$adiskon2 = $adiskon2 + $datajson->hasiljson[0]->data[$no]->ADISKON2;
					$totalpembelian = $totalpembelian + $datajson->hasiljson[0]->data[$no]->TOTALPEMBELIAN;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,''),
					"diskon1" => formatuang('IDR',$diskon1,'Rp '),
					"diskon2" => formatuang('IDR',$diskon2,'Rp '),
					"ppn" => formatuang('IDR',$ppn,'Rp '),
					"adiskon1" => formatuang('IDR',$adiskon1,'Rp '),
					"adiskon2" => formatuang('IDR',$adiskon2,'Rp '),
					"totalpembelian" => formatuang('IDR',$totalpembelian,'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporanreturpembeliannodatatables(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanreturpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatlaporanreturpembelian(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODEBARANG' => service('request')->getPost('KODEBARANG'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'KODEKATEGORI' => service('request')->getPost('KODEKATEGORI'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanreturpembelian", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "returpembelianperfaktur"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"jumlahitem" => formatuang('IDR',0,''),
					"totalpotongan" => formatuang('IDR',0,'Rp '),
					"totalsubtotal" => formatuang('IDR',0,'Rp '),
				];
			}
		}else{
			$jumlahitem = 0; $totalpotongan = 0; $totalsubtotal = 0;
			if (service('request')->getPost('KONDISI') == "returpembelianperfaktur"){
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTRXRETURBELI;
					$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALTRS));
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMASUPPLIER);
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALBARANG,'')." Item";
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALPOTONGAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALNOMINAL,'Rp ');
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMAPENGGUNA);
					$data[] = $row;
					$jumlahitem = $jumlahitem + $datajson->hasiljson[0]->data[$no]->TOTALBARANG;
					$totalpotongan = $totalpotongan + $datajson->hasiljson[0]->data[$no]->TOTALPOTONGAN;
					$totalsubtotal = $totalsubtotal + $datajson->hasiljson[0]->data[$no]->TOTALNOMINAL;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"jumlahitem" => formatuang('IDR',$jumlahitem,''),
					"totalpotongan" => formatuang('IDR',$totalpotongan,'Rp '),
					"totalsubtotal" => formatuang('IDR',$totalsubtotal,'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporanhutangnodatatables(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KONDISIHUTANG' => service('request')->getPost('KONDISIHUTANG'),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanhutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == 'false') return json_encode(['data' => []]);
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatlaporanhutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'KODESUPLIER' => service('request')->getPost('KODESUPLIER'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KONDISIHUTANG' => service('request')->getPost('KONDISIHUTANG'),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanhutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "pembayaranhutang"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"totalpembayaran" => formatuang('IDR',0,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "hutangpersuplier"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"totalkredit" => formatuang('IDR',0,'Rp '),
					"totalterbayarkan" => formatuang('IDR',0,'Rp '),
					"totalsisakredit" => formatuang('IDR',0,'Rp '),
				];
			}
		}else{
			if (service('request')->getPost('KONDISI') == "pembayaranhutang"){
				$totalpembayaran = 0;
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = date("d-m-Y", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALTRS))." ".$datajson->hasiljson[0]->data[$no]->WAKTU;
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTRANSAKSI;
					$row[] = $datajson->hasiljson[0]->data[$no]->TRANSAKSI_ID;
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMAPENGGUNA);
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMASUPPLIER);
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTARETURBELI;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->BAYAR,'Rp ');
					$data[] = $row;
					$totalpembayaran = $totalpembayaran + $datajson->hasiljson[0]->data[$no]->BAYAR;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"totalpembayaran" => formatuang('IDR',$totalpembayaran,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "hutangpersuplier"){
				$totalkredit = 0;$totalterbayarkan = 0;$totalsisakredit = 0;
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->SUPPLIER_ID;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMASUPPLIER;
					$row[] = $datajson->hasiljson[0]->data[$no]->ALAMAT;
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTELP;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALKREDIT,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALTERBAYARKAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALSISAKREDIT,'Rp ');
					$data[] = $row;
					$totalkredit = $totalkredit + $datajson->hasiljson[0]->data[$no]->TOTALKREDIT;
					$totalterbayarkan = $totalterbayarkan + $datajson->hasiljson[0]->data[$no]->TOTALTERBAYARKAN;
					$totalsisakredit = $totalsisakredit + $datajson->hasiljson[0]->data[$no]->TOTALSISAKREDIT;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"totalkredit" => formatuang('IDR',$totalkredit,'Rp '),
					"totalterbayarkan" => formatuang('IDR',$totalterbayarkan,'Rp '),
					"totalsisakredit" => formatuang('IDR',$totalsisakredit,'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
	public function formatlaporanpiutangnodatatables(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'IDPELANGGAN' => service('request')->getPost('IDPELANGGAN'),
			'GROUPELANGGAN' => service('request')->getPost('GROUPELANGGAN'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KONDISIPIUTANG' => service('request')->getPost('KONDISIPIUTANG'),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanpiutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == 'false') return json_encode(['data' => []]);
		return json_encode($datajson->hasiljson[0]);
	}
	public function formatlaporanpiutang(){
		$client = \Config\Services::curlrequest();
		$datapost = [
			'PERIODEAWAL' => service('request')->getPost('PERIODEAWAL'),
            'PERIODEAKHIR' => service('request')->getPost('PERIODEAKHIR'),
			'CARABAYAR' => service('request')->getPost('CARABAYAR'),
			'OUTLET' => service('request')->getPost('OUTLET'),
			'IDPELANGGAN' => service('request')->getPost('IDPELANGGAN'),
			'GROUPELANGGAN' => service('request')->getPost('GROUPELANGGAN'),
			'KONDISI' => service('request')->getPost('KONDISI'),
			'KODEUNIKMEMBER' => $this->session->get("kodeunikmember"),
			'KONDISIPIUTANG' => service('request')->getPost('KONDISIPIUTANG'),
		];
		$json_data = $client->request("POST", BASEURLAPI."laporan/formatlaporanpiutang", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
		if ($datajson->hasiljson[0]->success == "false"){
			if (service('request')->getPost('KONDISI') == "pembayaranpiutang"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"totalpembayaran" => formatuang('IDR',0,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "piutangmember"){
				$outputDT = [
					"draw" => 0,
					"recordsTotal" => 0,
					"recordsFiltered" => 0,
					"data" => [],
					"totalkredit" => formatuang('IDR',0,'Rp '),
					"totalterbayarkan" => formatuang('IDR',0,'Rp '),
					"totalsisakredit" => formatuang('IDR',0,'Rp '),
				];
			}
		}else{
			if (service('request')->getPost('KONDISI') == "pembayaranpiutang"){
				$totalpembayaran = 0;
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = date("d-m-Y H:i:s", strtotime($datajson->hasiljson[0]->data[$no]->TANGGALTRX));
					$row[] = $datajson->hasiljson[0]->data[$no]->NOTRANSAKSI;
					$row[] = $datajson->hasiljson[0]->data[$no]->TRANSAKSI_ID;
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMAPENGGUNA);
					$row[] = ucwords($datajson->hasiljson[0]->data[$no]->NAMAMEMBER);
					$row[] = "Keteranga Retur : ".$datajson->hasiljson[0]->data[$no]->KETERANGANRETUR."<br>Nota Retur : ".($datajson->hasiljson[0]->data[$no]->NOTARETUR == "" ? "Bukan Potong Retur Penjualan" : $datajson->hasiljson[0]->data[$no]->NOTARETUR);
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->BAYAR,'Rp ');
					$data[] = $row;
					$totalpembayaran = $totalpembayaran + $datajson->hasiljson[0]->data[$no]->BAYAR;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"totalpembayaran" => formatuang('IDR',$totalpembayaran,'Rp '),
				];
			}else if (service('request')->getPost('KONDISI') == "piutangmember"){
				$totalkredit = 0;$totalterbayarkan = 0;$totalsisakredit = 0;
				for ($no = 0; $no < $datajson->hasiljson[0]->totaldata; $no++) {
					$row = [];
					$row[] = $datajson->hasiljson[0]->data[$no]->FK_MEMBER;
					$row[] = $datajson->hasiljson[0]->data[$no]->NAMAMEMBER;
					$row[] = $datajson->hasiljson[0]->data[$no]->ALAMAT;
					$row[] = $datajson->hasiljson[0]->data[$no]->TELEPON;
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALKREDIT,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALTERBAYARKAN,'Rp ');
					$row[] = formatuang('IDR',$datajson->hasiljson[0]->data[$no]->TOTALSISAKREDIT,'Rp ');
					$data[] = $row;
					$totalkredit = $totalkredit + $datajson->hasiljson[0]->data[$no]->TOTALKREDIT;
					$totalterbayarkan = $totalterbayarkan + $datajson->hasiljson[0]->data[$no]->TOTALTERBAYARKAN;
					$totalsisakredit = $totalsisakredit + $datajson->hasiljson[0]->data[$no]->TOTALSISAKREDIT;
				}
				$outputDT = [
					"draw" => 1,
					"recordsTotal" => $datajson->hasiljson[0]->totaldata,
					"recordsFiltered" => $datajson->hasiljson[0]->totaldata,
					"data" => $data,
					"totalkredit" => formatuang('IDR',$totalkredit,'Rp '),
					"totalterbayarkan" => formatuang('IDR',$totalterbayarkan,'Rp '),
					"totalsisakredit" => formatuang('IDR',$totalsisakredit,'Rp '),
				];
			}
		}
		return json_encode($outputDT);
	}
}
