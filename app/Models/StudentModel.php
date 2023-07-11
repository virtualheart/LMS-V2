<?php 
namespace App\Models;  
use CodeIgniter\Model;

class StudentModel extends Model{
    protected $table = 'students';
    protected $primaryKey = 'st_id';

    protected $allowedFields = [
        'regno',
        'sname',
        'spass',
        'gender',
        'stemail',
        'Contact',  
        'did',
        'year',
        'shift',
        'img',
        'role'
    ];

    public function getTotalStudents()
    {
        return $this->countAllResults();
    }

   public function getProfile($id){
        $result = $this->where('st_id',$id)->first();
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