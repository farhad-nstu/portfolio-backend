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
            <h5 class="nk-block-title">Edit About Information</h5> 
          </div>
        </div>

        <form method="POST" action="{{route('about.update', $about->id)}}" enctype="multipart/form-data">
          @method('put')
          @csrf

          <div class="form-group">
            <label class="form-label">Name<span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ $about->name }}" name="name">

            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Email<span style="color: red">*</span></label>
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ $about->email }}" name="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ $about->phone }}" name="phone">

            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Designation</label>
            <input type="text" class="form-control form-control-lg @error('designation') is-invalid @enderror" name="designation" value="{{ $about->designation }}">

            @error('designation')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="short_name_desc">Short Description</label>
            <textarea type="text" class="form-control form-control-lg" id="full-name" name="short_name_desc">{{ $about->short_name_desc }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea type="text" class="summernote-basic" id="full-name" name="description">{{ $about->description }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Current Focus</label>
            <input type="text" class="form-control form-control-lg @error('current_focus') is-invalid @enderror" value="{{ $about->current_focus }}" name="current_focus">

            @error('current_focus')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="professional_experience">Experience</label>
            <textarea type="text" class="summernote-basic" id="full-name" name="professional_experience">{{ $about->professional_experience }}</textarea>
          </div>

          <div class="form-group">
            <label class="form-label">Course</label>
            <input type="text" class="form-control form-control-lg @error('course') is-invalid @enderror" value="{{ $about->course }}" name="course">

            @error('course')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" class="form-control form-control-lg @error('image') is-invalid @enderror" name="image">

            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
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
  <script type="text/javascript">
    function get_sub_cat(id) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: "post",
        url : '{{url("admin/subCat")}}',
        data: {
          catId: id,
        },
        success:function(data) {
          $('#subCat').empty().html(data);
        }
      });
    }
  </script>
@endsection