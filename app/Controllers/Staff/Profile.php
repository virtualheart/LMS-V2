<?php

namespace App\Controllers\staff;
use App\Controllers\BaseController;
use App\Models\StaffModel;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->staffModel = new StaffModel();
    }

    public function index()
    {
        $session = session();
        
        if ($session->get('role')!="staff") {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'post') {
        
            $data = [
                'profile' => $this->staffModel->getStaffProfile($session->get('id')),
            ];
            
            $id=$session->get('id');
            $apass = $this->request->getPost('apass');
            $amail = $this->request->getPost('mail');
            $contact = $this->request->getPost('contactno');
       
            $validation = \Config\Services::validation();

            $validation->setRules([
                'apass' => 'required',
                'contactno' => 'required',
                'amail' => 'required | valid_email'
            ]);

            if (empty($apass)) {
                $ahpass = $data['profile']['spass'];
            }else{
                $ahpass = password_hash($apass, PASSWORD_DEFAULT);
            }

            if (empty($contact)) {
                $contact = $data['profile']['Contact'];
            }

            if (empty($amail)) {
                $amail = $data['profile']['stemail'];
            }

            $data = [
                'spass' => $ahpass,
                'semail' => $amail,
                'contact' => $contact
            ];


            if($this->staffModel->updateProfile($id,$data)){
                $session->setFlashdata('msg', 'Profile Update Successfully.');
            } else{
                $session->setFlashdata('msg', 'Profile Update Failed.');
            }
        }

        $data = [
            'profile' => $this->staffModel->getStaffProfile($session->get('id')),
        ];

        echo view('Others/header');
        echo View('Staff/StaffProfile',$data);
        echo view('Others/fooder');    
    }
}
