<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<style>
    .dx-data-row td.number {  
    text-align: right!important;  
}  
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
            Pengisian Data Rekap Dana Bantuan Operasional Sekolah 
			</div>
			<div class="card-body">
            
                <div id="formInput"></div>
                <div id="tabPanel"></div>

            </div>
            
        </div>

    </div>
</div>

<script type="text/html" id="bosRegular">
            <div class="card-header">Regular</div>
              
            <div class="card">   
                <div class="card-body">
                    <div id="gridRegular"></div>
                </div>
            </div>
 </script>
 <script type="text/html" id="bosKinerja">
            <div class="card-header">Kinerja</div>
              
            <div class="card">   
                <div class="card-body">
                    <div id="gridKinerja"></div>
                </div>
            </div>
 </script>
 <script type="text/html" id="bosAfirmasi">
            <div class="card-header">Afirmasi</div>
              
            <div class="card">   
                <div class="card-body">
                    <div id="gridAfirmasi"></div>
                </div>
            </div>
 </script>











 
<div id="popup"></div>
<?= $this->include('bos/inputNew/_gridReguler') ?>
<?= $this->include('bos/inputNew/_gridKinerja') ?>
<?= $this->include('bos/inputNew/_gridAfirmasi') ?>
<script>
var tabPanel = $("#tabPanel").dxTabPanel({
    id:"tabPanel",
    selectedIndex: 0,
        loop: false,
        deferRendering :false,
        animationEnabled: true,
        swipeEnabled: true,
        items: [
            { title:"<?php echo $title1 ?>",
                template: $("#bosRegular"), 
            },
            { title:"<?php echo $title2 ?>",
                template: $("#bosKinerja"),
            },
            { title:"<?php echo $title3 ?>",
                template: $("#bosAfirmasi"), 
    
            },
    
    ]

}).dxTabPanel("instance");





var SchoolID;
var DataKotaSource = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
        load: function() {
            
            return $.getJSON("<?php echo base_url('api/kota')?>");
        }
    }),
    sort: "branchName"
}

var dataSekolahSource = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/sekolah')."/".$branchId?>");
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
            return $.getJSON("<?php echo base_url('api/mylibs/getMsValue')."/".$idValue?>");
        }
    }),
    sort: "name"
}

var datasignaturePemeriksaSource = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/mylibs/getSignaturePemeriksa/2')?>");
        }
    }),
    sort: "nama"
}


var datasignaturePemeriksaKeuanganSource = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/mylibs/getSignaturePemeriksa/1')?>");
        }
    }),
    sort: "nama"
}

var SignatureStore = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
       
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/mylibs/getSignaturesekolah/3')."/".$branchId?>");
        }
    }),
    sort: "nama"
}

var BendaharaStore = {
    store: new DevExpress.data.CustomStore({
        key: "id",
        loadMode: "raw",
       
        load: function() {
            // Returns an array of objects that have the following structure:
            // { id: 1, name: "John Doe" }
            return $.getJSON("<?php echo base_url('api/mylibs/getSignaturesekolah/4')."/".$branchId?>");
        }
    }),
    sort: "nama"
}
var SchoolID;
var trreport = { "id": "0",
        "idBranch": "<?php echo $branchId ?>",
        "year": "2021",
        "idRek": "4",
        "idValue": "<?php echo $idValue ?>",
        "amount": "0",
        "amount2": "0",
        "amount3": "0",
        "amount4": "0",
        "dataLock": "0",
        "fileNameUpload": "-",
        "statusWTP": "0",
        "userId": "<?= session()->get('userId') ?>",
        "userIdUpdate": "",
        "signatureAdminSchoolId": "<?php echo $signatureAdminSchoolId ?>",
        "signatureAdminId": "<?php echo $signatureAdminId ?>",
        "signatureSchoolHeadId": "<?php echo $signatureSchoolHeadId ?>",
        "signatureSchoolId": "<?php echo $signatureSchoolId ?>"};

   $(function() {
    $("#formInput").dxForm({
        formData: trreport,
        colCount:6,
        items: [
            {
                colSpan:2,
                    dataField: "idBranch",
                    label:{text: "Nama Sekolah",}, 
                    editorType: "dxSelectBox",
                    editorOptions: { 
                        dataSource: dataSekolahSource,
                         displayExpr: "branchName",
                         valueExpr: "id",
                        searchEnabled: true,
                        readOnly:true
                    },
                    validationRules: [{
                        type: "required",
                        message: "Nama Sekolah Harus Di Isi"
                    }],
                   
                },
                {
                    colSpan:2,
                    dataField: "idValue",
                    label:{text: "Jenis Dokumen",}, 
                    editorType: "dxSelectBox",
                    editorOptions: {
                      
                        dataSource: dataRekValueSource,
                         displayExpr: "name",
                         valueExpr: "id",
                        searchEnabled: true,
                        readOnly:true
                    },
                    validationRules: [{
                        type: "required",
                        message: "Jenis Dokumen Harus Di Isi"
                    }]

                },
                {
                    dataField: "year",
                    editorType: "dxNumberBox",
                    editorOptions: {
                        min: 2019,
                         max: 2024,
                         
                        showSpinButtons: true,
                        readOnly:true
                    }
                },
                { 
                    itemType:"empty",

                },
                 {
                itemType: "group",
                 caption: "Penanda tangan Sekolah",
                 labelLocation:"top",
                 colSpan:2,
                    items:[
                        {
                            dataField: "signatureSchoolHeadId",
                            label:{text: "Kepala Sekolah",}, 
                            editorType: "dxSelectBox",
                            editorOptions: { 
                                dataSource:  SignatureStore,
                              
                                displayExpr: "nama",
                                valueExpr: "id",
                                searchEnabled: true,
                                onValueChanged: function (data) {
                                     updateSignature(data.value,"signatureSchoolHeadId");
                                 }
                                },
                                validationRules: [{
                                type: "required",
                                message: "Kepala Sekolah Harus Di Isi"
                                }]
                        },
                        {
                            dataField: "signatureSchoolId",
                            label:{text: "Bendahara",}, 
                            editorType: "dxSelectBox",
                            editorOptions: { 
                                dataSource:  BendaharaStore,
                              
                                displayExpr: "nama",
                                valueExpr: "id",
                                searchEnabled: true,
                                onValueChanged: function (data) {
                                     updateSignature(data.value,"signatureSchoolId");
                                 }
                                },
                                validationRules: [{
                                type: "required",
                                message: "Bendahara Harus Di Isi"
                                }]
                        },
                    ]
                },
                {
                  itemType: "group",
                 caption: "Penanda tangan Pemeriksa",
                 labelLocation:"top",
                 colSpan:2,
                    items: [{
                            dataField: "signatureAdminSchoolId",
                            label:{text: "Dinas Pendidikan",}, 
                            editorType: "dxSelectBox",
                            editorOptions: { 
                                dataSource: datasignaturePemeriksaSource,
                                displayExpr: "nama",
                                valueExpr: "id",
                                searchEnabled: true,
                                onValueChanged: function (data) {
                                     updateSignature(data.value,"signatureAdminSchoolId");
                                 }
                                
                                },
                                validationRules: [{
                                type: "required",
                                message: "Pemeriksa Harus Di Isi"
                                }]
                            },
                            {
                            dataField: "signatureAdminId",
                            label:{text: "Biro Keuangan",}, 
                            editorType: "dxSelectBox",
                            editorOptions: { 
                                dataSource: datasignaturePemeriksaKeuanganSource,
                                displayExpr: "nama",
                                valueExpr: "id",
                                searchEnabled: true,
                                onValueChanged: function (data) {
                                     updateSignature(data.value,"signatureAdminId");
                                 }
                                },
                                validationRules: [{
                                type: "required",
                                message: "Pemeriksa Harus Di Isi"
                                }]
                            },

                           ]
                        }, 
                    ]
                },
               
                
                );
});

var SERVICE_URL  = '<?php echo base_url('api/bos')?>';


//var URL = "<?php echo base_url('api/bos')?>";

   





function numberBoxEditorTemplate(cellElement, cellInfo){
    return $("<div>").dxNumberBox({
        value: cellInfo.value,
        format: "#,##0",
        onValueChanged: function(e) {
                cellInfo.setValue(e.value)
            },
    })
}
function isEntry(idNo){
    return true;
}

function sendBatchRequest(url, changes) {
        var d = $.Deferred();

        $.ajax(url, {
            method: "POST",
            data: JSON.stringify(changes),
            cache: false,
            contentType: "application/json",
            xhrFields: { withCredentials: true }
        }).done(d.resolve).fail(function (xhr) {
            d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
        });

        return d.promise();
    }


    function updateSignature(val,datafield){
        var grid = getGrid();
	    var lastIndex = 7;
        for (r = 0; r <= lastIndex; r++) {
            grid.cellValue(r, datafield, val);             
        }
    }
console.log(<?php echo $param; ?>);
</script>
<?= $this->endSection() ?>