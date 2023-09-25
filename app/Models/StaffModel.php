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
        'Validity',
        'Remarks',
        'role'
    ];  

    // List of total Staff (Admin)
    public function getTotalStaff(){
        return $this->countAllResults();
    }

    // Get Staff detiles (Admin/Staff)
    public function getStaffProfile($id){
        $result = $this->where('sid',$id)
                        ->first();
        return $result;
    }
    
    // List All staff (Admin)
    public function getStaffList(){
        return $this->join('designation','designid=id',)
                    ->findAll();
    }

    // Update Profile staff (Staff Profile/Update staff(Admin))
    public function updateProfile($id, $data) {
        $result = $this->where('sid', $id)
                        ->set($data)
                        ->update();
        return $result;
    }

    // insert new staff (Admin)
    public function setinsertstf($data)
    {
        $this->insert($data);
        return true;

    }

}