<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class KotaModel extends Model

{

    protected $table = 'msbranchparent';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id','branchname'];

}