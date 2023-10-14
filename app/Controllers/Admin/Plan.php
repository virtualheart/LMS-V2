<?php

namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\PlanningModel;
use App\Models\PlannCmdsModel;

class Plan extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
        $this->planningModel = new PlanningModel();
        $this->plannCmdsModel = new PlannCmdsModel();
    }

    public function index()
    {
        $session = session();

        if ($session->get('role') !="admin") {
            return redirect()->to('/');
        }

        $data = [
            'plans' => $this->planningModel->getPlanningList(),
        ];

        echo view('Others/header');
        echo view('Admin/AdminPlanning',$data);
        echo view('Others/fooder');
    }

    public function planning($activity,$id)
    {
        $session = session();

        if ($session->get('role') != ("staff" or "admin" or "student")) {
            return redirect()->to('/');
        }

        if($activity=='new'){

            if($this->request->getMethod() == 'post'){
                $category = $this->request->getPost('category');
                $year = $this->request->getPost('year');
                $billno = $this->request->getPost('billno');
                $noofbooks = $this->request->getPost('noofbooks');
                $amount = $this->request->getPost('amount');
                $remark = $this->request->getPost('remark');

                $data = [
                    'category' => $category,
                    'year' => $year,
                    'billno' => $billno,
                    'plan_status' => 'New',
                    'noofbooks' => $noofbooks,
                    'amount' => $amount,
                    'remark' => $remark,
                ];

                if($this->planningModel->setPlanning($data)){
                    $session->setFlashdata('msg', 'New Plan Added Successfully.');
                    return redirect()->to('/admin/plan');
                } else{
                    $session->setFlashdata('msg', 'New Plan Added Failed.');
                }

            }

            // add new plan
            echo view('Others/header');
            echo view('Admin/AdminAddPlan');
            echo view('Others/fooder');

        } elseif($activity=='update'){
            // update old plan detiles

            if($this->request->getMethod() == 'post'){

                $category = $this->request->getPost('category');
                $year = $this->request->getPost('year');
                $billno = $this->request->getPost('billno');
                $noofbooks = $this->request->getPost('noofbooks');
                $amount = $this->request->getPost('amount');
                $remark = $this->request->getPost('remark');

                $data = [
                    'category' => $category,
                    'year' => $year,
                    'billno' => $billno,
                    'noofbooks' => $noofbooks,
                    'amount' => $amount,
                    'remark' => $remark,
                ];                
                
                if($this->planningModel->updatePlanning($data,$id)){
                    $session->setFlashdata('msg', 'Plan Update Successfully.');
                    return redirect()->to('/admin/plan');
                } else{
                    $session->setFlashdata('msg', 'Plan Update Failed.');
                }
            }

            $data = [
                'planed' => $this->planningModel->getPlan($id), 
            ];

        echo view('Others/header');
        echo view('Admin/AdminAddPlan',$data);
        echo view('Others/fooder');

        }
    }

    public function report($id)
    {
        $session = session();

        if ($session->get('role') != ("staff" or "admin" or "student")) {
            return redirect()->to('/');
        }

        if($this->request->getMethod() === "post"){
            $commands = $this->request->getPost('commands');
            $plan_status = $this->request->getPost('plan_status');

            $this->plannCmdsModel->setCmds(['command' => $commands,'plan_id' => $id, 'date' => date("Y-m-d h:i:s"),]);
            $this->planningModel->updatePlanning(['plan_status' => $plan_status],$id);
        }

        $data = [
            'plan' => $this->planningModel->getPlan($id), 
            'remarks' => $this->plannCmdsModel->getPlanningCmds($id), 
        ];

        echo view('Others/header');
        echo view('Admin/AdminPlanReport',$data);
        echo view('Others/fooder');
    }
}