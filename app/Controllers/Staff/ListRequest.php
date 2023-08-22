<?php

namespace App\Controllers\staff;
use App\Controllers\BaseController;

use App\Models\RequestModel;

class ListRequest extends BaseController
{

    public function __construct()
    {
        $this->requestModel = new RequestModel();

    }

    public function index()
    {
        $session = session();
        $data = [
            'requestlists' => $this->requestModel->getBookRequest($session->get('id'),$session->get('role')),
        ];

        echo view('Others/header');
        echo view('Staff/ListRequestView',$data);
        echo view('Others/fooder');
    }

    
    public function history()
    {
        $session = session();

        $data = [
            'requestlists' => $this->requestModel->getBookRequesthis($session->get('id'),$session->get('role')),
        ];

        echo view('Others/header');
        echo view('Staff/ListRequestView',$data);
        echo view('Others/fooder');

    }

}
