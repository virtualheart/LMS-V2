<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\StaffModel;
use App\Models\BarrowBooksModel;

class Report extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->staffModel = new StaffModel();
        $this->barrowBooksModel = new BarrowBooksModel();
    }
        
    public function student($id)
    {
        $session = session();
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'post') {

            $remark = $this->request->getPost('remark');
            
            $data = [
                'remark' => $remark,
            ];

            if($this->studentModel->updateProfile($id,$data));

        }

        $stddata = [
            'student' => $this->studentModel->getProfile($id),
            'books' => $this->barrowBooksModel->getAllBookbyUser($id,'student'),
        ];

        echo view('Others/header');
        echo view('Admin/AdminStudentReport',$stddata);
        echo view('Others/fooder');    

    }

    public function staff($id)
    {
        $session = session();
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'post') {

            $remark = $this->request->getPost('remark');
            
            $data = [
                'remark' => $remark,
            ];

            if($this->staffModel->updateProfile($id,$data));

        }

        $stddata = [
            'staff' => $this->staffModel->getStaffProfile($id),
            'books' => $this->barrowBooksModel->getAllBookbyUser($id,'staff'),
        ];

        echo view('Others/header');
        echo view('Admin/AdminStaffReport',$stddata);
        echo view('Others/fooder');    

    }
}