<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\BarrowBooksModel;

class Report extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->barrowBooksModel = new BarrowBooksModel();
    }
        
    public function student($id)
    {
        $session = session();
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        $stddata = [
            'student' => $this->studentModel->getProfile($id),
        ];

        echo view('Others/header');
        echo view('Admin/AdminStudentReport',$stddata);
        echo view('Others/fooder');    

    }
}