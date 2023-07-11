<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class BooksModel extends Model{
    protected $table = 'books';
    protected $primaryKey = 'bid';
    
    protected $allowedFields = [
        'sno',
        'bno',
        'bcode',
        'title',
        'aname',
        'publication',
        'price',
        'alamara',
        'rack',
        'status',
        'sstatus'
    ];

    public function getTotalBooks()
    {
        return $this->countAllResults();
    }

    public function getBooksList()
    {
        $query = $this->where('status', 0)->limit(500)->get();
        $results = $query->getResultArray();

        return $results;

        // return $this->findAll();
    }

    public function getBookDetail($id)
    {
        return $this->where('bid',$id)->first();
    }

    public function insertBooks($data)
    {
        $this->insertBatch($data);
    }

    public function insertBook($data)
    {
        $this->insert($data);
        return true;
    }

    public function updateBook($id,$data){
        $this->where('bid',$id)
             ->set($data)
             ->update();
        return true;
    }

}

