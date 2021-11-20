@extends('layouts.layout')

@section('contenido')
<div class="row">
    <div class="col-md-8 mx-auto">
    <h3 class="text-center"> LISTA DE AREAS</h3> 
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearArchivador">Nuevo Archivador</button>  
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Area</th>
                <th scope="col">Archivador</th>
                <th scope="col">Tipo de Archivador</th>
                <th scope="col">Estado de Archivador</th>
                <th scope="col">Operaciones</th>
                </tr>
            </thead>
            @foreach($Listararchivadores as $archivador)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$archivador -> area}}</td>
                    <td>{{$archivador -> documento}}</td>
                    <td>{{$archivador -> tipo_archivador}}</td>
                    @if($archivador -> estado_archivador==1)
                                <td>Activo</td>
                                @else
                                <td>Inactivo</td>
                                @endif
                    <td>
                    <a href="{{ route('archivadores.edit',$archivador->id_archivadores) }}" ><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                    <a><button class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a>
                    </td>
                 
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
</div>

<div class="modal fade" id="CrearArchivador" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Archivador</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('archivadores.store') }}" > 
                                                
                                                    @csrf
                                                    <div class="form-group">
                                                    <label for="areas" class="col-form-label">Elegir Nombre del Archivador</label>
                                                            <select id="nombre_archivador" name="nombre_archivador" class="form-control">
                                                            <option selected disabled>Elija Nombre del Archivador</option>
                                                            @foreach($Listardocumentos as $documentos)
                                                            <option value="{{$documentos->id}}">{{$documentos->documento}}</option>
                                                            @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                            <label for="areas" class="col-form-label">Elegir Tipo del Archivador</label>
                                                            <select id="tipo_archivador" name="tipo_archivador" class="form-control">
                                                            <option selected disabled>Elija El Tipo de Archivador</option>
                                                            <option value=1>ENVIADO</option>
                                                            <option value=2>ARCHIVADO</option>
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                            <label for="areas" class="col-form-label">{{ __('Elegir Area donde Crear Archivador') }}</label>
                                                            <select id="areas" name="areas" class="form-control">
                                                            <option selected disabled>Elija el Area a donde Enviara</option>
                                                            @foreach($Listarareas as $areas)
                                                            <option value="{{$areas->id}}" data-price="{{$areas->siglas}}">{{$areas->area}}</option>
                                                            @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Enviar</button></button>
                                                    </div>
                                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
   @endsection
