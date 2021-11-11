
<script>
function getGridKinerja(){
    return $("#gridKinerja").dxDataGrid("instance");
}
$(function(){
    $("#gridKinerja").dxDataGrid({
        id:"gridKinerja",
        onInitialized: function(e) {
        dataGrid = e.component;
        },
        dataSource:  SERVICE_URL+"/2",
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

    });
   

});
</script>