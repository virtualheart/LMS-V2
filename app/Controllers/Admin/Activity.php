<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\OtherModel;
use App\Models\BarrowBooksModel;
use App\Models\SettingsModel;
use App\Controllers\Mail;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Validation\ValidationInterface;

class Activity extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");

        $this->booksModel = new BooksModel();
        $this->barrowbooksModel = new BarrowBooksModel();
        $this->otherModel = new OtherModel();
        $this->settingsModel = new SettingsModel();
        $this->mail = new Mail();
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
            $remark = $this->request->getPost('remark');

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
                    'required' => 'The Register Number field is required.'
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

                $Appfine = $this->settingsModel->getAppfine();

                $return_date = ($res['role']=="staff") ? date("Y-m-d", strtotime("+". $Appfine['fine_stf_days']." days")) : date("Y-m-d", strtotime("+". $Appfine['fine_std_days']." days")) ;

                $request_date = date("Y-m-d h:i:s");
                $data = [
                    'sid' => $res['sid'],
                    'bid' => $book['bid'],
                    'role' => $res['role'],
                    'returned_date' => '0000-00-00',
                    'status' => 1,
                    'is_returned' => 0,
                    'return_date' => $return_date,
                    'request_date' => $request_date,
                    'remark' => $remark,
                ];

                if ($book['status']==1) {

                    if($this->barrowbooksModel->setBarroeBook($data)){
                        $this->booksModel->updateBook($bcode,['status' => 0]);
                        try{
                            // mail
                            $subject = '(TESTING) You borrowed a book from CA GAC-7 library';
                            
                            $body = str_replace(array('{name}', '{caname}', '{ctitle}', '{cpublic}', '{crdate}', '{cetdate}'),array($sname, $aname, $title, $publication, date("d-M-Y", strtotime($request_date)), date("d-M-Y", strtotime($return_date)), ),file_get_contents(base_url().'assets/Template/mail.phtml'));

                            // mail trigger (calling send mail function)
                           // $this->mail->sendmail($res['email'],$sname,$subject,$body);

                        } catch(Exception $e){

                        }

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
            $remark = $this->request->getPost('remark');


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
                    'required' => 'The Register Number field is required.'
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

                if ($this->barrowbooksModel->setBookreturn($book['bid'],['is_returned' => 1,'returned_date' => date("Y-m-d h:i:s"),'remark' => $remark ])) {
                    $this->booksModel->updateBook($bcode,['status' => 1]);
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
