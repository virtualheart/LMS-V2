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

    // DashBoard Total Book count 
    public function getTotalBooks()
    {
        return $this->countAllResults();
    }

    // Display All Book(All Users)
    public function getBooksList()
    {
        // $query = $this->limit(50)->get();
        // $results = $query->getResultArray();

        // return $results;

        return $this->findAll();
    }

    // Get Book Detiles For Barrow/Return Entry
    public function getBookDetail($id)
    {
        // need to fix bug here
        return $this->where('bid',$id)
                    ->orWhere('bcode', $id)
                    ->first();
    }

    // Admin Insert Bulk Books Record (File Upload)
    public function insertBooks($data)
    {
        $this->insertBatch($data);
    }

    // Admin Insert Single Book
    public function insertBook($data)
    {
        $this->insert($data);
        return true;
    }

    // Admin Update Book 
    public function updateBook($id,$data){
        $this->where('bid',$id)
             ->set($data)
             ->update();
        return true;
    }

}