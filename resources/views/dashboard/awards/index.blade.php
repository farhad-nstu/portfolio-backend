@extends('dashboard.master.app')
@section('title')
award
@endsection
@section('content')
<div class="nk-block nk-block-lg">
  <div class="nk-block-head">
    <div class="nk-block-head-content">
      <h4 class="nk-block-title text-warning">award</h4>
      <div class="float-right mb-3">
      </div>
    </div>
  </div>
  <div class="card card-preview">
    <div class="card-inner">
      <div class="row">
        <div class="col-md-4">
          <form method="POST" action="{{route('award.store')}}">
            @csrf

            <div class="form-group">
              <label class="form-label" for="title">Title<span style="color: red">*</span></label>
              <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('title') }}" name="title" id="title" required>

              @error('title')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label" for="date">Date<span style="color: red">*</span></label>
              <input type="text" class="datepicker form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('date') }}" name="date" id="date" required>

              @error('date')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label" for="ground">Ground</label>
              <input type="text" class="form-control form-control-lg @error('ground') is-invalid @enderror" value="{{ old('ground') }}" name="ground" id="ground">

              @error('ground')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-lg btn-primary btn-block">Save</button>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <table class="datatable-init table">
            <thead>
              <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Date</th>
                <th>Field</th>
                <th>Action</th> 
              </tr>
            </thead>
            <tbody> 
             @forelse ($awards as $award)

             <!-- Modal Start -->
             <div class="modal fade zoom" tabindex="-1" role="dialog" id="details{{$award->id}}">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                  <div class="modal-body modal-body-lg">
                                  <!-- <h5 class="title">Details</h5>
                                  <ul class="nk-nav nav nav-tabs">
                                    <li class="nav-item">
                                      <a class="nav-link active" data-toggle="tab" href="#personal">Lead Details</a>
                                    </li>
                                  </ul> -->
                                  <div class="tab-content">
                                    <div class="tab-pane active" id="personal">

                                    </div>


                                    <form method="POST" action="{{route('award.update', $award->id)}}">
                                      @method('put')
                                      @csrf



                                      <div class="form-group">
                                        <label class="form-label" for="title">Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ $award->title }}" name="title">

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>

                                      <div class="form-group">
                                        <label class="form-label" for="date">Date<span style="color: red">*</span></label>
                                        <input type="text" class="datepicker form-control form-control-lg @error('date') is-invalid @enderror" value="{{ $award->date }}" name="date">

                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>

                                      <div class="form-group">
                                        <label class="form-label" for="ground">Ground</label>
                                        <input type="text" class="form-control form-control-lg @error('ground') is-invalid @enderror" value="{{ $award->ground }}" name="ground">

                                        @error('ground')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>

                                      <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
                                      </div>
                                    </form>
                                    <!-- Modal End -->
                                    <tr> 
                                      <td>{{$loop->index + 1}}</td> 
                                      
                                      <td>
                                        {{ $award->title }}
                                      </td> 
                                      <td>{{ $award->date }}</td>
                                      <td>{{ $award->ground }}</td>

                                      <td>
                                        <a class="btn btn-sm btn-success"  data-toggle="modal" data-target="#details{{ $award->id }}" title="Edit">
                                          <span><em class="icon ni ni-pen-fill"></em></span>
                                        </a>
                                        
                                        <a href="#" class="btn btn-sm btn-danger"
                                        onclick="return myConfirm();">
                                        <span><em class="icon ni ni-trash"></em></span>
                                      </a>
                                      
                                      <form id="delete-form-{{ $award->id }}" action="{{ route('award.destroy', $award->id) }}"
                                        method="POST" style="display: none;">
                                        @csrf @method('delete')
                                      </form>
                                    </td> 
                                  </tr> 
                                  @empty
                                  
                                  @endforelse
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                          
                        </div>
                      </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                    <input type="hidden" id="success" value="{{Session::get('success')}}" />
                    @endsection

                    @section('scripts')

                    <script type="text/javascript">
                      $( function() {
                        $( ".datepicker" ).datepicker({
                          changeMonth: true,
                          changeYear: true
                        });
                      } );

                      function myConfirm() {
                        var result = confirm("Want to delete?");
                        if (result==true) {
                          @if(!empty($award->id))
                          event.preventDefault(); document.getElementById('delete-form-{{ $award->id }}').submit();
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