@extends('layouts.template')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Usuarios Registrados</h3>
                        <div class="form-group margin-bottom-none">
                            <div class="col-sm-9">

                            </div>
                            <div class="col-sm-3">
                                <button type="button" name="create_record" id="create_record"
                                    class="btn btn-success  ull-right btn-block btn-sm">Nuevo
                                    Usuario</button>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="user_table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar</h4>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4">Nombre: </label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Correo: </label>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Contraseña: </label>
                        <div class="col-md-8">
                            <input type="password" name="password" id="password" class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                            value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmación.</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">¿Realmente desea eliminar usuario?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

@section('script')

@section('script')
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
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

            $('#create_record').click(function() {
                $('.modal-title').text("Agregar nuevo usuario");
                $('#action_button').val("Agregar");
                $('#action').val("Add");
                $('#formModal').modal('show');
            });

            $('#sample_form').on('submit', function(event) {
                event.preventDefault();
                if ($('#action').val() == 'Add') {
                    $.ajax({
                        url: "{{ route('usuario.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(data) {
                            var html = '';
                            if (data.errors) {
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.success +
                                    '</div>';
                                $('#sample_form')[0].reset();
                                $('#user_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                        }
                    })
                }

                if ($('#action').val() == "Edit") {
                    $.ajax({
                        url: "{{ route('usuario.update') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(data) {
                            var html = '';
                            if (data.errors) {
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.success +
                                    '</div>';
                                $('#sample_form')[0].reset();
                                $('#user_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                        }
                    });
                }
            });

            $(document).on('click', '.edit', function() {
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url: "/usuario/" + id + "/edit",
                    dataType: "json",
                    success: function(html) {
                        $('#name').val(html.data.name);
                        $('#email').val(html.data.email);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text("Editar Registro de Usuario");
                        $('#action_button').val("Editar");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');
                    }
                })
            });

            var user_id;

            $(document).on('click', '.delete', function() {
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
                $('.modal-title').text("Borrar registro");
            });

            $('#ok_button').click(function() {
                $.ajax({
                    url: "usuario/destroy/" + user_id,
                    beforeSend: function() {
                        $('#ok_button').text('Eliminando...');
                    },
                    success: function(data) {
                        setTimeout(function() {
                            $('#confirmModal').modal('hide');
                            $('#user_table').DataTable().ajax.reload();
                        }, 2000);
                    }
                })
            });
        });        

    </script>

@endsection
