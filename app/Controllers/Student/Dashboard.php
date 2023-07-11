<?php

namespace App\Controllers\student;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\StudentModel;
use App\Models\StaffModel;
use App\Models\BarrowBooksModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->bookModel = new BooksModel();
        $this->studentModel = new StudentModel();
        $this->barrowBooksModel = new BarrowBooksModel();
    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role')!="student") {
            return redirect()->to('/');
        }

        $data = [
            'totalBooks' => $this->bookModel->getTotalBooks(),
            'totalStudents' => $this->studentModel->getTotalStudents(),
            'totalFine' => $this->barrowBooksModel->getFineAmount($session->get("id"),$session->get("role")),
            'books' => $this->barrowBooksModel->getBarrowedBookbyUser($session->get("id"),$session->get("role")),
        ];

        echo view('Others/header');
        echo view('Student/Dashboard',$data);
        echo view('Others/fooder');
    }
}
