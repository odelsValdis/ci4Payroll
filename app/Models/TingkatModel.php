<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class TingkatModel extends Model

{

    protected $table = 'mstingkatsekolah';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id','tingkat'];

}