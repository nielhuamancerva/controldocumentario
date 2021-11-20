@extends('layouts.layout')

@section('contenido')
<div class="row">
    <div class="col-md-10 mx-auto">
    <h3 class="text-center"> LISTA DE AREAS</h3>   
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearAccesoEnvio">Nuevo Acceso Envio</button>  
    
        <table class="table table-hover table-responsive ">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Area Origen</th>
                <th scope="col">Area Envio</th>
                <th scope="col">Documento</th>
                <th scope="col">Estado</th>
                <th scope="col">Operaciones</th>
                </tr>
            </thead>
            @foreach($ListarAccesoEnvio  as $acceso)
            <tbody>
                <tr>
                <td scope="row">{{$acceso -> id_acceso_envio}}</td>
                    <td scope="row">{{$acceso -> area_origen}}</td>
                    <td scope="row">{{$acceso -> destino}}</td>
                    <td scope="row">{{$acceso -> documento}}</td>
                    <td scope="row">{{$acceso -> estado_acceso_envio}}</td>
                    <td scope="row">
                        <a href="" ><button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button></a>
                        @if($acceso -> estado_acceso_envio==1)
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

                                    <div class="modal fade" id="CrearAccesoEnvio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Acceso Envio</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('accesoenvioarea.store') }}" > 
                                                
                                                    @csrf
                                                    <div class="form-group">
                                                                <label for="envio" class="col-form-label text-md-right">{{ __('Elegir Tipo de Area') }}</label>
                                                                <select id="acceso_envio_nivel_jerarquico" name="acceso_envio_nivel_jerarquico" class="form-control">
                                                                <option selected disabled>Elija El Nivel Jerarquico</option>
                                                                <option value="1">ALta Direccion</option>
                                                                <option value="2">Gerencia</option>
                                                                <option value="2">Oficina Auxiliar</option>
                                                                <option value="3">SubGerencia</option>
                                                                <option value="4">Oficina</option>
                                                                </select>     
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="envio" class="col-form-label text-md-right">{{ __('Elegir el Area') }}</label>
                                                            <select id="acceso_envio_area" name="acceso_envio_area" class="form-control" required>
                                                        
                                                            </select> 
                                                    </div>  

                                                    <div class="form-group">
                                                        <label for="envio" class="col-form-label text-md-right">{{ __('Elegir el Nivel a Enviar') }}</label>
                                                        
                                                            <select id="organigrama" name="organigrama" class="form-control" required>
                                                        
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="envio" class="col-form-label text-md-right">{{ __('Elegir el Area a Enviar') }}</label>
                                                            <select id="area_enviar" name="area_enviar" class="form-control" required>
                                                        
                                                            </select>
                                                    </div>  

                                                    <div class="form-group">
                                                        <label for="envio" class="col-form-label text-md-right">{{ __('Elegir el Tipo Documento a Enviar') }}</label>
                                                            <select id="documento_enviar" name="documento_enviar" class="form-control" required>
                                                            
                                                                   
                                                            </select>
                                                    </div>  

                                                    <div class="form-group row">
                                                        <label class="col-form-label text-md-right">{{ __('Codigo Unico Creacion') }}</label>
                                                            <input id="codigo_unico" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="codigo_unico" required autocomplete="codigo_unico" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-form-label text-md-right">{{ __('Gerenca Origen') }}</label>
                                                            <input id="matriz_gerencia" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="matriz_gerencia" required autocomplete="matriz_gerencia" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
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
   @section('script')
     <script>
$( document ).ready(function() {
         $('#acceso_envio_nivel_jerarquico').on('change',function(niveljerarquico){
                const accesoenvioarea =niveljerarquico.target.value;
                console.log(accesoenvioarea);
                $('#organigrama').empty(); 
                $('#organigrama').append('<option>Elija el Area a Enviar</option>');
                
                     
                            $('#organigrama').append('<option value="1">Alta Direccion</option>');
                            $('#organigrama').append('<option value="2">Gerencia</option>');
                            $('#organigrama').append('<option value="3">Sub Gerencia</option>');
                            $('#organigrama').append('<option value="4">Oficina</option>');           
                            $('#organigrama').append('<option value="2">Oficina Axuliar</option>');                                  
                    

                    $.get('/acceso_envio_nivel', {'accesoenvioarea':accesoenvioarea}, function (accesoenvioareanivel) {
                                console.log(accesoenvioareanivel);
                                $('#acceso_envio_area').empty();      
                                $('#acceso_envio_area').append('<option>Elija el Area</option>');
                                $('#area_enviar').empty();
                                $('#area_enviar').append('<option>Elija el Area a Enviar</option>');
                                $('#documento_enviar').empty();
                                $('#documento_enviar').append('<option>Elija el Documento a Enviar</option>');
                                $.each(accesoenvioareanivel, function(arreglo1,index1){
                                    $('#acceso_envio_area').append("<option value='"+index1.id+"'>"+index1.area+"</option>");
                                }) 
                                
                                $('#acceso_envio_area').on('change',function(envioarea){
                                        const acces =envioarea.target.value;
                                console.log(acces);
                                
                                $('#organigrama').on('change',function(organigrama){
                                const accesoenvioareas =organigrama.target.value;
                                console.log(accesoenvioareas);    

                                $.get('/acceso_envio_area', {'accesoenvioarea':accesoenvioareas,'acces':acces}, function (accesoenvioarea) {
                                console.log(accesoenvioarea);    
                                $('#area_enviar').empty();
                                $('#area_enviar').append('<option>Elija el Area a Enviar</option>');
                                $('#documento_enviar').empty();
                                $('#documento_enviar').append('<option>Elija el Documento a Enviar</option>');
                                $.each(accesoenvioarea, function(arreglo,index){
                                    $('#area_enviar').append("<option value='"+index.id+"'>"+index.area+"</option>");
                                        })

                                        $('#area_enviar').on('change',function(envio){
                                        const accesodestino =envio.target.value;
                                        console.log(accesodestino);   
                                            
                                       

                                        $.get('/acceso_envio_destino', {'accesodestino':accesodestino}, function (accesoenviodestino) {
                                            $.each(accesoenviodestino, function(arreglodestino,text){
                                          $('#codigo_unico').val(text.codigo_unico_creacion);
                                          $('#matriz_gerencia').val(text.matriz_gerencia);
                                         
                                            })
                                        });  

                                      
                                        $.get('/acceso_envio_documento', {'accesodestino':accesodestino,'acces':acces}, function (accesoenviodocumento) {
                                            $('#documento_enviar').empty();
                                            $('#documento_enviar').append('<option>Elija el Documento a Enviar</option>');
                                                  $.each(accesoenviodocumento, function(arreglos,documento){
                                                    $('#documento_enviar').append("<option value='"+documento.id+"'>"+documento.documento+"</option>");
                                        }) 
                                        });  
                                        
                                        });
                                });   
                            });   

                                });
                 });
             });  
      
    });   
      </script>
     @endsection