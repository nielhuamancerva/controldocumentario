@extends('layouts.layout')

@section('contenido')
<div class="row ">
    <div class="col-md-10 mx-auto">
    <h3 class="text-center"> BANDEJA DE ESPERA</h3>   
    <a type="button" href="{{ route('tramitesinternos.create') }}"><button  type="button" class="btn btn-success">Nuevo Documento a Enviar</button></a>  
    
                <table class="table table-hover table-responsive ">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Area</th>
                        <th scope="col">Expediente</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    @foreach($Listartramites as $tramite)
                    <tbody>
                        <tr>
                        <th >{{$loop->index+1}}</th>
                        <th >{{$tramite -> area}}</th>
                        <td>{{$tramite -> expediente}}</td>
                        <td >{{$tramite -> documento}} N°{{$tramite -> NumeroDoc}} - 2020-{{$tramite->Siglas}}/MDP</td>
                        <td>{{$tramite -> Asunto}}</td>
                        <td>
                            <a href="{{route('recepcionado',$tramite->detalles_documento_id)}}"><button type="button" class="btn btn-primary"><i class="fas fa-check"></i></button></a>

                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
   @endsection
   @section('script')
<script>
@if(session('expedientes'))
        swal('Expediente N° "{{session('expedientes')}}" Aceptado!', "", "success");
    @endif
    </script>
     @endsection
