<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\BooksModel;
use App\Models\BarrowBooksModel;
use App\Models\StaffModel;


class Home extends BaseController
{
    public function __construct()
    {

    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role') !="admin") {
            return redirect()->to('/');
        }

        $studentModel = new StudentModel();
        $staffModel = new StaffModel();
        $bookModel = new BooksModel();
        $barrowBooksModel = new BarrowBooksModel();


        $data = [
            'totalBooks' => $bookModel->getTotalBooks(),
            'totalStudents' => $studentModel->getTotalStudents(),
            'totalStaff' => $staffModel->getTotalStaff(),
            'barrowBooks' => $barrowBooksModel->getBarrowedBooks(),
        ];

        echo view('Others/header');
        echo view('Admin/home', $data);
        echo view('Others/fooder');
    }
}
