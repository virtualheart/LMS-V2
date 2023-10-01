<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class BooksModel extends Model{
    protected $table = 'books bk';
    protected $primaryKey = 'bid';
    
    protected $allowedFields = [
        'bno',
        'bcode',
        'title',
        'aname',
        'publication',
        'price',
        'year_of_publication',
        'edition',
        'Shelf_id',
        'remark',
        'status'
    ];

    // DashBoard Total Book count 
    public function getTotalBooks()
    {
        return $this->countAllResults();
    }

    // Display All Book(All Users)
    public function getBooksList()
    {
        return $this->select('bk.bno,bk.bcode,bk.title,bk.aname,bk.publication,bk.price,bk.status,sf.alamara,sf.rack')
                    ->join('shelf sf','sf.id=shelf_id')
                    ->findAll();
    }

    // Get Book Detiles For Barrow/Return Entry
    public function getBookDetail($id)
    {
        return $this->Where('bcode', $id)
                    ->first();
    }

    public function getLastBookid()
    {
        $result = $this->select('substr(bcode,10) as lbcode')
                        ->orderBy('bcode','desc')
                        ->limit(1)
                        ->get()
                        ->getRow();
        return $result;
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
    public function updateBook($bcode,$data){
        $this->where('bcode',$bcode)
             ->set($data)
             ->update();
        return true;
    }

}