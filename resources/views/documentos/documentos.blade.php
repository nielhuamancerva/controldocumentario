@extends('layouts.layout')
@section('contenido')
<div class="row">
    <div class="col-md-3 mx-auto">
        <h3 class="text-center"> LISTA DE DOCUMENTOS</h3>   
        
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearDocumentos">Nuevo  Documento</button>  
        <table class="table table-hover table-responsive ">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del Documento</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            @foreach($Listardocumentos as $documentos)
            <tbody>
                <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$documentos -> documento}}</td>
                <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EditarDocumentos{{$documentos->id}}"><i class="far fa-edit"></i></button>
                <a><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a>
                  
                </td>
                </tr>
                <tr>
            @endforeach
            </tbody>
     </table>
     </div>
</div>

                                @foreach($Listardocumentos as $documentos)
                                    <div class="modal fade" id="EditarDocumentos{{$documentos->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                        
                                                        <form method="POST"    action="{{ route('documentos.update',$documentos-> id) }}" > 
                                                        @method('PATCH')
                                                            @csrf

                                                        <div class="form-group">
                                                            <div class="form-group row">
                                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Documentos') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="documentos" type="text" class="form-control @error('username') is-invalid @enderror" name="documentos" value="{{ $documentos->documento }}" required autocomplete="username" autofocus>
                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Clasificacion') }}</label>
                                                                <div class="col-md-6">
                                                                        <select name="clasificaciondocumento" class="form-control">
                                                                        <option selected disabled>Elija su Clasificacion</option>
                                                                        @if($documentos->clacificaciondocumento=="interno")
                                                                            <option value="{{$documentos->clacificaciondocumento}}" selected>{{$documentos->clacificaciondocumento}} </option>
                                                                            <option value="externo">externo</option>
                                                                            @else
                                                                            <option value="interno" >interno </option>
                                                                            <option value="{{$documentos->clacificaciondocumento}}" selected>{{$documentos->clacificaciondocumento}} </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                                                <div class="col-md-6">
                                                                        <select name="estado_documento" class="form-control">
                                                                        <option selected disabled>Elija su estado</option>
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
                                @endforeach

                                    <div class="modal fade" id="CrearDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('documentos.store') }}" > 
                                                            @csrf

                                                        <div class="form-group">
                                                            <div class="form-group row">
                                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Documentos') }}</label>
                                                                <div class="col-md-6">
                                                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="documentos" value="" required autocomplete="username" autofocus>
                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Clasificacion') }}</label>

                                                                <div class="col-md-6">
                                                                        <select name="clasificaciondocumento" class="form-control">
                                                                        <option selected disabled>Elija su Clasificacion</option>
                                                                            <option value="interno" >interno</option>
                                                                            <option value="externo">externo</option>
                                                                        </select>
                                                                    </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                                                <div class="col-md-6">
                                                                        <select name="estado_documento" class="form-control">
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
   @endsection
@section('script')
   <script>
    @if(session('documento'))
        swal('Documento "{{session('documento')}}" Generado!', "", "success");
    @endif
      </script>
     @endsection
   

