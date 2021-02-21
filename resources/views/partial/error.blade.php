@if(count($errors))
<div class="card card-inverse-danger" id="context-menu-multi">
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
