<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\StudentModel;
use App\Models\OtherModel;
use App\Models\DepartmentModel;

class users extends BaseController
{
    public function __construct()
    {
        $this->staffModel = new StaffModel();
        $this->studentModel = new StudentModel();
        $this->otherModel = new OtherModel();
        $this->departmentModel = new DepartmentModel();
    }
     

    // list all staff   
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

    // list all studnet
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

    // add/update student detiles
    public function student($activity,$id)
    {
        $session = session();
        // add new studnet detiles
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
            $data = [
                'departments' => $this->departmentModel->getDepartmentList(),
            ];


            echo view('Others/header');
            echo view('Admin/AdminAddStudent',$data);
            echo view('Others/fooder');
        
        //Update old studnet detiles
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

    // Add/Update staff
    public function staff($activity,$id)
    {
        $session = session();

        // Add new staff detiles
        if ($activity=='add') {
            if ($this->request->getMethod() === "post") {
                
                $regno = $this->request->getPost('regno');
                $sname = $this->request->getPost('name');
                $gender = $this->request->getPost('gender');
                $semail = $this->request->getPost('mail');
                $Contact = $this->request->getPost('contact');
                $designid = $this->request->getPost('designid');

                if($gender == "male" || $gender == "Male")
                    $image = "assets/staff/male.png";
                elseif($gender == "female" || $gender == "Female")
                    $image = 'assets/staff/female.png';
    
                $data = [
                    'regno' => $regno,
                    'sname' => $sname,
                    'spass' => password_hash("pass", PASSWORD_DEFAULT),
                    'gender' => $gender,
                    'semail' => $semail,
                    'contact' => $Contact,
                    'did' => 1,
                    'designid' => $designid,
                    'image' => $image,
                    'role' => "staff",
                ];
                
                if($this->staffModel->setinsertstf($data))
                {
                    $session->setFlashdata('msg', 'New Staff Added Successfully.');
                } else{
                    $session->setFlashdata('msg', 'New Staff Add Failed.');
                } 
            }
       
            $useri = [
                'userid' => $this->otherModel->getLastStaffid()->dis ?? 0
            ];
       

            echo view('Others/header');
            echo view('Admin/AdminAddStaff',$useri);
            echo view('Others/fooder');

        // update old staff detiles
        }elseif($activity == 'update'){
            
            if ($this->request->getMethod() === "post") {

                $regno = $this->request->getPost('regno');
                $sname = $this->request->getPost('name');
                $gender = $this->request->getPost('gender');
                $semail = $this->request->getPost('mail');
                $Contact = $this->request->getPost('contact');
                $designid = $this->request->getPost('designid');

                if($gender == "male" || $gender == "Male")
                    $image = "assets/staff/male.png";
                elseif($gender == "female" || $gender == "Female")
                    $image = 'assets/staff/female.png';
    
                $data = [
                    'regno' => $regno,
                    'sname' => $sname,
                    'spass' => password_hash("pass", PASSWORD_DEFAULT),
                    'gender' => $gender,
                    'semail' => $semail,
                    'contact' => $Contact,
                    'did' => 1,
                    'designid' => $designid,
                    'image' => $image,
                    'role' => "staff",
                ];
                
                if($this->staffModel->updateProfile($id,$data))
                {
                    $session->setFlashdata('msg', 'New Staff Added Successfully.');
                } else{
                    $session->setFlashdata('msg', 'New Staff Add Failed.');
                } 
            }

            $stfdata = [
                'staff' => $this->staffModel->getStaffProfile($id) 
            ];

       
            echo view('Others/header');
            echo view('Admin/AdminAddStaff',$stfdata);
            echo view('Others/fooder');

        }
    }
}