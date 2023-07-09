<?php 
namespace App\Models;  
use CodeIgniter\Model;

class TestModel extends Model{
    protected $table = 'test';
    // protected $primaryKey = 'st_id';

    protected $allowedFields = [
        'id',
        'name',
    ];

    public function insertdata($data)
    {
    
        // Insert the data into the database table using the Query Builder
        $db = db_connect();
        $builder = $db->table('test');
        $builder->insertBatch($data);
    }

}