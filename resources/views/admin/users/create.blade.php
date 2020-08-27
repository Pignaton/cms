@extends('adminlte::page')

@section('title', 'Novo Usuario')

@section('content')
<div class="container">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        
            @if ($errors->any())
                <div class="callout alert-danger callout-danger">    
                    <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach  
                    </ul>
                </div> 
            @endif

        <!-- form start -->
        <form method="POST" action="{{route('users.store')}}" class="form-horizontal">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nome</label>
                    <div class="col-sm">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Nome">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">E-mail</label>
                    <div class="col-sm">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label ">Senha</label>
                    <div class="col-sm">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Senha">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="col-sm-2 control-label">Confirmar Senha</label>
                    <div class="col-sm">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha">
                    </div>
                </div>
            </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Cadastrar</button>
                </div>
                <!-- /.card-footer -->
        </form>
    </div>
</div>
@endsection