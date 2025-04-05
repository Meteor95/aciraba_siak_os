<?php

namespace App\Helpers;

use CodeIgniter\Controller;

class HakAksesHelper extends Controller
{
    private $kondisimenu;
    private $hakakses;
    private $session;

    public function __construct($kondisimenu, $hakakses, $session)
    {
        $this->kondisimenu = $kondisimenu;
        $this->hakakses = $hakakses;
        $this->session = $session;
    }

    public function checkPermission()
    {
        if ($this->session == "OWNER") {
            return 1;
        }else if ($this->searchForMenu(isset($this->kondisimenu[0]) ? $this->kondisimenu[0] : 0 , json_decode($this->hakakses)) == 1) {
            return 2;
        }else{
            return 0;
        }
    }

    private function searchForMenu($id, $jsonObject) {
        if (isset($jsonObject->menuakses)){
            $menuAkses = $jsonObject->menuakses;
            foreach ($menuAkses as $menu) {
                if ($menu->menuke === $id) {
                    return $menu->status;
                }
            }
        }else{
            header('Location: '.base_url().'auth');
			exit(); 
        }
        return 0;
    }    
}
