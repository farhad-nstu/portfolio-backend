@extends('dashboard.master.app')
@section('title')
Testimonial
@endsection
@section('content')
<div class="nk-block nk-block-lg">
  <div class="nk-block-head">
    <div class="nk-block-head-content">
      <h4 class="nk-block-title text-warning">Testimonial List</h4>
      <div class="float-right mb-3">
        <a href="{{ route('testimonials.create') }}" class=" btn btn-icon btn-primary"><em
          class="icon ni ni-plus"></em>
        </a>
      </div>
    </div>
  </div>
  <div class="card card-preview">
    <div class="card-inner">
      <table class="datatable-init table">
        <thead>
          <tr>
            <th>SL</th>
            <th>Icon</th>
            <th>Title</th>
            <th>Designation</th> 
            <th>Description</th>
            <th>Is Featured</th>
            <th>Status</th>
            <th>Action</th> 
          </tr>
        </thead>
        <tbody> 
          @forelse ($testimonials as $key => $testimonial)
         <tr> 
          <td>{{ ++$key }}</td> 
          <td><img src="{{ $testimonial->icon }}" width="100px;"></td>
          <td>{{ $testimonial->title }}</td> 
          <td>{{ $testimonial->designation }}</td>
          <td>{{ $testimonial->description }}</td>
          <td>{{ $testimonial->is_featured == 1 ? 'Yes' : 'No' }}</td>
          <td>{{ $testimonial->status == 1 ? 'Active' : 'Inactive' }}</td>

          <td>
            <a class="btn btn-sm btn-success" href="{{ route('testimonials.edit', $testimonial->id) }}" title="Edit">
              <span><em class="icon ni ni-pen-fill"></em></span>
            </a>

            <a class="btn btn-sm btn-danger" href="{{ url('admin/testimonial-delete/'. $testimonial->id) }}" title="Details">
              <span><em class="icon ni ni-trash"></em></span>
            </a>

          </td> 
        </tr> 
        @empty

        @endforelse

      </tbody>
    </table>
  </div>
</div><!-- .card-preview -->
</div> <!-- nk-block -->
<input type="hidden" id="success" value="{{Session::get('success')}}" />
@endsection

@section('scripts')

<script type="text/javascript">
  function myConfirm() {
    var result = confirm("Want to delete?");
    if (result==true) {
      @if(!empty($testimonial->id))
      event.preventDefault(); document.getElementById('delete-form-{{ $testimonial->id }}').submit();
      @endif
    } else {
     return false;
   }
 }
</script>

@if (Session::get('success')) 
<script>
  var message = $('#success').val();  
  if(message){
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: message,
      showConfirmButton: false,
      timer: 1500
    });
    e.preventDefault(); 
  }
</script> 

@endif 
@endsection