@extends('admin.layouts.main')
@section('contenedor')
    <div class="container">
        <div class="d-flex justify-content-between py-4">
            <h1>Mis Publicaciones</h1>
            <button type="button" class="btn btn-outline-succes" data-toggle="modal" data-target="#modalAdd">
                <i class="fa fa-plus"></i>
            </button>
        </div>

        @if ($mensaje = Session::get('errorInsertar'))
            <div class="alert alert-danger">
                <h5>Error: {{ $mensaje }}</h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($mensaje = Session::get('success'))
            <div class="alert alert-success">
                <h5>Listo: {{ $mensaje }}</h5>
            </div>
        @endif

        <div class="row">
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>Likes</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($registros as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->title }}</td>
                            <td>{{ $d->likes }}</td>
                            <td>{{ $d->category }}</td>
                            <td>{{ $d->created_at }}</td>
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
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Entrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/admin/posts" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Titulo:</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <div class="form-group">
                            <label for="">Descripcion:</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Imagen:</label>
                            <input type="file" class="form-control" name="img">
                        </div>
                        <div class="form-group">
                            <label for="">Categoría</label>
                            <select name="id_category" class="form-control">
                                @foreach($categorys as $c)
                                    <option value="{{ $c->id }}">{{ $c->category }}</option>
                                @endforeach
                            </select>
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
