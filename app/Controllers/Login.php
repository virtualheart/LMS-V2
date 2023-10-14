<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StaffModel;
use App\Models\StudentModel;
use App\Models\OtherModel;

class Login extends BaseController
{
    protected $userModel;
    protected $adminModel;
    protected $studentModel;

    public function __construct()
    {
        // $this->preogin();
        // $this->userModel = new UserModel();
        // $this->adminModel = new AdminModel();
        // $this->studentModel = new StudentModel();
    }

    public function index(){

        $session = session();
        switch($session->get("role")){
            case "admin":
                return redirect()->to('/admin/home');
            case "staff":
                return redirect()->to('/staff/Dashboard');
            case "student":
                return redirect()->to('/student/Dashboard');
            default:
                $session->destroy();
                return redirect()->to('Login/student');
        }
            
    }

    public function student(){
        $session = session();  
                
        switch($session->get("role")){
            case "admin":
                return redirect()->to('/admin/home');
            case "staff":
                return redirect()->to('/staff/Dashboard');
            case "student":
                return redirect()->to('/student/Dashboard');
        }              

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($this->request->getMethod() === 'post') {
          
            $this->studentModel = new StudentModel();
            $regno = $this->request->getPost('regno');
            $password = $this->request->getPost('password');

            $data = $this->studentModel->where('regno', $regno)->first();

            if ($data && password_verify($password,$data['spass'])) {
                // Successful login
                $session->set([
                    'id' => $data['st_id'],
                    'name' => $data['sname'],
                    'email' => $data['stemail'],
                    'role' => $data['role'],
                    'image' => $data['image'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/student/Dashboard');
            }

            // Invalid credentials
            $session->setFlashdata('msg', 'Email or Password is incorrect.');
            // return redirect()->to('/');
        }

        helper(['form']);
        echo view('Others/header');
        echo view('Login');
        echo view('Others/fooder');
    }

    public function staff(){
        $session = session();
        switch($session->get("role")){
            case "admin":
                return redirect()->to('/admin/home');
            case "staff":
                return redirect()->to('/staff/Dashboard');
            case "student":
                return redirect()->to('/student/Dashboard');
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'regno' => 'required',
            'password' => 'required'
        ]);

        if ($this->request->getMethod() === 'post') {
            $this->userModel = new StaffModel();
            $regno = $this->request->getPost('regno');
            $password = $this->request->getPost('password');

            $data = $this->userModel->where('regno', $regno)->first();

            if ($data && password_verify($password, $data['spass'])) {
                // Successful login
                $session->set([
                    'id' => $data['sid'],
                    'regno' => $data['regno'],
                    'name' => $data['sname'],
                    'email' => $data['semail'],
                    'role' => $data['role'],
                    'image' => $data['image'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/staff/Dashboard');
            }

            // Invalid credentials
            $session->setFlashdata('msg', 'Email or Password is incorrect.');
            // return redirect()->to('/staff');
        }

        helper(['form']);
        echo view('Others/header');
        echo view('Login');
        echo view('Others/fooder');
    }

    public function Admin2Login()
    {
        $session = session();
        switch($session->get("role")){
            case "admin":
                return redirect()->to('/admin/home');
            case "staff":
                return redirect()->to('/staff/Dashboard');
            case "student":
                return redirect()->to('/student/Dashboard');
        }

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($this->request->getMethod() === 'post') {
            $this->adminModel = new AdminModel();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $data = $this->adminModel->where('aname', $username)->first();

            if ($data && password_verify($password,$data['apass'])) {
                // Successful login
                $session->set([
                    'id' => $data['id'],
                    'name' => $data['aname'],
                    'email' => $data['a_mail'],
                    'role' => $data['role'],
                    'isLoggedIn' => true
                ]);

                return redirect()->to('/admin/home');
            }

            // Invalid credentials
            $session->setFlashdata('msg', 'Email or Password is incorrect. ');
            // return redirect()->to('Admin2Login');
        }

        helper(['form']);
        echo view('Others/header');
        echo view('Admin/Admin2login');
        echo view('Others/fooder');
    }

    public function forgetpassword()
    {
        $this->otherModel = new OtherModel();
        if ($this->request->getMethod() === 'post') {
            
        }

        echo view('ForgetPassword');
    }

}
