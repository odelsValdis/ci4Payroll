<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<style>
    #tabPanel {
    margin-top: 10px;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
                 Data Rekapitulasi Dana Bantuan Operasional Sekolah 
			</div>
			<div class="card-body">
            <div id="toolbar"></div>

            <div id="tabPanel"></div>
       
       
            <script type="text/html" id="bosRegular">
            <div class="card-header">Regular</div>
              
            <div class="card">   
                <div class="card-body">
                    <div id="gridRegular"></div>
                </div>
            </div>
            </script>

            <script type="text/html" id="bosKinerja">
            <div class="card">   
                <div class="card-header">Kinerja</div>
                <div class="card-body">
                    <div id="gridKinerja"></div>
                </div>
            </div>
            </script>

            <script type="text/html" id="bosAfirmasi">
            <div class="card">   
                <div class="card-header">Afirmasi</div>
                <div class="card-body">
                    <div id="gridAfirmasi"></div>
                </div>
            </div>
            </script>

           
           



            </div>
            
        </div>

    </div>
</div>

<div id="popup"></div>
<?= $this->include('bos/_gridRegular') ?>
<?= $this->include('bos/_gridKinerja') ?>
<?= $this->include('bos/_gridAfirmasi') ?>

<script>

var tabPanel = $("#tabPanel").dxTabPanel({
    id:"tabPanel",
    selectedIndex: 0,
        loop: false,
        deferRendering :false,
        animationEnabled: true,
        swipeEnabled: true,
        items: [
            { title:"Bos Regular",
                template: $("#bosRegular"), 
            },
            { title:"Bos Kinerja",
                template: $("#bosKinerja"), 
            },
            { title:"Bos Afirmasi",
                template: $("#bosAfirmasi"), 
    
            },
    
    ]

}).dxTabPanel("instance");



   var tipeRek =[{
    "ID": 1,
    "Name": "Bos Reguler"},
    {
    "ID": 2,
    "Name": "Bos Kinerja"},
    {
    "ID": 3,
    "Name": "Bos Afirmasi"}
];
var dataSekolahSource = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/sekolah')?>");
        }
    }),
    sort: "branchName"
}
var dataRekValueSource = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/mylibs/getMsValue')?>");
        }
    }),
    sort: "name"
}


var selectedRek;
var SERVICE_URL = '<?php echo base_url('api/mylibs/getheadertrreport')?>';
var dataGrid;



var popup = $("#popup").dxPopup({
      //contentTemplate: popupContentTemplate,
      width: 300,
      height: 280,
      showTitle:true,
      title:"Tambah Data",
      visible:false,
        dragEnabled:false,
        contentTemplate: function(e) {
                var formContainer = $("<div id='form'>");
                formContainer.dxForm({
                readOnly: false,
                showColonAfterLabel: false,
                minColWidth: 300,
                showValidationSummary: true,
                colCount: 1,
                items: [
                 {
                     dataField: "idBranch",
                     
                    label:{text: "Nama Sekolah",}, 
                    editorType: "dxSelectBox",
                    editorOptions: { 
                        dataSource: dataSekolahSource,
                        elementAttr: { id: "newBranchId" },
                         displayExpr: "branchName",
                         valueExpr: "id",
                        searchEnabled: true,
                    }
                }, {
                    dataField: "idrek",
                    label:{text: "Jenis Dokumen",}, 
                    editorType: "dxSelectBox",
                    editorOptions: {
                        elementAttr: { id: "newIdRek" },
                        dataSource: dataRekValueSource,
                         displayExpr: "name",
                         valueExpr: "id",
                        searchEnabled: true,
                        
                    },
                    validationRules: [{
                        type: "required",
                        message: "Jenis Dokumen Harus Di Isi"
                    }]

                }, {
                    dataField: "year",
                    label:{text: "Tahun",}, 
                    editorType: "dxNumberBox",
                    editorOptions: {
                        min: 2019,
                         max: 2024,
                         
                        showSpinButtons: true,
                        value:2021,
                        elementAttr: { id: "newYear" },
                    },
                   
                }, ]
                }).dxForm("instance");
                e.append(formContainer);
    },
    toolbarItems: [{
        widget: "dxButton",
        toolbar: "bottom",
        location: "before",
        options: {
          icon: "newfolder",
          text: "Tambah",
          onClick: function(e) {
              processNew();
          
          },
        }
      }, {
        widget: "dxButton",
        toolbar: "bottom",
        location: "after",
        options: {
          text: "Tutup",
          onClick: function(e) {
            popup.hide();
          }
        }
      }]
    
    });


   

 


function getType() {
    
    if(selectedRek){
        return selectedRek;
    }
     return 1;
    }

    var isLock = function(status) {
        return status.trim().toUpperCase()=== "TERKUNCI";
       // return true;
    };

    function processEdit(rowData){
        console.log(rowData);
        var tipeRek =  parseInt(rowData.substring(0, 1));
        var idSekolah = parseInt(rowData.substring(1, 5));
        var idrek = parseInt(rowData.substring(5, 7));
        var idyear = parseInt(rowData.substring(7));
          redirUrl = '<?php echo base_url('inputbos/inputnew')?>'+"/"+idSekolah+"/"+idrek+"/"+idyear;
                   window.location.href = redirUrl;
                   // console.log(redirUrl);          
    }

    function processNew(){
        
        var idSekolah = $("#newBranchId").dxSelectBox("instance").option("value");
        var idrek = $("#newIdRek").dxSelectBox("instance").option("value");
        var idyear = $("#newYear").dxNumberBox("instance").option("value");
        var urlCek =  '<?php echo base_url('api/mylibs/cekTrreportExist')?>'+"/"+idSekolah+"/"+idrek+"/"+idyear;
        $.getJSON( urlCek, function( data ){
            if(data){
                if( data[0].dataLock==1){
                     DevExpress.ui.notify({
                    message: "Tidak Bisa Menambah Data Sudah Terkunci",
               
                 }, "error", 6000);
                }else{
                    redirUrl = '<?php echo base_url('inputbos/inputnew')?>'+"/"+idSekolah+"/"+idrek+"/"+idyear;
                    window.location.href = redirUrl;
                }
            }else{
                    redirUrl = '<?php echo base_url('inputbos/inputnew')?>'+"/"+idSekolah+"/"+idrek+"/"+idyear;
                    window.location.href = redirUrl;
                }
           // console.log( "JSON Data: " + data[0].dataLock);
        }) 
    }

    $("#toolbar").dxToolbar({
        items: [{
                location: 'before',
                widget: 'dxButton',
                options: {
                    text:"Tambah Data",
                    onClick: function() {
                        popup=$("#popup").dxPopup("instance");
                         popup.show();
                    }
                }
            }, 
        ]
    });
</script>

<?= $this->endSection() ?>