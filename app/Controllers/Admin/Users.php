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
        
    public function staffs()
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

    public function students()
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

    public function student($activity,$id)
    {
        $session = session();
        if ($activity=='add') {

            if ($this->request->getMethod() === "post") {
                
                $regno = $this->request->getPost('regno');
                $sname = $this->request->getPost('name');
                $gender = $this->request->getPost('gender');
                $stemail = $this->request->getPost('mail');
                $Contact = $this->request->getPost('contact');
                $did = $this->request->getPost('dname');
                $year = $this->request->getPost('year');
                $shift = $this->request->getPost('shift');

                if($gender == "boy" || $gender == "Boy")
                    $image = "assets/student/boy.png";
                elseif($gender == "Girl" || $gender == "girl")
                    $image = 'assets/student/girl.png';
    
                $data = [
                    'regno' => $regno,
                    'sname' => $sname,
                    'spass' => password_hash("pass", PASSWORD_DEFAULT),
                    'gender' => $gender,
                    'stemail' => $stemail,
                    'Contact' => $Contact,
                    'did' => $did,
                    'year' => $year,
                    'shift' => $shift,
                    'image' => $image,
                    'role' => "student",
                ];
                
                if($this->studentModel->insertstd($data))
                {
                    $session->setFlashdata('msg', 'New Student Added Successfully.');
                } else{
                    $session->setFlashdata('msg', 'New Student Add Failed.');
                } 
            }
       
            echo view('Others/header');
            echo view('Admin/AdminAddStudent');
            echo view('Others/fooder');
        
        }elseif($activity == 'update'){
            $session = session();

            if ($this->request->getMethod() === "post") {
                
                $regno = $this->request->getPost('regno');
                $sname = $this->request->getPost('name');
                $gender = $this->request->getPost('gender');
                $stemail = $this->request->getPost('mail');
                $Contact = $this->request->getPost('contact');
                $did = $this->request->getPost('dname');
                $year = $this->request->getPost('year');
                $shift = $this->request->getPost('shift');

                if($gender == "boy" || $gender == "Boy")
                    $image = "assets/student/boy.png";
                elseif($gender == "Girl" || $gender == "girl")
                    $image = 'assets/student/girl.png';
    
                $data = [
                    'regno' => $regno,
                    'sname' => $sname,
                    'spass' => password_hash("pass", PASSWORD_DEFAULT),
                    'gender' => $gender,
                    'stemail' => $stemail,
                    'Contact' => $Contact,
                    'did' => $did,
                    'year' => $year,
                    'shift' => $shift,
                    'image' => $image,
                    'role' => "student",
                ];
                
                if($this->studentModel->updateProfile($id,$data))
                {
                    $session->setFlashdata('msg', 'Student Update Successfully.');
                } else{
                    $session->setFlashdata('msg', 'Student Update Failed.');
                } 
            }

            $stddata = [
                'student' => $this->studentModel->getProfile($id) 
            ];
            
            echo view('Others/header');
            echo view('Admin/AdminAddStudent',$stddata);
            echo view('Others/fooder');    

        }
    }
}