<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\StaffModel;
use App\Models\StudentModel;


class Profile extends BaseController
{
    public function __construct()
    {
        
    }
        
    public function index()
    {
        $session = session();

        if ($session->get('role')!="admin") {
            return redirect()->to('/');
        }
    }
}