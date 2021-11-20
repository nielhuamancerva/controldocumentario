@extends('layouts.layout')

@section('contenido')
<div class="row">
    <div class="col-md-10 mx-auto">
    <h3 class="text-center"> LISTA DE CANTIDAD DE ENVIO A AREAS</h3>   
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearCantidadEnvioArea">Nuevo Cantidad Envio</button>  
    
        <table class="table table-hover table-responsive ">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Areas</th>
                <th scope="col">Nombre de Cantidad</th>
                <th scope="col">Estado</th>
                <th scope="col">Operaciones</th>
                </tr>
            </thead>
            @foreach($Listar_Cantidad_Envio_Area as $Cantidad_Envio_Area)
            <tbody>
                <tr>
                    <td scope="row">{{$loop->index+1}}</td>
                    <td scope="row">{{$Cantidad_Envio_Area -> area}}</td>
                    <td scope="row">{{$Cantidad_Envio_Area -> nombre_cantidad_envio}}</td>
                    <td scope="row">{{$Cantidad_Envio_Area -> estado_cantidad_envio}}</td>
                    <td scope="row">
                        <a href="" ><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                        @if($Cantidad_Envio_Area ->estado_cantidad_envio==1)
                                <a href=""  class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                @else
                                <a href="" class="btn btn-primary"><i class="fas fa-check-circle"></i></a>
                                @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
</div>

<div class="modal fade" id="CrearCantidadEnvioArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Acceso Envio</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('cantidadenvioarea.store') }}" > 
                                                
                                                            @csrf

                                                            <div class="form-group">
                                                                <label for="envio" class="col-form-label text-md-right">{{ __('Elegir el Area') }}</label>
                                                                    <select id="cantidad_envio" name="cantidad_envio" class="form-control">
                                                                    <option selected disabled>Elija el Area</option>
                                                                    @foreach($ListarAreas as $Areas)
                                                                    <option value="{{$Areas->id}}" >{{$Areas->area}}</option>
                                                                    @endforeach
                                                                    </select> 
                                                            </div>  

                                                            <div class="form-group">
                                                                        <label for="envio" class="col-form-label text-md-right">{{ __('Elegir Tipo de Cantidad') }}</label>
                                                                        <select id="area_cantidad_envio" name="area_cantidad_envio" class="form-control">
                                                                       
                                                                        </select>   
                                                            </div>
                                                            <div class="form-group">
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                                            </div>
                                                    </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
   @endsection
   @section('script')
     <script>
$( document ).ready(function() {
        $('#cantidad_envio').on('change',function(e){
                console.log(e);
                var cantidad_envio =e.target.value;
                console.log(cantidad_envio);   
                    $.get('/cantidad_envio', {'cantidad_envio':cantidad_envio}, function (cantidad_envio) {
                                console.log(cantidad_envio);      
                                $('#area_cantidad_envio').empty();
                                $('#area_cantidad_envio').append('<option selected disabled>Elija La Cantidad de Envio</option>');
                         
                                $.each(cantidad_envio, function(arreglo,index){
                                    $('#area_cantidad_envio').append("<option value='"+index.id_cantidad_envio+"'>"+index.nombre_cantidad_envio+"</option>");
                                })
              
                              
                        });  
                        
         
        });
        });
      </script>
     @endsection