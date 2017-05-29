@extends('layouts.config')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center"><i class="glyphicon glyphicon-education"></i> Capacitación</h2>
            </div>
            <div class="col-lg-12">
                <h3><i class="glyphicon glyphicon-cog"></i> <a href="/config">Configuración</a> / Crear pagina</h3>
            </div>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <form action="{!! route('muuch.store') !!}" method="POST">
                    {!! csrf_field() !!}
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="module">Modulo</label>
                            <select name="module_id" id="module_id" class="form-control input-lg">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Titulo</label>
                            <input type="text" name="name" class="form-control input-lg">
                        </div>
                       <div class="form-group">
                           <label for="html">Markdown</label>
                           <textarea name="markdown"class="form-control" id="" cols="30" rows="10"></textarea>
                       </div>
                        <div class="form-group">
                            <label for="file">Descargable</label>
                            <input type="text" name="file" class="form-control input-lg" value=" ">
                        </div>
                        <div class="form-group">
                            <label for="cover">Caratula</label>
                            <input type="text" name="cover" class="form-control input-lg" value="/img/content_default.png" required>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary" type="submit">Crear contenido</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>
@endsection