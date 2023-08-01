<?php

namespace App\Controllers;
use App\Models\BooksModel;

class Books extends BaseController
{    
    public function status()
    {
        $booksModel = new BooksModel();

        $data['books'] = $booksModel->getBooksList();

        echo view('Others/header');
        echo view('BookStatus',$data);
        echo view('Others/fooder');
    }

    public function request()
    {
        $session = session();
        if($this->request->getMethod() === 'post'){
            $bcode = $this->request->getPost('bcode');
            $id = $session->get('id');
            $role =$session->get('role');
            return true;
        } else {
            return $this->response->setJSON([
                'status' => 'Failed',
                'msg' => "Method not allowed",
            ]);
        }
    }
}