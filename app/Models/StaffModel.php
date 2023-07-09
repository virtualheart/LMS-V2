<?php 
namespace App\Models;  
use CodeIgniter\Model;

class StaffModel extends Model{
    protected $table = 'staff';
    protected $primaryKey = 'sid';

    protected $allowedFields = [
        'regno',
        'spass',
        'sname',
        'semail',
        'did',
        'id',  // designation id(modify database in future)
        'contact',
        'gender',
        'image',
        'role'
    ];  

    public function getTotalStaff(){
        return $this->countAllResults();
    }

    public function getStaffProfile($id){
        $result = $this->where('sid',$id)->first();
        return $result;

        // $query = $this->where('id', $id)->get();
        // $results = $query->getResultArray();

    }

}