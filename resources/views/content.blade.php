@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
            <div class="col-lg-4">
            <a href="/capacitacion" class="btn btn-default btn-block btn-lg"> <i class="glyphicon glyphicon-arrow-left"></i> Regresar a {!! 'Nivel '.$content->module->level.' / Modulo '.$content->module->module !!}</a>
                        <br>
            <div class="panel panel-default display--toc">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{!! $content->cover !!}" alt="{!! $content->name !!}" class="img-responsive">
                        </div>
                        <div class="col-md-7">
                            <h3>{!! $content->name !!}</h3>
                            <a href="{!! $content->file !!}" target="_blank" class="btn btn-primary btn-block"> <i class="glyphicon glyphicon-download"></i> Descargalo</a>
                             </div>
                        <div class="col-sm-12">
                        <hr>
                             {!! $toc !!}
                        </div>
                    </div>
                </div>
            </div>
            <a id="back-to-top" class="btn--top" href="#"> <i class="glyphicon glyphicon-arrow-up"></i> Volver al inicio</a>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default display--content">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1" id="content-display">
                            {!! $content->markup !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default display--content">
                <div class="panel-body">
                    <a href="#" class="btn btn-success btn-block btn-lg"  data-target="#modal-complete" data-toggle="modal" onclick="set_content_modal({!! $content->id !!}, '{!! $content->name !!}')">PRESIONA PARA COMPLETAR</a>
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
            json = {!! json_encode($helper, JSON_UNESCAPED_SLASHES) !!};
            $("#content-display").children("h1, h2, h3, h4, h5").each(function(){
                $(this).attr('id', json[0]['slug']);
                json.splice(0,1);
            });

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