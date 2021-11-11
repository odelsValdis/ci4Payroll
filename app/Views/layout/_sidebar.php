
<div id="menu-treeview"></div>
<script>


// $(function() {

//         let apimodul = "<?php echo base_url('api/mylibs/getsidemenu')?>";
//         $("#menu-treeview").dxTreeView({
//             // ...
//             dataSource: function() {
//               return  $.getJSON(apimodul);
//         }
//             })
//     });


// let apimodul = "<?php echo base_url('api/mylibs/getsidemenu/20')?>";
let url = $(location).attr('href');
let urlKey = url.replace(/\/\s*$/, "").split('/').pop();
console.log(urlKey)
var treeView = $("#menu-treeview").dxTreeView({ 
        dataSource: "<?php echo base_url('api/mylibs/getTreeMenu/')?>"+"/"+urlKey,
        dataType: "json",
        parentIdExpr: "parentId",
        keyExpr: "id",
        displayExpr: "text",
       // dataStructure:"plain",
        
       // width: 700,
        searchEnabled: true,
        onItemClick: function(e) {
            var item = e.itemData;
            if(item.path.length>0){
                
                let newUrl = "<?php echo base_url()?>"+"/"+item.path;
                window.location.replace(newUrl);
            };
        }
    }).dxTreeView("instance");

</script>


<!--  -->