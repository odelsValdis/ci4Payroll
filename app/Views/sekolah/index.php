<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				Data Sekolah
			</div>
			<div class="card-body">
            
                <div id="gridSekolah"></div>

            </div>
            
        </div>

    </div>
</dv>
<script>
var SERVICE_URL = '<?php echo base_url('api/sekolah')?>';

var lookupDataKotaSource = {
        store: new DevExpress.data.CustomStore({
            key: "id",
            loadMode: "raw",
            load: function() {
                // Returns an array of objects that have the following structure:
                // { id: 1, name: "John Doe" }
                return $.getJSON("<?php echo base_url('api/kota')?>");
            }
        }),
        sort: "branchName"
    }

    var lookupDataTingkatSource = {
        store: new DevExpress.data.CustomStore({
            key: "id",
            loadMode: "raw",
            load: function() {
                // Returns an array of objects that have the following structure:
                // { id: 1, name: "John Doe" }
                return $.getJSON("<?php echo base_url('api/mylibs/gettingkatall')?>");
            }
        }),
        sort: "tingkat"
    }
var sekolahStore =     new DevExpress.data.CustomStore({
    key: "id",
     load: function(loadOptions) {
         return $.getJSON(SERVICE_URL);
     },
  
     byKey: function(key) {
         return $.getJSON(SERVICE_URL + "/" + encodeURIComponent(key));
     },
  
     insert: function(values) {
         return $.post(SERVICE_URL, values);
     },
  
     update: function(key, values) {
         return $.ajax({
             url: SERVICE_URL + "/" +  encodeURIComponent(key),
             method: "PUT",
             data: values,
         });
     },
  
     remove: function(key) {
         return $.ajax({
             url: SERVICE_URL + "/" + encodeURIComponent(key),
             method: "DELETE",
         });
     }
  
 });


 $(function(){
    $("#gridSekolah").dxDataGrid({
        dataSource: sekolahStore,
         editing: {
            mode: "batch",
            allowUpdating: true,
            allowAdding: true,
            allowDeleting: true,
            popup: {
                title: "Sekolah Info",
                showTitle: true,
                width: 500,
                height: 280
            },
            form: {
                colCount: 2,
                items: [{
                    dataField:"id",

                    colSpan: 2,
                    editorOptions: 
                        {
                            width: "20%",
                         disabled: true
                        },
                
                    },
                    {
                        dataField:"branchName",
                        caption:"Nama Sekolah",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                        validationRules: [{
                        type: "required",
                        message: "Nama Sekolah Harus diisi"
                        }]
                    
                    },
                    {
                        dataField:"branchParentId",
                        caption:"kota/Kabupaten",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                        validationRules: [{
                        type: "required",
                        message: "Kota/Kabupaten Harus diisi"
                        }]
                    
                    },{
                        dataField:"remark",
                        caption:"Kecamatan/Kelurahan",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                        validationRules: [{
                        type: "required",
                        message: "Kecamatan/kelurahan Harus diisi"
                        },
                        
                        ]
                    
                    },
                    {
                        dataField:"idTingkat",
                        caption:"Tingkat Sekolah",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                    }
                ]
            }
        },
        columns: [
                    {
                        dataField:"id",
                        caption:"ID"
                    },
                    {
                        dataField:"branchName",
                        caption:"Nama Sekolah"
                    },
                    {
                        dataField:"branchParentId",
                        caption:"Kota/Kabupaten",
                        groupIndex: 0,
                        lookup: {
                            dataSource: lookupDataKotaSource,
                            displayExpr: "branchName",
                            valueExpr: "id"
                        }
                    },
                    {
                        dataField:"remark",
                        caption:"Kecamatan/Kelurahan"
                    },
                    {
                        dataField:"idTingkat",
                        caption:"Tingkat",
                        lookup: {
                            dataSource: lookupDataTingkatSource,
                            displayExpr: "tingkat",
                            valueExpr: "id"
                        }
                    },

                ],
                summary: {
                groupItems: [{
                column: "branchName",
                summaryType: "count",
                displayFormat: "Jumlah {0} sekolah ",
            }]
        },
        
        filterRow: {
            visible: true
        },
        headerFilter: {
            visible: true
        },
        rowAlternationEnabled:true,
        scrolling: {
            mode: "virtual"
        },
        height: 400,
        showBorders: true,
        grouping: {
            enabled: true,
        },
        searchPanel: {
            visible: true
        },
        groupPanel: {
            visible: true
        },
        paging: {
            pageSize: 10
        },
        pager: {
            visible: true,
            allowedPageSizes: [5, 10, 'all'],
            showPageSizeSelector: true,
            showInfo: true,
            showNavigationButtons: true
        },
        export: {
      enabled: true
    },
    onExporting: function(e) {
      var workbook = new ExcelJS.Workbook();
      var worksheet = workbook.addWorksheet('Sekolah');
      
      DevExpress.excelExporter.exportDataGrid({
        component: e.component,
        worksheet: worksheet,
        topLeftCell: { row: 4, column: 1 }
      }).then(function(cellRange) {
        // header
        var headerRow = worksheet.getRow(2);
        headerRow.height = 30;
        worksheet.mergeCells(2, 1, 2, 8);

        headerRow.getCell(1).value = 'Daftar Sekolah';
        headerRow.getCell(1).font = { name: 'Segoe UI Light', size: 22 };
        headerRow.getCell(1).alignment = { horizontal: 'center' };
        
        // footer
        var footerRowIndex = cellRange.to.row + 2;
        var footerRow = worksheet.getRow(footerRowIndex);
        worksheet.mergeCells(footerRowIndex, 1, footerRowIndex, 8);
        
        footerRow.getCell(1).value = 'www.wikipedia.org';
        footerRow.getCell(1).font = { color: { argb: 'BFBFBF' }, italic: true };
        footerRow.getCell(1).alignment = { horizontal: 'right' };
      }).then(function() {
        workbook.xlsx.writeBuffer().then(function(buffer) {
          saveAs(new Blob([buffer], { type: 'application/octet-stream' }), 'DaftarSekolah.xlsx');
        });
      });
      e.cancel = true;
    },
    });
});  


</script>
<?= $this->endSection() ?>