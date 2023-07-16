<?php 
namespace App\Models;  
use CodeIgniter\Model;

class OtherModel extends Model

{
    public function getUserDet($u) {

    $db = \Config\Database::connect();

    $query = $db->table('staff')
        ->select('sid as sid,sname as sname,semail as email,role')
        ->Where('regno', $u)
        ->limit(1);

    $result = $query->get()->getRowArray();

    if (!$result) {
        $query = $db->table('students')
            ->select('st_id as sid,sname as sname,stemail as email,role')
            ->Where('regno', $u)
            ->limit(1);

        $result = $query->get()->getRowArray();
    }

        return $result;
    }

    public function getUserDet2($u) {
        $db = \Config\Database::connect();

        $query = $db->table('staff')
            ->Where('sid', $u)
            ->limit(1);

        $result = $query->get()->getRowArray();

        if (!$result) {
            $query = $db->table('students')
                ->Where('st_id', $u)
                ->limit(1);

            $result = $query->get()->getRowArray();
        }

        return $result;
}
}
