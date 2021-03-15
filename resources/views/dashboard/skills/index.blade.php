@extends('dashboard.master.app')
@section('title')
skill
@endsection
@section('content')
<div class="nk-block nk-block-lg">
  <div class="nk-block-head">
    <div class="nk-block-head-content">
      <h4 class="nk-block-title text-warning">skill</h4>
      <div class="float-right mb-3">
        
      </div>
    </div>
  </div>
  <div class="card card-preview">
    <div class="card-inner">
      <div class="row">
        <div class="col-md-4">
          <form method="POST" action="{{route('skill.store')}}">
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
                <th>Action</th> 
              </tr>
            </thead>
            <tbody> 
             @forelse ($skills as $skill)

             <!-- Modal Start -->
             <div class="modal fade zoom" tabindex="-1" role="dialog" id="details{{$skill->id}}">
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


                                    <form method="POST" action="{{route('skill.update', $skill->id)}}">
                                      @method('put')
                                      @csrf



                                      <div class="form-group">
                                        <label class="form-label" for="title">Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ $skill->title }}" name="title">

                                        @error('title')
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
                                        {{ $skill->title }}
                                      </td> 

                                      <td>
                                        <a class="btn btn-sm btn-success"  data-toggle="modal" data-target="#details{{ $skill->id }}" title="Edit">
                                          <span><em class="icon ni ni-pen-fill"></em></span>
                                        </a>
                                        
                                        <a href="#" class="btn btn-sm btn-danger"
                                        onclick="return myConfirm();">
                                        <span><em class="icon ni ni-trash"></em></span>
                                      </a>
                                      
                                      <form id="delete-form-{{ $skill->id }}" action="{{ route('skill.destroy', $skill->id) }}"
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
                      function myConfirm() {
                        var result = confirm("Want to delete?");
                        if (result==true) {
                          @if(!empty($skill->id))
                          event.preventDefault(); document.getElementById('delete-form-{{ $skill->id }}').submit();
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