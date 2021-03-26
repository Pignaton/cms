@extends('adminlte::page')

@section('title', 'Nova Página')

@section('content')
    <div class="container">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Nova Página</h3>
            </div>
            <!-- /.box-header -->

            @if ($errors->any())
                <div class="callout alert-danger callout-danger">
                    <h4><i class="icon fa fa-ban"></i> Erro!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- form start -->
            <form method="POST" action="{{ route('pages.store') }}" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Títutlo</label>
                        <div class="col-sm">
                            <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Titulo"
                                class="form-control @error('title') is-invalid @enderror">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body" class="col-sm-2 control-label">Corpo</label>
                        <div class="col-sm">
                            <textarea name="body" class="form-control">{{ old('body') }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Criar</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>
@endsection
