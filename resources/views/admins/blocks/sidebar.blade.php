{{-- {{ dd(request()->route()->getName()) }} --}}

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
        <img src="{{ asset('admins/img/logo_travelocal.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Travelocal</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="far fa-home"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item ">
        <a class="nav-link {{ request()->routeIs('admin.listUser') || request()->routeIs('admin.editUser') ? 'active' : '' }}" href="{{ route('admin.listUser') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
             <i class="far fa-users"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.listTour') || request()->routeIs('admin.editTour') || request()->routeIs('admin.createTour') ? 'active' : '' }}" href="{{ route('admin.listTour') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="far fa-plane-departure"></i>
            </div>
            <span class="nav-link-text ms-1">Tours</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.listBooking') ||request()->routeIs('admin.showBooking') || request()->routeIs('admin.trashBooking') ? 'active' : '' }} " href="{{ route('admin.listBooking') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-ticket-alt"></i>
            </div>
            <span class="nav-link-text ms-1">Booking</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.listGuide') ||request()->routeIs('admin.createGuide') || request()->routeIs('admin.editGuide') ? 'active' : '' }} " href="{{ route('admin.listGuide') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-user-headset"></i>
            </div>
            <span class="nav-link-text ms-1">tour-guid</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.listFaqs') ||request()->routeIs('admin.createFaqs') || request()->routeIs('admin.editFaqs') || request()->routeIs('admin.trashFaqs') ? 'active' : ''  }} " href="{{ route('admin.listFaqs') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="far fa-question-square"></i>
            </div>
            <span class="nav-link-text ms-1">Faqs</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('admin.listIcon') ||request()->routeIs('admin.createIcon') || request()->routeIs('admin.editIcon') || request()->routeIs('admin.trashIcon') ? 'active' : ''  }} " href="{{ route('admin.listIcon') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-hiking"></i>
            </div>
            <span class="nav-link-text ms-1">Acitvity</span>
          </a>
        </li>
         <li class="nav-item">
          <a class="nav-link  " href="../pages/rtl.html">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="far fa-question-square"></i>
            </div>
            <span class="nav-link-text ms-1">Acitvity</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/rtl.html">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
           <i class="far fa-comment-alt-dots"></i>
            </div>
            <span class="nav-link-text ms-1">Chat</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account </h6>
        </li>
       
        <li class="nav-item">
          <a class="nav-link  " href="../pages/sign-up.html">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
             <i class="fas fa-person-sign"></i>
            </div>
            <span class="nav-link-text ms-1">info</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../pages/sign-in.html">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
             <i class="fas fa-sign-out"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
   
  </aside>