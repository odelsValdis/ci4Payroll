<?php namespace App\Controllers\api;

 

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\UserModel;

 

class User extends ResourceController

{

    use ResponseTrait;

    // get all product

    public function index()

    {

        $model = new UserModel();

        $data = $model->findAll();

        return $this->respond($data);

    }
    
 

    // get single product

    public function show($id = null)

    {

        $model = new UserModel();

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

        $model = new UserModel();
       // ['id','email','name','passord','filephoto','phone','address','status','gender','userType','loginTime','logoutTime']
       $newId=$model->newID(0); 
       $data = [

            //'id' => $this->request->getVar('id'),
            'id'    =>$newId,
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'gender' => $this->request->getVar('gender'),
            'status' => $this->request->getVar('status'),
            'password' => $this->request->getVar('password'),
            'userType' => $this->request->getVar('userType'),
            
            
            
            
            

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

        $model = new UserModel();

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

        $model = new UserModel();

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