<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class TrreportModel extends Model

{

    protected $table = 'trreport';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id','idbranch','year','idRek','idValue','amount','amount2','amount3','amount4','dataLock','fileNameUpload','statusWTP',
                                'userId','userIdUpdate','signatureAdminSchoolId','signatureAdminId','signatureSchoolHeadId','signatureSchoolId'];


    public  function getRegulerHeader($table,$id){
        $SQL ="select DISTINCT CONCAT(".$id.",LPAD(a.idBranch,4,'0'),a.idValue,a.year) as id,b.branchName as sekolah,c.branchname as kota,b.remark as kecamatan,d.name as jnsDokumen,
         a.year,if(a.dataLock=1,'Terkunci','') as dataLock,e.name as userInput,f.name as userUpdate from ".$table." a join
          msbranch b on a.idBranch=b.id join msbranchparent c on b.branchParentId = c.id join
           msvalue d on a.idValue=d.id join msuser e on a.userId = e.id left join msuser f on a.userIdUpdate = f.id 
           ORDER BY a.year desc,a.idBranch ";
           
           $query = $this->db->query($SQL);
           return $query->getResult();
    } 
    
    public function selectAllInputActive($table,$idBranch = 0, $idValue = 0, $year = 0) {
         $yearLast = (int)$year-1;
        if ($idValue == '14') {
            $SQL = "select a.id,a.name,a.color,b.id as idHeader,IFNULL(b.amount,0)as amount,IFNULL(b.amount2,0)as amount2,IFNULL(b.amount3,0)as amount3,
                    IFNULL(b.amount4,0)as amount4,IFNULL(b.idBranch,". $this->db->escape($idBranch) .") AS idBranch ,IFNULL(b.year,". $this->db->escape($idValue) . ")as year,IFNULL(b.idValue," . $this->db->escape($idValue) . ")as idValue,signatureAdminSchoolId,signatureAdminId,signatureSchoolHeadId,signatureSchoolId from msrek a left join 
    		(select id,idRek,idBranch,idValue,year,amount,amount2,amount3,amount4,signatureAdminSchoolId,signatureAdminId,signatureSchoolHeadId,signatureSchoolId from ".$table."  
    		where year = " . $this->db->escape($year) . " and idBranch=" . $this->db->escape($idBranch) . " and idValue=" . $this->db->escape($idValue) . ") b 
    		on a.id = b.idRek where a.statusInput = 1 and a.id <> 5 order by a.id";
        } else {
            $SQL = "select a.id,if(a.id=4,'Saldo Awal /Sisa Dana Bos (Bank) " .$yearLast . "',if(a.id=5,'Saldo Awal /Sisa Dana Bos (Tunai) " .$yearLast. "',
            a.name)) as name, a.color,b.id as idHeader,IFNULL(b.amount,0)as amount,IFNULL(b.amount2,0)as amount2,IFNULL(b.amount3,0)as amount3,
                    IFNULL(b.amount4,0)as amount4,IFNULL(b.idBranch,". $this->db->escape($idBranch) .") AS idBranch ,IFNULL(b.year,". $this->db->escape($idValue) . ")as year,IFNULL(b.idValue," . $this->db->escape($idValue) . ")as idValue,signatureAdminSchoolId,signatureAdminId,signatureSchoolHeadId,signatureSchoolId from msrek a left join 
    		(select id,idRek,idBranch,idValue,year,amount,amount2,amount3,amount4,signatureAdminSchoolId,signatureAdminId,signatureSchoolHeadId,signatureSchoolId from ".$table."  
    		where year = " . $this->db->escape($year) . " and idBranch=" . $this->db->escape($idBranch) . " and idValue=" . $this->db->escape($idValue) . ") b 
    		on a.id = b.idRek where a.statusInput = 1 and a.id <> 3 order by a.id";
        }
        $query = $this->db->query($SQL);
        return $query->getResult();
    }

    function userEditUpdate($table,$idBranch = 0, $idValue = 0, $year = 0){
        $SQL = "update ".$table." set userIdUpdate = ".session()->get('userId').
        " where year = " . $this->db->escape($year) . " and idBranch="
         . $this->db->escape($idBranch) . " and idValue=" . $this->db->escape($idValue) ;
         $query = $this->db->query($SQL);
         return true;
     }

    function calCulateAmount($id,$trw,$table,$idBranch = 0, $idValue = 0, $year = 0){
        
    }
}