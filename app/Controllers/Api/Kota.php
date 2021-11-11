<?php namespace App\Controllers\api;

 

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\KotaModel;

 

class Kota extends ResourceController

{

    use ResponseTrait;

    // get all product

    public function index()

    {

        $model = new KotaModel();

        $data = $model->findAll();

        return $this->respond($data);

    }

 

    // get single product

    public function show($id = null)

    {

        $model = new KotaModel();

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

        $model = new KotaModel();

        $data = [

            'id' => $this->request->getVar('id'),

            'branchname' => $this->request->getVar('branchName')

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

        $model = new KotaModel();

        $input = $this->request->getRawInput();
        
        $data = [

            'branchname' => $input['branchName']

        ];

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

        $model = new KotaModel();

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

            return $this->failNotFound('No Data Found with id '.$id);

        }

         

    }

 

}