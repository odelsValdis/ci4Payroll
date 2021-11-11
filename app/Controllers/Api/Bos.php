<?php namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\API\ResponseTrait;

use App\Models\TrreportModel;
use App\Models\TrreportKinerjaNodel;
use App\Models\TrreportAfirmasiModel;

class Bos extends ResourceController

{
    use ResponseTrait;



   



    public function GetBos($id,$idbranch,$idvalue,$year){
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
        $tobelanja = array(
                            "id"=> 901,
                            "name"=> "Total Belanja (5 + 6 + 7 + 8)",
                            "color"=> "black",
                            "idHeader"=> null,
                            "amount"=> "0.00",
                            "amount2"=> "0.00",
                            "amount3"=> "0.00",
                            "amount4"=> "0.00",
                            "idBranch"=> $idbranch,
                            "year"=> $year,
                            "idValue"=> $idvalue,
                            "signatureAdminSchoolId"=> null,
                            "signatureAdminId"=> null,
                            "signatureSchoolHeadId"=> null,
                            "signatureSchoolId"=> null
            
        );
        $sisalanja = array(
            "id"=> 902,
            "name"=> $idvalue=="14"?"Sisa Dana RKAS BOS (1 - 2)":"Saldo Awal (1+2)",
            "color"=> "black",
            "idHeader"=> null,
            "amount"=> "0.00",
            "amount2"=> "0.00",
            "amount3"=> "0.00",
            "amount4"=> "0.00",
            "idBranch"=> $idbranch,
            "year"=> $year,
            "idValue"=> $idvalue,
            "signatureAdminSchoolId"=> null,
            "signatureAdminId"=> null,
            "signatureSchoolHeadId"=> null,
            "signatureSchoolId"=> null

            );

            $sisasaldoBank = array(
                "id"=> 903,
                "name"=>$idvalue=="14"? "Sisa Saldo Bank (2 - 3) + 4":"Sisa Saldo Bank (1 - 3) + 4",
                "color"=> "black",
                "idHeader"=> null,
                "amount"=> "0.00",
                "amount2"=> "0.00",
                "amount3"=> "0.00",
                "amount4"=> "0.00",
                "idBranch"=> $idbranch,
                "year"=> $year,
                "idValue"=> $idvalue,
                "signatureAdminSchoolId"=> null,
                "signatureAdminId"=> null,
                "signatureSchoolHeadId"=> null,
                "signatureSchoolId"=> null

            );

            $sisaTunai = array(
                "id"=> 904,
                "name"=> "Sisa Saldo Tunai 3 - (4 + 5 + 6 + 7 + 8)",
                "color"=> "black",
                "idHeader"=> null,
                "amount"=> "0.00",
                "amount2"=> "0.00",
                "amount3"=> "0.00",
                "amount4"=> "0.00",
                "idBranch"=> $idbranch,
                            "year"=> $year,
                            "idValue"=> $idvalue,
                "signatureAdminSchoolId"=> null,
                "signatureAdminId"=> null,
                "signatureSchoolHeadId"=> null,
                "signatureSchoolId"=> null

            );
        array_push($data, $tobelanja,$sisalanja,$sisasaldoBank,$sisaTunai);

        return $this->respond($data);


    }

    public function getTrreportNew($id,$idBranch,$idvalue,$year){
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

        $data= $model->selectAllInputActive($table,$idBranch,$idvalue,$year);
        $tot1_amount1 =0;
        $tot1_amount2 =0;
        $tot1_amount3 =0;

        $tot2_amount1 =0;
        $tot2_amount2 =0;
        $tot2_amount3 =0;

        $tot3_amount1 =0;
        $tot3_amount2 =0;
        $tot3_amount3 =0;

        $tot4_amount1 =0;
        $tot4_amount2 =0;
        $tot4_amount3 =0;

        foreach ($data as $row) {
            //$sum += $item['qty'];
        if($idvalue=="14"){
            if($row->id=="3"){
				$tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
				
			}
			
			 if($row->id=="4"){
				$tot3_amount1 +=(int)$row->amount;
                $tot3_amount2 +=(int)$row->amount2;
                $tot3_amount3 +=(int)$row->amount3;
				
				 $tot2_amount1 -=(int)$row->amount;
                $tot2_amount2 -=(int)$row->amount2;
                $tot2_amount3 -=(int)$row->amount3;
			 }
			
			 if($row->id=="9"){
				 $tot4_amount1 +=(int)$row->amount;
                $tot4_amount2 +=(int)$row->amount2;
                $tot4_amount3 +=(int)$row->amount3;
				
				
				$tot3_amount1 -=(int)$row->amount;
                $tot3_amount2 -=(int)$row->amount2;
                $tot3_amount3 -=(int)$row->amount3;
			 }
			 if($row->id=="10"){
				 $tot4_amount1 -=(int)$row->amount;
                $tot4_amount2 -=(int)$row->amount2;
                $tot4_amount3 -=(int)$row->amount3;
				
				
				$tot3_amount1 +=(int)$row->amount;
                $tot3_amount2 +=(int)$row->amount2;
                $tot3_amount3 +=(int)$row->amount3;
			 }
			
			 if($row->id=="250"||$row->id=="258"||$row->id=="410"||$row->id=="258"||$row->id=="420"){
				 $tot1_amount1 +=(int)$row->amount;
                $tot1_amount2 +=(int)$row->amount2;
                $tot1_amount3 +=(int)$row->amount3;
				
				 $tot4_amount1 -=(int)$row->amount;
                $tot4_amount2 -=(int)$row->amount2;
                $tot4_amount3 -=(int)$row->amount3;
				
			 }
			
			
        }
        if($idvalue=="15"){
            if($row->id=="4"){
                $tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
                $tot3_amount1 +=(int)$row->amount;
                $tot3_amount2 +=(int)$row->amount2;
                $tot3_amount3 +=(int)$row->amount3;
                $tot4_amount1 +=(int)$row->amount;
            }
            if($row->id=="5"){
                $tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
                $tot4_amount1 +=(int)$row->amount;
            }
            
            if($row->id=="10"||$row->id=="258"||$row->id=="258"||$row->id=="410"||$row->id=="420" ){
                    $tot4_amount1 -=(int)$row->amount;
                    $tot4_amount1 -=(int)$row->amount2;
                    $tot1_amount2 +=(int)$row->amount2;
                }
            }
          
                     
        }
       
       
        $tobelanja = array(
                            "id"=> 901,
                            "name"=> "Total Belanja (5 + 6 + 7 + 8)",
                            "color"=> "black",
                            "idHeader"=> null,
                            "amount"=> $tot1_amount1,
                            "amount2"=>  $tot1_amount2,
                            "amount3"=>  $tot1_amount3,
                            "amount4"=> "0.00",
                            "idBranch"=> $idBranch,
                            "year"=> $year,
                            "idValue"=> $idvalue,
                            "signatureAdminSchoolId"=> null,
                            "signatureAdminId"=> null,
                            "signatureSchoolHeadId"=> null,
                            "signatureSchoolId"=> null
            
        );
        $sisalanja = array(
            "id"=> 902,
            "name"=> $idvalue=="14"?"Sisa Dana RKAS BOS (1 - 2)":"Saldo Awal (1+2)",
            "color"=> "black",
            "idHeader"=> null,
            "amount"=> $tot2_amount1,
            "amount2"=>  $idvalue=="14"?$tot2_amount2: $tot2_amount1,
            "amount3"=> $tot2_amount3,
            "amount4"=> "0.00",
            "idBranch"=> $idBranch,
            "year"=> $year,
            "idValue"=> $idvalue,
            "signatureAdminSchoolId"=> null,
            "signatureAdminId"=> null,
            "signatureSchoolHeadId"=> null,
            "signatureSchoolId"=> null

            );

            $sisasaldoBank = array(
                "id"=> 903,
                "name"=>$idvalue=="14"? "Sisa Saldo Bank (2 - 3) + 4":"Sisa Saldo Bank (1 - 3) + 4",
                "color"=> "black",
                "idHeader"=> null,
                "amount"=> $tot3_amount1,
                "amount2"=> $idvalue=="14"? $tot3_amount2:0,
                "amount3"=> $tot3_amount3,
                "amount4"=> "0.00",
                "idBranch"=> $idBranch,
                "year"=> $year,
                "idValue"=> $idvalue,
                "signatureAdminSchoolId"=> null,
                "signatureAdminId"=> null,
                "signatureSchoolHeadId"=> null,
                "signatureSchoolId"=> null

            );

            $sisaTunai = array(
                "id"=> 904,
                "name"=> "Sisa Saldo Tunai 3 - (4 + 5 + 6 + 7 + 8)",
                "color"=> "black",
                "idHeader"=> null,
                "amount"=> $idvalue=="14"?$tot4_amount1:$tot2_amount1-$tot3_amount1,
                "amount2"=> $idvalue=="14"?$tot4_amount2:0,
                "amount3"=> $tot4_amount3,
                "amount4"=> "0.00",
                "idBranch"=> $idBranch,
                            "year"=> $year,
                            "idValue"=> $idvalue,
                "signatureAdminSchoolId"=> null,
                "signatureAdminId"=> null,
                "signatureSchoolHeadId"=> null,
                "signatureSchoolId"=> null

            );
        array_push($data, $tobelanja,$sisalanja,$sisasaldoBank,$sisaTunai);

        return $this->respond($data);
    }
    

    public function getTrreport($id,$param){
         //$id = intval(substr($param,0,1));
         $idBranch =  intval(substr($param,0,4));
         $idvalue = intval(substr($param,4,2));
         $year = intval(substr($param,6,4)); 
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

        $data= $model->selectAllInputActive($table,$idBranch,$idvalue,$year);
       
        $tot1_amount1 =0;
        $tot1_amount2 =0;
        $tot1_amount3 =0;

        $tot2_amount1 =0;
        $tot2_amount2 =0;
        $tot2_amount3 =0;

        $tot3_amount1 =0;
        $tot3_amount2 =0;
        $tot3_amount3 =0;

        $tot4_amount1 =0;
        $tot4_amount2 =0;
        $tot4_amount3 =0;

        foreach ($data as $row) {
            //$sum += $item['qty'];
        if($idvalue=="14"){
            if($row->id=="250"||$row->id=="258"||$row->id=="410"||$row->id=="258"||$row->id=="420" ){
                $tot1_amount1 +=(int)$row->amount;
                $tot1_amount2 +=(int)$row->amount2;
                $tot1_amount3 +=(int)$row->amount3;
            }
            if($row->id=="3"){
                $tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
            }
            if($row->id=="4"){
                if($idvalue=="14"){
                $tot2_amount1 -=(int)$row->amount;
                $tot2_amount2 -=(int)$row->amount2;
                $tot2_amount3 -=(int)$row->amount3;
                }else{
                    $tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
                }

                $tot3_amount1 +=(int)$row->amount;
                $tot3_amount2 +=(int)$row->amount2;
                $tot3_amount3 +=(int)$row->amount3;
            }
           
            if($row->id=="10"){
                $tot3_amount1 +=(int)$row->amount;
                $tot3_amount2 +=(int)$row->amount2;
                $tot3_amount3 +=(int)$row->amount3;
            }
            if($row->id=="9"){
                $tot3_amount1 -=(int)$row->amount;
                $tot3_amount2 -=(int)$row->amount2;
                $tot3_amount3 -=(int)$row->amount3;

                $tot4_amount1 +=(int)$row->amount;
                $tot4_amount2 +=(int)$row->amount2;
                $tot4_amount3 +=(int)$row->amount3;
            }
            if($row->id=="10"||$row->id=="258"||$row->id=="258"||$row->id=="410"||$row->id=="420" ){
                $tot4_amount1 -=(int)$row->amount;
                $tot4_amount2 -=(int)$row->amount2;
                $tot4_amount3 -=(int)$row->amount3;

            }
        }
        if($idvalue=="15"){
            if($row->id=="4"){
                $tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
                $tot3_amount1 +=(int)$row->amount;
                $tot3_amount2 +=(int)$row->amount2;
                $tot3_amount3 +=(int)$row->amount3;
                $tot4_amount1 +=(int)$row->amount;
            }
            if($row->id=="5"){
                $tot2_amount1 +=(int)$row->amount;
                $tot2_amount2 +=(int)$row->amount2;
                $tot2_amount3 +=(int)$row->amount3;
                $tot4_amount1 +=(int)$row->amount;
            }
            
            if($row->id=="10"||$row->id=="258"||$row->id=="258"||$row->id=="410"||$row->id=="420" ){
                    $tot4_amount1 -=(int)$row->amount;
                    $tot4_amount1 -=(int)$row->amount2;
                    $tot1_amount2 +=(int)$row->amount2;
                }
            }
          
                     
        }
       
       
        $tobelanja = array(
                            "id"=> 901,
                            "name"=> "Total Belanja (5 + 6 + 7 + 8)",
                            "color"=> "black",
                            "idHeader"=> null,
                            "amount"=> $tot1_amount1,
                            "amount2"=>  $tot1_amount2,
                            "amount3"=>  $tot1_amount3,
                            "amount4"=> "0.00",
                            "idBranch"=> $idBranch,
                            "year"=> $year,
                            "idValue"=> $idvalue,
                            "signatureAdminSchoolId"=> null,
                            "signatureAdminId"=> null,
                            "signatureSchoolHeadId"=> null,
                            "signatureSchoolId"=> null
            
        );
        $sisalanja = array(
            "id"=> 902,
            "name"=> $idvalue=="14"?"Sisa Dana RKAS BOS (1 - 2)":"Saldo Awal (1+2)",
            "color"=> "black",
            "idHeader"=> null,
            "amount"=> $tot2_amount1,
            "amount2"=>  $idvalue=="14"?$tot2_amount2: $tot2_amount1,
            "amount3"=> $tot2_amount3,
            "amount4"=> "0.00",
            "idBranch"=> $idBranch,
            "year"=> $year,
            "idValue"=> $idvalue,
            "signatureAdminSchoolId"=> null,
            "signatureAdminId"=> null,
            "signatureSchoolHeadId"=> null,
            "signatureSchoolId"=> null

            );

            $sisasaldoBank = array(
                "id"=> 903,
                "name"=>$idvalue=="14"? "Sisa Saldo Bank (2 - 3) + 4":"Sisa Saldo Bank (1 - 3) + 4",
                "color"=> "black",
                "idHeader"=> null,
                "amount"=> $tot3_amount1,
                "amount2"=> $idvalue=="14"? $tot3_amount2:0,
                "amount3"=> $tot3_amount3,
                "amount4"=> "0.00",
                "idBranch"=> $idBranch,
                "year"=> $year,
                "idValue"=> $idvalue,
                "signatureAdminSchoolId"=> null,
                "signatureAdminId"=> null,
                "signatureSchoolHeadId"=> null,
                "signatureSchoolId"=> null

            );

            $sisaTunai = array(
                "id"=> 904,
                "name"=> "Sisa Saldo Tunai 3 - (4 + 5 + 6 + 7 + 8)",
                "color"=> "black",
                "idHeader"=> null,
                "amount"=> $idvalue=="14"?$tot4_amount1:$tot2_amount1-$tot3_amount1,
                "amount2"=> $idvalue=="14"?$tot4_amount2:0,
                "amount3"=> $tot4_amount3,
                "amount4"=> "0.00",
                "idBranch"=> $idBranch,
                            "year"=> $year,
                            "idValue"=> $idvalue,
                "signatureAdminSchoolId"=> null,
                "signatureAdminId"=> null,
                "signatureSchoolHeadId"=> null,
                "signatureSchoolId"=> null

            );
        array_push($data, $tobelanja,$sisalanja,$sisasaldoBank,$sisaTunai);

        return $this->respond($data);

   }
   
   public function updateTrreport($id,$idBranch,$idvalue,$year){
   
    $input = $this->request->getRawInput();
    if($id==1){
        $model = new TrreportModel();
        $table = "trreport";
    }
    if($id==2){
        $model = new TrreportKinerjaNodel();
        $table = "trreport_kinerja";
    }
    if($id==3){
        $model = new TrreportAfirmasiModel();
        $table = "trreport_afirmasi";
    }
    $modelGeneral = new TrreportModel();
    $data = $input;
    $oldData=$model->getWhere(['idbranch' => $idBranch,'idValue'=>$idvalue,'year'=>$year,'idrek'=>$this->request->getVar('id')])->getResult();
    if($oldData){

        $data = [

            
            'amount'=>($this->request->getVar('amount')!=null?$this->request->getVar('amount'):$oldData[0]->amount),
            'amount2'=>($this->request->getVar('amount2')!=null?$this->request->getVar('amount2'):$oldData[0]->amount2),
            'amount3'=>($this->request->getVar('amount3')!=null?$this->request->getVar('amount3'):$oldData[0]->amount3),
            'amount4'=>($this->request->getVar('amount4')!=null?$this->request->getVar('amount4'):$oldData[0]->amount4),
            'userIdUpdate'=>session()->get('userId'),
            'signatureAdminSchoolId'=>($this->request->getVar('signatureAdminSchoolId')!=null?$this->request->getVar('signatureAdminSchoolId'):$oldData[0]->signatureAdminSchoolId),
            'signatureAdminId'=>($this->request->getVar('signatureAdminId')!=null?$this->request->getVar('signatureAdminId'):$oldData[0]->signatureAdminId),
            'signatureSchoolHeadId'=>($this->request->getVar('signatureSchoolHeadId')!=null?$this->request->getVar('signatureSchoolHeadId'):$oldData[0]->signatureSchoolHeadId),
            'signatureSchoolId'=>($this->request->getVar('signatureSchoolId')!=null?$this->request->getVar('signatureSchoolId'):$oldData[0]->signatureSchoolId)
            

        ];


        $model->update($oldData[0]->id, $data);
      
        $modelGeneral->userEditUpdate($table,$idBranch, $idvalue, $year);
        $response = [

            'status'   => 200,

            'error'    => null,

            'messages' => [

                'success' => 'Data Updated'

            ]

        ];
        return $this->respond($response);
    }else{
        $data = [

            
            'idbranch' =>$idBranch,
            'year'=>$year,
            'idRek'=>$this->request->getVar('id'),
            'idValue'=>$idvalue,
            'amount'=>$this->request->getVar('amount'),
            'amount2'=>$this->request->getVar('amount2'),
            'amount3'=>$this->request->getVar('amount3'),
            'amount4'=>$this->request->getVar('amount4'),
            'userId'=>session()->get('userId'),
            'userIdUpdate'=>session()->get('userId'),
            'signatureAdminSchoolId'=>$this->request->getVar('signatureAdminSchoolId'),
            'signatureAdminId'=>$this->request->getVar('signatureAdminId'),
            'signatureSchoolHeadId'=>$this->request->getVar('signatureSchoolHeadId'),
            'signatureSchoolId'=>$this->request->getVar('signatureSchoolId')

            

        ];
        $idPost =(int)$this->request->getVar('id');


        if($idPost<900){
            $model->insert($data);
        }
        $response = [

            'status'   => 201,

            'error'    => null,

            'messages' => [

                'success' => 'Data Saved',
                'data'=>$data,

            ]

        ];

        return $this->respondCreated($response);
     }

    }
    public function create(){
      
        $model = new TrreportModel();
        $data = [

            "idBranch"=> $this->request->getVar('idBranch'),
            "year"=> $this->request->getVar('year'),
            "idValue"=>$this->request->getVar('idValue'),
            'amount' => $this->request->getVar('amount'),
            'amount2' => $this->request->getVar('amount2'),
            'amount3' => $this->request->getVar('amount3'),

        ];

      //  $input = $this->request->getRawInput();
        //$data = $input;
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

}