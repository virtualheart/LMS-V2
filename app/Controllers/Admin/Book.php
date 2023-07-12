<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;

class Book extends BaseController
{
    public function __construct()
    {
        $this->booksModel = new BooksModel();


    }
        
    public function book($activity,$bookId)
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if ($activity=="Add") {

            if ($this->request->getMethod() === 'post') {
                $bno = $this->request->getPost('bno');
                $bcode = $this->request->getPost('bcode');
                $title = $this->request->getPost('title');
                $aname = $this->request->getPost('aname');
                $publication = $this->request->getPost('publication');
                $price = $this->request->getPost('price');
                $alamara = $this->request->getPost('alamara');
                $rack = $this->request->getPost('rack');

                $validation = \Config\Services::validation();

                $validation->setRules([
                    'bno' => 'required',
                    'bcode' => 'required',
                    'title' => 'required',
                    'aname' => 'required',
                    'publication' => 'required',
                    'price' => 'required',
                    'alamara' => 'required',
                    'rack' => 'required',
                ]);


                $data = [
                    'bno' => $bno, 
                    'bcode' => $bcode, 
                    'title' => $title, 
                    'aname' => $aname, 
                    'publication' => $publication, 
                    'price' => $price, 
                    'alamara' => $alamara, 
                    'rack' => $rack
                ];

                    if($this->booksModel->insertBook($data)){
                        $session->setFlashdata('msg', 'New Book Added Successfully.');
                    } else{
                        $session->setFlashdata('msg', 'New Book Add Failed.');
                    } 

            }

            helper(['form']);
            echo view('Others/header');
            echo view('Admin/AdminBook');
            echo view('Others/fooder');

        } else if($activity=="Update"){

            if ($this->request->getMethod() === 'post') {
                $bno = $this->request->getPost('bno');
                $bcode = $this->request->getPost('bcode');
                $title = $this->request->getPost('title');
                $aname = $this->request->getPost('aname');
                $publication = $this->request->getPost('publication');
                $price = $this->request->getPost('price');
                $alamara = $this->request->getPost('alamara');
                $rack = $this->request->getPost('rack');

                $validation = \Config\Services::validation();

                $validation->setRules([
                    'bno' => 'required',
                    'bcode' => 'required',
                    'title' => 'required',
                    'aname' => 'required',
                    'publication' => 'required',
                    'price' => 'required',
                    'alamara' => 'required',
                    'rack' => 'required',
                ]);

                $data = [
                    'bno' => $bno, 
                    'bcode' => $bcode, 
                    'title' => $title, 
                    'aname' => $aname, 
                    'publication' => $publication, 
                    'price' => $price, 
                    'alamara' => $alamara, 
                    'rack' => $rack
                ];


                $this->booksModel->updateBook($bookId,$data);

            }

            $data = [
                'Book' => $this->booksModel->getBookDetail($bookId),
            ];

            helper(['form']);
            echo view('Others/header');
            echo view('Admin/AdminBook',$data);
            echo view('Others/fooder');

        } 
    }

}
