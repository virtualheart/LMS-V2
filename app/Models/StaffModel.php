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
        'designid',
        'contact',
        'gender',
        'image',
        'role'
    ];  

    public function getTotalStaff(){
        return $this->countAllResults();
    }

    public function getStaffProfile($id){
        $result = $this->where('sid',$id)
                        ->first();
        return $result;
    }
    
    public function getStaffList(){
        return $this->join('designation','designid=id',)
                    ->findAll();
    }

    public function updateProfile($id, $data) {
        $result = $this->where('sid', $id)
                        ->set($data)
                        ->update();
        return $result;
    }


}