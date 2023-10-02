<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class StaffDeptModel extends Model{
    protected $table = 'staff_department';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        's_d_name'
    ];

    public function getstfDepartmentList()
    {
        return $this->findAll();
    }

    public function setstfDepartment($data)
    {
        $this->insert($data);
        return true;
    }

}

