@extends('dashboard.master.app')
@section('title')
    Portfolio Menu Child
@endsection
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title text-warning">Portfolio Menu Child List</h4>
            <div class="float-right mb-3">
              <a href="{{ route('portfolioMenuChilds.create') }}" class=" btn btn-icon btn-primary"><em
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
                        <th>Title</th> 
                        <th>Menu</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                 <tbody> 
                     @forelse ($childs as $child)
                        <tr> 
                          <td>{{$loop->index + 1}}</td> 
                          <td>
                              <div class="nk-tb-col">
                                <div class="user-card">
                                  <div class="user-info">
                                    @if (!empty($child->image))
                                    <span class="tb-lead"><img src="{{ asset($child->image) }}" width="100px;"><span
                                        class="dot dot-success d-md-none ml-1"></span></span>
                                    @else
                                    <span class="tb-lead"><img src="" width="100px;"><span
                                        class="dot dot-success d-md-none ml-1"></span></span>
                                    @endif
                                  </div>
                                </div>
                              </div>
                          </td>
                            
                            <td>{{ $child->title }}</td> 
                            <td>{{ $child->menu->title }}</td>

                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('portfolioMenuChilds.edit', $child->id) }}" title="Edit">
                                    <span><em class="icon ni ni-pen-fill"></em></span>
                                  </a>
    
                                  <a href="#" class="btn btn-sm btn-danger"
                                  onclick="return myConfirm();">
                                  <span><em class="icon ni ni-trash"></em></span>
                                  </a>
    
                                  <form id="delete-form-{{ $child->id }}" action="{{ route('portfolioMenuChilds.destroy', $child->id) }}"
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
        @if(!empty($child->id))
        event.preventDefault(); document.getElementById('delete-form-{{ $child->id }}').submit();
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