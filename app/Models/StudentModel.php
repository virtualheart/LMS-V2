<?php 
namespace App\Models;  
use CodeIgniter\Model;

class StudentModel extends Model{
    protected $table = 'students std';
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
        'Validity', 
        'Remarks',
        'role'
    ];
    // Get Total Student Count (Admin/Staff)
    public function getTotalStudents()
    {
        return $this->countAllResults();
    }

    // Get Student profile Detiles (Admin/Student)
    public function getProfile($id){
        $result = $this->where('st_id',$id)
                    ->join('department','did')
                    ->first();
        return $result;
    }

    // Show All Student (Admin)
    public function getStudentList($dept,$year){
        return $this->join('department dd','dd.did=std.did')
                    ->where('dd.did',$dept)
                    ->Where('year',$year)
                    ->findAll();
    }

    // Update Student (Student update(Admin) / Profile Update(Student))
    public function updateProfile($id, $data) {
        $result = $this->where('st_id', $id)
                        ->set($data)
                        ->update();
        return $result;
    }

    // Insert Bulk Student Data (Admin)
    public function insertstds($data)
    {
        $this->insertBatch($data);
    }

    // Insert single Student ()
    public function insertstd($data)
    {
        $this->insert($data);
        return true;
    }

}   