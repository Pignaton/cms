@extends('adminlte::page')

@section('title', 'Editar Página')

@section('content')

    <div class="container">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Editar Página</h3>
            </div>
            <!-- /.card-header -->

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
            <form method="POST" action="{{ route('pages.update', ['page' => $page->id]) }}" class="form-horizontal">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Titulo</label>
                        <div class="col-sm">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ $page->title }}" placeholder="Titulo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body" class="col-sm-2 control-label">Corpo</label>
                        <div class="col-sm">
                            <textarea name="body" class="form-control bodytextarea">{{ $page->body }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Alterar</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea.bodytextarea',
            height: 300,
            menubar: false,
            plugins: ['link', 'table', 'lists', 'autoresize', 'image'],
            toolbar: 'fontselect | fontsizeselect | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | rotateleft rotateright | imageoptions | table | link image | bullist numlist',
            content_css: ['{{asset('assets/css/content.css')}}'],
            fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            font_formats: 'Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats',
            //images_upload_url: '{{route('imageupload')}}',
            images_upload_credentials:true,
            convert_urls:false
        });

    </script>

@endsection
