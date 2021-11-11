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
        onRowUpdating: function(e) {
			  e.newData = $.extend({}, e.oldData, e.newData);  
			 const deferred = $.Deferred();
			  var grid = getGridKinerja();
			  var saldo1 = parseInt(grid.cellValue(11, "amount"));
			   var saldo2 = parseInt(grid.cellValue(11, "amount2"));
			   var saldo3 = parseInt(grid.cellValue(11, "amount3"));
			  if(saldo1!=0||saldo2!=0||saldo3!=0){
				  //DevExpress.ui.notify("sisa saldo Tunai belum 0", "error", 600);
				   var erText ="";
				   if(saldo1!=0)erText +=" (Tri 1)";
				   if(saldo2!=0)erText +=" (Tri 2)";
				   if(saldo3!=0)erText +=" (Tri 3)";
				   deferred.reject("Sisa saldo Tunai"+erText+" belum 0");
				  deferred.resolve(true);
			  }else{
				  deferred.resolve(false);
			  }
			   e.cancel = deferred.promise();
		 },
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

                // if(e.data.id===901||e.data.id===902||e.data.id===903||e.data.id===904){
                //     if(e.column.dataField === "amount"||e.column.dataField === "amount2"||e.column.dataField === "amount3"){
                //         e.cellElement.readOnly(true);
                //     }
                // }
                // Tracks the `Amount` data field
               
            }
        },
        onEditorPreparing: function(e) {
            if(e.parentType === "dataRow" && e.dataField === "amount" &&( e.row.data.id===901||e.row.data.id===902||e.row.data.id===903||e.row.data.id===904)) {
                e.editorOptions.readOnly = true;
            }
            
        },
        onEditorPrepared(e){
			var idEdit= e.row.data.id;
            var result=0;
			var row8 =0;
			var row9 =0;
			var row10 =0;
			var row11 =0;
            if(e.dataField.substring(0, 6)=="amount"){
                var field = e.dataField
                var grid = getGrid();
			     var lastIndex = 7;
                let rows =  grid.getVisibleRows();
                      $(e.editorElement).dxNumberBox("instance").on("valueChanged", function (args) {
					               
					  for (r = 0; r <= lastIndex; r++) {
						    let row = rows[r];
                            let idRow = row.data["id"];
							if(idRow==="250"){
								
								row8 += idEdit==="250"?parseInt(args.value):parseInt(row.data[field]);
								row11 -=idEdit==="250"?parseInt(args.value):parseInt(row.data[field]);
							}
							
							if(idRow==="258"){
								
								row8 += idEdit==="258"?parseInt(args.value):parseInt(row.data[field]);
								row11 -=idEdit==="258"?parseInt(args.value):parseInt(row.data[field]);
							}
							if(idRow==="410"){
								
								row8 += idEdit==="410"?parseInt(args.value):parseInt(row.data[field]);
								row11 -=idEdit==="410"?parseInt(args.value):parseInt(row.data[field]);
							}
							
							
							if(idRow==="420"){
								
								row8 += idEdit==="420"?parseInt(args.value):parseInt(row.data[field]);
								row11 -=idEdit==="420"?parseInt(args.value):parseInt(row.data[field]);
							}
							
							
							if(idRow==="3"){
								
								row9 += idEdit==="3"?parseInt(args.value):parseInt(row.data[field]);
								//row10 += idEdit==="3"?parseInt(args.value):parseInt(row.data[field]);
								
							}
							if(idRow==="4"){
								row9 -= idEdit==="4"?parseInt(args.value):parseInt(row.data[field]);
								row10 += idEdit==="4"?parseInt(args.value):parseInt(row.data[field]);
							}
							if(idRow==="9"){
								row10 -= idEdit==="9"?parseInt(args.value):parseInt(row.data[field]);
								row11 +=idEdit==="9"?parseInt(args.value):parseInt(row.data[field]);
							}
							if(idRow==="10"){
								row11 -= idEdit==="10"?parseInt(args.value):parseInt(row.data[field]);
								row10 +=idEdit==="10"?parseInt(args.value):parseInt(row.data[field]);
							}
					   }
					    
					 
					  
					   
					   
					   
					    grid.cellValue(8, field, row8);
						grid.cellValue(9, field, row9);
						grid.cellValue(10, field, row10);
						grid.cellValue(11, field, row11);

		   
						
						 
						 
						 
                        
                       
                        
                           
                        } 

                    )}
                    
                
            
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
                        caption:"Realisasi Dana Bos Tahap I (Rp)",
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
                        caption:"Realisasi Dana Bos Tahap II (Rp)",
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
                        dataField:"amount3",
                        caption:"Realisasi Dana Bos Tahap III (Rp)",
                       // editCellTemplate: numberBoxEditorTemplate,
                       dataType:"number", 
                       editorOptions:{min:0},
                       format: {
                                    type: "fixedPoint",
                                    precision: 0
                                },
                    },
                    {
                        cssClass: "number", 
                        caption: "Jumlah",
                        dataType:"number", 
                        calculateCellValue: function(rowData) {
                            return  parseInt(rowData.amount) +  parseInt(rowData.amount2)+ parseInt(rowData.amount3);
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