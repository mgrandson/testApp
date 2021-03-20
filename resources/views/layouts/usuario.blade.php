<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 5.8 - DataTables Server Side Processing using Ajax</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">Laravel 5.8 Ajax Crud Tutorial - Delete or Remove Data</h3>
        <br />
        <div align="right">
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create
                Record</button>
        </div>
        <br />
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="user_table">
                <thead>
                    <tr>
                        <th width="10%">Image</th>
                        <th width="35%">First Name</th>
                        <th width="35%">Last Name</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <br />
        <br />
    </div>
</body>

</html>

<script>
    $(document).ready(function() {

        $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('usuario.index') }}",
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });
    });

</script>
