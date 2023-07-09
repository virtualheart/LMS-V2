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



}   