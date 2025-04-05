<?php
namespace App\Controllers;

class PaymentGateway extends BaseController{
	protected $uri,$session,$breadcrumb,$sidetitle = "Payment Gateway Data";
	public function duitku()
	{
		$this->breadcrumb  = array( 
			"Daftar Metode Pembayaran" => base_url()."masterdata/daftarmetodepembayaran",
			"Pengaturan DUIKU.COM" => base_url()."paymentgateway/duitku",
	   	);
		$data = [
			"titleheader"=>"DAFTAR PENCATATAN TRANSAKSI DUITKU",
			"menuaktif" => "3",
			"submenuaktif" => "10",
			"breadcrumb"=>$this->breadcrumb,
			"sidetitle" => $this->sidetitle,
			
		];
		return view('backend/paymentgateway/duitku',$data);
	}
    public function cektransaksi(){
        $client = \Config\Services::curlrequest();
		$datapost = [
            'VENDOR' => service('request')->getPost('VENDOR'),
            'PAGE' => service('request')->getPost('PAGE'),
            'PER_PAGE' => service('request')->getPost('PER_PAGE'),
            'TOTALBELANJA' => service('request')->getPost('TOTALBELANJA'),
            'REFERENCE' => service('request')->getPost('REFERENCE'),
            'MERCHANT_REF' => service('request')->getPost('MERCHANT_REF'),
			'METHOD' => "QRIS2",
			'STATUS' => service('request')->getPost('STATUS'),
		];
		$json_data = $client->request("POST", BASEURLAPI."paymentgateway/detailtransaksi", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
        return json_encode($datajson->hasilresponsedetailtransaksi);
    }
    public function qris(){
        $client = \Config\Services::curlrequest();
		$datapost = [
            'VENDOR' => service('request')->getPost('VENDOR'),
            'NAMAMEMBER' => service('request')->getPost('NAMAMEMBER'),
            'EMAIL' => service('request')->getPost('EMAIL'),
            'NOKONTAK' => service('request')->getPost('NOKONTAK'),
            'ITEMS' => service('request')->getPost('ITEMS'),
			'ORDERID' => service('request')->getPost('ORDERID'),
			'TOTALBELANJA' => service('request')->getPost('TOTALBELANJA'),
            'METHOD' => "SP",
		];
		$json_data = $client->request("POST", BASEURLAPI."paymentgateway/reqtrx", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
        return json_encode($datajson->hasilresponsecektransaksi);
    }
	public function daftarbankduitku(){
        $client = \Config\Services::curlrequest();
		$datapost = [
			'TOKEN' => generateRandomString(32),
		];
		$json_data = $client->request("POST", BASEURLAPI."paymentgateway/nodeduitkugetmethodpayment", [
			"headers" => [
				"Accept" => "application/json",
				"Authorization" => $_ENV['TOKENSCHEME'].base64_encode($_ENV['TOKENAPI'].":::".$this->session->get("TOKENUSER")),
			],
			"form_params" => $datapost
		]);
		$datajson = json_decode($json_data->getBody());
        return json_encode($datajson->daftarchanelpembayaran);
    }
}