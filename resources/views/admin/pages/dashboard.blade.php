 @extends('admin::layout.app')
 @section('title', 'dashboard')
 @section('admin::content')
     <div class="content-wrapper">
         @if (session('status'))
             <div class="alert alert-{{ session('status')['type'] }}">
                 {{ session('status')['message'] }}
             </div>
         @endif
         <div class="page-header">
             <h3 class="page-title">
                 <span class="page-title-icon bg-gradient-primary text-white me-2">
                     <i class="mdi mdi-home"></i>
                 </span>
                 Dashboard
             </h3>
             <nav aria-label="breadcrumb">
                 <ul class="breadcrumb">
                     <li class="breadcrumb-item active" aria-current="page">
                         <span></span>Overview
                         <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                     </li>
                 </ul>
             </nav>

         </div>

         <div>
             <h3>Admin Dashboard</h3>
         </div>
         <div class="row">
             <div class="col-md-4 stretch-card grid-margin">
                 <div class="card bg-gradient-danger card-img-holder text-white">
                     <div class="card-body">
                         <h4 class="font-weight-normal mb-3">
                             Total Departments
                             <i class="mdi mdi-microsoft-teams menu-icon mdi-24px float-end"></i>
                         </h4>
                         <h2 class="mb-5">{{ $departments }}</h2>
                     </div>
                 </div>
             </div>
             <div class="col-md-4 stretch-card grid-margin">
                 <div class="card bg-gradient-info card-img-holder text-white">
                     <div class="card-body">
                         <h4 class="font-weight-normal mb-3">
                             Total Team Lead
                             <i class="mdi mdi-diamond mdi-24px float-end"></i>
                         </h4>
                         <h2 class="mb-5">{{ $teamleads }}</h2>
                     </div>
                 </div>
             </div>
             <div class="col-md-4 stretch-card grid-margin">
                 <div class="card bg-gradient-success card-img-holder text-white">
                     <div class="card-body">
                         {{-- <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" /> --}}
                         <h4 class="font-weight-normal mb-3">
                             Total Members
                             <i class="mdi mdi-account-group menu-icon mdi-24px float-end"></i>
                         </h4>
                         <h2 class="mb-5">{{ $members }}</h2>


                     </div>
                 </div>
             </div>
         </div>


     </div>

 @endsection
