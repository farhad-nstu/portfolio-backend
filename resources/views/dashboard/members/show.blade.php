@extends('dashboard.master.app')
@section('title')
Dashboard  
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

<div class="nk-content ">
  <div class="container-fluid">
    <div class="nk-content-inner">
      <div class="nk-content-body">
        <div class="nk-block">
          <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
              <div class="card-inner p-0">
                <div id="imageDiv" class="row pl-2 pt-2">
                  <img width="150px" height="150px" class="px-3" src="{{ asset($member->image) }}">
                </div>
                <div class="row pl-2 pt-2">                  
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Title</label>
                      </div>
                      <div class="col-sm-8">
                        <span>{{ $member->title }}</span>
                      </div>   
                    </div>    

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Email</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $member->email }}</p>
                      </div>   
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Phone</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $member->phone }}</p>
                      </div>   
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Designation</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $member->designation }}</p>
                      </div>   
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Company Name</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $member->company_name }}</p>
                      </div>   
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Description</label>
                      </div>
                      <div class="col-sm-8">
                        <span>{!! $member->description !!}</span>
                      </div>   
                    </div>                        
                    
                  </div>
                </div>              
              </div>
            </div>
          </div>
        </div>
      </div>                 
    </div>
  </div>
</div>

@endsection