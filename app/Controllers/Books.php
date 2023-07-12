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
}