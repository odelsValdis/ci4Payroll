<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				Monitoring Data BOS
			</div>
			<div class="card-body">
            
                <div id="gridDashboard"></div>

            </div>
            
        </div>

    </div>
</dv>


<script>
var SERVICE_URL = '<?php echo base_url('api/dashboard/get')?>';
var SERVICE_URL_KAB = '<?php echo base_url('api/dashboard/getKab')?>';
var tipeRek =[{
    "ID": 1,
    "Name": "Bos Reguler"},
    {
    "ID": 2,
    "Name": "Bos Afirmasi"},
    {
    "ID": 1,
    "Name": "Bos Kinerja"}
];
var selectedDateStart,selectedRek;

function getGrid(){
    return $("#gridDashboard").dxDataGrid("instance");
}


 $(function(){
    $("#gridDashboard").dxDataGrid({
        dataSource: SERVICE_URL+"/"+getYear()+"/"+getType(),
        
        columns: [
                    {
                        dataField:"branchParentId",
                        caption:"ID",
                        visible:false,
                    },
                    {
                        dataField:"branchName",
                        caption:"Kota/Kabupaten"
                    },
                    {
                        dataField:"cnt",
                        caption:"Jumlah Sekolah",
                        dataType: "number",
                        alignment: "right",
                    },
                    {
                        dataField:"b1",
                        caption:"Tahun Berjalan",
                        dataType: "number",
                        alignment: "right",
                    },
                    {
                        dataField:"b2",
                        caption:"Tahun N-1",
                        dataType: "number",
                        alignment: "right",
                    },
                    {
                        dataField:"r1",
                        caption:"Sisa Tahun Berjalan",
                        dataType: "number",
                        alignment: "right",
                    },
                    {
                        dataField:"r2",
                        caption:"Sisa Tahun N-1",
                        dataType: "number",
                        alignment: "right",
                    },


                ],
            summary: {
            totalItems: [{
                column: "cnt",
                summaryType: "sum",
                customizeText: function(data) {
                    return "Jumlah: " + data.value;
                }
            }, {
                column: "b1",
                summaryType: "sum",
                customizeText: function(data) {
                    return "Jumlah: " + data.value;
                }
            }, {
                column: "b2",
                summaryType: "sum",
                customizeText: function(data) {
                    return "Jumlah: " + data.value;
                }
            }, {
                column: "r1",
                summaryType: "sum",
                customizeText: function(data) {
                    return "Jumlah: " + data.value;
                }
            }, {
                column: "r2",
                summaryType: "sum",
                customizeText: function(data) {
                    return "Jumlah: " + data.value;
                }
            }]
        }, 
    
        masterDetail: {
            enabled: true,
            template: function(container, options) { 
                var currentKabData = options.data;
                
                $("<div>")
                    .addClass("master-detail-caption")
                    .text("'Data Sekolah "+currentKabData.branchName  +":")
                    .appendTo(container);

                    $("<div>")
                    .dxDataGrid({
                        columnAutoWidth: true,
                        showBorders: true,
                        columns: [
                        { caption: '#',  
                            cellTemplate: function(cellElement, cellInfo) {  
                             cellElement.text(cellInfo.row.rowIndex+1)  
                                }  
                          },
                        {
                            caption:"Nama Sekolah",
                            dataField: "branchName",
                           
                        }, {caption:"Tahun Berjalan",
                            dataField: "b1",
                            dataType: "number",
                            alignment: "right",
                        }, {
                            caption:"Tahun N-1",
                            dataField: "b2",
                            dataType: "number",
                            alignment: "right",
                        }],
                        dataSource: SERVICE_URL_KAB+"/"+getYear()+"/"+getType()+"/"+currentKabData.branchParentId,
                        showRowLines:true,
                        filterRow: {
                            visible: true
                        },
                        headerFilter: {
                            visible: true
                        },
                        onCellPrepared: function(e){
                        var CompelteColor = "#008000";
                        if (e.rowType == "data") {
                            
                            if (e.data.b1 == 1) {
                                if (e.column.dataField == "b1") {
                                    e.cellElement.css("background-color", "#84f811");
                                    e.cellElement.css("color", "#84f811");
                                }
                                }else{
                                if (e.column.dataField == "b1") {
                                    e.cellElement.css("background-color", "white");
                                    e.cellElement.css("color", "white");
                                }
                            }
                            if (e.data.b2 == 1) {
                                if (e.column.dataField == "b2") {
                                    e.cellElement.css("background-color", "#84f811");
                                    e.cellElement.css("color", "#84f811");
                                }
                                }else{
                                if (e.column.dataField == "b2") {
                                    e.cellElement.css("background-color", "white");
                                    e.cellElement.css("color", "white");
                                }
                            }
                        
                        }
                    
                        },
                        
                    }).appendTo(container);
            }
        },      
       
        filterRow: {
            visible: true
        },
        headerFilter: {
            visible: true
        },
        rowAlternationEnabled:false,
        showRowLines:true,
        scrolling: {
            mode: "virtual"
        },
        height: 500,
        showBorders: true,
        onCellPrepared: function(e){
        var CompelteColor = "#008000";
		if (e.rowType == "data") {
            
            if (e.data.r1 == 0) {
                if (e.column.dataField == "r1") {
                    e.cellElement.css("background-color", "#84f811");
                }
                }else{
                if (e.column.dataField == "r1") {
                    e.cellElement.css("background-color", "white");
                }
            }
            if (e.data.r2 == 0) {
                if (e.column.dataField == "r2") {
                    e.cellElement.css("background-color", "#84f811");
                }
                }else{
                if (e.column.dataField == "r2") {
                    e.cellElement.css("background-color", "white");
                }
            }
        
         }
    
        },
        export: {
      enabled: true,
      allowExportSelectedData: false
    },
        onExporting: function(e) {
      var workbook = new ExcelJS.Workbook();
      var worksheet = workbook.addWorksheet('MonitoringBos');
      
      DevExpress.excelExporter.exportDataGrid({
        component: e.component,
        worksheet: worksheet,
        topLeftCell: { row: 4, column: 1 },
        autoFilterEnabled: true
      }).then(function() {
        // header
        var headerRow = worksheet.getRow(2);
        headerRow.height = 30;
        worksheet.mergeCells(2, 1, 2, 8);

        headerRow.getCell(1).value = 'Monitoring '+$("#select-rek").dxSelectBox("instance").option("text")+' Tahun :'+ $("#select-month").dxDateBox("instance").option("text");
        headerRow.getCell(1).font = { name: 'Segoe UI Light', size: 22 };
        headerRow.getCell(1).alignment = { horizontal: 'center' };

        workbook.xlsx.writeBuffer().then(function(buffer) {
          saveAs(new Blob([buffer], { type: 'application/octet-stream' }), $("#select-month").dxDateBox("instance").option("text")+'.xlsx');
        });
      });
      e.cancel = true;
    },
        
        onToolbarPreparing : function(e) {
		var dtGrid = e.component;
		e.toolbarOptions.items.unshift(
			{
				location: "before",
				template: function () {
					return "<div class='toolbar-label'>Tahun:</div>";

				},



			},



			{

				location: "before",
				widget: "dxDateBox",
				options: {

					value: new Date(),
					displayFormat: "yyyy",
					elementAttr: { id: "select-month" },
					calendarOptions: {
						minZoomLevel: "decade",
						maxZoomLevel: "decade",
						value: new Date()

					},

				}
			},
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
                        selectedDateStart = $("#select-month").dxDateBox("instance").option("value");
                        selectedRek = $("#select-rek").dxSelectBox("instance").option("value"); 


				
							getGrid().option("dataSource", SERVICE_URL+"/"+getYear()+"/"+getType());
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
                        selectedDateStart = $("#select-month").dxDateBox("instance").option("value");
                        selectedRek = $("#select-rek").dxSelectBox("instance").option("value"); 


				
							getGrid().option("dataSource", SERVICE_URL+"/"+getYear()+"/"+getType());
                            getGrid().refresh();
					
					 }
				}
			},
			




		);
	}
    });
});  

function getYear() {
   
    if(selectedDateStart){
        return toymd(selectedDateStart); 
    }
    return 2021;
  }

  function getType() {
    
    if(selectedRek){
        return selectedRek;
    }
     return 1;
    }

    function toymd(d) {

if (d instanceof Date) {

    let date = ("0" + d.getDate()).slice(-2);


    let month = ("0" + (d.getMonth() + 1)).slice(-2);


    let year = d.getFullYear().toString();


    return year ;
} else {

    return toymd(new Date(d));

}
}


function masterDetailTemplate(_, masterDetailOptions) {
    return $("<div>").dxTabPanel({
        items: [{
            title: "Orders",
            template: createOrdersTabTemplate(masterDetailOptions.data)
        }, {
            title: "Address",
            template: createAddressTabTemplate(masterDetailOptions.data),
        }]
    });
}		

    </script>
<?= $this->endSection() ?>