@extends('layouts.layout')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8 mxauto">
    <h3 class="text-center"> BANDEJA DE ARCHIVOS ENVIADOS </h3>
    <form class="form-inline">
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
                        </tr>
            </thead>
            @foreach($ListarArchivadoresBandeja as $archibandeja)
            <tbody>
                <tr>
                <th scope="row">{{$loop->index+1}}</th>
                    
                    <td>{{$archibandeja -> documento}} DE {{$archibandeja -> tipo_archivador}}</td>
                    <td>{{$archibandeja -> documento}} N°{{$archibandeja -> NumeroDoc}} - 2020-{{$archibandeja->Siglas}}/MDP</td>
                    <td>{{$archibandeja -> asunto}}</td>
                    <td>{{$archibandeja -> expediente}}</td>

                    </td>
                 
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
</div>

   @endsection
