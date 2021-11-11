<?php namespace App\Controllers\api;

 

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\SekolahModel;
use App\Models\SignatureModel;
 

class Sekolah extends ResourceController

{

    use ResponseTrait;

    // get all product

    public function index()

    {

        $model = new SekolahModel();

        $data = $model->findAll();

        return $this->respond($data);

    }

 

    // get single product

    public function show($id = null)

    {

        $model = new SekolahModel();

        $data = $model->getWhere(['id' => $id])->getResult();

        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found with id '.$id);

        }

    }

 

    // create a product

    public function create()

    {

        $model = new SekolahModel();

        $data = [

            
            'branchName' => $this->request->getVar('branchName'),
            'branchParentId' => $this->request->getVar('branchParentId'),
            'remark' => $this->request->getVar('remark'),
            'idTingkat' => $this->request->getVar('idTingkat'),
            

        ];

        $model->insert($data);

        $response = [

            'status'   => 201,

            'error'    => null,

            'messages' => [

                'success' => 'Data Saved'

            ]

        ];

        return $this->respondCreated($response);

    }

 

    // update product

    public function update($id = null)

    {

        $model = new SekolahModel();

        $input = $this->request->getRawInput();
        
        $data = $input;

        $model->update($id, $data);

        $response = [

            'status'   => 200,

            'error'    => null,

            'messages' => [

                'success' => 'Data Updated'

            ]

        ];

        return $this->respond($response);

    }

 

    // delete product

    public function delete($id = null)

    { 
        $modelSign = new SignatureModel();

        $Sign = $modelSign->where('branchId', $id)->delete();
        if($Sign){

        $model = new SekolahModel();

        $data = $model->find($id);

        if($data){

            $model->delete($id);

            $response = [

                'status'   => 200,

                'error'    => null,

                'messages' => [

                    'success' => 'Data Deleted'

                ]

            ];

            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Error delete signature with Branch Id '.$id);

        }
        }else{

            return $this->failNotFound('No Data Found with id '.$id);

        }

         

    }

 

}