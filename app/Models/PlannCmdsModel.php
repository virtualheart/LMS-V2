<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class PlannCmdsModel extends Model{
    protected $table = 'pln_commands';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'plan_id', 
        'date', 
        'command',    
        'status',
    ];

    // Get Admin Detiles
    public function getPlanningCmds($id)
    {
        return $this->where('id',$id)
                    ->findAll();
    }

    public function setCmds($data)
    {
        $this->insert($data);
        return true;
    }
}

