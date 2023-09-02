<?php

namespace App\Controllers\Admin;
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
            'requestlists' => $this->requestModel->getAllBookRequest(),
        ];

        echo view('Others/header');
        echo view('Admin/AdminListRequestView',$data);
        echo view('Others/fooder');

        $this->requestModel->setIsSeenAdmin();

    }

    public function history()
    {
        $session = session();

        $data = [
            'requestlists' => $this->requestModel->getAllBookRequesthis(),
        ];

        echo view('Others/header');
        echo view('Admin/AdminListRequestView',$data);
        echo view('Others/fooder');

    }

}
