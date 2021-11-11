<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class RekModel extends Model

{

    protected $table = 'msrek';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['id','code','name','statusInput','color'];

}