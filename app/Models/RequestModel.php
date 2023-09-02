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
        'bcode', 
		'is_seen',
        'is_seen_admin',	
        'req_role',
        'rec_role',
        'rec_date',
		'status'
    ];

    // Insert Request from Users(All Users)
    public function setBookRequest($data)
    {
        $this->insert($data);       
        return true;
    }

    // Requet message set seen or not (Staff and Studnet) 
    public function setIsSeen($id,$role)
    {
        $this->where('receiver_id',$id)
            ->where('rec_role',$role)
            ->set('is_seen',1)
            ->update();
        return true;
    }

    // Requet message set seen or not (Admin) 
    public function setIsSeenAdmin()
    {
        $this->set('is_seen_admin',1)
            ->where("id!=","a")
            ->update();
        return true;
    }

    // Get All Book Request from Users (Admin/unseen)
    public function getAllBookRequest()
    {
        return $this->select('rs.requester_id, rs.receiver_id, rs.messagee, rs.rec_role, rs.req_role,rs.is_seen,ss.sname,rs.rec_date,CASE WHEN rs.req_role = "student" THEN ss.regno ELSE sf.regno END AS regno',false)
                    ->join('students ss', 'rs.requester_id = ss.st_id AND rs.req_role = ss.role', 'LEFT')
                    ->join('staff sf', 'rs.requester_id = sf.sid AND rs.req_role = sf.role', 'LEFT')
                    ->where('is_seen_admin',0)
                    ->get()
                    ->getResult();
    }

    // history of Get All Book Request from Users (Admin/seen)
    public function getAllBookRequesthis()
    {
        return $this->select('rs.requester_id, rs.receiver_id, rs.messagee, rs.rec_role, rs.req_role,rs.is_seen,ss.sname,rs.rec_date,CASE WHEN rs.req_role = "student" THEN ss.regno ELSE sf.regno END AS regno',false)
                    ->join('students ss', 'rs.requester_id = ss.st_id AND rs.req_role = ss.role', 'LEFT')
                    ->join('staff sf', 'rs.requester_id = sf.sid AND rs.req_role = sf.role', 'LEFT')
                    ->where('is_seen_admin',1)
                    ->get()
                    ->getResult();
    }

    // Get Book our request (staff/studnet by role and id)
    public function getBookRequest($id,$role)
    {
        return $this->select('rs.requester_id, rs.receiver_id, rs.messagee, rs.rec_role, rs.req_role,rs.rec_date,CASE WHEN rs.req_role = "student" THEN ss.regno ELSE sf.regno END AS regno',false)
                    ->join('students ss', 'rs.requester_id = ss.st_id AND rs.req_role = ss.role', 'LEFT')
                    ->join('staff sf', 'rs.requester_id = sf.sid AND rs.req_role = sf.role', 'LEFT')
                    ->where('rs.rec_role', $role)
                    ->where('rs.receiver_id', $id)
                    ->where('is_seen', 0)
                    ->get()
                    ->getResult();
    }

    // History of Book request after seen (Staff/Student)
    public function getBookRequesthis($id,$role)
    {
        return $this->select('rs.requester_id, rs.receiver_id, rs.messagee, rs.rec_role, rs.req_role,rs.rec_date,CASE WHEN rs.req_role = "student" THEN ss.regno ELSE sf.regno END AS regno',false)
                    ->join('students ss', 'rs.requester_id = ss.st_id AND rs.req_role = ss.role', 'LEFT')
                    ->join('staff sf', 'rs.requester_id = sf.sid AND rs.req_role = sf.role', 'LEFT')
                    ->where('rs.rec_role', $role)
                    ->where('rs.receiver_id', $id)
                    ->where('is_seen', 1)
                    ->orderBy('rec_date','desc')
                    ->get()
                    ->getResult();
    }
}