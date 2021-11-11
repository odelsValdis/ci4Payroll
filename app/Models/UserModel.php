<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'msuser';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
     protected $allowedFields = ['id','email','name','password','filephoto','phone','address','status','gender','userType','loginTime','logoutTime'];

    public function newID($newId){
        
         if($newId===0){
            $SQL = "select Max(id) as newId FROM msuser";
            $query = $this->db->query($SQL);
            $row = $query->getRow(0);
            $newId=$row->newId;
            $newId++;
         }
             $newId++;
             $SQL = "select Count(id) as cid FROM msuser where id=".$newId;
             $query = $this->db->query($SQL);
             $row = $query->getRow(0);
             $count = $row->cid;
             if($count>0){
                return $this->newID($newId);
             }else{
                return $newId;
             }     
         
        // $builder->where('id', $newId);
        // //$builder->from('my_table');
        // $cekCount =$builder->countAllResults();
        // if($cekCount>0){
        //     return $this->newID($newId);
        // } else{
        //     return $newId;
        // }
       
    }
   
    public function get_module_by_id($id) {
        $SQL = "select moduleName,url,IFNULL(dtusermodule_temp.view_tbl,0) as view_tbl
        ,IFNULL(dtusermodule_temp.add_tbl,0) as add_tbl
        ,IFNULL(dtusermodule_temp.upd_tbl,0) as upd_tbl
        ,IFNULL(dtusermodule_temp.del_tbl,0) as del_tbl,temporer.id_fix,temporer.id
        from (
        select id,moduleName,url,0 as id_fix from msmodule where id in (select parentId from msmodule where url <> '#' and active=1) and url='#'
        union
        select parentId as id,moduleName,url,id as id_fix from msmodule where url<>'#' and active=1 order by id,id_fix) temporer left join 
        (select * from dtusermodule where userId = " . $id . ")as dtusermodule_temp on temporer.id_fix = dtusermodule_temp.moduleId order by temporer.id,temporer.id_fix";
        $query = $this->db->query($SQL);
        return $query->getResult();
    }
    public function get_branch_by_id($id) {
        $SQL = "select branchName,branchCode,IFNULL(dtuserbranch_temp.id,0) as auth,temporer.id
        from (
        select a.id,a.branchName,IFNULL(b.branchName,'')as branchCode from msbranch a left join msbranchparent b on a.branchParentId = b.id order by a.id) temporer left join 
        (select * from dtuserbranch where userId = " . $id . ")as dtuserbranch_temp on temporer.id = dtuserbranch_temp.branchid order by branchCode,branchName";
        $query = $this->db->query($SQL);
        return $query->getResult();
    }
   
}