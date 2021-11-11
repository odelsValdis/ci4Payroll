<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserLoginModel extends Model{
    protected $table = 'msuserlogin';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id','userId','userName','loginTime','logoutTime','debit','sale','payment','remain'];


    public function getLastActive($userId) {
        $SQL = "select * from `msuserlogin` where userId =" . $userId . " and logoutTime ='1990-01-01 01:01:01' order by id desc limit 1";
        $query = $this->db->query($SQL);
        return $query->getResult();
    }
    
    public function insertUserLog($data) {
        $this->db->table("msuserlogin")->insert($data);
    }

}