@extends('admin.layouts.main')
@section('contenedor')
    <div class="container">
        <div class="d-flex justify-content-between py-4">
                    <h1>Usuarios</h1>
            <button type="button" class="btn btn-outline-succes" data-toggle="modal" data-target="#modalAdd">
                <i class="fa fa-plus"></i>
            </button>
        </div>
        @if($mensaje=Session::get('errorInsertar'))
            <div class="alert alert-danger">
                <h5>Error: {{$mensaje}}</h5>
                <ul>
                    @foreach($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($registros as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name}}</td>
                            <td>{{ $d->email }}</td>
                            <td>******</td>
                            <td>
                                <button class="btn btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="/admin/users" method="POST">
            @csrf
        <div class="modal-body">

            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label for="">Email:</label>
                <input type="email" class="form-control" name="email">
            </div>

            <div class="form-group">
                <label for="">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="form-group">
                <label for="">Confirmar password:</label>
                <input type="password" class="form-control" name="password_confirm">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection