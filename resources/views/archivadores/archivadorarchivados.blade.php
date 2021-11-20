@extends('layouts.layout')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8 mxauto">
    <h3 class="text-center"> BANDEJA DE ARCHIVOS ENVIADOS </h3>
    <form class="form-inline" autocomplete="off">
                    <div class="form-group row">
                            <div class="col-md-6">
                                <select name="buscartipodocumento" class="form-control border-dark">
                                <option selected disabled>Tipo de Documento</option>
                                @foreach($insertarselectarchivadores as $archibandeja)
                                <option value="{{$archibandeja->documento}}">{{$archibandeja->documento}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                
              <button class="btn btn-navbar bg-white border-secondary" type="submit">
                <i class="fas fa-search"></i>
              </button>
        </form>
        <table class="table table-bordered table-hover bg-white">
            <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Archivador</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Asunto</th>
                        <th scope="col">Expediente</th>
                        <th scope="col">Ver </th>
                        </tr>
            </thead>
            @foreach($ListarArchivadoresBandeja as $archibandeja)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    
                    <td>{{$archibandeja -> documento}} DE {{$archibandeja -> estado_documento}}</td>
                    <td>{{$archibandeja -> documento}} N°{{$archibandeja -> NumeroDoc}} - 2020-{{$archibandeja->Siglas}}/MDP</td>
                    <td>{{$archibandeja -> asunto}}</td>
                    <td>{{$archibandeja -> expediente}}</td>
                    <td>
                
                    <button id="{{$archibandeja->detalles_documento_id}}" type="button"  class="btn btn-primary" data-toggle="modal" data-target="#AgregarDocumento{{$archibandeja->detalles_documento_id}}" data-whatever="@mdo"><i class="fas fa-file-alt"></i></button>
                    <div class="modal fade" id="AgregarDocumento{{$archibandeja->detalles_documento_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Enviar Documento</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('archivadoresrecibidos.update',$archibandeja->detalles_documento_id)}}" enctype="multipart/form-data" autocomplete="off">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Documento') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="documentos{{$archibandeja->detalles_documento_id}}" name="documentos" class="form-control" required>
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
                                                                <input id="numerodoc{{$archibandeja->detalles_documento_id}}" type="numerodoc" class="form-control @error('numerodoc') is-invalid @enderror" name="numerodoc" required>

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
                                                                <option value="" selected disabled>Elija el Area a donde Enviara</option>
                                                                @foreach($Listarareas as $areas)
                                                                <option value="{{$areas->id}}" >{{$areas->area}}</option>
                                                                @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="siglasareas" class="col-md-4 col-form-label text-md-right">{{ __('Siglas del Documento') }}</label>

                                                            <div class="col-md-6">
                                                                <input  id="siglasareas{{$archibandeja->detalles_documento_id}}" type="text" class="form-control @error('siglasareas') is-invalid @enderror" name="siglasareas" required>
                                                
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="asunto" class="col-md-4 col-form-label text-md-right">{{ __('Asunto') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="asunto" type="text" class="form-control @error('asunto') is-invalid @enderror" name="asunto" required>
                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label for="envio" class="col-md-4 col-form-label text-md-right">{{ __('Elegir Tipo de Envio') }}</label>
                                                            <div class="col-md-6">
                                                                <select id="tipoenvio" name="tipoenvio" class="form-control" required>
                                                                <option value="" selected disabled>Elija el Envio</option>
                                                                @foreach($Listarenvio as $envio)
                                                                <option value="{{$envio->id}}" >{{$envio->nombre_envio}}</option>
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
                            
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ReenvioDocumentoArchivar{{$archibandeja->detalles_documento_id}}" data-whatever="@mdo"><i class="fas fa-file-export "></i></button>
                                 <div class="modal fade" id="ReenvioDocumentoArchivar{{$archibandeja->detalles_documento_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                              
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Enviar Documento</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('EnviarProveidoArchivado',$archibandeja->detalles_documento_id) }}" > 
                                                    @method('PATCH')
                                                    @csrf
                                                    
                                                    <div class="form-group row">
                                                            <label for="areas" class="col-form-label">{{ __('Elegir Cantidad de Envio') }}</label>
                                                                    <select id="cantidad_areas" name="cantidad_areas" class="form-control">
                                                                    <option selected disabled>Elija Cantidad a Enviar</option>
                                                                    
                                                                    <option value=1>Individual</option>
                                                                 
                                                                    </select>
                                                    </div>   

                                                    <div class="form-group row">
                                                            <label for="areas" class="col-form-label">{{ __('Elegir Area donde Enviar') }}</label>
                                                            <select id="areas" name="areas" class="form-control">
                                                            <option selected disabled>Elija el Area a donde Enviara</option>
                                                            @foreach($Listarareas as $areas)
                                                            <option value="{{$areas->id}}">{{$areas->area}}</option>
                                                            @endforeach
                                                            </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nota" class="col-form-label">Nota:</label>
                                                        <input type="text" class="form-control" id="nota" name="nota">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="envio" class="col-form-label">{{ __('Elegir Tipo de Envio') }}</label>
                                                            <select id="tipoenvio" name="tipoenvio" class="form-control" required>
                                                            <option selected disabled>Elija el Envio</option>
                                                            @foreach($Listarenvio as $envio)
                                                            <option value="{{$envio->id}}" >{{$envio->nombre_envio}}</option>
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
$(document).ready(function() {
    $('.btn-primary').click(function() {
        var id=this.id;
        $('#documentos'+id).on('change',function(e){
                console.log(e);
                var nextnumero =e.target.value;
                $.get('/getnumero', {'nextnumero':nextnumero}, function (numero) {
                                              
                                for (var i=0; i< numero.length; i++)
                                        {  
                            var numero = numero[i]
                            if(numero.NumeroDoc!="1"){
                            $('#siglasareas'+id).prop('readOnly', true);
                            $('#numerodoc'+id).prop('readOnly', true);
                            $('#numerodoc'+id).val(numero.NumeroDoc);
                            $('#siglasareas'+id).val(numero.siglas);
                            }
                            else{
                            $('#numerodoc'+id).val(numero.NumeroDoc)
                            $('#siglasareas'+id).val(numero.siglas);
                            $('#numerodoc'+id).prop('readOnly', false);
                            $('#siglasareas'+id).prop('readOnly', false);  
                       }     
                            } 
                });  
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
                            $('#areas').removeAttr("required");  
                        }
                        
                    }
        });
        $(window).bind("pageshow", function() {
                    var form = $('form'); 
                    form[0].reset();
                        });
    });      
</script>
<script>
@if(session('expediente'))
        swal('Activado Expediente N° "{{session('expediente')}}"!', "", "success");
    @endif
    </script>
     @endsection