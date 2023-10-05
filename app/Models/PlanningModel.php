<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class PlanningModel extends Model{
    protected $table = 'lib_planning';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'category',
        'year', 
        'billno', 
        'noofbooks', 
        'amount', 
        'balance', 
        'remark',   
        'status',
    ];

    // Get Admin Detiles
    public function getPlanningList()
    {
        return $this->findAll();
    }

    public function getPlan($id)
    {
        return $this->where('id',$id)
                    ->first();   
    }
    public function setPlanning($data)
    {
        $this->insert($data);
        return true;
    }

    public function updatePlanning($data,$id)
    {
        $this->set($data)
            ->where('id',$id)
            ->update();
        return true;
    }
}

