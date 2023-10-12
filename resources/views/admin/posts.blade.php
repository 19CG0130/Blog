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

                    <!--se imprimen los distintos registros segun existan -->
                    @foreach ($registros as $d)
                        <tr>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->title }}</td>
                            <td>{{ $d->likes }}</td>
                            <td>{{ $d->category }}</td>
                            <td>{{ $d->created_at }}</td>
                            <td>
                                <button class="btn btn-outline-danger btnEliminar" data-id="{{ $d->id }}"
                                    data-toggle="modal" data-target="#modalDelete">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form action="{{ url('admin/post', ['id' => $d->id]) }}" method="POST"
                                    id="formEliminar_{{ $d->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $d->id }}">
                                    <input type="hidden" name="_method" value="delete">

                                </form>
                                <button class="btn btn-outline-primary btnUpdate" data-toggle="modal"
                                    data-target="#modalUpdate" data-id="{{ $d->id }}"
                                    data-title="{{ $d->title }}" data-content="{{ $d->content }}"
                                    data-id_category="{{ $d->id_category }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <!---->

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

                <form action="/admin/post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Titulo:</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="">Descripcion:</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Imagen:</label>
                            <input type="file" class="form-control" name="img">
                        </div>
                        <div class="form-group">
                            <label for="">Categoría</label>
                            <select name="id_category" class="form-control">
                                @foreach ($categorys as $c)
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
    <!-- Modal DELETE -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>¿Deseas eliminar el registro?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btnEliminar" type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal UPDATE -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modificar Entrada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/admin/post/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Titulo:</label>
                            <input id="title" type="text" class="form-control" name="title">
                        </div>

                        <div class="form-group">
                            <label for="">Descripcion:</label>
                            <textarea id="contentUpdate" name="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Categoría</label>
                            <select id="id_category" name="id_category" class="form-control">
                                @foreach ($categorys as $c)
                                    <option value="{{ $c->id }}">{{ $c->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="id" id="idUpdate">
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

@section('scripts')
    <script>
        window.onload = () => {
            var idEliminar = 0
            let buttons = document.getElementsByClassName('btnEliminar');
            console.log(buttons)
            for (var x = 0; x < buttons.length; x++) {
                buttons[x].addEventListener('click', (evt) => {
                    //evt.stopPropagation();
                    idEliminar = evt.target.dataset.id
                    alert(idEliminar)
                })
            }
            //btn eliminar
            document.querySelector("#btnEliminar").addEventListener('click', () => {
                //alert("Vas a eliminar"+idEliminar)
                document.querySelector("#formEliminar_" + idEliminar).requestSubmit()
            })
            //btn update
            let btns = document.querySelectorAll(".btnUpdate")
            btns.forEach(ele => ele.addEventListener('click', (event) => {
                let id = event.target.dataset.id
                let t = event.target.dataset.title
                let c = event.target.dataset.content
                let ca = event.target.dataset.id_category
                document.querySelector("#idUpdate").value = id
                document.querySelector("#title").value = t
                document.querySelector("#contentUpdate").value = c
                document.querySelector("#id_category").value = ca
            }))

        }
    </script>
@endsection
