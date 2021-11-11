<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class DashboardModel extends Model

{

    public function getPositionLock($year=2020,$tabnme ="trreport"){
        $SQL = 'select *,(cnt-b1)as r1,(cnt-b2)as r2 from (select branchParentId,branchName,sum(b1)as b1,sum(b2)as b2 from (
            select a.branchName,a.branchParentId,
            
            if(b.idValue = 14,1,0)as b1,
            if(b.idValue = 15,1,0)as b2    
            
            from 
            (select a1.id,b1.id as branchParentId,b1.branchName from msbranch a1 inner join msbranchparent b1 on a1.branchParentId = b1.id) a left join
            (SELECT idBranch,idValue FROM '.$tabnme.' where dataLock = 1 and year = ' . $year . ' group by idBranch,idValue) b on a.id = b.idBranch) temporer group by branchParentId,branchName)x1 
            inner join (select b2.id,count(a2.id)as cnt from msbranch a2 inner join msbranchparent b2 on a2.branchParentId = b2.id group by b2.id) x2 on x1.branchParentId = x2.id';
            $query = $this->db->query($SQL);
            return $query->getResult();
    }

    public function getKabPositionLock($year=2020,$tabName = "trreport",$branch=1){
        $SQL = 'select branchName,sum(b1)as b1,sum(b2)as b2 from (
            select a.branchName,
            
            if(b.idValue = 14,1,0)as b1,
            if(b.idValue = 15,1,0)as b2    
            
            from 
            (select a1.id,a1.branchName from msbranch a1 inner join msbranchparent b1 on a1.branchParentId = b1.id where b1.id = ' . $branch . ') a left join
            (SELECT idBranch,idValue FROM '.$tabName.' where dataLock = 1 and year = ' . $year . ' group by idBranch,idValue) b on a.id = b.idBranch) temporer group by branchName';
            $query = $this->db->query($SQL);
            return $query->getResult();
    }
}