$(function(){var t=$("#role-form"),a=$("table"),e=$("#role-table").DataTable({processing:!0,serverSide:!0,pageLength:20,order:[[0,"desc"]],ajax:{url:"/load/roles"},columns:[{data:"id",name:"id"},{data:"name",name:"name"},{data:"description",name:"description"},{data:"action",name:"action"}]});t.on("submit",function(a){a.preventDefault();var r=$("#role-save"),o="/store/role";"edit"==r.attr("data-action")&&(o="update/role/"+r.attr("data-id")),$.post(o,t.serialize(),function(a){a.status?(e.draw(),$("#role-form-modal").modal("hide"),t.get(0).reset()):$.alert({theme:"dark",title:"ERROR!",content:a.message})})}),a.on("click",".edit-role",function(){var t=$(this).data("id");$.get("/role/"+t,function(a){if(a.status){var e=$("#role-save");$("#name").val(a.data.name),$("#description").val(a.data.description),e.attr("data-action","edit"),e.attr("data-id",t),$("#role-form-modal").modal("show")}})}),a.on("click",".delete-role",function(){var t=$(this).data("id");$.confirm({theme:"dark",title:"Confirm!",content:"Are you sure!",buttons:{confirm:{btnClass:"btn-red",action:function(){$.get("/role/delete/"+t,function(t){if(t.status)return e.draw();$.alert({theme:"dark",title:"ERROR!",content:"Oops! our bad, please try again later."})})}},cancel:function(){}}})}),$("#add-role-btn").click(function(){var a=$("#role-save");t.get(0).reset(),a.attr("data-action","add"),a.attr("data-id","")})});
