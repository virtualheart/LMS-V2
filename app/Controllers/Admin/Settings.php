<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\SettingsModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\ShelfModel;

class Settings extends BaseController
{
    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
        $this->departmentModel = new DepartmentModel();
        $this->designationModel = new DesignationModel();
        $this->shelfModel = new ShelfModel();
    }
        
    public function App()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === 'post') {
            
            $app_name = $this->request->getPost('app_name');
            $app_decp = $this->request->getPost('app_decp');
            $fine = $this->request->getPost('fine');
            $fine_stf_days = $this->request->getPost('fine_stf_days');
            $fine_std_days = $this->request->getPost('fine_std_days');

            $data = [
                'app_name' => $app_name,
                'app_decp' => $app_decp,
                'fine' => $fine,
                'fine_stf_days' => $fine_stf_days,
                'fine_std_days' => $fine_std_days,
            ];
                
            if($this->settingsModel->SetAppSettings($data)){
                $session->setFlashdata('msg', 'App Settings Update Successfully.');
            } else {
                $session->setFlashdata('msg', 'App Settings Update Failed.');
            } 
        }
        
        $data = [
            'appsetting' => $this->settingsModel->getAppSettings(),
        ];

        echo view('Others/header');
        echo View('Admin/AdminAppSettings',$data);
        echo view('Others/fooder');
        
    }

    public function Smtp()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }
        

        if ($this->request->getMethod() === 'post') {
            
            $smtp_host = $this->request->getPost('smtp_host');
            $smtp_port = $this->request->getPost('smtp_port');
            $smtp_user = $this->request->getPost('smtp_user');
            $smtp_pass = $this->request->getPost('smtp_pass');
            $smtp_sec_type = $this->request->getPost('smtp_sec_type');

            $data = [
                'smtp_host' => $smtp_host,
                'smtp_port' => $smtp_port,
                'smtp_user' => $smtp_user,
                'smtp_pass' => $smtp_pass,
                'smtp_sec_type' => $smtp_sec_type,
            ];
                
            if($this->settingsModel->SetSMTPSettings($data)){
                $session->setFlashdata('msg', 'SMTP Settings Update Successfully.');
            } else {
                $session->setFlashdata('msg', 'SMTP Settings Update Failed.');
            } 
        }
        

        $data = [
            'smtpsetting' => $this->settingsModel->getAppSmtp(),
        ];

        echo view('Others/header');
        echo View('Admin/AdminSMTPSettings',$data);
        echo view('Others/fooder');
        
    }

    public function general()
    {
        
        if ($this->request->getMethod() === 'post') {

            if ($this->request->getPost('class_name')) {

                $department = $this->request->getPost('class_name');

                $data = [
                    'dname' => $department,
                ];

                $this->departmentModel->setDepartment($data);
                
            }elseif($this->request->getPost('savedesign')){
                $designation = $this->request->getPost('designation_name');

                $data = [
                    'designation' => $designation,
                ];

                $this->designationModel->setDesignation($data);
                
            }elseif($this->request->getPost('berrowno') && $this->request->getPost('rackno') && $this->request->getPost('side')){

                $berrowno = $this->request->getPost('berrowno');
                $rackno = $this->request->getPost('rackno');
                $side = $this->request->getPost('side');
                
                $data = [
                    'alamara' => $berrowno,
                    'rack' => $rackno,
                    'side' => $side,
                    'status' => 1
                ];

                $this->shelfModel->setAlamaras($data);
            }
        }

        $data = [
            'departments' => $this->departmentModel->getDepartmentList(),
            'designations' => $this->designationModel->getDesignationList(),
            'berrows' => $this->shelfModel->getAlamarasList()
        ];

        echo view('Others/header');
        echo View('Admin/AdminGenSettings',$data);
        echo view('Others/fooder');
    }
    
}