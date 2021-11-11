<?php namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\DashboardModel;
use App\Models\UserModel;
use App\Models\TrreportModel;
class Dashboard extends ResourceController

{
    use ResponseTrait;
    
    public function get($year,$tipe){
      
        $model = new DashboardModel();
      
        if($tipe==1){
            $data=$model->getPositionLock($year,'trreport');
        }
        if($tipe==2){
            $data=$model->getPositionLock($year,'trreport_afirmasi');
        }
        if($tipe==3){
            $data=$model->getPositionLock($year,'trreport_kinerja');
        }
        
        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found ');

        }
    }

    public function getKab($year,$tipe,$branch){
        $model = new DashboardModel();
      
        if($tipe==1){
            $data=$model->getKabPositionLock($year,'trreport',$branch);
        }
        if($tipe==2){
            $data=$model->getKabPositionLock($year,'trreport_afirmasi',$branch);
        }
        if($tipe==3){
            $data=$model->getKabPositionLock($year,'trreport_kinerja',$branch);
        }
        
        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found ');

        }

        
    } 
    

    
}