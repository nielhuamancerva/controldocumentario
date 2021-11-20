@extends('layouts.layout')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-md-center bg-info text-white"> <label class="col-form-label text-md-right">REALIZAR UN DOCUMENTO</label></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tramitesexternos.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Documento') }}</label>

                            <div class="col-md-6">
                                <select id=documentos name="documentos" class="form-control" required>
                                <option value="" selected disabled>Elija el Tipo de Documento</option>
                                @foreach($Listardocumentos as $documentos)
                                <option value="{{$documentos->id}}">{{$documentos->documento}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Numero de Documento') }}</label>
                            <div class="col-md-6">
                                <input id="numerodoc" type="numerodoc" class="form-control @error('numerodoc') is-invalid @enderror" name="numerodoc" required>
                                @error('numerodoc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                       

                        <div class="form-group row">
                            <label for="areas" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Cantidad de Envio') }}</label>
                            <div class="col-md-6">
                                <select id="cantidad_areas" name="cantidad_areas" class="form-control" required>
                                <option value="" selected disabled>Elija Cantidad a Enviar</option>
                                @foreach($Listarcantidadenvio as $cantidadenvio)
                                <option value="{{$cantidadenvio->nombre_cantidad_envio_id}}" >{{$cantidadenvio->nombre_cantidad_envio}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="cantidades" name="cantidades">
                            <label for="areas" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Area donde Enviar') }}</label>
                            <div class="col-md-6" >
                                <select id="areas" name="areas" class="form-control" required>
                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="siglasareas" class="col-md-4 col-form-label text-md-right">{{ __('Siglas del Documento') }}</label>

                            <div class="col-md-6">
                                <input  id="siglasareas" type="text" class="form-control @error('siglasareas') is-invalid @enderror" name="siglasareas" required>
                                @error('siglasareas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="asunto" class="col-md-4 col-form-label text-md-right">{{ __('Asunto') }}</label>

                            <div class="col-md-6">
                                <input id="asunto" type="text" class="form-control @error('asunto') is-invalid @enderror" name="asunto" required>
                                @error('asunto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="envio" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Tipo de Envio') }}</label>
                            <div class="col-md-6">
                                <select id="tipoenvio" name="tipoenvio" class="form-control" required>
                                <option selected disabled>Elija el Envio</option>
                                @foreach($Listarenvio as $envio)
                                <option value="{{$envio->id}}" >{{$envio->nombre_envio}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('Dni Remitente') }}</label>
                            <div class="col-md-6">
                                <input id="dni" type="text" minlength="8" maxlength="11" class="form-control @error('dni') is-invalid @enderror" name="dni" required pattern="[0-9]+">
                                @error('dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombres" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" required>
                                @error('nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror" name="celular" required>
                                @error('celular')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
</div>
@endsection
@section('script')
     <script>
            $( document ).ready(function() {
                $('#documentos').on('change',function(codigo){
                console.log(codigo);
                const nextnumero =codigo.target.value;
                $.get('/AreaEnvio', {'nextnumero':nextnumero}, function (areaenviodestino) {  
                    $('#areas').empty();      
                    $('#areas').append('<option>Elija el Area</option>');    
                    $.each(areaenviodestino, function(array1,index1){
                        console.log(index1); 
                                    $('#areas').append("<option value='"+index1.id+"'>"+index1.area+"</option>");
                                }) 
                        }); 
        });
        $('#cantidad_areas').on('change',function(e){
                console.log(e);
                var cantidad_envios =e.target.value;
                console.log(cantidad_envios); 
                    if(cantidad_envios==1 || cantidad_envios==9){
                        $('#cantidades').show();
                        $('#areas').prop('selectedIndex',0);
                        $('#areas').removeAttr("class multiple style name");
                        $( '#areas' ).attr( "name","areas");
                        $('#areas').addClass('form-control');
                        $('.selection').remove();
                    }
                    else{

                        if(cantidad_envios==10){
                            $('#cantidades').show();
                            $('#areas').removeAttr("class multiple style");
                        $( '#areas' ).attr( "multiple", "multiple");
                        $( '#areas' ).attr( "name","areas[]");
                        $('#areas').addClass('js-example-basic-multiple');
                        $('.js-example-basic-multiple').select2();
                                }
                        else{
                            $('#cantidades').hide();
                        }
                    }
                });

                $(window).bind("pageshow", function() {
                    var form = $('form'); 
                    form[0].reset();
                        });
    });      
      </script>
     @endsection