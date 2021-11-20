

@extends('layouts.layout')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-12 mx-auto">
            <h3 class="text-center"> SEGUIMIENTO DE EXPEDIENTE </h3>
            <form class="form-inline" autocomplete="on">
            <div class="form-group row">
                  <div class="col-md-6">
                <input id="buscar" class="form-control border-dark" placeholder="Digite Tu Busqueda" autocomplete="buscar" value="{{$buscar}}" name="buscar" autofocus>
                </div>
            </div>
            <div class="form-group row">
                    <div class="col-md-6">
                            <select id="tipobusqueda" name="tipobusqueda" class="form-control">
                                <option selected disabled>Elija su Area</option>
                                <option value="expediente" {{ "expediente" == $tipobusqueda ? 'selected' : '' }}>Expediente</option>
                                <option value="dni" {{"dni" == $tipobusqueda ? 'selected' : '' }}>Dni</option>
                            </select>  
                    </div>
            </div>
                    
                  <button class="btn btn-navbar bg-white border-secondary" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
            </form>
        <table class="table table-responsive table-bordered table-hover bg-white">
            <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Expediente</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Area Inicio</th>
                        <th scope="col">Area Destino</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Tipo de Envio</th>
                        <th scope="col">Nota</th>
                        </tr>
            </thead>
            @foreach($ListarExpediente as $Expediente)
                    <tbody>
                        <tr>
                        <th>{{$loop->index+1}}</th>
                        <td>{{$Expediente -> expediente}}</td>
                        <td >{{$Expediente -> documento}} N°{{$Expediente -> NumeroDoc}} - {{$Expediente->Año_Doc}}-{{$Expediente->Siglas}}/MDP</td>
                        <td>
                            {{$Expediente -> area}}                
                        </td>
                        <td >{{$Expediente -> destino}}</th>
                        <td>{{$Expediente -> Asunto}}</td>
                        <td>{{$Expediente -> estado_documento}}</td>
                        <td>{{$Expediente -> clase_envio_documento}}</td>
                        <td>{{$Expediente -> nota}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
        </div>
</div>

   @endsection
