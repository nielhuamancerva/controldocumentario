

@extends('layouts.layout')

@section('contenido')

        
    <div class="row">
        <div class="col-md-5 mx-auto">
            <h3 class="text-center"> LISTA DE PERSONAS </h3>   
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearPersonas">Nuevo Persona</button>  
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dni</th>
                        <th scope="col">Name</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Tipo Persona</th>
                        <th scope="col">operaciones</th>
                        </tr>
                    </thead>
                    @foreach($Listarperonas as $usuarios)
                    <tbody>
                        <tr>
                        <th scope="row">{{$usuarios -> id}}</th>
                        <td>{{$usuarios -> dni}}</td>
                        <td>{{$usuarios -> name}}</td>
                        <td>{{$usuarios -> celular}}</td>                
                        <td>{{$usuarios -> tipo_persona}}</td>                                    
                        <td>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EditarUsuarios{{$usuarios->id}}"><i class="far fa-edit"></i></button>
                                @if($usuarios->estado=="activado")
                                <a href="{{route('usuarios.show',$usuarios->id) }}"  class="btn btn-danger"><i class="fas fa-ban"></i></a>
                                @else
                                <a href="{{route('usuarios.show',$usuarios->id) }}" class="btn btn-primary"><i class="fas fa-check-circle"></i></a>
                                @endif
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>

    @foreach($Listarperonas as $usuarios)
                                    <div class="modal fade" id="EditarUsuarios{{$usuarios->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('personas.update',$usuarios-> id) }}" >
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ $usuarios->dni }}" required autocomplete="name" autofocus>

                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuarios->name }}" required autocomplete="name" autofocus>

                                                                        @error('name')
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

    <div class="modal fade" id="CrearPersonas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Personas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('personas.store') }}" > 
                                                            @csrf
                                                        <div class="form-group">

                                                            <div class="form-group row">
                                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Dni') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="dni" type="text" class="form-control @error('dni') is-invalid @enderror" name="dni" value="{{ old('dni') }}" required autocomplete="dni" autofocus>

                                                                    @error('dni')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="celular" type="celular" class="form-control @error('name') is-invalid @enderror" name="celular" value="{{ old('celular') }}" required autocomplete="celular">

                                                                    @error('celular')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="envio" class="col-form-label text-md-right">{{ __('Elegir Tipo de Persona') }}</label>
                                                                <div id="selector" class="col-md-6">
                                                                <select id="tipo_persona" name="tipo_persona" class="form-control">
                                                                <option selected disabled>Elija Persona</option>
                                                                <option value="funcionario">Funcionario</option>
                                                                <option value="ciudadano">Cuidadano</option>
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

     
