@extends('layouts.admin')
@section('title', 'Tour')
@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Danh sách tour</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            @foreach ($tours as $tour)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 tour-card border-radius-lg"
                                    style="background-image: url('{{ asset('clients/images/gallery-tours/' . $tour->thumbnail->imageURL) }}');">

                                    <div class="d-flex flex-column">
                                      <a href=""> <h6 class="mb-3 text-lg text-primary">{{ $tour->title }}</h6></a> 
                                        <span class="mb-2 text-sm">Địa điểm:
                                            <span class="font-weight-bold ms-sm-2">{{ $tour->destination }}</span>
                                        </span>
                                        <span class="mb-2 text-sm">Giá:
                                            <span class="font-weight-bold ms-sm-2">{{ number_format($tour->priceAdult) }}
                                                VND/ Người</span>
                                        </span>
                                        <span class="mb-2 text-sm">Thời gian:
                                            <span class="ms-sm-2 font-weight-bold">{{ $tour->time }}</span>
                                        </span>
                                        <span class="text-sm">Số lượng:
                                            <span class="ms-sm-2 font-weight-bold">{{ $tour->quantity }} người</span>
                                        </span>
                                    </div>

                                    <div class="ms-auto text-end">
                                        <a class="btn btn-link text-success  text-sm text-gradient px-3 mb-0" href="javascript:;">
                                            <i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit
                                        </a>
                                        <a class="btn btn-link text-danger text-sm text-gradient px-3 mb-0"
                                            href="javascript:;">
                                            <i class="far fa-trash-alt me-2"></i>Delete
                                        </a>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
