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
                    <div class="position-relative">
                      <a class="d-block">
                        <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-md">
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                      <p class="text-secondary mb-0 text-sm">Project #2</p>
                      <a href="javascript:;">
                        <h5 class="font-weight-bolder">
                          Modern
                        </h5>
                      </a>
                      <p class="mb-4 text-sm">
                        As Uber works through a huge amount of internal management turmoil.
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                            <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                            <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                          </a>
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
