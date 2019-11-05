$(function () {
    var roleTable = $('#role-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 20,
        order: [[0, "desc"]],
        ajax: {
            url: '/load/roles',
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action'},
        ],
    });

    $('#role-save').on('click', function () {
        var roleForm = $('#role-form');
        $.post(
            '/store/role',
            roleForm.serialize(),
            function (response) {
                if (response.status) {
                    roleTable.draw();
                    $("#role-form-modal").modal('hide');
                    roleForm.get(0).reset()
                }
            }
        );
    });
});
