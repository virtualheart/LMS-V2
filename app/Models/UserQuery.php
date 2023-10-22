<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class UserQuery extends Model{
    protected $table = 'tbl_query';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'query_id', 
        'user_id', 
        'query',    
        'role', 
        'is_resolved', 
        'status'
    ];

    // Get All Query Detiles 
    public function getAllQueryCmds()
    {
        return $this->findAll();
    }

    // Get user Query Detiles 
    public function getUserQueryCmds($id,$role)
    {
        return $this->where('user_id',$id)
                    ->where('role',$role)
                    ->findAll();
    }

    public function setQuery($data)
    {
        $this->insert($data);
        return true;
    }
}

