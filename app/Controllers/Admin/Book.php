<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\BarrowBooksModel;
use App\Models\OtherModel;

class Book extends BaseController
{
    public function __construct()
    {
        $this->booksModel = new BooksModel();
        $this->barrowbooksModel = new BarrowBooksModel();
        $this->otherModel = new OtherModel();
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

        }elseif ($activity=="Barrow") {

            $response = $this->booksModel->getBookDetail($bookId);
            $jsonResponse = json_encode($response);
            return $this->response->setJSON($jsonResponse);

        }elseif ($activity=="Return") {
            $response = $this->barrowbooksModel->getBarrowBookDetails($bookId);
            if(!empty($response)){
                $responseArray = json_decode(json_encode($response), true);
                $userDetails = $this->otherModel->getUserDet2($responseArray['sid']);
                
                $responseArray = array_merge($responseArray, $userDetails);
                
                $jsonResponse = json_encode($responseArray);
                return $this->response->setJSON($jsonResponse);
            }
            return $this->response->setStatusCode(204)->setJSON('{"mgs": "Book Not barrowed"}');
        }
    }

    public function getUserDet($u){
        $result = $this->otherModel->getUserDet($u);
        return $this->response->setJSON($result);
    }

}