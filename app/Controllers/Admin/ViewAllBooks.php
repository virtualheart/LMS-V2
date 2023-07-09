<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;


class ViewAllBooks extends BaseController
{
    public function __construct()
    {

    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        $booksModel = new BooksModel();

        $data['books'] = $booksModel->getBooksList();


        echo view('Others/header');
        echo view('Admin/AdminViewAllBooks',$data);
        echo view('Others/fooder');
    }
}
