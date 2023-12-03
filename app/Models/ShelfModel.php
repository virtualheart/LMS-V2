<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class ShelfModel extends Model{
    protected $table = 'shelf';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'alamara',
        'rack',
        'count',
        'side',
        'count',
        'borrowed_list',
        'status'
    ];

    public function getAlamarasList()
    {
        return $this->findAll();
    }

    public function setAlamaras($data)
    {
        $this->insert($data);
        return true;
    }
}

