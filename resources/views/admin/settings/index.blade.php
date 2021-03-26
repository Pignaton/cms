@extends('adminlte::page')

@section('title', 'Configurações do site');


@section('content')

    @if ($errors->any())
        <div class="callout callout-danger alert-danger">
            <h4><i class="icon fa fa-ban"></i> Erro!</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.save') }}" method="POST" class="form-horizontal">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Titulo do Site</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="title" value="{{ $settings['title'] }}"
                            aria-describedby="helpId1" placeholder="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sub-Titulo do Site</label>
                    <div class="col-sm-10">
                        <input type="text" name="subtitle" id="subtitle" class="form-control"
                            value="{{ $settings['subtitle'] }}" placeholder="" aria-describedby="helpId2">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-mail para contato</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control" value="{{ $settings['email'] }}"
                            placeholder="" aria-describedby="helpId3">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do fundo</label>
                    <div class="col-sm-10">
                        <input type="color" name="bgcolor" id="bgcolor" class="form-control"
                            value="{{ $settings['bgcolor'] }}" placeholder="" aria-describedby="helpId5"
                            style="width: 70px;">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Cor do texto</label>
                    <div class="col-sm-10">
                        <input type="color" name="textcolor" id="textcolor" class="form-control"
                            value="{{ $settings['textcolor'] }}" placeholder="" aria-describedby="helpId6"
                            style="width: 70px;">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-success" value="Salvar">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
