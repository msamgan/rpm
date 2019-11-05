$(function () {
    var roleForm = $('#role-form');
    var roleSave = $('#role-save');

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

    roleForm.on('submit', function (e) {
        e.preventDefault();

        var actionUrl = '/store/role';
        if (roleSave.data('action') == 'edit') {
            actionUrl = 'update/role/' + roleSave.data('id')
        }

        $.post(
            actionUrl,
            roleForm.serialize(),
            function (response) {
                if (response.status) {
                    roleTable.draw();
                    $("#role-form-modal").modal('hide');
                    roleForm.get(0).reset()
                } else {
                    $.alert({
                        theme: 'dark',
                        title: 'ERROR!',
                        content: response.message,
                    });
                }
            }
        );
    });

    $('table').on('click', '.edit-role', function () {
        var id = $(this).data('id');
        $.get('/role/' + id, function (response) {
            if (response.status) {

                $('#name').val(response.data.name);
                $('#description').val(response.data.description);
                roleSave.attr('data-action', 'edit');
                roleSave.attr('data-id', id);
                $("#role-form-modal").modal('show');
            }
        })
    });

    $('#add-role-btn').click(function () {
        roleForm.get(0).reset();
    })
});
