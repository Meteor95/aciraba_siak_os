<?php

namespace App\Filters;
use App\Helpers\HakAksesHelper;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CheckPermission implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $hakakses = $session->get('jsonmenu');
        $session = $session->get('hakakses');
        $hakAksesHelper = new HakAksesHelper($arguments, $hakakses, $session);
        if ($hakAksesHelper->checkPermission() == 0) {
            return redirect()->to('/auth/area403');
        }
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}