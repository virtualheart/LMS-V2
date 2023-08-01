<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class AdminModel extends Model{
    protected $table = 'request_mgs';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
		'requester_id',	
		'receiver_id',	
		'messagee',	
		'is_seen',	
		'status'
    ];

    public function setRequest($rid,$bcode,$role)
    {

    }
}