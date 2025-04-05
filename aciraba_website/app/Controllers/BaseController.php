<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\Filters\FilterInterface;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['GlobalFn', 'Security','number'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		date_default_timezone_set('Asia/Jakarta');
		parent::initController($request, $response, $logger);
		$this->session = \Config\Services::session();
		$request = \Config\Services::request();
        $uri = $request->getUri()->setSilent();
		if ($uri->getSegment(1) != "auth"){
			if ($this->session->get("kodeunikmember") == ""){
				header('Location: '.base_url().'auth');
				exit(); 
			}
			if ($this->session->get("verif_wa") != base64_encode($this->session->get("kodeunikmember").$this->session->get("namapengguna"))){
				header('Location: '.base_url().'auth/verifikasi_pengguna');
				exit(); 
			}
		}
		$this->hakakses = json_decode($this->session->get("jsonmenu", true));
	}
}
