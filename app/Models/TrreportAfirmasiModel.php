<?php namespace App\Models;

 

use CodeIgniter\Model;

 

class TrreportAfirmasiModel extends Model

{

    protected $table = 'trreport_afirmasi';

    protected $primaryKey = 'id';

    protected $allowedFields = ['id','idbranch','year','idRek','idValue','amount','amount2','amount3','amount4','dataLock','fileNameUpload','statusWTP',
                                'userId','userIdUpdate','signatureAdminSchoolId','signatureAdminId','signatureSchoolHeadId','signatureSchoolId'];


                            
}