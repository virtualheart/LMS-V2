<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ShelfModel extends Model{
    protected $table = 'shelf';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'berrow',
        'rack',
        'count',
        'side',
        'count',
        'barrowed_list',
        'status'
    ];

    public function getAlamarasList()
    {
        return $this->findAll();
    }

}

