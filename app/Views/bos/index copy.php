<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
                 Data Rekapitulasi Dana Bantuan Operasional Sekolah 
			</div>
			<div class="card-body">
            
            <div id="tabpanel-container"></div>
                <div id="gridRegular"></div>

            </div>
            
        </div>

    </div>
</dv>

<div id="popup"></div>
<script>
 var tabPanel = $("#tabpanel-container").dxTabPanel({
        height: 260,
        selectedIndex: 0,
        loop: false,
        animationEnabled: true,
        swipeEnabled: true,
        items: [
            { title:"Bos Regular",
            },
            { title:"Bos Kinerja",
            },
            { title:"Bos Afirmasi",
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

function getGrid(){
    return $("#gridRegular").dxDataGrid("instance");
}

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
            // const message = `Email is sent to `;
            // DevExpress.ui.notify({
            //   message: message,
            //   position: {
            //     my: "center top",
            //     at: "center top"
            //   }
            // }, "success", 3000);
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


   

 $(function(){
    $("#gridRegular").dxDataGrid({
        onInitialized: function(e) {
        dataGrid = e.component;
        },
        dataSource:  SERVICE_URL+"/"+getType(),
        keyExpr: "id",
        columns: [ { 
            width: "auto", 
            cellTemplate: function(container, options) { 
                container.text(dataGrid.pageIndex() * dataGrid.pageSize() + options.rowIndex+1); 
            } 
        },
             { dataField: "id",
                      visible:false },
                      {dataField:"sekolah",width:"auto"}, {dataField:"kota",width:"auto"},
                      {dataField: "kecamatan",width:150}, "year",
                      {dataField:"jnsDokumen",width:"auto"}, 
                {dataField:"dataLock",
                 caption:"Status",
                  allowSorting: false,
                alignment :"center",
                           },
                      "userInput","userUpdate",
                      {type:"buttons",
                        buttons:[{
                            hint: "edit",
                            icon: "edit",
                            visible:function(e){
                                return !isLock(e.row.data.dataLock);
                            },
                            onClick: function(e) {
                                processEdit(e.row.data.id);
                                
                            }
                        }]
                    
                    }],
        allowColumnResizing: true,
        selection: {
            mode: "single"
        },
        showBorders: true,
        searchPanel: {
            visible: true
        },
        filterRow: {
            visible: true
        },
        headerFilter: {
            visible: true,
            allowSearch:true,
        },
        rowAlternationEnabled:true,
        onToolbarPreparing : function(e) {
		var dtGrid = e.component;
		e.toolbarOptions.items.unshift(
			
            {
                location:"before",
                template: function () {
					return "<div class='toolbar-label'>Rekening:</div>";
                }
            },
            {
                location :"before",
                widget:"dxSelectBox",
                options:{
                    dataSource: tipeRek,
                     displayExpr: "Name",
                     valueExpr: "ID",
                     value: 1,
                     elementAttr: { id: "select-rek" },
                     onValueChanged :function (e) {
                       
                        selectedRek = $("#select-rek").dxSelectBox("instance").option("value"); 


				
							getGrid().option("dataSource", SERVICE_URL+"/"+getType());
                            getGrid().refresh();
					
					 }
                }
            },

			{
				location: "before",
				widget: "dxButton",
				options: {
					hint: "Open",
					icon: "activefolder",
					text: "Refresh",
					type:"default",
					 onClick: function (e) {
                        selectedRek = $("#select-rek").dxSelectBox("instance").option("value"); 
                        getGrid().option("dataSource", SERVICE_URL+"/"+getType());
                        getGrid().refresh();
					
                     }
				}
			},
			{
				location: "before",
				widget: "dxButton",
				options: {
					hint: "Tambah",
					icon: "plus",
					text: "Tambah Data",
					type:"success",
                    onClick: function() {
                       
                        popup=$("#popup").dxPopup("instance");
                        popup.show();
                    }
					//  onClick: function (e) {
                    //     selectedRek = $("#select-rek").dxSelectBox("instance").option("value"); 
                    //     getGrid().option("dataSource", SERVICE_URL+"/"+getType());
                    //     getGrid().refresh();
					
                    //  }
				}
			},




		);
	}
    });
   

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
        redirUrl = '<?php echo base_url('inputbos/inputnew')?>'+"/"+tipeRek+"/"+idSekolah+"/"+idrek+"/"+idyear;
                   window.location.href = redirUrl;
                   // console.log(redirUrl);          
    }

    function processNew(){
        var tipeRek =  $("#select-rek").dxSelectBox("instance").option("value");
        var idSekolah = $("#newBranchId").dxSelectBox("instance").option("value");
        var idrek = $("#newIdRek").dxSelectBox("instance").option("value");
        var idyear = $("#newYear").dxNumberBox("instance").option("value");
        var urlCek =  '<?php echo base_url('api/mylibs/cekTrreportExist')?>'+"/"+tipeRek+"/"+idSekolah+"/"+idrek+"/"+idyear;
        $.getJSON( urlCek, function( data ){
            if(data){
                if( data[0].dataLock==1){
                     DevExpress.ui.notify({
                    message: "Tidak Bisa Menambah Data Sudah Terkunci",
               
                 }, "error", 6000);
                }else{
                    redirUrl = '<?php echo base_url('inputbos/inputnew')?>'+"/"+tipeRek+"/"+idSekolah+"/"+idrek+"/"+idyear;
                    window.location.href = redirUrl;
                }
            }else{
                    redirUrl = '<?php echo base_url('inputbos/inputnew')?>'+"/"+tipeRek+"/"+idSekolah+"/"+idrek+"/"+idyear;
                    window.location.href = redirUrl;
                }
           // console.log( "JSON Data: " + data[0].dataLock);
        }) 
    }
</script>
<?= $this->endSection() ?>