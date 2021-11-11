<?php namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\TrreportAdmModel;

class RekapBunga extends ResourceController

{
    use ResponseTrait;

    public function getRekapBunga($idBranch,$idvalue,$year){

        $model = new TrreportAdmModel();
        $data= $model->selectAllInputActiveAdm($idBranch,$idvalue,$year);
        return $this->respond($data);

    }

}