<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				Penanda Tangan
			</div>
			<div class="card-body">
            
                <div id="gridSign"></div>

            </div>
            
        </div>

    </div>
</dv>


<script>
var SERVICE_URL = '<?php echo base_url('api/signature')?>';
var optTipeUser=[{"id": "1","Name": "Tim BPKAD"},{"id": "2","Name": "Tim Dinas Pendidikan"},{"id": "3","Name": "Kepala Sekolah"},{"id": "4","Name": "Bendahara Sekolah"}];
var lookupDataSekolahSource = {
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
var signStore =     new DevExpress.data.CustomStore({
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
    $("#gridSign").dxDataGrid({
        dataSource: signStore,
         editing: {
            mode: "popup",
            allowUpdating: true,
            allowAdding: true,
            allowDeleting: true,
            popup: {
                title: "PenandaTangan",
                showTitle: true,
                width: 350,
                height: 300
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
                        dataField:"nip",
                        caption:"NIP",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                    
                    },
                    {
                        dataField:"nama",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                    
                    },
                    {
                        dataField:"typeId",
                        colSpan: 2,
                        
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                    
                    },
                    {
                        dataField:"branchId",
                        colSpan: 2,
                        
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                    
                    },
                ]
            }
        },
        columns: [
                    {
                        dataField:"id",
                        caption:"ID"
                    },
                    {
                        dataField:"nip",
                        caption:"NIP"
                    },
                    {
                        dataField:"nama",
                        caption:"Nama"
                    },
                    {
                        dataField:"typeId",
                        caption:"Tipe Penandatangan",
                        lookup: {
                            dataSource: optTipeUser,
                            displayExpr: "Name",
                            valueExpr: "id"
                        },
                    },
                    {
                        dataField:"branchId",
                        caption:"Nama Sekolah",
                        lookup: {
                            dataSource: lookupDataSekolahSource,
                            displayExpr: "branchName",
                            valueExpr: "id"
                        },
                    },

                ],
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
        height: 300,
        showBorders: true,
    });
});  
</script>
<?= $this->endSection() ?>