<?php

namespace App\Controllers;
use App\Models\BooksModel;
use App\Models\RequestModel;
use App\Models\BarrowBooksModel;
use App\Models\OtherModel;

class Books extends BaseController
{    
    public function __construct()
    {
        $this->requestModel = new RequestModel();
        $this->barrowBooksModel = new BarrowBooksModel();
        $this->otherModel = new OtherModel();
    }
    public function status()
    {
        $session = session();
        $booksModel = new BooksModel();

        $data['books'] = $booksModel->getBooksList();

        echo view('Others/header');
        switch ($session->get('role')) {
             case 'admin':
                echo view('Admin/Adminsidebar');
                break;
            case 'staff':
                echo view('Staff/Staffsidebar');
                break;
            default:
                echo view('Student/Sidebar');
                break;
         }
        
        echo view('BookStatus',$data);
        echo view('Others/fooder');
    }

    public function bookrequest()
    {

        $session = session();

        if($this->request->getMethod() === 'post'){
   
            $bcode = $this->request->getPost('bcode');
            
            $data = [
                'requester_id' => $session->get('id'),
                'receiver_id' => $this->barrowBooksModel->getBarrowedUserId($bcode),
                'messagee' => "The Book Barcode: " . $bcode . " wanted to " . $session->get('role') ." " . $session->get('name') . ".",
                'is_seen' => 0,
                'role' => $session->get('role'),
                'status' => 1
            ];

            if($this->requestModel->setRequest($data))
                return true;
            else
                return false;
        } else {

            return $this->response->setJSON([
                'status' => 'Failed',
                'status1' => $session->get("name"),
                'msg' => "Method not allowed",
            ]);
        }
    }
}