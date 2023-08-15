<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class BooksModel extends Model{
    protected $table = 'books';
    protected $primaryKey = 'bid';
    
    protected $allowedFields = [
        'bno',
        'bcode',
        'title',
        'aname',
        'publication',
        'price',
        'alamara',
        'rack',
        'status',
    ];

    public function getTotalBooks()
    {
        return $this->countAllResults();
    }

    public function getBooksList()
    {
        // $query = $this->limit(50)->get();
        // $results = $query->getResultArray();

        // return $results;

        return $this->findAll();
    }

    public function getBookDetail($id)
    {
        // need to fix bug here
        return $this->where('bid',$id)
                    ->orWhere('bcode', $id)
                    ->first();
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