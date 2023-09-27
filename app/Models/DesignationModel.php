<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class DesignationModel extends Model{
    protected $table = 'designation';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'designation'
    ];

    public function getDesignationList(){
        return $this->findAll();
    }

    
}

