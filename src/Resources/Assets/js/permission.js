$(function(){var t=$("#permission-form"),a=$("table"),e=$("#permission-table").DataTable({processing:!0,serverSide:!0,pageLength:20,order:[[0,"desc"]],ajax:{url:"/load/permissions"},columns:[{data:"id",name:"id"},{data:"name",name:"name"},{data:"route_name",name:"route_name"},{data:"description",name:"description"},{data:"action",name:"action"}]});t.on("submit",function(a){a.preventDefault();var r=$("#permission-save"),o="/store/permission";"edit"==r.attr("data-action")&&(o="update/permission/"+r.attr("data-id")),$.post(o,t.serialize(),function(a){a.status?(e.draw(),$("#permission-form-modal").modal("hide"),t.get(0).reset()):$.alert({theme:"dark",title:"ERROR!",content:a.message})})}),a.on("click",".edit-permission",function(){var t=$(this).data("id");$.get("/permission/"+t,function(a){if(a.status){var e=$("#permission-save");$("#name").val(a.data.name),$("#description").val(a.data.description),$("#permissionGroup").val(a.data.permission_group_id),$("#routeName").val(a.data.route_name),e.attr("data-action","edit"),e.attr("data-id",t),$("#permission-form-modal").modal("show")}})}),a.on("click",".delete-permission",function(){var t=$(this).data("id");$.confirm({theme:"dark",title:"Confirm!",content:"Are you sure!",buttons:{confirm:{btnClass:"btn-red",action:function(){$.get("/permission/delete/"+t,function(t){if(t.status)return e.draw();$.alert({theme:"dark",title:"ERROR!",content:"Oops! our bad, please try again later."})})}},cancel:function(){}}})}),$("#add-permission-btn").click(function(){var a=$("#permission-save");t.get(0).reset(),a.attr("data-action","add"),a.attr("data-id","")})});
