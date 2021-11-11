<?php namespace App\Controllers\api;

 

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\ModulModel;

 

class Modul extends ResourceController

{

    use ResponseTrait;

    // get all product

    public function index()

    {

        $model = new modulModel();

        $data = $model->findAll();

        return $this->respond($data);

    }
}