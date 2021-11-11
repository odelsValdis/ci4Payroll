<script>
  var bosKinerjaStore = new DevExpress.data.CustomStore({
        key: "id",
        load: function() {
            return $.getJSON(SERVICE_URL+"/getTrreportnew/2/"+<?php echo $branchId ?>+"/"+<?php echo $idValue ?>+"/"+<?php echo $idYear ?>); 
           // return sendRequest(URL + "/getTrreport/"+$param);
        },
        insert: function(values) {
            return sendRequest(SERVICE_URL + "/InsertOrder", "POST", {
                values: JSON.stringify(values)
            });
        },
        update: function(key, values) {
            return $.ajax({
                url: SERVICE_URL + "/updateTrreport/2/"+<?php echo $branchId ?>+"/"+<?php echo $idValue ?>+"/"+<?php echo $idYear ?>,
             method: "POST",
             data: values,
         });
            
        },
        remove: function(key) {
            return sendRequest(SERVICE_URL + "/DeleteOrder", "DELETE", {
                key: key
            });
        }
    });


$(function(){
    $("#gridKinerja").dxDataGrid({
        dataSource:bosKinerjaStore,
      
        editing: {
            mode: "batch",
            allowUpdating: true,
            selectTextOnEditStart:true,

        },
    //    remoteOperations: true,
        repaintChangesOnly: true,
        onRowUpdating: function(options) {  
                options.newData = $.extend({}, options.oldData, options.newData);  
        }  ,
        showRowLines:true,

        sorting: {
            mode: "none"
        },
        onCellPrepared: function(e) {
            if(e.rowType === "data"){
                
                if( e.column.dataField === "name") {
                e.cellElement.css("color", e.data.color);
                }

                if(e.data.id===901||e.data.id===902||e.data.id===903||e.data.id===904){
                    e.cellElement.css("background-color","#dadada");
                    e.cellElement.css('font-weight', 'bold');
                }

                if(e.column.dataField === "amount"&&(e.data.id==="9"||e.data.id==="10"
            ||e.data.id==="250"||e.data.id==="258"||e.data.id==="410"||e.data.id==="420"||e.data.id===901)){
                e.cellElement.css("background-color","#dadada");
                e.cellElement.css("color","#dadada");
                    e.cellElement.css('font-weight', 'bold');
            }
            if(e.column.dataField === "amount2"&&(e.data.id==="4"||e.data.id==="5")){
                e.cellElement.css("background-color","#dadada");
                    e.cellElement.css('font-weight', 'bold');
                    e.cellElement.css("color","#dadada");
            }
            if(e.column.caption==="Selisih"&&(e.data.id===901||e.data.id===902||e.data.id===903||e.data.id===904)){
                e.cellElement.css("background-color","#dadada");
                    e.cellElement.css('font-weight', 'bold');
                    e.cellElement.css("color","#dadada");
            }

               
               
            }
        },
        onEditorPreparing: function(e) {
            if(e.parentType === "dataRow" && e.dataField === "amount" &&( e.row.data.id===901||e.row.data.id===902||e.row.data.id===903||e.row.data.id===904)) {
                e.editorOptions.readOnly = true;
            }
            if(e.parentType === "dataRow" && e.dataField === "amount" &&( e.row.data.id==="9"||e.row.data.id==="10"
            ||e.row.data.id==="250"||e.row.data.id==="258"||e.row.data.id==="410"||e.row.data.id==="420")) {
                e.editorOptions.readOnly = true;
            }
            if(e.parentType === "dataRow" && e.dataField === "amount2" &&( e.row.data.id==="4"||e.row.data.id==="5"
            )) {
                e.editorOptions.readOnly = true;
            }

            
        },
        onEditorPrepared(e){
			var idEdit= e.row.data.id;
			var row82 =0;
			var row91 =0;
			var row92 =0;
			var row101 =0;
			var row102 =0;
			var row111 =0;
			var row112 =0;
            var result=0;
            var grid = getGridKinerja();
			 var lastIndex = 7;
             let rows =  grid.getVisibleRows();
			   if(e.dataField.substring(0, 6)=="amount"){
                var field = e.dataField
				$(e.editorElement).dxNumberBox("instance").on("valueChanged", function (args) {
					for (r = 0; r <= lastIndex; r++) {
								let row = rows[r];
								let idRow = row.data["id"];
								
								if(idRow==="4"){
								row91 += idEdit==="4"?parseInt(args.value):parseInt(row.data["amount"]);
								row92 += idEdit==="4"?parseInt(args.value):parseInt(row.data["amount"]);
								row101 += idEdit==="4"?parseInt(args.value):parseInt(row.data["amount"]);
								row102 += idEdit==="4"?parseInt(args.value):parseInt(row.data["amount"]);
								}
								if(idRow==="5"){
								row91 += idEdit==="5"?parseInt(args.value):parseInt(row.data["amount"]);
								row92 += idEdit==="5"?parseInt(args.value):parseInt(row.data["amount"]);
								//row101 += idEdit==="5"?parseInt(args.value):parseInt(row.data[field]);
								row111 += idEdit==="5"?parseInt(args.value):parseInt(row.data["amount"]);
								row112 += idEdit==="5"?parseInt(args.value):parseInt(row.data["amount"]);
								}
								if(idRow==="9"){
								row102 -= idEdit==="9"?parseInt(args.value):parseInt(row.data["amount2"]);
								row112 += idEdit==="9"?parseInt(args.value):parseInt(row.data["amount2"]);
								}
								if(idRow==="10"){
								row102 += idEdit==="10"?parseInt(args.value):parseInt(row.data["amount2"]);
								row112 -= idEdit==="10"?parseInt(args.value):parseInt(row.data["amount2"]);
								}
								if(idRow==="250"){
								row82 += idEdit==="250"?parseInt(args.value):parseInt(row.data["amount2"]);
								row112 -= idEdit==="250"?parseInt(args.value):parseInt(row.data["amount2"]);
								}
								if(idRow==="258"){
								row82 += idEdit==="258"?parseInt(args.value):parseInt(row.data["amount2"]);
								row112 -= idEdit==="258"?parseInt(args.value):parseInt(row.data["amount2"]);
								}
								if(idRow==="410"){
								row82 += idEdit==="410"?parseInt(args.value):parseInt(row.data["amount2"]);
								row112 -= idEdit==="410"?parseInt(args.value):parseInt(row.data["amount2"]);
								}
								if(idRow==="420"){
								row82 += idEdit==="420"?parseInt(args.value):parseInt(row.data["amount2"]);
								row112 -= idEdit==="420"?parseInt(args.value):parseInt(row.data["amount2"]);
								}
					}
					
					 grid.cellValue(8, "amount2", row82);
						grid.cellValue(9, "amount", row91);
						grid.cellValue(9, "amount2", row92);
						grid.cellValue(10, "amount", row101);
						grid.cellValue(10, "amount2", row102);
						grid.cellValue(11, "amount", row111);
						grid.cellValue(11, "amount2", row112);
				
				});
			   }
        },
		onRowUpdating: function(e) {
			  e.newData = $.extend({}, e.oldData, e.newData);  
			 const deferred = $.Deferred();
			  var grid = getGridKinerja();
			  var saldo1 = parseInt(grid.cellValue(11, "amount2"));
			  
			  if(saldo1!=0){
				  //DevExpress.ui.notify("sisa saldo Tunai belum 0", "error", 600);
				   var erText ="";
				   
				   deferred.reject("Sisa saldo Tunai"+erText+" belum 0");
				  deferred.resolve(true);
			  }else{
				  deferred.resolve(false);
			  }
			   e.cancel = deferred.promise();
		 },
        onToolbarPreparing : function(e) {
		var dtGrid = e.component;
		e.toolbarOptions.items.unshift(
			
            
           

			{
				location: "before",
				widget: "dxButton",
				options: {
					hint: "Open",
					icon: "arrowleft",
					text: "Batal",
					type:"default",
					 onClick: function (e) {
                        let backUrl = "<?php echo base_url()?>"+"/inputbos";
                        window.location.replace(backUrl);
					
                     }
				}
			},
			




		);
	},
    
        columns: [
                    {
                        dataField:"id",
                        caption:"ID",
                        visible:false
                    },
                    {  
                        caption: 'No',  
                        cellTemplate: function(cellElement, cellInfo) {  
                            cellElement.text(cellInfo.row.rowIndex+1)  
                        } ,
                        width:30, 
                    },
                    {
                        dataField:"name",
                        allowEditing:false,
                        caption:"Uraian",
                        width:250,    
                    },
                    {
                        cssClass: "number",  
                        dataField:"amount",
                        caption:"Jumlah Anggaran RKAS",
                        dataType:"number",
                        editorOptions:{min:0},
                        // editCellTemplate: numberBoxEditorTemplate,
                        format: {
                                    type: "fixedPoint",
                                    precision: 0
                                },
                    },
                    {
                        cssClass: "number", 
                        dataField:"amount2",
                        caption:"Realisasi Sisa Dana BOS (Rp)",
                        dataType:"number",
                        editorOptions:{min:0},
                        //editCellTemplate: numberBoxEditorTemplate,
                        format: {
                                    type: "fixedPoint",
                                    precision: 0
                                },
                    },
                    
                    {
                        cssClass: "number", 
                        caption: "Selisih",
                        dataType:"number", 
                        calculateCellValue: function(rowData) {
                            return  parseInt(rowData.amount) +  parseInt(rowData.amount2);
                        },
                        format: {
                                    type: "fixedPoint",
                                    precision: 0
                                },
                    },

                    {
                        dataField:"signatureSchoolHeadId",
                        caption:"Kepalasekolah",
                        visible:false,
                        
                    },
                    {
                        dataField:"signatureSchoolId",
                        caption:"Bendahara",
                        visible:false,
                    },
                    
                    {
                        dataField:"signatureAdminSchoolId",
                        caption:"dinas",
                        visible:false,
                    },
                    {
                        dataField:"signatureAdminId",
                        caption:"Biro keu",
                        visible:false,
                    },
        ]
    })
})
function getGridKinerja(){
    return $("#gridKinerja").dxDataGrid("instance");
}

</script>