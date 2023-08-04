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
        'role',
		'status'
    ];

    public function setBookRequest($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function getRequest($id,$role)
    {
        $studentData = $this->select('rs.requester_id, rs.receiver_id AS id, rs.messagee, rs.role, ss.regno AS regno ')
                           ->Join('students ss', 'rs.receiver_id = ss.st_id AND rs.role = "student"','left')
                           ->where('rs.role', 'student')
                           ->get()
                           ->getResult();

        $staffData = $this->select('rs.requester_id, rs.receiver_id AS id, rs.messagee, rs.role, sf.regno AS regno')
                         ->Join('staff sf', 'rs.receiver_id = sf.sid AND rs.role = "staff"','left')
                         ->where('rs.role', 'staff')
                         ->get()
                         ->getResult();

        return array_merge($studentData, $staffData);
    }
}