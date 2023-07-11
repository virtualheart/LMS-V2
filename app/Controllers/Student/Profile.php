<?php

namespace App\Controllers\student;
use App\Controllers\BaseController;
use App\Models\StudentModel;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
                $session = session();

        if ($session->get('role')!="student") {
            return redirect()->to('/');
        }

        $data = [
            'profile' => $this->studentModel->getProfile($session->get('id')),
        ];

        if ($this->request->getMethod() === 'post') {

            $id=$session->get('id');
            $user = $this->request->getPost('user');
            $apass = $this->request->getPost('apass');
            $amail = $this->request->getPost('amail');
       
            $validation = \Config\Services::validation();

            $validation->setRules([
                'apass' => 'required',
                'amail' => 'required | valid_email'
            ]);

            if (empty($apass)) {
                $ahpass = $data['profile']['apass'];
            }else{
                $ahpass = password_hash($apass, PASSWORD_DEFAULT);
            }


            if($this->studentModel->updateProfile($id,$ahpass,$amail)){
                $session->setFlashdata('msg', 'Profile Update Successfully.');
            } else{
                $session->setFlashdata('msg', 'Profile Update Failed.');
            }
        }

        $data = [
            'profile' => $this->studentModel->getProfile($session->get('id')),
        ];


        echo view('Others/header');
        echo view('Student/StudentProfile',$data);
        echo view('Others/fooder');

        
    }
}