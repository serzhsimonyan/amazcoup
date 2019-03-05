@extends('layouts.main')

@section('content')
    <div class="main-banner d-flex justify-content-center align-items-center">
        <div class="conatainer text-center">
            <h2 class="banner--lg-title">AMAZCOUP</h2>
            <p class="banner--txt">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut blanditiis delectus dolore id illum
                laborum molestiae, quis repellendus sit voluptatem. Ad commodi laudantium libero.
            </p>
        </div>
    </div>
    <div class="main-content">
        <form class="contact-form" method="POST" action="{{ route('send_message') }}">
            @csrf
            <h1 class="title--main text-center mt-0">Contact us</h1>
            <div class="contact-form--inner">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="fName">First Name*</label>
                            <input id="fName" name="first_name" type="text" class="form-control" value="{{ old('first_name') }}" required>
                            @if ($errors->has('first_name'))
                               <small  class="text-danger">
                                   <strong>{{ $errors->first('first_name') }}</strong>
                               </small>
                            @endif
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="lName">Last Name*</label>
                            <input id="lName" name="last_name" type="text" class="form-control" value="{{ old('last_name') }}" required>
                            @if ($errors->has('last_name'))
                                <small  class="text-danger">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="contactingSelect">What are you contacting us about?*</label>
                            <select id="contactingSelect" class="form-control" required name="contacting_select" value="{{old('contacting_select')}}">
                                <option>Contacting</option>
                            </select>
                            @if ($errors->has('contacting_select'))
                                <small  class="text-danger">
                                    <strong>{{ $errors->first('contacting_select') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="contactEmail">Email*</label>
                            <input type="email" id="contact_email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <small  class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="contactMessage">Your message*</label>
                            <textarea id="contactMessage" cols="30" rows="6"
                                      class="form-control" name="contact_message">{{ old('contact_message') }}</textarea>
                            @if ($errors->has('contact_message'))
                                <small class="text-danger">
                                    <strong>{{ $errors->first('contact_message') }}</strong>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button class="btn btn--main px-5">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

