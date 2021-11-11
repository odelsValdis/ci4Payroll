<?php namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\DashboardModel;
use App\Models\UserModel;
use App\Models\ModulModel;
use App\Models\TingkatModel;
use App\Models\RekModel;
use App\Models\MsValueModel;
use App\Models\TrreportModel;
use App\Models\TrreportKinerjaNodel;
use App\Models\TrreportAfirmasiModel;
use App\Models\SignatureModel;
use App\Models\TrreportAdm;
use App\Models\TrreportAdmModel;
class Mylibs extends ResourceController

{
    use ResponseTrait;

    public function getnewUserId($id){
        $model = new UserModel();
        $result =  $model->newID($id);
        if($result){

            return $this->respond($result);

        }else{

            return $this->failNotFound('No Data Found ');

        }      
    }   

    public function getTingkatAll()
    {
        $model = new TingkatModel();
        $data = $model->findAll();

        return $this->respond($data);

    }
    public function gettingkatById($id){
        $model = new TingkatModel();
       $data=$model->getWhere(['id' => $id])->getResult();

        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found with id '.$id);

        }
    } 

    public function getSideMenu(){
        $id =session()->get('idMenuSelected') ;
        if($id==null)$id=1;
        $model=new ModulModel();
        $data=$model->getsidemenu($id);
        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found with id '.$id);

        }
    }

    public function getTreeMenu($menuActive=null){
        $model=new ModulModel();
        $rootMenu =$model->getWhere(['parentId'=>"0"])->getResult();
       $menu=array();
       $data=array();
       $data["id"] = 0;
       $data["text"]="Dashboard";
       $data["path"]="home";
       $data["icon"]="home";
       array_push($menu,$data);
        foreach ($rootMenu as $modul) {
            $data=array();
            $data["id"] = $modul->id;
            $data["text"]=$modul->moduleName;
            $data["icon"]=$modul->moduleIcon;
            $data["path"]="#";
            $data["expanded"]=true;
            $child =$model->getWhere(['parentId'=>$modul->id])->getResult();
            $nodeMenu =array();
            $i=0;
            foreach($child as $node){
                $nodeMenu[$i]["id"] = $node->id;
                $nodeMenu[$i]["text"]=$node->moduleName;
                $nodeMenu[$i]["path"]=$node->url;
                $nodeMenu[$i]["selected"]=strtolower($node->url)==$menuActive?true:false ;
                $i++;
            }
            $data["items"]=$nodeMenu;
            array_push($menu,$data);
        }
        return $this->respond($menu);
    }
    
    public function getRek(){
        $model = new RekModel();
        $data = $model->findAll();

        return $this->respond($data);

    } 
    
    public function getSignaturePemeriksa($type){
        $model = new SignatureModel();
        //$type=2;
        $data = $model->getWhere(['typeid' => $type])->getResult();

        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found with id ');

        }
    }

    public function getSignaturesekolah($type,$id){
        $model = new SignatureModel();
        //$type=2;
        $data = $model->getWhere(['typeid' => $type,'branchId'=>$id])->getResult();

        if($data){

            return $this->respond($data);

        }else{

            return $this->failNotFound('No Data Found with id ');

        }
    }
        
    public function getMsValue(){
        $model = new MsValueModel();
        $data = $model->find([14,15]);

        return $this->respond($data);

    }  
    public function getHeaderTrreport($id){
        $model = new TrreportModel();
        if($id==1){
            $tabel='trreport';
        }
        if($id==2){
            $tabel='trreport_afirmasi';
        }
        if($id==3){
            $tabel='trreport_kinerja';
        }
        $data = $model->getRegulerHeader($tabel,$id);

        return $this->respond($data);
    }

    public function getHeaderTrreportAdm(){
        $model = new TrreportAdmModel();
        $data = $model->getRegulerAdmHeader(14);
        

        return $this->respond($data);
    }




    public function cekTrreportExist($branchId,$idrek,$year){
        
            $model = new TrreportModel();
        
       

        $data=$model->getWhere(['idbranch' => $branchId,'idValue'=>$idrek,'year'=>$year])->getResult();
        if($data){

            return $this->respond($data);

        }else{
            //$data = [{"dataLock":0}];
            $data[]= array("dataLock"=>0); 
            return $this->respond($data);

        }
    }

    public function selectInputBos($id,$idbranch,$idvalue,$year){
        if($id==1){
            $table = "trreport";
        }
        if($id==2){
            $table = "trreport_kinerja";
        }
        if($id==3){
            $table = "trreport_afirmasi";
        }
        $model = new TrreportModel();

        $data= $model->selectAllInputActive($table,$idbranch,$idvalue,$year);
        return $this->respond($data);

 
    }

}