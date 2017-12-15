@if(is_object($errors))
    @if(count($errors->all()) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif
@endif

@if (\Session::has('message'))
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{{ \Session::get('message') }}</p>
    </div>
@endif

@if (\Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{{ \Session::get('success') }}</p>
    </div>
@endif

@if (\Session::has('danger'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p>{{ \Session::get('danger') }}</p>
    </div>
@endif
