<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Controllers\Upload;
use App\Models\StudentModel;

class Uploadstudents extends BaseController
{
    public function __construct()
    {
        $this->upload = new Upload();
        $this->StudentModel = new StudentModel();
    }
        
    public function index()
    {

        ini_set('memory_limit', '512M');
        set_time_limit(120); 

        $session = session();
        $data = [];

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === "post") {
            $file = $this->request->getFile('file');
            if ($file->isValid() && !$file->hasMoved()) {

                if(strtolower($file->getClientExtension()) === 'xlsx' || strtolower($file->getClientExtension()) === 'csv'){

                    // Move the file to a temporary directory
                    $destination = WRITEPATH . 'uploads/';
                    $file->move($destination);

                    // Store the file path in session or database
                    $session->set('imported_file', $destination . $file->getName());
                    
                    // Redirect to the preview page
                    return redirect()->to('admin/Uploadstudents/importpreview');
                } else{
                    $session->setFlashdata('msg', 'Only upload excal(xlsx) file format');
                }
            } else {
                $session->setFlashdata('msg', 'Upload failed');
            }
        }

        echo view('Others/header');
        echo View('Admin/AdminStudentUpload', $data);
        echo view('Others/fooder');
    }

    public function importpreview()
    {
        $session = session();
        $data = [];

        if ($session->get('role')!="admin" || !$session->get('imported_file')) {
            return redirect()->to('/');
        }

        // Retrieve the file path from session or database
        $importedFilePath = $session->get('imported_file');

        // Process the file and prepare data for preview
        $data['records'] = $this->upload->StudentprocessFile($importedFilePath);
        
        echo view('Others/header');
        echo View('Admin/AdminStudentUpload2', $data);
        echo view('Others/fooder');

    }

    public function booksimport()
    {
        $session = session();

        // Retrieve the file path from session or database
        $importedFilePath = $session->get('imported_file');

        // Process and import the data
        $importedData = $this->upload->StudentprocessFile($importedFilePath);

        // Insert the data into your database
        $this->StudentModel->insertstds($importedData);
        $data = [
            'count' => count($importedData),
        ];

        // Clear the session or database record of the imported file
        $session->remove('   imported_file');
        
        echo view('Others/header');
        echo View('Admin/Uploadstudents3', $data);
        echo view('Others/fooder');

    }

    public function importcancel()
    {
        $session = session();
        $session->remove('imported_file');
        return redirect()->to('/admin/Uploadstudents');
    }

}