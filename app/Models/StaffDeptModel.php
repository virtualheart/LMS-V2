<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class StaffDeptModel extends Model{
    protected $table = 'staff_department';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'staff_department'
    ];

    public function getstfDepartmentList()
    {
        return $this->findAll();
    }

}

