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
        
    public function student($id=null)
    {
        $session = session();
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        $stddata = [
            'student' => $this->studentModel->getProfile($id) 
        ];

      $chart = [
            'staff' => $this->barrowBooksModel->getBarrowedBookcountbyRole("staff"),
            'student' => $this->barrowBooksModel->getBarrowedBookcountbyRole("student"),
            'datevice' => $this->barrowBooksModel->getBarrowedBookMonth()
        ];
        
        echo view('Others/header');
        echo view('Admin/AdminChart',$chart);
        echo view('Admin/AdminStudentReport',$stddata);
        echo view('Others/fooder');    

    }
}