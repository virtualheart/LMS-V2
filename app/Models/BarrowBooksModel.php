<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class BarrowBooksModel extends Model{
    protected $table = 'barrow_books sbb';
    protected $primaryKey = 'sbid';
    
    protected $allowedFields = [
        'sid',
        'bid',
        'request_date',
        'return_date',
        'is_returned',
        'role',
        'status'
    ];

    public function getBarrowedBooks(){
        return $this->where('is_returned',0)->countAllResults();
    }

    public function getBarrowedBookbyUser($id,$role){
        $query = $this->join('books bk','bk.bid=sbb.bid')
                    ->where('sid',$id)
                    ->where('role',$role)
                    ->where('is_returned',0)
                    // ->countAllResults();
                    ->get();
        $results = $query->getResultArray();
        return $results;
    }

    public function getFineAmount($id,$role){
        /** IFNULL - when return null replace 0
         * SUM - calculate all books late fee and showing
         * GREATEST - calculate late date 
         **/

        $this->select('IFNULL(SUM(GREATEST(DATEDIFF(CURDATE(), return_date), 0) * se.fine),0) AS total_fine');
        $this->join('settings se','1=1'); 
        $this->where('sid', $id);
        $this->where('role', $role);
        $result = $this->get();

        return $result->getRow()->total_fine;
    }

    public function getBarrowBookDetails($bcode)
    {
        $query = $this->select('sbb.sid, sbb.bid, sbb.request_date, sbb.role, sb.bno, sb.bcode, sb.title, sb.aname, sb.alamara, sb.rack, sb.price,sb.publication, GREATEST(DATEDIFF(CURDATE(), sbb.return_date), 0) as fineday, se.fine')
            ->join('books sb', 'sb.bid = sbb.bid')
            ->join('settings se','1=1')
            ->where('sb.bcode', $bcode)
            ->where('sbb.is_returned', 0)
            ->get();

        // return $query->getResult();
        return $query->getRow();
    }

    public function setBarroeBook($data){
        $this->insert($data);
        return true;
    }

    public function setBookreturn($bid,$data){
        $this->where('bid',$bid)
             ->set($data)
             ->update();
        return true;
    }
}

