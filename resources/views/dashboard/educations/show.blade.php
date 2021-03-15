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
                <div class="row pl-2 pt-2">                  
                  <div class="col-md-12">

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Exam Title</label>
                      </div>
                      <div class="col-sm-8">
                        <span>{{ $education->title }}</span>
                      </div>   
                    </div>    

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Institution</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $education->institute }}</p>
                      </div>   
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Concentration</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $education->concentration }}</p>
                      </div>   
                    </div>  

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Pass Year</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $education->pass_year }}</p>
                      </div>   
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <label class="font-weight-bold">Result</label>
                      </div>
                      <div class="col-sm-8">
                        <p>{{ $education->result }}</p>
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