@extends('layouts.admin')
@section('title', 'tour-guide')
@section('content')
    <div class="container-fluid">

        <div class="row">
             <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Người hướng dẫn tour</h6>
                        <a href="{{ route('admin.createGuide') }}" class="btn btn-primary">Thêm hướng dẫn viên</a>
            
            </div>
            <div class="card-body p-4">
              <div class="row">
                @foreach ($guides as $guide)
                    
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain p-4">
                    <div class="position-relative">
                      <a class="d-block">
                        <img src="{{ $guide->avatar ? asset('clients/images/guide/'.$guide->avatar) : asset('clients/images/avatar/avatar-default.png') }}" alt="img-blur-shadow" class="img-fluid shadow img-guide-admin  rouded">
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0 text-center">
                      <p class="text-secondary mb-0 text-sm">Sdt : {{ $guide->phone }}</p>
                      <a href="javascript:;">
                        <h5 class="font-weight-bolder">
                          {{ $guide->name }}
                        </h5>
                      </a>
                      <p class="mb-4 text-sm">
                       {{ $guide->bio }}
                      </p>
                      <div class="d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.editGuide',$guide->guideId) }}" class="btn btn-outline-primary btn-sm mb-0">Sửa</a>
                      
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        </div>
    </div>
@endsection
