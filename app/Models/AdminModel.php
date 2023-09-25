<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class AdminModel extends Model{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'aname',
        'apass',
        'a_mail',
        'role'
    ];

    // Get Admin Detiles
    public function getAdminProfile($id){
        $result = $this->where('id',$id)->first();
        return $result;
    }

    // Update Admin Profile
    public function updateProfile($id, $data) {

        $result = $this->where('id', $id)
                        ->set($data)
                        ->update();
        // return $this->affectedRows() > 0;
        return $result;
    }

}

