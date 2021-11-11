<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class SignatureModel extends Model

{

    protected $table = 'mssignature';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['id','nip','nama','typeId','branchId'];

}