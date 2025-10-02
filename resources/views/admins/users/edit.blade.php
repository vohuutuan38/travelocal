@extends('layouts.admin')
@section('title', 'User edit')
@section('content')
 <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <form role="form text-left" method="POST" action="{{ route('admin.updateUser',$user->userId) }}">
            @csrf
            <label>Name</label>
                  <div class="mb-3">
                    <input type="text" class="form-control" name="userName" placeholder="Name" aria-label="Name" aria-describedby="email-addon" value="{{ $user->userName }}">
                  </div>
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon" value="{{ $user->email }}">
                  </div>
                 
                  <label>Status</label>
                   <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" name="isActive" type="checkbox" id="flexSwitchCheckDefault" {{ $user->isActive == 'y' ? 'checked' : '' }}>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">update</button>
                  </div>
                
                </form>
        </div>
      </div>
      
    </div>
@endsection