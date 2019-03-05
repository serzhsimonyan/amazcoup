
    <div class="alert alert-danger" role="alert"   id='errorMessage' style="{{(session()->has('error'))?'display:block':'display:none'}}" >
        {{ session('error') }}
    </div>
