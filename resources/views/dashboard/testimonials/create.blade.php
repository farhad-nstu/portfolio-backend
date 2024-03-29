@extends('dashboard.master.app')
@section('title')
Testimonials
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
            <h5 class="nk-block-title">Add Testimonial</h5> 
          </div>
        </div>

        <form method="POST" action="{{route('testimonials.store')}}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label class="form-label">Icon</label>
            <input type="file" class="form-control form-control-lg @error('icon') is-invalid @enderror" value="{{ old('icon') }}" name="icon">

            @error('icon')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="title">Title<span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" id="title" required>

            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="is_featured">Is Featured?</label>
            <input type="checkbox" class="form-control form-control-lg" {{ old('is_featured') == 1 ? 'checked' : '' }} value="1" name="is_featured" id="is_featured">
          </div>

          <div class="form-group">
            <label class="form-label" for="designation">Designation<span style="color: red">*</span></label>
            <input type="text" class="form-control form-control-lg @error('designation') is-invalid @enderror" value="{{ old('designation') }}" name="designation" id="designation" required>

            @error('designation')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="description">Description<span style="color: red">*</span></label>
            <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" name="description" id="description" required>{{ old('description') }}</textarea>

            @error('description')
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
            <label class="form-label" for="status">Status<span style="color: red">*</span></label>
            <select class="form-control form-control-lg @error('status') is-invalid @enderror" name="status" id="status" required>
              <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
              <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Inactive</option>
            </select>

            @error('status')
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
