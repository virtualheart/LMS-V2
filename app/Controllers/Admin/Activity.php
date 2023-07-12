<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;

class Activity extends BaseController
{
    public function Barrow()
    {
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if($this->request->getMethod() === 'post'){

        }

        helper(['form']);
        echo view('Others/header');
        echo view('Admin/AdminBookBarrow');
        echo view('Others/fooder');
    }

    public function Return()
    {
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }
        
        if($this->request->getMethod() === 'post'){

        }
        
        helper(['form']);
        echo view('Others/header');
        echo view('Admin/AdminBookReturn');
        echo view('Others/fooder');

    }
}
