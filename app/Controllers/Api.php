<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\BooksModel;

class Api extends BaseController
{

    public function __construct()
    {
        $this->before = ['auth'];
        $this->booksModel= new BooksModel();
    }
    
    // Login for Mobile Application (Planning)
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

    // Book list Using DATATABLES js api
    public function getBooksListAPI()
    {
        $session=session();
        if ($session->get('role') != ("staff" or "admin" or "student")) {
            return redirect()->to('/');
        }
        
        if ($this->request->getMethod() == "post") {
            
            return $this->response->setJSON(
                $this->booksModel->getBooksList()
            );
        }else {
            return $this->response->setJSON([
                'status' => 'Failed',
                'msg' => "Method not allowed",
            ]);
        }
    }
}
