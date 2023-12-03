<?php

namespace App\Controllers;

use App\Models\BooksModel;
use App\Models\RequestModel;
use App\Models\BorrowBooksModel;
use App\Models\OtherModel;

class Books extends BaseController
{    
    public function __construct()
    {        
        $this->requestModel = new RequestModel();
        $this->borrowBooksModel = new BorrowBooksModel();
        $this->otherModel = new OtherModel();
        $this->booksModel = new BooksModel();
    }

    public function status()
    {
        $session = session();

        if ($session->get('role') != ("staff" or "admin" or "student")) {
            return redirect()->to('/');
        }

        $data['books'] = $this->booksModel->getBooksList();

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
                'receiver_id' => $this->borrowBooksModel->getBorrowedUserId($bcode)['sid'],
                'messagee' => "The Book Barcode: " . $bcode . " wanted to " . $session->get('role') ." " . $session->get('name') . ".",
                'bcode' => $bcode,
                'is_seen' => 0,
                'is_seen_admin' => 0,
                'rec_role' => $this->borrowBooksModel->getBorrowedUserId($bcode)['role'],
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

    public function borrow()
    {
        $session = Session();

        if ($session->get('role') != ("admin")) {
            return redirect()->to('/');
        }

        $data['books'] = $this->borrowBooksModel->getBorrowedBooks();

        echo view('Others/header');
        echo view('Admin/Adminsidebar');        
        echo view('Admin/AdminBorrowStatus',$data);
        echo view('Others/fooder');
    }

    public function borrowed()
    {
        $session = Session();

        $data['books'] = $this->borrowBooksModel->getBorrowedBookbyUser($session->get("id"),$session->get("role"));

        echo view('Others/header');
        echo view('Student/Sidebar');        
        echo view('BorrowBookStatus',$data);
        echo view('Others/fooder');

    }

    public function returned()
    {
        $session = Session();

        $data = [
            'books' => $this->borrowBooksModel->getReturnedBookbyUser($session->get("id"),$session->get("role"))
        ];

        echo view('Others/header');
        echo view('Student/Sidebar');        
        echo view('ReturnedBookStatus',$data);
        echo view('Others/fooder');

    }


}