<?= $this->extend('layout/_layout') ?>

<?= $this->section('content') ?>
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header bg-secondary text-white">
				Data Pengguna
			</div>
			<div class="card-body">
            
                <div id="gridUser"></div>

            </div>
            
        </div>

    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Otorisasi Sekolah
            </div>
            <div class="card-body">
            <div id="gridOtoSekolah"></div>

            </div>
        </div>
    </div>
</dv>


<script>
var SERVICE_URL = '<?php echo base_url('api/user')?>';
var optStatus = [{"id": "1","Name": "Active"},{"id": "0","Name": "Non Active"}];
var optGender=[{ "ID": "1","Name": "Laki-Laki"},{"ID": "0", "Name": "Wanita"}];
var optTipeUser=[{"ID": "1","Name": "Administrator"},{"ID": "0","Name": "Operator"}];
var currIndex;
var userStore =     new DevExpress.data.CustomStore({
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

 function getGrid(){
    return $("#gridUser").dxDataGrid("instance");
}



$(function(){
    $("#gridUser").dxDataGrid({
        dataSource: userStore,
         editing: {
            mode: "popup",
            allowUpdating: true,
            allowAdding: true,
            allowDeleting: true,
            popup: {
                title: "User Info",
                showTitle: false,
                width: 700,
                height: 525
            },
            form: {
                items: [{
                    itemType: "group",
                    colCount: 2,
                    colSpan: 2,
                    caption:"User Login",
                    items: [{dataField:"email",
                            validationRule:[{type:"required"},
                                            {type:"email"},
                                            ]},
                            {dataField:"name",
                             validationRule:[{type:"required"}]},
                             {
                dataField: "password",
                editorOptions: {
                    mode: "password"
                },
                validationRules: [{
                    type: "required",
                    message: "Password is required"
                }]
            }, 
                             ]
                }, {
                    itemType: "group",
                    colCount: 2,
                    colSpan: 2,
                    caption: "User Info",
                    items: [
                        {
                            dataField:"status"
                        }, "gender",'userType']
                }]
            }
        },
        columns: [
                    {
                        dataField:"id",
                        caption:"ID",
                        visible:false,
                    },
                    {
                        dataField:"email",
                        caption:"Email"
                    },
                    {
                        dataField:"name",
                        caption:"User Name"
                    },
                    {
                        dataField:"password",
                        caption:"Password",
                        customizeText: function(cellInfo) {
                            return "*****";
                        },
                        editorOptions: {
                            mode: "password",
                           
                        },
                    },
                    {
                        dataField:"status",
                        caption:"Status",
                        lookup: {
                            dataSource: optStatus,
                            displayExpr: "Name",
                            valueExpr: "id"
                        }
                    },
                    {
                        dataField:"gender",
                        caption:"Jenis Kelamin",
                        lookup: {
                            dataSource: optGender,
                            displayExpr: "Name",
                            valueExpr: "ID"
                        }
                    },
                    {
                        dataField:"userType",
                        caption:"Tipe User",
                        lookup: {
                            dataSource: optTipeUser,
                            displayExpr: "Name",
                            valueExpr: "ID"
                        }
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
        onEditingStart : function(e){
                currIndex =e.component.getRowIndexByKey(e.key);
        },
        focusedRowEnabled: true,
        focusedRowIndex :0,
    });
});  
</script>
<?= $this->endSection() ?>