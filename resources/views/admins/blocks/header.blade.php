 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
     navbar-scroll="true">
     <div class="container-fluid py-1 px-3">
        
         <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
             <ul class="ms-md-auto pe-md-3 d-flex align-items-center">
                 <li class="nav-item d-flex align-items-center">
                     <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="">
                         @if (Auth::guard('admin')->check())
                             {{ Auth::guard('admin')->user()->userName }}
                         @endif
                     </a>
                 </li>
             </ul>
         </div>
     </div>
      @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show flex-center-message" role="alert"
                    id="flash-message">
                    <i class="fad fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show flex-center-message" role="alert"
                    id="flash-message">
                    <i class="fad fa-times-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
 </nav>
