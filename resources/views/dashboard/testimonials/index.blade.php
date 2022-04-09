@extends('dashboard.master.app')
@section('title')
    Works List
@endsection
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title text-warning">Works List</h4>
            <div class="float-right mb-3">
              <a href="{{ route('works.create') }}" class=" btn btn-icon btn-primary"><em
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
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                 <tbody> 
                     @forelse ($works as $work)
                        <tr> 
                          <td>{{$loop->index + 1}}</td> 
                          <td>
                              <div class="nk-tb-col">
                                  <div class="user-card">
                                    <div class="user-info">
                                      @if (!empty($work->icon))
                                      <span class="tb-lead"><img src="{{ $work->icon }}" width="100px;"><span
                                          class="dot dot-success d-md-none ml-1"></span></span>
                                      @else
                                      <span class="tb-lead"><img src="" width="100px;"><span
                                          class="dot dot-success d-md-none ml-1"></span></span>
                                      @endif
                                    </div>

                                  </div>
                              </div>
                          </td>
                            
                            <td>{{ $work->title }}</td> 
                            <td>{{ $work->description }}</td>
                            <td>
                              <div class="nk-tb-col">
                                  <div class="user-card">
                                    <div class="user-info">
                                      @if (!empty($work->image))
                                      <span class="tb-lead"><img src="{{ $work->image }}" width="100px;"><span
                                          class="dot dot-success d-md-none ml-1"></span></span>
                                      @else
                                      <span class="tb-lead"><img src="" width="100px;"><span
                                          class="dot dot-success d-md-none ml-1"></span></span>
                                      @endif
                                    </div>

                                  </div>
                              </div>
                          </td>

                            <td>
                              <a class="btn btn-sm btn-success" href="{{ route('works.edit', $work->id) }}" title="Edit">
                                  <span><em class="icon ni ni-pen-fill"></em></span>
                              </a>
                              <a class="btn btn-sm btn-danger" href="{{ url('admin/work-delete/'. $work->id) }}" title="Details">
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
        @if(!empty($work->id))
        event.preventDefault(); document.getElementById('delete-form-{{ $work->id }}').submit();
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