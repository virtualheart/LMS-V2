<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StaffModel;
use App\Models\StudentModel;
use App\Models\OtherModel;
use App\Controllers\Mail;

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
        $session = session();
        $this->mail = new Mail();

        $this->otherModel = new OtherModel();
        $this->studentModel = new StudentModel();
        $this->userModel = new StaffModel();

        if ($this->request->getMethod() === 'post') {
            $regno = $this->request->getPost('regno');
            $email = $this->request->getPost('email');

            $data = $this->otherModel->forgetpassword($regno,$email);

            if ($data) {

                $sid = $data->sid;
                $stemail = $data->semail;
                $sname = $data->sname;
                $role = $data->role;
                
                try{
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $newpassword = '';

                    for ($i = 0; $i < 8; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $newpassword .= $characters[$index];
                    }

                    // mail
                    $subject = '(TESTING) DLMS Password Reset request';
                            
                    $body = str_replace(
                        array('{cname}', '{cpassword}'),
                        array($sname, $newpassword),
                        file_get_contents(base_url('assets/Template/resetpasswd.phtml'))
                    );

                    // mail trigger (calling send mail function)
                   if($this->mail->sendmail($stemail,$sname,$subject,$body)){
                            
                            $data = [
                                'spass' => password_hash($newpassword, PASSWORD_DEFAULT),
                            ];

                        if ($role == 'staff') {
                            $this->userModel->updateProfile($sid,$data);                           
                        } elseif ($role == 'student'){
                            $this->studentModel->updateProfile($sid,$data);
                        }

                        return redirect()->to('/');

                   }

                } catch(Exception $e){
                    $session->setFlashdata('msg', 'Email is not being sent. Please contact a librarian for assistance');
                }

            } else{
                $session->setFlashdata('msg', 'Incorrect Register Number or Email');
            }
            
        }

        echo view('Others/header');
        echo view('ForgetPassword');
        echo view('Others/fooder');

    }

}
