@extends('dashboard.master.app')
@section('title')
skill
@endsection
@section('content')
<div class="nk-block nk-block-lg">
  <div class="nk-block-head">
    <div class="nk-block-head-content">
      <h4 class="nk-block-title text-warning">Attribute</h4>
      <div class="float-right mb-3">
      </div>
    </div>
  </div>
  <div class="card card-preview">
    <div class="card-inner">
      <div class="row">
        <div class="col-md-4">
          <form method="POST" action="{{route('attribute.store')}}" enctype="multipart/form-data">
            @csrf

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
              <label class="form-label" for="name">Skill<span style="color: red">*</span></label>
              <select class="form-control form-control-lg @error('skill_id') is-invalid @enderror" value="{{ old('skill_id') }}" name="skill_id" id="skill_id">
                <option>Select Skill</option>
                @foreach($skills as $skill)
                <option value="{{ $skill->id }}">{{ $skill->title }}</option>
                @endforeach
              </select>
              @error('skill_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <label class="form-label">Logo</label>
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
        </div>
        <div class="col-md-8">
          <table class="datatable-init table">
            <thead>
              <tr>
                <th>SL</th>
                <th>Logo</th>
                <th>Skill</th>
                <th>Title</th> 
                <th>Action</th> 
              </tr>
            </thead>
            <tbody> 
             @forelse ($attributes as $attribute)

             <!-- Modal Start -->
             <div class="modal fade zoom" tabindex="-1" role="dialog" id="details{{$attribute->id}}">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                  <div class="modal-body modal-body-lg">
                                  <h5 class="title">Update Data</h5>

                                  <div class="tab-content">
                                    <div class="tab-pane active" id="personal">

                                    </div>


                                    <form method="POST" action="{{route('attribute.update', $attribute->id)}}" enctype="multipart/form-data">
                                      @method('put')
                                      @csrf

                                      <div class="form-group">
                                        <label class="form-label" for="title">Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ $attribute->title }}" name="title">

                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>

                                      <div class="form-group">
                                        <label class="form-label" for="name">Skill<span style="color: red">*</span></label>
                                        <select class="form-control form-control-lg @error('skill_id') is-invalid @enderror" value="{{ old('skill_id') }}" name="skill_id" id="skill_id">
                                          @foreach($skills as $skill)
                                          <option {{ ($skill->id == $attribute->skill_id) ? 'selected' : '' }} value="{{ $skill->id }}">{{ $skill->title }}</option>
                                          @endforeach
                                        </select>
                                        @error('skill_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>

                                      <div class="form-group">
                                        <label class="form-label">Logo</label>
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
                                    <!-- Modal End -->
                                    <tr> 
                                      <td>{{$loop->index + 1}}</td> 

                                      <td>
                                        <div class="nk-tb-col">
                                          <a href="html/user-details-regular.html">
                                            <div class="user-card">
                                              <div class="user-info">
                                                @if (!empty($attribute->image))
                                                <span class="tb-lead"><img src="{{ $attribute->image }}" width="100px;"><span
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
                                            @foreach($skills as $skill)
                                            @if($skill->id == $attribute->skill_id)
                                            {{ $skill->title }}
                                            @endif
                                            @endforeach
                                          </td>

                                          <td>
                                            {{ $attribute->title }}
                                          </td> 

                                          <td>
                                            <a class="btn btn-sm btn-success"  data-toggle="modal" data-target="#details{{ $attribute->id }}" title="Edit">
                                              <span><em class="icon ni ni-pen-fill"></em></span>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger"
                                            onclick="return myConfirm();">
                                            <span><em class="icon ni ni-trash"></em></span>
                                          </a>

                                          <form id="delete-form-{{ $attribute->id }}" action="{{ route('attribute.destroy', $attribute->id) }}"
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
                              @if(!empty($attribute->id))
                              event.preventDefault(); document.getElementById('delete-form-{{ $attribute->id }}').submit();
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