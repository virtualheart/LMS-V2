<?php

namespace App\Controllers\student;
use App\Controllers\BaseController;
use App\Models\UserQuery;

class Query extends BaseController
{
    public function __construct()
    {
        $this->UserQuery = new UserQuery();
    }
    public function index()
    {

        $session = session();
        
        if ($session->get('role')!="student") {
            return redirect()->to('/');
        }

        if ($this->request->getMethod() === "post") {

            $query = $this->request->getPost('query');

            $data = [
                'query_id' => rand(100000,999999),
                'user_id' => $session->get('id'),
                'query' => $query,
                'role' => $session->get('role'),
                'is_resolved' => 0,
                'status' => 1
            ];

            if($this->UserQuery->setQuery($data)){
                $session->setFlashdata('msg','Query Registered');
            }
        }

        $dat = [
            'querys' => $this->UserQuery->getUserQueryCmds($session->get('id'),$session->get('role')),
        ];
        
        echo view('Others/header');
        echo view('Student/Query',$dat);
        echo view('Others/fooder');
    }
}
