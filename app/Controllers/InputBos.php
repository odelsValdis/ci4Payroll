<?php

namespace App\Controllers;
use App\Models\TrreportModel;
use App\Models\TrreportAfirmasiModel;
use App\Models\TrreportKinerjaNodel;
use App\Models\RekModel;

class InputBos extends BaseController
{
    public function index()
    {
        return view('bos/index');
    }

    public function inputNew($branchId,$idValue,$year)
    {
       
        
            $title1 = 'BOS Reguler';
            $model1 = new TrreportModel();
        
        
            $title2 = 'BOS Kinerja';
            $model2 = new TrreportKinerjaNodel();
        
        
            $title3 = 'BOS Afirmasi';
            $model3 = new TrreportAfirmasiModel();
        
        
        $repReguler = $model1->getWhere(['idbranch' => $branchId,'idValue'=>$idValue,'year'=>$year,'idrek'=>3],1)->getResult();
        $repKinerja = $model2->getWhere(['idbranch' => $branchId,'idValue'=>$idValue,'year'=>$year,'idrek'=>3],1)->getResult();
        $repAfirmasi = $model3->getWhere(['idbranch' => $branchId,'idValue'=>$idValue,'year'=>$year,'idrek'=>3],1)->getResult();
        
        //print_r($rep);
        $data['branchId'] = $branchId;
        $data["idValue"] = $idValue;
        $data["idYear"]= $year;
        $data["param"]= str_pad($branchId,4,"0",STR_PAD_LEFT).$idValue.$year;
        $data = array(
            'title1' => $title1,
            'title2' => $title2,
            'title3' => $title3,
            'branchId' => $branchId,
            'idValue' => $idValue,
            'idYear' => $year,
            'param'=>str_pad($branchId,4,"0",STR_PAD_LEFT).$idValue.$year,
            'signatureAdminSchoolId'=>($repReguler!=null ?$repReguler[0]->signatureAdminSchoolId:0),
            'signatureAdminId'=> ($repReguler!=null ?$repReguler[0]->signatureAdminId:0),
            'signatureSchoolHeadId'=> ($repReguler!=null ?$repReguler[0]->signatureSchoolHeadId:0),
            'signatureSchoolId'=>($repReguler!=null ?$repReguler[0]->signatureSchoolId:0),
        );
        
        if($idValue=="14"){
        return view("bos/inputNew",$data);
        }else{
            return view("bos/inputNewN-1",$data);
        }
    }
}
