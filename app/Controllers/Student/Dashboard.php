<?php

namespace App\Controllers\student;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\BarrowBooksModel;
use App\Models\RequestModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->bookModel = new BooksModel();
        $this->barrowBooksModel = new BarrowBooksModel();
        $this->requestModel = new RequestModel();
    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role')!="student") {
            return redirect()->to('/');
        }

        $data = [
            'totalBooks' => $this->bookModel->getTotalBooks(),
            'totalRequest' => count($this->requestModel->getBookRequest($session->get("id"),$session->get("role"))),
            'totalFine' => $this->barrowBooksModel->getFineAmount($session->get("id"),$session->get("role")),
            'books' => $this->barrowBooksModel->getBarrowedBookbyUser($session->get("id"),$session->get("role")),
        ];

        echo view('Others/header');
        echo view('Student/Dashboard',$data);
        echo view('Others/fooder');
    }
}
