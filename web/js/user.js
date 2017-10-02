
    var table;
    // not display error messages for DataTable
    $.fn.dataTable.ext.errMode = 'none';
    $('#userTable').DataTable({
        ajax: "/site/sample",
        rowId: "id",
        // VISUAL OPTIONS
        lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "paging": false,
        "info": false,
        "processing": true,
        "serverSide": true,
        "searching": false,


        stateDuration: 60 * 60 * 24 * 30,

        // COLUMNS DATA

        columnDefs: [
            {
                targets: [0, 1, 2, 3],
                orderSequence: ['null', 'desc', 'asc']
            },
            {
                targets: [0],
                orderable: false
            },
            {
                targets: [0, 1, 2, 3],
                className: 'dt-body-center'
            }
        ],
        columns: [
            {
                title: 'ID',
                data: 'id'
            },
            {
                title: 'User Name',
                data: 'username'
            },
            {
                title: 'Email',
                data: 'email'
            },
            {
                title: 'Created at',
                data: 'created_at'
            }
        ]
    });
