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
        'image',
        'role'
    ];

    public function getTotalStudents()
    {
        return $this->countAllResults();
    }

   public function getProfile($id){
        $result = $this->where('st_id',$id)
                    ->join('department','did')
                    ->first();
        return $result;
    }

    public function getStudentList(){
        return $this->findAll();
    }

    public function updateProfile($id, $data) {
        $result = $this->where('st_id', $id)
                        ->set($data)
                        ->update();
        // return $this->affectedRows() > 0;
        return $result;
    }

    public function insertBooks($data)
    {
        $this->insertBatch($data);
    }

}   