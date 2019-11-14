$(function(){var e=$("#permission-form"),a=$("table"),t=$("#permission-table").DataTable({processing:!0,serverSide:!0,pageLength:20,order:[[0,"desc"]],ajax:{url:"/load/permissions"},columns:[{data:"id",name:"id"},{data:"name",name:"name"},{data:"route_name",name:"route_name"},{data:"group_name",name:"group_name"},{data:"description",name:"description"},{data:"action",name:"action"}]});e.on("submit",function(a){a.preventDefault();var i=$("#permission-save"),o="/store/permission";"edit"==i.attr("data-action")&&(o="update/permission/"+i.attr("data-id")),$.post(o,e.serialize(),function(a){a.status?(t.draw(),$("#permission-form-modal").modal("hide"),e.get(0).reset()):$.alert({theme:"dark",title:"ERROR!",content:a.message})})}),a.on("click",".edit-permission",function(){var e=$(this).data("id");$.get("/permission/"+e,function(a){if(a.status){var t=$("#permission-save");$("#name").val(a.data.name),$("#description").val(a.data.description),$("#permissionGroup").val(a.data.permission_group_id),$("#routeName").val(a.data.route_name),t.attr("data-action","edit"),t.attr("data-id",e),$("#permission-form-modal").modal("show")}})}),a.on("click",".delete-permission",function(){var e=$(this).data("id");$.confirm({theme:"dark",title:"Confirm!",content:"Are you sure!",buttons:{confirm:{btnClass:"btn-red",action:function(){$.get("/permission/delete/"+e,function(e){if(e.status)return t.draw();$.alert({theme:"dark",title:"ERROR!",content:"Oops! our bad, please try again later."})})}},cancel:function(){}}})}),$("#add-permission-btn").click(function(){var a=$("#permission-save");e.get(0).reset(),a.attr("data-action","add"),a.attr("data-id","")}),$("#add-more-route-name").on("click",function(){var e=Math.floor(100*Math.random()+1);$("#more-route-name-section").append('<div id="'+e+'"><input type="text" class="form-control mt-2" id="" name="route_name[]" required placeholder="Name of the Route permission to be applied"><small style="float: right; cursor: pointer; color: red" class="form-text mb-2 remove-route-name" data-id="'+e+'" >Remove</small></div>')}),$("#more-route-name-section").on("click",".remove-route-name",function(){$("#"+$(this).data("id")).remove()})});
