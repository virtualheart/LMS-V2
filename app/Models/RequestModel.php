<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class RequestModel extends Model{
    protected $table = 'request_mgs';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
		'requester_id',	
		'receiver_id',	
		'messagee',	
		'is_seen',	
        'role',
		'status'
    ];

    public function setRequest($data)
    {
        $this->insert($data);
        return true;
    }
}