$(function(){var t=$("#permission-group-form"),a=$("table"),e=$("#permission-group-table").DataTable({processing:!0,serverSide:!0,pageLength:20,order:[[0,"desc"]],ajax:{url:"/load/permission-groups"},columns:[{data:"id",name:"id"},{data:"name",name:"name"},{data:"description",name:"description"},{data:"action",name:"action"}]});t.on("submit",function(a){a.preventDefault();var r=$("#permission-group-save"),o="/store/permission-group";"edit"==r.attr("data-action")&&(o="update/permission-group/"+r.attr("data-id")),$.post(o,t.serialize(),function(a){a.status?(e.draw(),$("#permission-group-form-modal").modal("hide"),t.get(0).reset()):$.alert({theme:"dark",title:"ERROR!",content:a.message})})}),a.on("click",".edit-permission-group",function(){var t=$(this).data("id");$.get("/permission-group/"+t,function(a){if(a.status){var e=$("#permission-group-save");$("#name").val(a.data.name),$("#description").val(a.data.description),e.attr("data-action","edit"),e.attr("data-id",t),$("#permission-group-form-modal").modal("show")}})}),a.on("click",".delete-permission-group",function(){var t=$(this).data("id");$.confirm({theme:"dark",title:"Confirm!",content:"Are you sure!",buttons:{confirm:{btnClass:"btn-red",action:function(){$.get("/permission-group/delete/"+t,function(t){if(t.status)return e.draw();$.alert({theme:"dark",title:"ERROR!",content:"Oops! our bad, please try again later."})})}},cancel:function(){}}})}),$("#add-permission-group-btn").click(function(){var a=$("#permission-group-save");t.get(0).reset(),a.attr("data-action","add"),a.attr("data-id","")})});