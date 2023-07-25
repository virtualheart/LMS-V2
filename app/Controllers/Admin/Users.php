<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\StudentModel;


class users extends BaseController
{
    public function __construct()
    {
        $this->staffModel = new StaffModel();
        $this->studentModel = new StudentModel();
    }
        
    public function staff()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        $data = [
            'users' => $this->staffModel->getStaffList(),
        ];

        echo view('Others/header');
        echo view('Admin/AdminUserList',$data);
        echo view('Others/fooder');
    }

    public function student()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        $data = [
            'users' => $this->studentModel->getStudentList(),
        ];

        echo view('Others/header');
        echo view('Admin/AdminStudentList',$data);
        echo view('Others/fooder');
        
    }
}