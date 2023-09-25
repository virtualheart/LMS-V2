<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class DepartmentModel extends Model{
    protected $table = 'department';
    protected $primaryKey = 'did';
    
    protected $allowedFields = [
        'dname',
    ];

    // Get Admin Detiles
    public function getDepartmentList(){
        return $this->findAll();
    }

}

