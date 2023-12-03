<?php

namespace App\Controllers\staff;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\BorrowBooksModel;
use App\Models\RequestModel;


class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->bookModel = new BooksModel();
        $this->borrowBooksModel = new BorrowBooksModel();
        $this->requestModel = new RequestModel();
    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role')!="staff") {
            return redirect()->to('/');
        }

        $data = [
            'totalBooks' => $this->bookModel->getTotalBooks(),
            'totalRequest' => count($this->requestModel->getBookRequest($session->get("id"),$session->get("role"))),
            'totalFine' => $this->borrowBooksModel->getFineAmount($session->get("id"),$session->get("role")),
            'books' => $this->borrowBooksModel->getBorrowedBookbyUser($session->get("id"),$session->get("role")),
        ];


        echo view('Others/header');
        echo view('Staff/Dashboard',$data);
        echo view('Others/fooder');
    }
}
