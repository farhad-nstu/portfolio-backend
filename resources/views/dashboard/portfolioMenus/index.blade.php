@extends('dashboard.master.app')
@section('title')
    Portfolio List
@endsection
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title text-warning">Portfolio List</h4>
            <div class="float-right mb-3">
              <a href="{{ route('portfolioMenus.create') }}" class=" btn btn-icon btn-primary"><em
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
                        <th>Title</th> 
                        <th>Unique No</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                 <tbody> 
                     @forelse ($menus as $menu)
                        <tr> 
                          <td>{{$loop->index + 1}}</td>                        
                            <td>{{ $menu->title }}</td> 
                            <td>{{ $menu->unique_id }}</td> 
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('portfolioMenus.edit', $menu->id) }}" title="Edit">
                                    <span><em class="icon ni ni-pen-fill"></em></span>
                                  </a>
    
                                  <a href="#" class="btn btn-sm btn-danger"
                                  onclick="return myConfirm();">
                                  <span><em class="icon ni ni-trash"></em></span>
                                  </a>
    
                                  <form id="delete-form-{{ $menu->id }}" action="{{ route('portfolioMenus.destroy', $menu->id) }}"
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