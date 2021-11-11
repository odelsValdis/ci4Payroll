<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class MsValueModel extends Model

{

    protected $table = 'msvalue';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['id','name'];

}