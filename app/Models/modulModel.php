<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class ModulModel extends Model

{

    protected $table = 'msmodule';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id','moduleName','url','parentid'];
  
    public function getsidemenu($id=null) {
        $SQL = "select  id,
        moduleName as text,
				url as path,
        parentid,If(id=".$id.",1,0) as selected ,0 as expanded
from    (select * from msmodule
         order by parentid, id) msmodule_sorted,
        (select @pv := 0) initialisation
where   find_in_set(parentid, @pv)
and     length(@pv := concat(@pv, ',', id))";
        $query = $this->db->query($SQL);
        return $query->getResult();
    }
}