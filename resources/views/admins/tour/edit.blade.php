@extends('layouts.admin')
@section('title', 'Tour Edit')
@section('content')
    <div class="container-fluid py-4">
        <div class="card mb-4">

            <div class="card-header p-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <img src="{{ asset('clients/images/avatar/avatar-default.png') }}" class="img-fluid rounded shadow"
                            alt="tour1">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('clients/images/avatar/avatar-default.png') }}" class="img-fluid rounded shadow"
                            alt="tour2">
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('clients/images/avatar/avatar-default.png') }}" class="img-fluid rounded shadow"
                            alt="tour3">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('clients/images/avatar/avatar-default.png') }}" class="img-fluid rounded shadow"
                            alt="tour4">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('clients/images/avatar/avatar-default.png') }}" class="img-fluid rounded shadow"
                            alt="tour5">
                    </div>
                </div>
            </div>
             <div class="card-body p-3">
              <div class="row">
                <div class="col-xl-12  mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    
                  </div>
                </div>
               
               
              </div>
            </div>
        </div>
    </div>
@endsection
