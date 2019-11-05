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
});
