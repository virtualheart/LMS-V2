<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\OtherModel;
use App\Models\BarrowBooksModel;

class Activity extends BaseController
{
    public function __construct()
    {
        $this->booksModel = new BooksModel();
        $this->barrowbooksModel = new BarrowBooksModel();
        $this->otherModel = new OtherModel();
    }

    public function Barrow()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if($this->request->getMethod() === 'post'){

            $bcode = $this->request->getPost('bcode');
            $regno = $this->request->getPost('regno');
            $sname = $this->request->getPost('sname');
            $bno = $this->request->getPost('bno');
            $title = $this->request->getPost('title');
            $aname = $this->request->getPost('aname');
            $publication = $this->request->getPost('publication');
            $price = $this->request->getPost('price');
            $alamara = $this->request->getPost('alamara');
            $rack = $this->request->getPost('rack');

            $validation = \Config\Services::validation();

            $validation->setRules([
                'bcode' => 'required',
                'regno' => 'required',
                'sname' => 'required',
                'bno' => 'required',
                'title' => 'required',
                'aname' => 'required',
                'publication' => 'required',
                'price' => 'required',
                'reqdate' => 'required',
                'retdate' => 'required'
            ]);

            $res = $this->otherModel->getUserDet($regno);
            $book = $this->booksModel->getBookDetail($bcode);
            
            $data = [
                'sid' => $res['sid'],
                'bid' => $book['bid'],
                'role' => $res['role'],
                'returned_date' => '0000-00-00',
                'status' => 1,
                'is_returned' => 0,
                'return_date' => date("Y-m-d", strtotime("+15 days")),
                'request_date' => date("Y-m-d"),
            ];

            if ($book['status']==1) {

                if($this->barrowbooksModel->setBarroeBook($data)){
                    $session->setFlashdata('msg', 'Book Barrowed.');
                } else{
                    $session->setFlashdata('msg', 'Book Barrowed Failed.');
                }
            } else{
                echo "<script>alert('Please verify if the book is borrowed or unavailable in the library')</script>";
                $session->setFlashdata('msg', 'Please verify if the book is borrowed or unavailable in the library.');
            }
        }

        helper(['form']);
        echo view('Others/header');
        echo view('Admin/AdminBookBarrow');
        echo view('Others/fooder');
    }

    public function Return()
    {
        $session = session();
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }
        
        if($this->request->getMethod() === 'post'){

        }
        
        helper(['form']);
        echo view('Others/header');
        echo view('Admin/AdminBookReturn');
        echo view('Others/fooder');

    }
}
