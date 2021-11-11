<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				Kabupaten Kota
			</div>
			<div class="card-body">
            
                <div id="gridKota"></div>

            </div>
            
        </div>

    </div>
</dv>


<script>
var SERVICE_URL = '<?php echo base_url('api/kota')?>';

var kotaStore =     new DevExpress.data.CustomStore({
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
    $("#gridKota").dxDataGrid({
        dataSource: kotaStore,
         editing: {
            mode: "popup",
            allowUpdating: true,
            allowAdding: true,
            allowDeleting: true,
            popup: {
                title: "Kota /Kabupaten Info",
                showTitle: true,
                width: 350,
                height: 200
            },
            form: {
                colCount: 2,
                items: [{
                    dataField:"id",

                    colSpan: 2,
                    editorOptions: 
                        {
                            width: "20%",
                         disabled: false
                        },
                
                    },
                    {
                        dataField:"branchName",
                        colSpan: 2,
                        editorOptions: 
                        {
                            width: "100%"
                        
                        },
                    
                    }]
            }
        },
        columns: [
                    {
                        dataField:"id",
                        caption:"ID"
                    },
                    {
                        dataField:"branchName",
                        caption:"Kota/Kabupaten"
                    }

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