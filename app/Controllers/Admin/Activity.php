<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\OtherModel;
use App\Models\BarrowBooksModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Validation\ValidationInterface;



class Activity extends BaseController
{
    public function __construct()
    {
        $this->booksModel = new BooksModel();
        $this->barrowbooksModel = new BarrowBooksModel();
        $this->otherModel = new OtherModel();

        // Inject the ValidationInterface into the controller
        $this->validation = \Config\Services::validation();

    }

    public function Barrow($var = null)
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

            // Set the validation rules
            $validationRules = [
                'bcode' => 'required',
                'regno' => 'required',
                'sname' => 'required',
                'bno' => 'required',
                // 'title' => 'required',
                // 'aname' => 'required',
                // 'publication' => 'required',
                // 'price' => 'required',
                // 'reqdate' => 'required',
                // 'retdate' => 'required'
            ];

            // Set custom error messages for each field
            $validationMessages = [
                'bcode' => [
                    'required' => 'The Barcode No field is required.'
                ],
                'regno' => [
                    'required' => 'The Reg Number field is required.'
                ],
                'sname' => [
                    'required' => 'The Std/Staff Name field is required.'
                ],
                'bno' => [
                    'required' => 'The Book No field is required.'
                ]//,
                // 'title' => [
                //     'required' => 'The Title field is required.'
                // ], 
                // 'aname' => [
                //     'required' => 'The Author Name field is required.'
                // ],
                // 'publication' => [
                //     'required' => 'The Publication field is required.'
                // ],
                // 'price' => [
                //     'required' => 'The Price field is required.'
                // ],
                // 'reqdate' => [
                //     'required' => 'The Request Date field is required.'
                // ],
                // 'retdate' => [
                //     'required' => 'The ETA Return Date field is required.'
                // ]
            ];


            $validation = \Config\Services::validation();

            $validation->setRules($validationRules, $validationMessages);


            if($this->validation->withRequest($this->request)->run()){

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
                        $this->booksModel->updateBook($book['bid'],['status' => 0]);
                        $session->setFlashdata('msg', 'Book Barrowed.');
                    } else{
                        $session->setFlashdata('msg', 'Book Barrowed Failed.');
                    }
                } else{
                    // echo "<script>alert('Please verify if the book is borrowed or unavailable in the library')</script>";
                    $session->setFlashdata('msg', 'Please verify if the book is borrowed or unavailable in the library.');
                }
            } else {
                // Validation failed
                $errors = $this->validation->getErrors();
            }
        }

            helper(['form']);
            echo view('Others/header');
        if($var==null){
            echo view('Admin/AdminBookBarrow');
        } else{
             $data = [
            'BooksData' => $this->booksModel->getBookDetail($var),
        ];
            echo view('Admin/AdminBookBarrowA',$data);
        }
            echo view('Others/fooder');
    }

    public function Return()
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


            // Set the validation rules
            $validationRules = [
                'bcode' => 'required',
                'regno' => 'required',
                'sname' => 'required',
                'bno' => 'required',
            ];

            // Set custom error messages for each field
            $validationMessages = [
                'bcode' => [
                    'required' => 'The Barcode No field is required.'
                ],
                'regno' => [
                    'required' => 'The Reg Number field is required.'
                ],
                'sname' => [
                    'required' => 'The Std/Staff Name field is required.'
                ],
                'bno' => [
                    'required' => 'The Book No field is required.'
                ]
            ];

            $validation = \Config\Services::validation();

            $validation->setRules($validationRules, $validationMessages);

            if($this->validation->withRequest($this->request)->run()){
                
                $book = $this->booksModel->getBookDetail($bcode);

                if ($this->barrowbooksModel->setBookreturn($book['bid'],['is_returned' => 1])) {
                    $this->booksModel->updateBook($book['bid'],['status' => 1]);
                        $session->setFlashdata('msg', 'Book return Successfully.');
                } else{
                    $session->setFlashdata('msg', 'Book return Failed.');
                }

            } else {
                // Validation failed
                $errors = $this->validation->getErrors();
            }
                

        }
        
        helper(['form']);
        echo view('Others/header');
        echo view('Admin/AdminBookReturn');
        echo view('Others/fooder');

    }
}
