<?php

/**
 * Pending list
 * 1) Include security and one time process 2nd time not allowed 
 * 2) Add smtp settings
 * 3) Add class(in DB Department) list
 * 4) check if posiable add composer update in this page 
 * 5) Triggers not affect database(not load Trigger)  
*/
namespace App\Controllers;
use App\Models\SettingsModel;
use App\Models\StaffDeptModel;
use CodeIgniter\Files\File;
use CodeIgniter\Database\Forge;

class install extends BaseController
{

    public function __construct()
    {
        $this->session = session();
    }

    // App first install (Under Development)
    public function index()
    {
        echo view('install/install');
    }

    public function step1()
    {
        $sourceFile = getcwd() . '/env';
        $destinationFile = getcwd() . '/.env';
        $destinationFilePath = getcwd();

        if (file_exists($destinationFile)) {
            $this->session->set('error',true);
            $this->session->setFlashdata('msg', 'The installation process is already complete!(If you need to install delect .env manually)');
        } elseif (!is_writable($destinationFilePath)) {
            $this->session->set('error',true);
            $this->session->setFlashdata('msg', 'Failed to adjust file permissions. Please check your server configuration.');
        } else {
            // Copy the source .env file to the destination .env
            if (copy($sourceFile, $destinationFile)) {
                $this->session->setFlashdata('msg', '.env File copied successfully.');
            } else {
                $this->session->set('error',true);
                $this->session->setFlashdata('msg', 'Failed to copy the file.');
            }
        }

        if($this->request->getMethod() == "post"){

            $db_name = $this->request->getPost('name');
            $db_user = $this->request->getPost('user');
            $db_pass = $this->request->getPost('pass');
            $db_host = $this->request->getPost('host');
            $db_port = $this->request->getPost('port');

            $db_name_env = 'database.default.database = '.$db_name;
            $db_user_env = 'database.default.username = '.$db_user;
            $db_pass_env = 'database.default.password = '.$db_pass;
            $db_host_env = 'database.default.hostname = '.$db_host;
            $db_port_env = 'database.default.port = '.$db_port;
            $db_driver_env = 'database.default.DBDriver = MySQLi';
            
            $create = $this->request->getPost('create');

            // Read the content of the file
            $content = file_get_contents($destinationFile);

            $content = str_replace('# database.default.username = db_uname', $db_user_env, $content);
            $content = str_replace('# database.default.password = db_password', $db_pass_env, $content);
            $content = str_replace('# database.default.hostname = db_hname', $db_host_env, $content);
            $content = str_replace('# database.default.port = db_port', $db_port_env, $content);
            $content = str_replace('# database.default.DBDriver = MySQLi', $db_driver_env, $content);


            if(file_put_contents($destinationFile, $content))
            {
                $newConfig = [
                    'hostname' => $db_host,
                    'username' => $db_user,
                    'password' => $db_pass,
                    'database' => '',
                    'DBDriver' => 'MySQLi', 
                ];

                if ($create=="create") {
                    
                    $forge = \Config\Database::forge($newConfig);
                    if ($forge->createDatabase($db_name)) {
                        // echo 'Database created!';
                    }
                } 

                $content = str_replace('# database.default.database = db_name',$db_name_env, $content);
                file_put_contents($destinationFile, $content);     

                $newConfig = [
                    'hostname' => $db_host,
                    'username' => $db_user,
                    'password' => $db_pass,
                    'database' => $db_name,
                    'DBDriver' => 'MySQLi', 
                ];
                $db = \Config\Database::connect($newConfig);

                $database_dump_file = getcwd() . '/db/import.sql';
                $lines = file($database_dump_file);

                $query = '';
                foreach ($lines as $line) {
                    $line = trim($line);
                    if (empty($line) || strpos($line, '--') === 0) {
                        continue;
                    }
                    $query .= $line;

                    if (substr($line, -1) === ';') {
                        try{
                            $db->query($query);
                        }catch(\CodeIgniter\Database\Exceptions\DatabaseException $e){
                            $this->session->setFlashdata('msg', 'SQL dump imported failed.');
                        }
                        $query = '';
                    }
                }
                
                // if possiable add composer here

                $this->session->setFlashdata('msg', 'SQL dump imported successfully.');
                $this->session->set('error',false);

                $db->close();

                return redirect()->to('install/step2');
            }
        }else{
            echo view('install/step1');
        }
    }

    public function step2()
    {
        if ($this->request->getMethod()== "post") 
        {
            $appname = $this->request->getPost('appname');
            $department = $this->request->getPost('department');
            $fine = $this->request->getPost('fine');
            $fine_stf_days = $this->request->getPost('fine_stf_days');
            $fine_std_days = $this->request->getPost('fine_std_days');

            $settingsModel = new SettingsModel(); 
            $staffDeptModel = new StaffDeptModel(); 

            $data = [
                'app_name' => $appname,
                'fine' => $fine,
                'fine_stf_days' => $fine_stf_days,
                'fine_std_days' => $fine_std_days,
            ];
            $data1 = [
                's_d_name' => $department
            ];
            $staffDeptModel->setstfDepartment($data1);
            if($settingsModel->SetAppSettings($data))
            {
                $this->session->setFlashdata('msg', 'SQL dump imported successfully.');
                return redirect()->to('install/step3');
            }

        } else{
            echo view('install/step2');
        }
    }

    public function step3()
    {
        echo view('install/finish');
    }

}
