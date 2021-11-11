<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class SekolahModel extends Model

{

    protected $table = 'msbranch';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['id','branchName','branchParentId','remark','idTingkat'];

}