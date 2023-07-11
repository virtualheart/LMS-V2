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

    public function getAdminProfile($id){
        $result = $this->where('id',$id)->first();
        return $result;
    }

    public function updateProfile($id, $apass, $amail) {
        $data = [
            'apass' => $apass,
            'a_mail' => $amail
        ];

        $result = $this->where('id', $id)->set($data)->update();
        // return $this->affectedRows() > 0;
        return $result;
    }

}

