<div class="col-md-12">

    @if(Session::has('flash_message_error'))

<div class="alert alert-danger alert-dismissible fade show p-4" role="alert">

  <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="close">x</button>
  <strong class="">  {{session('flash_message_error')}}</strong>

</div>

@endif


@if(Session::has('flash_message_success'))

<div class="alert alert-primary alert-dismissible fade show p-4" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close">x</button>
  <strong class="">  {{session('flash_message_success')}}</strong>

</div>
@endif


</div>
