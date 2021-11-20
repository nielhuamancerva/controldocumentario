

@extends('layouts.layout')

@section('contenido')

        
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h3 class="text-center"> LISTA DE USUARIOS </h3>   
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#CrearUsuarios">Nuevo Usuario</button>  
            
            @if($buscar)
                <div class="alert alert-info" role="alert">
                    Los Resultado de Busqueda Son '{{$buscar}}' son:
                </div>
            @endif

                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Area</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    @foreach($Listarusuarios as $usuarios)
                    <tbody>
                        <tr>
                        <th scope="row">{{$usuarios -> id}}</th>
                        <td>{{$usuarios -> name}}</td>
                        <td>{{$usuarios -> username}}</td>
                        <td>{{$usuarios -> email}}</td>
                        <td>
                                @foreach($usuarios -> areas as $area)
                                {{$area->area}}                           
                               @endforeach                      
                        </td>
                        <td>
                                @foreach($usuarios -> roles as $role)
                                {{$role->name}}                             
                                @endforeach                                         
                        </td> 
                        <td>
                                @foreach($usuarios -> cargos as $cargo)
                                {{$cargo->cargo}}                             
                                @endforeach                                         
                        </td>                        
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

                                @foreach($Listarusuarios as $usuarios)
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
                                                    <form method="POST" action="{{ route('usuarios.update',$usuarios-> id) }}" >
                                                                @method('PATCH')
                                                                @csrf
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

                                                                <div class="form-group row">
                                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('UserName') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ $usuarios->username }}" required autocomplete="name" autofocus>

                                                                        @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuarios->email }}" required autocomplete="email">
                                                                        @error('email')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Area') }}</label>

                                                                    <div class="col-md-6">
                                                                        <select name="area" class="form-control">
                                                                        <option selected disabled>Elija su Area</option>
                                                                        @foreach($Listarareas as $areas)
                                                                            @if($areas->area == str_replace(array('["', '"]'), '', $usuarios->tieneAreas()))
                                                                                <option value="{{$areas->id}}" selected>{{$areas->area}} </option>
                                                                            @else
                                                                            <option value="{{$areas->id}}">{{$areas->area}}</option>
                                                                            @endif

                                                                        @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Rol') }}</label>

                                                                <div class="col-md-6">
                                                                    <select name="rol" class="form-control">
                                                                    <option selected disabled>Elija su Rol</option>
                                                                    @foreach($Listarroles as $roles)
                                                                        @if($roles->name == str_replace(array('["', '"]'), '', $usuarios->tieneRol()))
                                                                            <option value="{{$roles->id}}" selected>{{$roles->name}} </option>
                                                                        @else
                                                                        <option value="{{$roles->id}}">{{$roles->name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Cargo') }}</label>

                                                                <div class="col-md-6">
                                                                    <select name="cargo" class="form-control">
                                                                    <option selected disabled>Elija su Rol</option>
                                                                    @foreach($Listarcargos as $cargos)
                                                                        @if($cargos->cargo == str_replace(array('["', '"]'), '', $usuarios->tieneCargos()))
                                                                            <option value="{{$cargos->id}}" selected>{{$cargos->cargo}} </option>
                                                                        @else
                                                                        <option value="{{$cargos->id}}">{{$cargos->cargo}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $usuarios->password }}" required autocomplete="new-password">

                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ $usuarios->password }}" required autocomplete="new-password">
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


                                    <div class="modal fade" id="CrearUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuarios</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('usuarios.store') }}" > 
                                                
                                                            @csrf

                                                        <div class="form-group">

                                                            <div class="form-group row">
                                                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}" required autocomplete="username" autofocus>

                                                                    @error('username')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Area') }}</label>

                                                                <div class="col-md-6">
                                                                    <select name="area" class="form-control @error('area') is-invalid @enderror" required autocomplete="area">
                                                                    <option selected disabled>Elija su Area</option>
                                                                    @foreach($Listarareas as $areas)
                                                                    <option value="{{$areas->id}}" {{ old('area') == $areas->id ? 'selected' : '' }}>{{$areas->area}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                    
                                                                    @error('area')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Rol') }}</label>

                                                                <div class="col-md-6">
                                                                    <select name="rol" class="form-control @error('rol') is-invalid @enderror" value="{{ old('rol') }}" autocomplete="rol" required>
                                                                    <option selected disabled>Elija su Rol</option>
                                                                    @foreach($Listarroles as $roles)
                                                                    <option value="{{$roles->id}}" {{ old('rol') == $roles->id ? 'selected' : '' }}>{{$roles->name}}</option>
                                                                    @endforeach
                                                                    </select>
                                                                    @error('rol')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="cargo" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Cargo') }}</label>

                                                                <div class="col-md-6">
                                                                    <select name="cargo" class="form-control @error('cargo') is-invalid @enderror" autocomplete="cargo" required>

                                                                    <option selected disabled>Elija su Cargo</option>
                                                                    @foreach($Listarcargos as $cargos)
                                                                    <option value="{{$cargos->id}}" {{ old('cargo') == $cargos->id ? 'selected' : '' }}>{{$cargos->cargo}} </option>
                                                                    @endforeach
                                                                    </select>
                                                                    @error('cargo')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="persona" class="col-md-4 col-form-label text-md-right">{{ __('Asignar Persona') }}</label>

                                                                <div class="col-md-6">
                                                                    <select name="persona" class="form-control @error('persona') is-invalid @enderror" autocomplete="persona" required>

                                                                    <option selected disabled>Asignar Persona</option>
                                                                    @foreach($Listarpersonas as $personas)
                                                                    <option value="{{$personas->id}}"  {{ old('persona') == $personas->id ? 'selected' : '' }}>{{$personas->name}} </option>
                                                                    @endforeach
                                                                    </select>
                                                                    @error('persona')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" name="password"  autocomplete="password" required>

                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password_confirmation') }}" name="password_confirmation" required autocomplete="new-password">
                                                                    @error('password_confirmation')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
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

     



