<?php

namespace App\Controllers;

class Front extends BaseController
{
	public function index(){
		$data = [
			"titleheader"=> "DASHBOARD ACIPAY - DOMPET DATA",
		];
		return view('front/landing/website',$data);
	}
	public function member_profile(){
		$data = [
			"titleheader"=> "DASHBOARD ACIPAY - DOMPET DATA",
		];
		return view('front/member/profile',$data);
	}
}