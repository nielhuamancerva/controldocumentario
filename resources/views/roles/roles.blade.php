
@extends('layouts.layout')
@section('contenido')
<div class="row">
    <div class="col-md-3 mx-auto">
        <h3 class="text-center"> LISTA DE ROLES</h3>   
 
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearRoles">Nuevo Rol</button>  
        <table class="table table-hover table-responsive ">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre Rol</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            @foreach($Listarroles as $roles)
            <tbody>
                <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$roles -> name}}</td>
                <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EditarRoles{{$roles->id}}"><i class="far fa-edit"></i></button>
                <a><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a>
                   
                </td>
                </tr>
                <tr>
            @endforeach
            </tbody>
     </table>
     </div>
</div>


                                    <div class="modal fade" id="CrearRoles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('roles.store') }}" > 
                                                            @csrf

                                                        <div class="form-group">
                                                            <div class="form-group row">
                                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="name" value="" required autocomplete="username" autofocus>
                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Label') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="label" value="" required autocomplete="username" autofocus>
                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                                                <div class="col-md-6">
                                                                        <select name="estado_rol" class="form-control">
                                                                        <option selected disabled>Elija su Area</option>
                                                                            <option value="activado" >activado </option>
                                                                            <option value="desactivado">desactivado</option>
                                                                        </select>
                                                                    </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>


                                    @foreach($Listarroles as $roles)
                                    <div class="modal fade" id="EditarRoles{{$roles->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                        
                                                        <form method="POST"    action="{{ route('roles.update',$roles-> id) }}" > 
                                                        @method('PATCH')
                                                            @csrf

                                                        <div class="form-group">
                                                            <div class="form-group row">
                                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="documentos" type="text" class="form-control @error('username') is-invalid @enderror" name="name" value="{{ $roles->name }}" required autocomplete="username" autofocus>
                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Denominacion') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="documentos" type="text" class="form-control @error('username') is-invalid @enderror" name="label" value="{{ $roles->label }}" required autocomplete="username" autofocus>
                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado Rol') }}</label>
                                                                <div class="col-md-6">
                                                                        <select name="estado_roles" class="form-control">
                                                                            <option selected disabled>Elija su Clasificacion</option>
                                                                            @if($roles->estado_roles=="activo")
                                                                            <option value="{{$roles->estado_roles}}" selected>{{$roles->estado_roles}} </option>
                                                                            <option value="desactivado">desactivado</option>
                                                                            @else
                                                                            <option value="activo" >activo </option>
                                                                            <option value="{{$roles->estado_roles}}" selected>{{$roles->estado_roles}} </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Enviar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
   @endsection

