@if (Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><i class="glyphicon glyphicon-check text-success"></i></strong> {!! Session::get('success') !!}
</div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error: </strong>
            @foreach ($errors->all() as $error)
                {!! $error !!}.
            @endforeach
    </div>
@endif
