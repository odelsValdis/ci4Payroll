<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class TrreportAdmModel extends Model

{

    protected $table = 'trreportadm';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id','idbranch','year','idRek','idValue','amount','amount2','amount3','amount4','dataLock','fileNameUpload','statusWTP',
    'userId','userIdUpdate','signatureAdminSchoolId','signatureAdminId','signatureSchoolHeadId','signatureSchoolId'];

    public function selectAllInputActiveAdm($idBranch = 0, $idValue = 0, $year = 0) {
        $SQL = "select a.id,a.name,a.color,b.id as idHeader,IFNULL(b.amount,0)as amount,IFNULL(b.amount2,0)as amount2,IFNULL(b.amount3,0)as amount3,
                IFNULL(b.amount4,0)as amount4,b.idBranch,b.year,b.idValue,IFNULL(b.remark,'')as remark,signatureAdminSchoolId,signatureAdminId,signatureSchoolHeadId,signatureSchoolId 
                from msrekadm a left join 
		(select id,idRek,idBranch,idValue,year,amount,amount2,amount3,amount4,remark,signatureAdminSchoolId,signatureAdminId,signatureSchoolHeadId,signatureSchoolId from trreportadm 
		where year = " . $this->db->escape($year) . " and idBranch=" . $this->db->escape($idBranch) . " and idValue=" . $this->db->escape($idValue) . ") b 
		on a.id = b.idRek where a.statusInput = 1";
        $query = $this->db->query($SQL);
        return $query->getResult();
    }

    public  function getRegulerAdmHeader($id){
        $SQL ="select DISTINCT CONCAT(".$id.",LPAD(a.idBranch,4,'0'),a.year) as id,b.branchName as sekolah,c.branchname as kota,b.remark as kecamatan,
         a.year,if(a.dataLock=1,'Terkunci','') as dataLock,e.name as userInput,f.name as userUpdate from trreportadm a join
          msbranch b on a.idBranch=b.id join msbranchparent c on b.branchParentId = c.id  join msuser e on a.userId = e.id left join msuser f on a.userIdUpdate = f.id 
           ORDER BY a.year desc,a.idBranch ";
           
           $query = $this->db->query($SQL);
           return $query->getResult();
    } 
}