<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class BarrowBooksModel extends Model{
    protected $table = 'barrow_books';
    protected $primaryKey = 'sbid';
    
    protected $allowedFields = [
        'sid',
        'bid',
        'request_date',
        'return_date',
        'today',
        'role',
        'status'
    ];

    public function getBarrowedBooks(){
        return $this->where('is_returned',0)->countAllResults();
    }

    public function getBarrowedBookbyUser($id,$role){
        return $this->where('sid',$id)->where('role',$role)->countAllResults();
    }

    public function getFineAmount($id,$role){
        $this->select('SUM(GREATEST(DATEDIFF(CURDATE(), return_date), 0) * se.fine) AS total_fine');
        $this->join('settings se','se.id=1','left'); 
        $this->where('sid', $id);
        $this->where('role', $role);
        $result = $this->get();

        if ($result->getNumRows() > 0) {
            return $result->getRow()->total_fine;
        } else {
            return 0;
        }
    }

    public function getBarrowBookDetails($bcode)
    {
        $query = $this->table('barrow_books sbb')
            ->select('sbb.sid, sbb.bid, sbb.request_date, sbb.role, sb.bno, sb.bcode, sb.title, sb.aname, sb.publication, GREATEST(DATEDIFF(CURDATE(), sbb.return_date), 0) as fineday, se.fine')
            ->join('books sb', 'sb.bid = sbb.bid')
            ->join('settings se')
            ->where('sb.bcode', $bcode)
            ->get();

        return $query->getResult();
    }
}

