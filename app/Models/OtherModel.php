<?php 
namespace App\Models;  
use CodeIgniter\Model;

class OtherModel extends Model

{
    // Using Ajax / Book Barrow / Book Return
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

    public function getUserDet2($u,$role) {
        $db = \Config\Database::connect();

        if($role == "staff"){
            $query = $db->table('staff')
                ->select('sname,semail,regno')
                ->Where('sid', $u)
                ->limit(1);

            $result = $query->get()->getRowArray();
        } else{
            $query = $db->table('students')
                ->Where('st_id', $u)
                ->limit(1);            
            $result = $query->get()->getRowArray();
        }

        return $result;
    }

    public function getLastStaffid()
    {
        $db = \Config\Database::connect();

        $result = $db->table('staff') 
                        ->select('substr(regno,4) as dis')
                        ->orderBy('regno','desc')
                        ->limit(1)
                        ->get()
                        ->getRow();
        return $result;
    }

    public function forgetpassword($user,$mail)
    {
        $db = \Config\Database::connect();

        $query = $db->table('staff'); 
        $query->select('sid, semail, sname, role')
                    ->Where('regno',$user)
                    ->Where('semail',$mail);

        $unionQuery = $db->table('students');
        $unionQuery->select('st_id as sid, stemail as semail, sname, role')
                    ->Where('regno',$user)
                    ->Where('stemail',$mail);

        $query->union($unionQuery)->limit(1);

        $result = $query->get();
        return $result->getRow();
    }

}
