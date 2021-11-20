

@extends('layouts.layout')

@section('contenido')
<div class="row">
    <div class="col-md-6 mx-auto">
    <h3 class="text-center"> LISTA DE AREAS</h3>   
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearAreas">Nueva Area</button>  
    
        <table class="table table-hover table-responsive ">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Areas</th>
                <th scope="col">Siglas</th>
                <th scope="col">Estado</th>
                <th scope="col">Operaciones</th>
                </tr>
            </thead>
            @foreach($Listarareas as $area)
            <tbody>
                <tr>
                    <td scope="row">{{$area -> id}}</td>
                    <td scope="row">{{$area -> area}}</td>
                    <td scope="row">{{$area -> siglas}}</td>
                    <td scope="row">{{$area -> estado_area}}</td>
                    <td scope="row">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EditarAreas{{$area->id}}"><i class="far fa-edit"></i></button>
                        @if($area ->estado_area==1)
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



                                @foreach($Listarareas as $area)
                                    <div class="modal fade" id="EditarAreas{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{ route('areas.update',$area-> id) }}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="rolename" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="areaname" type="text" class="form-control @error('rolename') is-invalid @enderror" name="areaname" value="{{ $area->area }}" required autocomplete="areaname" autofocus>

                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="siglasarea" class="col-md-4 col-form-label text-md-right">{{ __('Siglas') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="siglasarea" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="siglasarea" value="{{ $area->siglas }}" required autocomplete="siglasarea" autofocus>

                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Actualizar') }}
                                                            </button>
                                                            <button type="reset" class="btn btn-danger">Cancelar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                    <div class="modal fade" id="CrearAreas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form method="POST" action="{{ route('areas.store') }}">
                                                    @csrf

                                                    <div class="form-group row">
                                                        <label for="envio" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Tipo de Envio') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="niveljerarquico" name="niveljerarquico" class="form-control">
                                                            <option selected disabled>Elija El Nivel Jerarquico</option>
                                                            <option value="1">ALta Direccion</option>
                                                            <option value="2">Gerencia</option>
                                                            <option value="2">Oficina Auxiliar</option>
                                                            <option value="3">SubGerencia</option>
                                                            <option value="4">Oficina</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="envio" class="col-md-4 col-form-label text-md-right">{{ __('Elegir el Area') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="organigrama" name="organigrama" class="form-control">
                                                        
                                                            </select>
                                                        </div>
                                                    </div>  

                                                    <div class="form-group row">
                                                        <label for="siglasarea" class="col-md-4 col-form-label text-md-right">{{ __('Siglas') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="siglasarea" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="siglasarea" required autocomplete="siglasarea" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Codigo Unico Creacion') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo_unico" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="codigo_unico" required autocomplete="codigo_unico" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Jefe Inmediato') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="jefe_inmediato" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="jefe_inmediato" required autocomplete="siglasarea" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Codigo Jefe Inmediato') }}</label>
                                                        <div class="col-md-6">
                                                            <input id="codigo_jefe_inmediato" type="text" class="form-control @error('siglasarea') is-invalid @enderror" name="codigo_jefe_inmediato" required autocomplete="siglasarea" autofocus>
                                                            @error('rolename')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Depedencia de Gerencia') }}</label>
                                                        <div class="col-md-6">
                                                            <select id="matriz_gerencia" name="matriz_gerencia" class="form-control">
                                                                    <option selected disabled>Elegir la dependencia de Gerencia</option>
                                                                    @foreach($ListarGerencias as $gerencias)
                                                                    <option value="{{$gerencias->nombre}}" >{{$gerencias->nombre}}</option>
                                                                    @endforeach
                                                            </select> 
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('Register') }}
                                                            </button>
                                                            <button type="reset" class="btn btn-danger">Cancelar</button>
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
$( document ).ready(function() {
        $('#niveljerarquico').on('change',function(e){
                console.log(e);
                var niveljerarquico =e.target.value;
                    
                    $.get('/niveljerarquico', {'niveljerarquico':niveljerarquico}, function (organigrama) {
                                console.log(organigrama);      
                                $('#organigrama').empty();
                                $('#siglasarea').val('');
                                $('#jefe_inmediato').val('');
                                $('#codigo_unico').val('');
                                $('#codigo_jefe_inmediato').val('');
                                $('#organigrama').append('<option>Elija el Area</option>');
                                $.each(organigrama, function(arreglo,index){
                                    $('#organigrama').append("<option value='"+index.nombre+"'>"+index.nombre+"</option>");
                                })
                              
                                $('#organigrama').on('change',function(e){
                                var nivel = e.target.value;
                                $.each(organigrama, function(arreglo,text){

                                    if(text.nombre==nivel){
                                        $('#siglasarea').val(text.siglas);
                                        $('#jefe_inmediato').val(text.jefe_nombre);
                                        $('#codigo_unico').val(text.codigo_unico_creacion);
                                        $('#codigo_jefe_inmediato').val(text.codigo_jefe_nombre);
                                    }
                                 
                                })
                                console.log(nivel);
                        });  
                        
         
        });
        });
   

    

    });      
      </script>
     @endsection