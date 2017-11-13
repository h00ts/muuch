@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default display--toc">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-3 col-lg-2">
                                <img src="{!! (isset($cover)) ? $cover : '' !!}" alt="{!! (isset($name)) ? $name : '' !!}" class="img-responsive">
                            </div>
                            <div class="col-sm-8 col-md-9 col-lg-10">
                                <h5>{{ $content->page->category->name.' / '.$content->page->name }}</h5>
                                <h3>{!! $name !!}</h3>
                                <p>{{ $description }}</p>
                               <a href="{!! $file !!}" target="_blank" class="btn btn-primary"> <i class="glyphicon glyphicon-download"></i> Descargar</a>
                                <a href="/muuch" target="_blank" class="btn btn-primary"> <i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>

                            </div>
                        </div>
                    </div>
                </div>
                <a id="back-to-top" class="btn--top" href="#"> <i class="glyphicon glyphicon-arrow-up"></i> Volver al inicio</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <iframe src="{{ $file }}" width="100%" height="800" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="modal-complete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 class="modal-title">Confirma que has completado:</h4>
                </div>
                <div class="modal-body">
                    <h4 class="text-center" id="content_name"></h4>
                </div>
                <div class="modal-footer">
                    <form action="/capacitacion/completar/" method="POST" id="complete_content">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-check"></i> Confirmar y completar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-default">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        function set_content_modal(id, name) {
            $("#complete_content").attr("action", "/capacitacion/completar/"+id);
            $("#content_name").html(name);
        }

        $(function(){
    {{--
    json = {!! json_encode($helper, JSON_UNESCAPED_SLASHES) !!};
    $("#content-display").children("h1, h2, h3, h4, h5").each(function(){
        $(this).attr('id', json[0]['slug']);
        json.splice(0,1);
    });
    --}}

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("back-to-top").style.display = "block";
        } else {
            document.getElementById("back-to-top").style.display = "none";
        }
    }
});

        </script>
@endsection