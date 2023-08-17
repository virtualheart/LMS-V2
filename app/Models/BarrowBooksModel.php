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
        'returned_date',
        'is_returned',
        'role',
        'status'
    ];

    public function getBarrowedBooks(){
        return $this->where('is_returned',0)
                    ->countAllResults();
    }

    public function getBarrowedBookbyUser($id,$role){
        $query = $this->join('books bk','bk.bid=sbb.bid')
                    ->where('sid',$id)
                    ->where('role',$role)
                    ->where('is_returned',0)
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

    public function getBarrowedUserId($bcode)
    {
        return $this->select('sbb.sid,sbb.role')
                    ->join('books sb', 'sb.bid = sbb.bid')
                    ->where('sb.bcode', $bcode)
                    ->first();
    }

    public function getBarrowedBookcountbyRole($role)
    {
        return $this->where('role',$role)
                    ->like('request_date',date('Y-m'))
                    ->countAllResults();
    }

    public function getBarrowedBookMonth()
    {
        // $query = $this->select('COUNT(*) AS count')
        //     ->where('YEAR(request_date)',date('Y'))
        //     ->groupBy('MONTH(request_date)')
        //     ->get();
           $query = $this->db->query("
            SELECT
                IFNULL(COUNT(request_date), 0) AS count
            FROM (
                SELECT 1 AS m UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6
                UNION SELECT 7 UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
            ) AS months
            LEFT JOIN barrow_books ON MONTH(request_date) = months.m AND YEAR(request_date) = YEAR(CURDATE())
            GROUP BY months.m
        ");

        return array_column($query->getResultArray(), 'count');
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

