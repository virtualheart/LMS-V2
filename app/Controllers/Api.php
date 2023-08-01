<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Api extends BaseController
{

    public function __construct()
    {
        $this->before = ['auth'];
    }
    
    public function login()
    {
        if ($this->request->getMethod() == "post") {
            $this->studentModel = new StudentModel();
            $regno = $this->request->getPost('regno');
            $password = $this->request->getPost('password');

            $data = $this->studentModel->where('regno', $regno)->first();

            if ($data && password_verify($password, $data['spass'])) {
                // Successful login
                $userData = [
                    'user_id' => $data['st_id'],
                ];
                
            } else {
                return $this->response->setJSON([
                    'status' => 'Failed',
                    'msg' => "Login Failed",
                ]);
            }

        } else {
            return $this->response->setJSON([
                'status' => 'Failed',
                'msg' => "Method not allowed",
            ]);
        }
    }


    public function test($s=null){


        switch ($s) {
            case '1':
                copy(getcwd().'/env', getcwd().'/.envtest');

                break;
            }

        $data = [
            'step' => $s,
            'Basepath' => getcwd(),
            'installpath' => getcwd().'/.envtest',
        ];

        echo view('Others/header');
        echo view('install/install',$data);
        echo view('Others/fooder');
    }

}
