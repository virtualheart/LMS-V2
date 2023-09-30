<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StudentModel;
use App\Models\BooksModel;
use App\Models\BarrowBooksModel;
use App\Models\StaffModel;

use App\Models\OtherModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->staffModel = new StaffModel();
        $this->bookModel = new BooksModel();
        $this->barrowBooksModel = new BarrowBooksModel();
    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role') !="admin") {
            return redirect()->to('/');
        }


        $data = [
            'totalBooks' => $this->bookModel->getTotalBooks(),
            'totalStudents' => $this->studentModel->getTotalStudents(),
            'totalStaff' => $this->staffModel->getTotalStaff(),
            'barrowBooks' => $this->barrowBooksModel->getBarrowedBookscount(),
        ];

        $chart = [
            'staff' => $this->barrowBooksModel->getBarrowedBookcountbyRole("staff"),
            'student' => $this->barrowBooksModel->getBarrowedBookcountbyRole("student"),
            'datevice' => $this->barrowBooksModel->getBarrowedBookMonth()
        ];
        
           
        echo view('Others/header');
        echo view('Admin/home', $data);
        echo view('Others/fooder');
        echo view('Admin/AdminChart',$chart);
    }
}
