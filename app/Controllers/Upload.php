<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BooksModel;
use App\Models\StudentModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Upload
{
    protected $booksModel;

    public function __construct()
    {
        $this->booksModel = new BooksModel();
        $this->studentModel = new StudentModel();
    }


    // Generate a new name for the uploaded file
    private function generateNewFileName($originalName)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $newName = uniqid() . '.' . $extension;
        return $newName;
    }

    public function BookprocessFile($filePath)
    {

        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();

            $higestRow = $worksheet->getHighestRow();
            $data = [];

            $var = $this->booksModel->getLastBookid()->lbcode ?? 0;

            $code =  'GACCA'.date("Y").str_pad($var, 5, '0', STR_PAD_LEFT);

            for ($row = 2; $row <= $higestRow; $row++) {
                
                $bcode = ++$code;
                $bno = filter_var($worksheet->getCellByColumnAndRow(2, $row)->getValue(), FILTER_SANITIZE_STRING);
                $title = filter_var($worksheet->getCellByColumnAndRow(3, $row)->getValue(), FILTER_SANITIZE_STRING);
                $aname = filter_var($worksheet->getCellByColumnAndRow(4, $row)->getValue(), FILTER_SANITIZE_STRING);
                $publication = filter_var($worksheet->getCellByColumnAndRow(5, $row)->getValue(), FILTER_SANITIZE_STRING);
                $price = filter_var($worksheet->getCellByColumnAndRow(6, $row)->getValue(), FILTER_SANITIZE_STRING);
                $language = filter_var($worksheet->getCellByColumnAndRow(7, $row)->getValue(), FILTER_SANITIZE_STRING);
                $year_of_publication = filter_var($worksheet->getCellByColumnAndRow(8, $row)->getValue(), FILTER_SANITIZE_STRING);
                $edition = filter_var($worksheet->getCellByColumnAndRow(9, $row)->getValue(), FILTER_SANITIZE_STRING);
                $plan_id = ltrim(filter_var($worksheet->getCellByColumnAndRow(10, $row)->getValue(), FILTER_SANITIZE_STRING), 'P');
                $Shelf_id = ltrim(filter_var($worksheet->getCellByColumnAndRow(11, $row)->getValue(), FILTER_SANITIZE_STRING), 'BR');
                $status = 1;

                $data[] = [
                    'bno' => $bno,
                    'bcode' => $bcode,
                    'title' => $title,
                    'aname' => $aname,
                    'publication' => $publication,
                    'price' => $price,
                    'language' => $language,
                    'year_of_publication' => $year_of_publication,
                    'edition' => $edition,
                    'plan_id' => $plan_id,
                    'Shelf_id' => $Shelf_id,
                    'status' => $status,
                ];
            }

            return $data;
            // $this->booksModel->insertBooks($data);

        } catch (Exception $e) {
            // session()->setFlashdata('msg',$e);
            return false;
        }
    }

    public function StudentprocessFile($filePath)
    {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();

            $higestRow = $worksheet->getHighestRow();
            $data = [];

            for ($row = 2; $row <= $higestRow; $row++) {

                $regno = filter_var($worksheet->getCellByColumnAndRow(2, $row)->getValue(), FILTER_SANITIZE_STRING);
                $sname = filter_var($worksheet->getCellByColumnAndRow(3, $row)->getValue(), FILTER_SANITIZE_STRING);
                $gender = filter_var($worksheet->getCellByColumnAndRow(4, $row)->getValue(), FILTER_SANITIZE_STRING);
                $stemail = filter_var($worksheet->getCellByColumnAndRow(5, $row)->getValue(), FILTER_SANITIZE_STRING);
                $Contact = filter_var($worksheet->getCellByColumnAndRow(6, $row)->getValue(), FILTER_SANITIZE_STRING);
                $did = ltrim(filter_var($worksheet->getCellByColumnAndRow(7, $row)->getValue(), FILTER_SANITIZE_STRING),'C');
                $year = filter_var($worksheet->getCellByColumnAndRow(8, $row)->getValue(), FILTER_SANITIZE_STRING);
                $shift = filter_var($worksheet->getCellByColumnAndRow(9, $row)->getValue(), FILTER_SANITIZE_STRING);
                
                if($gender == "boy" || $gender == "Boy" || $gender == "male" || $gender == "Male")
                    $image = "assets/student/boy.png";
                elseif($gender == "Girl" || $gender == "girl" || $gender == "female" || $gender == "Female")
                    $image = 'assets/student/girl.png';
                else
                    $image = 'assets/boy.png';
                
                $data[] = [
                    'regno' => $regno,
                    'sname' => $sname,
                    'spass' => password_hash("pass", PASSWORD_DEFAULT),
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

            // $this->studentModel->insertstds($data);
            return $data;

        } catch (Exception $e) {
            // session()->setFlashdata('msg',$e);
            return false;
        }
    }

}
