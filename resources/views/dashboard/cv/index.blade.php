@extends('dashboard.master.app')
@section('title')
    Projects List
@endsection
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title text-warning">List</h4>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Resume</th>
                        <th>Action</th> 
                    </tr>
                </thead>
                 <tbody> 
                        <tr> 
                          <td>
                              <div class="nk-tb-col">
                                <a href="{{ route('file.download', $resume->id) }}">
                                  <div class="user-card">
                                    <div class="user-info">
                                      <span class="tb-lead">Download File</span>
                                    </div>

                                  </div>
                                </a>
                              </div>
                          </td>
                            
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('resume.edit', $resume->id) }}" title="Edit">
                                    <span><em class="icon ni ni-pen-fill"></em></span>
                                  </a>
    
                            </td> 
                        </tr> 
                    
                 </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
<input type="hidden" id="success" value="{{Session::get('success')}}" />
@endsection
