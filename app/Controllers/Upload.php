<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\StudentModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Upload extends BaseController
{
    protected $booksModel;

    public function __construct()
    {
        $this->booksModel = new BooksModel();
        $this->studentModel = new StudentModel();
    }

    public function upload($activity)
    {
        $session = session();
        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }
        
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate a new name for the file
            $newName = $this->generateNewFileName($file->getName());

            // Move the file to a directory
            $destination = WRITEPATH . 'uploads/';
            $file->move($destination);

            if ($activity=="Book") {
                $data = $this->BookprocessFile($destination.'/'.$file->getName());
            } elseif($activity == "Student") {
                $data = $this->StudentprocessFile($destination.'/'.$file->getName());
            }


            if ($data !== false) {
                // File processed successfully
                return $this->response->setJSON([
                    'message' => 'File uploaded and processed successfully',
                    'data' => $data
                ]);
            } else {
                // File processing failed
                // Delete the uploaded file if necessary
                unlink($destination.'/'.$file->getName());
                session()->set("data",session()->getFlashdata('msg'));

                return $this->response->setJSON([
                    'message' => 'Failed to process the file'
                ])->setStatusCode(500);
            }
        } else {
            // Return an error JSON response
            session()->set("data",session()->getFlashdata('msg'));

            return $this->response->setJSON([
                'message' => 'Error uploading file'
            ])->setStatusCode(400);
        }
    }

    // Generate a new name for the uploaded file
    private function generateNewFileName($originalName)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $newName = uniqid() . '.' . $extension;
        return $newName;
    }

private function BookprocessFile($filePath)
{
    try {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $higestRow = $worksheet->getHighestRow();
        $data = [];

        for ($row = 2; $row <= $higestRow; $row++) {
            $bno = filter_var($worksheet->getCellByColumnAndRow(2, $row)->getValue(), FILTER_SANITIZE_STRING);
            $bcode = filter_var($worksheet->getCellByColumnAndRow(3, $row)->getValue(), FILTER_SANITIZE_STRING);
            $title = filter_var($worksheet->getCellByColumnAndRow(4, $row)->getValue(), FILTER_SANITIZE_STRING);
            $aname = filter_var($worksheet->getCellByColumnAndRow(5, $row)->getValue(), FILTER_SANITIZE_STRING);
            $publication = filter_var($worksheet->getCellByColumnAndRow(6, $row)->getValue(), FILTER_SANITIZE_STRING);
            $price = filter_var($worksheet->getCellByColumnAndRow(7, $row)->getValue(), FILTER_SANITIZE_STRING);
            $alamara = filter_var($worksheet->getCellByColumnAndRow(8, $row)->getValue(), FILTER_SANITIZE_STRING);
            $rack = filter_var($worksheet->getCellByColumnAndRow(9, $row)->getValue(), FILTER_SANITIZE_STRING);
            $status = 1;

            $data[] = [
                'bno' => $bno,
                'bcode' => $bcode,
                'title' => $title,
                'aname' => $aname,
                'publication' => $publication,
                'price' => $price,
                'alamara' => $alamara,
                'rack' => $rack,
                'status' => $status,
            ];
        }

        $this->booksModel->insertBooks($data);

        return true;
    } catch (Exception $e) {
        // session()->setFlashdata('msg',$e);
        return false;
    }
}

private function StudentprocessFile($filePath)
{
    try {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $higestRow = $worksheet->getHighestRow();
        $data = [];

        for ($row = 2; $row <= $higestRow; $row++) {

            $regno = filter_var($worksheet->getCellByColumnAndRow(2, $row)->getValue(), FILTER_SANITIZE_STRING);
            $sname = filter_var($worksheet->getCellByColumnAndRow(3, $row)->getValue(), FILTER_SANITIZE_STRING);
            $spass = filter_var($worksheet->getCellByColumnAndRow(4, $row)->getValue(), FILTER_SANITIZE_STRING);
            $gender = filter_var($worksheet->getCellByColumnAndRow(5, $row)->getValue(), FILTER_SANITIZE_STRING);
            $stemail = filter_var($worksheet->getCellByColumnAndRow(6, $row)->getValue(), FILTER_SANITIZE_STRING);
            $Contact = filter_var($worksheet->getCellByColumnAndRow(7, $row)->getValue(), FILTER_SANITIZE_STRING);
            $did = filter_var($worksheet->getCellByColumnAndRow(8, $row)->getValue(), FILTER_SANITIZE_STRING);
            $year = filter_var($worksheet->getCellByColumnAndRow(9, $row)->getValue(), FILTER_SANITIZE_STRING);
            $shift = filter_var($worksheet->getCellByColumnAndRow(10, $row)->getValue(), FILTER_SANITIZE_STRING);
            
            if($gender == "boy" || $gender == "Boy")
                $image = "assets/student/boy.png";
            elseif($gender == "Girl" || $gender == "girl")
                $image = 'assets/student/girl.png';
            
            $data[] = [
                'regno' => $regno,
                'sname' => $sname,
                'spass' => password_hash($spass, PASSWORD_DEFAULT),
                'gender' => $gender,
                'stemail' => $stemail,
                'Contact' => $Contact,
                'did' => $did,
                'year' => $year,
                'shift' => $shift,
                'image' => $image,
                'role' => "student",
            ];
        }

        $this->studentModel->insertstds($data);

        return true;
    } catch (Exception $e) {
        // session()->setFlashdata('msg',$e);
        return false;
    }
}

}
