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

        if ($session->get('role') != ("staff" or "admin" or "student")) {
            return redirect()->to('/');
        }
        
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
        
        if ($session->get('role') != ("staff" or "admin" or "student")) {
            return redirect()->to('/');
        }

        if($this->request->getMethod() === 'post'){
   
            $bcode = $this->request->getPost('bcode');
            
            $data = [
                'requester_id' => $session->get('id'),
                'receiver_id' => $this->barrowBooksModel->getBarrowedUserId($bcode)['sid'],
                'messagee' => "The Book Barcode: " . $bcode . " wanted to " . $session->get('role') ." " . $session->get('name') . ".",
                'is_seen' => 0,
                'rec_role' => $this->barrowBooksModel->getBarrowedUserId($bcode)['role'],
                'req_role' => $session->get('role'),
                'rec_date' => date('Y-m-d'),
                'status' => 1
            ];

            $this->requestModel->setBookRequest($data);

        } else {

            return $this->response->setJSON([
                'status' => 'Failed',
                'status1' => $session->get("name"),
                'msg' => "Method not allowed",
            ]);
        }
    }
}