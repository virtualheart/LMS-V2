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
        'remark',
        'status'
    ];

    // For admin dashboard count
    public function getBarrowedBookscount(){
        return $this->where('is_returned',0)
                    ->countAllResults();
    }

    // Get all Barrow Book list
    public function getBarrowedBooks(){
        return $this->select('bno,title,aname,publication,request_date,return_date,IFNULL(GREATEST(DATEDIFF(CURDATE(), return_date), 0) * se.fine,0) AS fine,COALESCE(st.role, sf.role) AS borrower_role,COALESCE(st.sname, sf.sname) AS borrower_name,COALESCE(st.regno, sf.regno) AS borrower_regno')
                    ->join('books bk','bk.bid=sbb.bid')
                    ->join('students st','sbb.sid=st.st_id', 'LEFT')
                    ->join('staff sf','sbb.sid=sf.sid', 'LEFT')
                    ->join('settings se','1=1')
                    ->where('is_returned',0)
                    ->FindAll();
    }

    // Staff or Student barrowed book list 
    public function getBarrowedBookbyUser($id,$role){
        $query = $this->select('bno,title,aname,publication,request_date,return_date,IFNULL(GREATEST(DATEDIFF(CURDATE(), return_date), 0) * se.fine,0) AS fine')
                    ->join('books bk','bk.bid=sbb.bid')
                    ->join('settings se','1=1') 
                    ->where('sid',$id)
                    ->where('role',$role)
                    ->where('is_returned',0)
                    ->get();
        $results = $query->getResultArray();
        return $results;
    }

    // Staff or Student return book list 
    public function getReturnedBookbyUser($id,$role){
        $query = $this->join('books bk','bk.bid=sbb.bid')
                    ->where('sid',$id)
                    ->where('role',$role)
                    ->where('is_returned',1)
                    ->get();
        $results = $query->getResultArray();
        return $results;
    }

    // Staff or Student All barrowed and retuned book list 
    public function getAllBookbyUser($id,$role){
        $query = $this->select('bno,title,aname,publication,request_date,return_date,IFNULL(GREATEST(DATEDIFF(CURDATE(), return_date), 0) * se.fine,0) AS fine')
                    ->join('books bk','bk.bid=sbb.bid')
                    ->join('settings se','1=1') 
                    ->where('sid',$id)
                    ->where('role',$role)
                    ->get();
        $results = $query->getResultArray();
        return $results;
    }

    // Staff or Studnet Due fine amount
    public function getFineAmount($id,$role){
        /** IFNULL - when return null replace 0
         * SUM - calculate all books late fee and showing
         * GREATEST - calculate late date 
         **/

        $this->select('IFNULL(SUM(GREATEST(DATEDIFF(CURDATE(), return_date), 0) * se.fine),0) AS total_fine');
        $this->join('settings se','1=1'); 
        $this->where('sid', $id);
        $this->where('role', $role);
        $this->where('is_returned',0);
        $result = $this->get();

        return $result->getRow()->total_fine;
    }

    // Admin Barrow entry detiles 
    public function getBarrowBookDetails($bcode)
    {
        $query = $this->select('sbb.sid,sbb.return_date, sbb.bid, sbb.request_date, sbb.role, sb.bno, sb.bcode, sb.title, sb.aname, sf.alamara, sf.rack, sb.price,sb.publication, GREATEST(DATEDIFF(CURDATE(), sbb.return_date), 0) as fineday, (se.fine * GREATEST(DATEDIFF(CURDATE(), sbb.return_date), 0)) as fine ')
                    ->join('books sb', 'sb.bid = sbb.bid')
                    ->join('shelf sf','sf.id=shelf_id')
                    ->join('settings se','1=1')
                    ->where('sb.bcode', $bcode)
                    ->where('sbb.is_returned', 0)
                    ->get();

        // return $query->getResult();
        return $query->getRow();
    }

    // Admin Barrow entry user detiles
    public function getBarrowedUserId($bcode)
    {
        return $this->select('sbb.sid,sbb.role')
                    ->join('books sb', 'sb.bid = sbb.bid')
                    ->where('sb.bcode', $bcode)
                    ->first();
    }

    // (Admin Dashboard chart) getting Staff and Student barrow book count
    public function getBarrowedBookcountbyRole($role)
    {
        return $this->where('role',$role)
                    ->like('request_date',date('Y-m'))
                    ->countAllResults();
    }

    // (Admin Dashboard chart) current month Book borrow entry count 
    public function getBarrowedBookMonth()
    {
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

    // insert Book barrow entry 
    public function setBarroeBook($data){
        $this->insert($data);
        return true;
    }

    // update Book barrow entry (Returned)
    public function setBookreturn($bid,$data){
        $this->where('bid',$bid)
             ->set($data)
             ->update();
        return true;
    }
}

