<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;

use App\Models\SettingsModel;

class Settings extends BaseController
{
    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
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
}