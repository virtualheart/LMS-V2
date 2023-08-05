<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class RequestModel extends Model{
    protected $table = 'request_mgs rs';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
		'requester_id',	
		'receiver_id',	
		'messagee',	
		'is_seen',	
        'req_role',
        'rec_role',
		'status'
    ];

    public function setBookRequest($data)
    {
        $this->insert($data);       
        return true;
    }

    public function getBookRequest($id,$role)
    {
        return $this->select('rs.requester_id, rs.receiver_id, rs.messagee, rs.rec_role, rs.req_role,CASE WHEN rs.req_role = "student" THEN ss.regno ELSE sf.regno END AS regno',false)
                    ->join('students ss', 'rs.requester_id = ss.st_id AND rs.req_role = ss.role', 'LEFT')
                    ->join('staff sf', 'rs.requester_id = sf.sid AND rs.req_role = sf.role', 'LEFT')
                    ->where('rs.rec_role', $role)
                    ->where('rs.receiver_id', $id)
                    ->get()
                    ->getResult();
    }
}