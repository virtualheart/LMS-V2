<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BooksModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use PhpOffice\PhpSpreadsheet\IOFactory;


class BooksUpload extends BaseController
{
    protected $booksModel;

    public function __construct()
    {
        $this->booksModel = new BooksModel();
    }

    public function upload()
    {
        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            // Generate a new name for the file
            $newName = $this->generateNewFileName($file->getName());

            // Move the file to a directory
            $destination = WRITEPATH . 'uploads/';
            $file->move($destination);

            $data = $this->processFile($destination.'/'.$file->getName());

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

private function processFile($filePath)
{
    try {
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $higestRow = $worksheet->getHighestRow();
        $data = [];

        for ($row = 2; $row <= $higestRow; $row++) {
            $sno = filter_var($worksheet->getCellByColumnAndRow(1, $row)->getValue(), FILTER_SANITIZE_STRING);
            $bno = filter_var($worksheet->getCellByColumnAndRow(2, $row)->getValue(), FILTER_SANITIZE_STRING);
            $bcode = filter_var($worksheet->getCellByColumnAndRow(3, $row)->getValue(), FILTER_SANITIZE_STRING);
            $title = filter_var($worksheet->getCellByColumnAndRow(4, $row)->getValue(), FILTER_SANITIZE_STRING);
            $aname = filter_var($worksheet->getCellByColumnAndRow(5, $row)->getValue(), FILTER_SANITIZE_STRING);
            $publication = filter_var($worksheet->getCellByColumnAndRow(6, $row)->getValue(), FILTER_SANITIZE_STRING);
            $price = filter_var($worksheet->getCellByColumnAndRow(7, $row)->getValue(), FILTER_SANITIZE_STRING);
            $alamara = filter_var($worksheet->getCellByColumnAndRow(8, $row)->getValue(), FILTER_SANITIZE_STRING);
            $rack = filter_var($worksheet->getCellByColumnAndRow(9, $row)->getValue(), FILTER_SANITIZE_STRING);
            $status = filter_var($worksheet->getCellByColumnAndRow(10, $row)->getValue(), FILTER_SANITIZE_STRING);
            $sstatus = filter_var($worksheet->getCellByColumnAndRow(11, $row)->getValue(), FILTER_SANITIZE_STRING);

            $data[] = [
                'sno' => $sno,
                'bno' => $bno,
                'bcode' => $bcode,
                'title' => $title,
                'aname' => $aname,
                'publication' => $publication,
                'price' => $price,
                'alamara' => $alamara,
                'rack' => $rack,
                'status' => $status,
                'sstatus' => $sstatus
            ];
        }

        $this->booksModel->insertBooks($data);

        return true;
    } catch (Exception $e) {
        session()->setFlashdata('msg',$e);
        return false;
    }
}

}
