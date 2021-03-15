@extends('dashboard.master.app')
@section('title')
Dashboard  
@endsection

@section('content')
@if (Session::get('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong class="text-success">Message: {{  Session::get('message')  }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>      
@endif
<!-- content @s -->
<div class="nk-content "> 
  <div class="nk-split nk-split-page nk-split-md">
    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white" style="width: 100%;">
      <div class="absolute-top-right d-lg-none p-3 p-sm-5">
        <a href="#" class="toggle btn btn-white btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
      </div>
      <div class="nk-block nk-block-middle nk-auth-body"> 
        <div class="nk-block-head">
          <div class="nk-block-head-content">
            <h5 class="nk-block-title">Add Client</h5> 
          </div>
        </div>

        <form method="POST" action="{{route('client.store')}}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label class="form-label" for="name">Name<span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" required>

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Email<span style="color: red">*</span></label>
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone">

            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="name">Country<span style="color: red">*</span></label>
            <select onchange="get_sub_cat(this.value)" class="form-control form-control-lg @error('country_id') is-invalid @enderror" value="{{ old('country_id') }}" name="country_id" id="country_id">
              <option>Select Country</option>
              @foreach($countries as $country)
              <option value="{{ $country->CountryID }}">{{ $country->CountryName }}</option>
              @endforeach
            </select>
            @error('country_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" class="form-control form-control-lg @error('image') is-invalid @enderror" value="{{ old('image') }}" name="image">

            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Save</button>
          </div>
        </form>
        <!-- form -->

      </div><!-- .nk-block -->

    </div><!-- nk-split-content -->

  </div><!-- nk-split -->
</div>
<!-- wrap @e -->
</div>
<!-- content @e -->
@endsection

@section('scripts')
  <link rel="stylesheet" href="{{ asset('/') }}assets/css/editors/summernote.css?ver=1.9.2">
  <script src="{{ asset('/') }}assets/js/libs/editors/summernote.js?ver=1.9.2"></script>
  <script src="{{ asset('/') }}assets/js/editors.js?ver=1.9.2"></script>
@endsection
