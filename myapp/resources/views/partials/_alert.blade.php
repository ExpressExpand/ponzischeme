@if(Session::has('flash_message'))
    <div class="alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))
          <button type="button" class="close" aria-hidden="true" data-dismiss="alert">&times;</button>
        @endif
        {{ Session::get('flash_message') }}
    </div>
@endif
@if($errors->any())
  <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
      <li style="margin-left: 20px">{{ $error }} </li>
    @endforeach
  </ul>
@endif