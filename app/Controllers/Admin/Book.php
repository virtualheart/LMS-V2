<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\BorrowBooksModel;
use App\Models\OtherModel;
use App\Models\ShelfModel;
use App\Models\PlanningModel;

class Book extends BaseController
{
    public function __construct()
    {
        $this->booksModel = new BooksModel();
        $this->borrowbooksModel = new BorrowBooksModel();
        $this->otherModel = new OtherModel();
        $this->shelfModel = new ShelfModel();
        $this->planningModel = new PlanningModel();
    }
        
    public function book($activity,$bcode)
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if ($activity=="Add") {

            if ($this->request->getMethod() === 'post') {
                $bno = $this->request->getPost('bno');
                $plan_id = $this->request->getPost('plan');
                $bcode = $this->request->getPost('bcode');
                $title = $this->request->getPost('title');
                $aname = $this->request->getPost('aname');
                $publication = $this->request->getPost('publication');
                $price = $this->request->getPost('price');
                $language = $this->request->getPost('language');
                $alamara = $this->request->getPost('alamara');
                $year_of_publication = $this->request->getPost('year_of_publication');
                $remark = $this->request->getPost('remark');
                $edition = $this->request->getPost('edition');

                $validation = \Config\Services::validation();

                $validation->setRules([
                    'bno' => 'required',
                    'bcode' => 'required',
                    'title' => 'required',
                    'aname' => 'required',
                    'publication' => 'required',
                    'price' => 'required',
                    'alamara' => 'required',
                    'year_of_publication' => 'required',
                    'edition' => 'required'
                ]);

                $data = [
                    'bno' => $bno, 
                    'bcode' => $bcode,
                    'plan_id' => $plan_id,
                    'title' => $title, 
                    'aname' => $aname, 
                    'publication' => $publication, 
                    'price' => $price, 
                    'language' => $language,
                    'Shelf_id' => $alamara,
                    'year_of_publication' => $year_of_publication,
                    'edition' => $edition,
                    'remark' => $remark,
                    'status' => 1
                ];

                    if($this->booksModel->insertBook($data)){
                        $session->setFlashdata('msg', 'New Book Added Successfully.');
                    } else{
                        $session->setFlashdata('msg', 'New Book Add Failed.');
                    } 

            }

            $data = [
                'bcodeid' => $this->booksModel->getLastBookid()->lbcode ?? 0,
                'Alamaras' => $this->shelfModel->getAlamarasList(),
                'Plans' => $this->planningModel->getPlanningList(),
            ];

            helper(['form']);
            echo view('Others/header');
            echo view('Admin/AdminBook',$data);
            echo view('Others/fooder');

        } else if($activity=="Update"){
            // need to work empty record update page

            if ($this->request->getMethod() === 'post') {
                $bno = $this->request->getPost('bno');
                $title = $this->request->getPost('title');
                $aname = $this->request->getPost('aname');
                $publication = $this->request->getPost('publication');
                $price = $this->request->getPost('price');
                $alamara = $this->request->getPost('alamara');
                $year_of_publication = $this->request->getPost('year_of_publication');
                $remark = $this->request->getPost('remark');
                $edition = $this->request->getPost('edition');

                $validation = \Config\Services::validation();

                $validation->setRules([
                    'bno' => 'required',
                    'bcode' => 'required',
                    'title' => 'required',
                    'aname' => 'required',
                    'publication' => 'required',
                    'price' => 'required',
                    'Shelf_id' => 'required',
                ]);

                $data = [
                    'bno' => $bno, 
                    'title' => $title, 
                    'aname' => $aname, 
                    'publication' => $publication, 
                    'price' => $price, 
                    'Shelf_id' => $alamara,
                    'year_of_publication' => $year_of_publication,
                    'edition' => $edition,
                    'remark' => $remark,
                ];

                if($this->booksModel->updateBook($bcode,$data)){
                        $session->setFlashdata('msg', 'Updated Successfully.');
                } else{
                    $session->setFlashdata('msg', 'Updated Failed.');
                } 
            }

            $data = [
                'Book' => $this->booksModel->getBookDetail($bcode),
                'Alamaras' => $this->shelfModel->getAlamarasList(),
                'Plans' => $this->planningModel->getPlanningList(),
            ];

            helper(['form']);
            echo view('Others/header');
            echo view('Admin/AdminBook',$data);
            echo view('Others/fooder');

        }elseif ($activity=="Borrow") {

            $response = $this->booksModel->getBookDetail($bcode);
            $jsonResponse = json_encode($response);
            return $this->response->setJSON($jsonResponse);

        }elseif ($activity=="Return") {
            $response = $this->borrowbooksModel->getBorrowBookDetails($bcode);
            if(!empty($response)){
                $responseArray = json_decode(json_encode($response), true);
                $userDetails = $this->otherModel->getUserDet2($responseArray['sid'],$responseArray['role']);
                
                $responseArray = array_merge($responseArray, $userDetails);
                
                $jsonResponse = json_encode($responseArray);
                return $this->response->setJSON($jsonResponse);
            }
            return $this->response->setStatusCode(204)->setJSON('{"mgs": "Book Not borrowed"}');
        } else{
            $data = [
                'message' => ' Controller or its method is not found'
            ];
            return view('errors/html/error_404',$data);
        }
    }

    public function getUserDet($u){

        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        $result = $this->otherModel->getUserDet($u);
        if (!empty($result)) {
            return $this->response->setJSON($result);
        }
        
        return $this->response->setStatusCode(204)->setJSON('{"mgs": "User Not Found"}');

    }

}