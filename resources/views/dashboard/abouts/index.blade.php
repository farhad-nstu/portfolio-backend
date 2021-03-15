@extends('dashboard.master.app')
@section('title')
    About
@endsection
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title text-warning">About</h4>
            <div class="float-right mb-3">
              <a href="{{ route('about.create') }}" class=" btn btn-icon btn-primary"><em
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
                        <th>Image</th>
                        <th>Name</th> 
                        <th>Email</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                 <tbody> 
                     @forelse ($abouts as $about)
                        <tr> 
                          <td>{{$loop->index + 1}}</td> 
                          <td>
                              <div class="nk-tb-col">
                                <a href="html/user-details-regular.html">
                                  <div class="user-card">
                                    <div class="user-info">
                                      @if (!empty($about->image))
                                      <span class="tb-lead"><img src="{{ $about->image }}" width="100px;"><span
                                          class="dot dot-success d-md-none ml-1"></span></span>
                                      @else
                                      <span class="tb-lead"><img src="" width="100px;"><span
                                          class="dot dot-success d-md-none ml-1"></span></span>
                                      @endif
                                    </div>

                                  </div>
                                </a>
                              </div>
                          </td>
                            
                            <td>
                                <a href="{{ route('about.show', $about->id) }}">{{ $about->name }}</a>
                            </td> 

                            <td>{{ $about->email }}</td>

                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('about.edit', $about->id) }}" title="Edit">
                                    <span><em class="icon ni ni-pen-fill"></em></span>
                                  </a>
    
                                  <a class="btn btn-sm btn-info" href="{{ route('about.show', $about->id) }}" title="Details">
                                    <span><em class="icon ni ni-eye-fill"></em></span>
                                  </a>
    
                                  <a href="#" class="btn btn-sm btn-danger"
                                  onclick="return myConfirm();">
                                  <span><em class="icon ni ni-trash"></em></span>
                                  </a>
    
                                  <form id="delete-form-{{ $about->id }}" action="{{ route('about.destroy', $about->id) }}"
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
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
<input type="hidden" id="success" value="{{Session::get('success')}}" />
@endsection

@section('scripts')

<script type="text/javascript">
    function myConfirm() {
      var result = confirm("Want to delete?");
      if (result==true) {
        @if(!empty($about->id))
        event.preventDefault(); document.getElementById('delete-form-{{ $about->id }}').submit();
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