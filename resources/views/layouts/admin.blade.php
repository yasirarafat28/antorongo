<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{\App\Setting::setting()->app_name}} - Dashboards</title>

    <!-- Custom fonts for this template-->
    <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Hind+Siliguri:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" media="all">
    <link href="{{asset('admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" media="all" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" media="all">


    <link rel="stylesheet" href="{{asset('admin/plugins/datatable/dataTables.bootstrap4.min.css')}}" media="all">




    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/admin/plugins/selectpicker/bootstrap-select.min.css">


    <!-- Custom styles for this template-->
    <link href="/admin/css/sb-admin-2.min.css" rel="stylesheet">

    @yield('style')

    <style>
        .btn{
            margin: 3px !important;
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Antorongo <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>ড্যাশবোর্ড</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <li class="nav-item active">
                <a class="nav-link" href="/admin/message">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>বার্তা</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="/admin/balance">
                    <i class="fas fa-coins"></i>
                    <span>ব্যালেন্স সমূহ </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#memberNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>সদস্য ম্যানেজমেন্ট</span>
                </a>
                <div id="memberNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/members/find')}}">সদস্য খুঁজুন </a>
                        <a class="collapse-item" href="{{url('admin/members')}}" >সদস্য তালিকা  </a>
                        <a class="collapse-item" href="{{url('admin/members?project=founding_member')}}" > পরিচালক সদস্য তালিকা  </a>
                    </div>
                </div>
            </li>



            <div class="sidebar-heading">
                সঞ্চয়
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shortSaving"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>স্বল্প মেয়াদী সঞ্চয়</span>
                </a>
                <div id="shortSaving" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/saving/short/application')}}">আবেদন  </a>
                        <a class="collapse-item" href="{{url('admin/saving/short/list')}}">সঞ্চয় তালিকা</a>
                        <!--<a class="collapse-item" href="{{url('admin/saving/find')}}" > <span>আদায়/ কালেকশন </span></a>-->
                        <a class="collapse-item" href="{{url('admin/saving/short/collection-report')}}" > <span>আদায় রিপোর্ট</span></a>
                        <!--<a class="collapse-item" href="{{url('admin/saving/short/withdraw')}}">সঞ্চয় উত্তোলন</a>-->
                        <a class="collapse-item" href="{{url('admin/saving/short/withdraw-report')}}" > <span>উত্তোলন রিপোর্ট</span></a>
                        <a class="collapse-item" href="{{url('admin/saving/short/packages')}}" > <span>পাকেজসমুহ</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#longSaving"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>দীর্ঘ মেয়াদী সঞ্চয়</span>
                </a>
                <div id="longSaving" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/saving/long/application')}}">আবেদন  </a>
                        <a class="collapse-item" href="{{url('admin/saving/long/list')}}">সঞ্চয় তালিকা</a>
                        <!--<a class="collapse-item" href="{{url('admin/saving/long/withdraw')}}">সঞ্চয় উত্তোলন</a>
                        <a class="collapse-item" href="{{url('admin/saving/find')}}" > <span>আদায়/ কালেকশন </span></a>-->
                        <a class="collapse-item" href="{{url('admin/saving/long/collection-report')}}" > <span>আদায় রিপোর্ট</span></a>
                        <a class="collapse-item" href="{{url('admin/saving/long/withdraw-report')}}" > <span>উত্তোলন রিপোর্ট</span></a>
                        <a class="collapse-item" href="{{url('admin/saving/long/packages')}}" > <span>পাকেজসমুহ</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dailySaving"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>দৈনিক সঞ্চয়</span>
                </a>
                <div id="dailySaving" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/saving/daily/application')}}">আবেদন  </a>
                        <a class="collapse-item" href="{{url('admin/saving/daily/list')}}">সঞ্চয় তালিকা</a>
                        <!--<a class="collapse-item" href="{{url('admin/saving/daily/withdraw')}}">সঞ্চয় উত্তোলন</a>
                        <a class="collapse-item" href="{{url('admin/saving/find')}}" > <span>আদায়/ কালেকশন </span></a>-->
                        <a class="collapse-item" href="{{url('admin/saving/daily/collection-report')}}" > <span>আদায় রিপোর্ট</span></a>
                        <a class="collapse-item" href="{{url('admin/saving/daily/withdraw-report')}}" > <span>উত্তোলন রিপোর্ট</span></a>
                        <a class="collapse-item" href="{{url('admin/saving/daily/packages')}}" > <span>পাকেজসমুহ</span></a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#currentSaving"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>সাধারণ সঞ্চয়(সেভিংস )</span>
                </a>
                <div id="currentSaving" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/saving/current/application')}}">আবেদন  </a>
                        <a class="collapse-item" href="{{url('admin/saving/current/list')}}">সঞ্চয় তালিকা</a>
                        <a class="collapse-item" href="{{url('admin/saving/current/collection-report')}}" > <span>আদায় রিপোর্ট</span></a>
                        <a class="collapse-item" href="{{url('admin/saving/current/withdraw-report')}}" > <span>উত্তোলন রিপোর্ট</span></a>

                    </div>
                </div>
            </li>


            <div class="sidebar-heading">
                আমানত
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/admin/founder-deposit">
                    <i class="fas fa-fw fa-hand-holding-usd"></i>
                    <span>পরিচালকের আমানত</span></a>
            </li>

            <div class="sidebar-heading">
                এফ ডি আর
            </div>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fdrNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>এফ ডি আর ম্যানেজমেন্ট</span>
                </a>
                <div id="fdrNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/fdr/application')}}">আবেদন  </a>
                        <a class="collapse-item" href="{{url('admin/fdr/list')}}">এফ ডি আর তালিকা  </a>
                        <a class="collapse-item" href="{{url('admin/fdr/profit-report')}}" >লাভের রিপোর্ট  </a>
                        <!--<a class="collapse-item" href="{{url('admin/fdr/withdraw')}}">এফ ডি আর উত্তোলন  </a>-->
                        <a class="collapse-item" href="{{url('admin/fdr/withdraw-report')}}" >উত্তোলন রিপোর্ট  </a>
                    </div>
                </div>
            </li>


            <div class="sidebar-heading">
                ঋণ
            </div>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loanNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>ঋণ ম্যানেজমেন্ট</span>
                </a>
                <div id="loanNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/loan/application')}}">ঋণ আবেদন  </a>
                        <a class="collapse-item" href="{{url('admin/loan/find')}}">ঋণ খুঁজুন  </a>
                        <a class="collapse-item" href="{{url('admin/loan/list')}}" >ঋণ তালিকা  </a>
                        <!--<a class="collapse-item" href="{{url('admin/collection/collect')}}">কালেকশন/আদায় করুন  </a>-->
                        <a class="collapse-item" href="{{url('admin/collection/report')}}" >কালেকশন/আদায় রিপোর্ট  </a>
                    </div>
                </div>
            </li>


            <div class="sidebar-heading">
                লেনদেন
            </div>



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#incomeNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-arrow-circle-right"></i>
                    <span>আয়</span>
                </a>
                <div id="incomeNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/transaction-head/income')}}">আয়ের খাত  </a>
                        <a class="collapse-item" href="{{url('admin/income/create')}}">আয় যোগ করুন  </a>
                        <a class="collapse-item" href="{{url('admin/income/')}}" > <span> আয়ের রিপোর্ট  </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expenseNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    <span>ব্যয়</span>
                </a>
                <div id="expenseNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/transaction-head/expense')}}">ব্যয় এর খাত  </a>
                        <a class="collapse-item" href="{{url('admin/expense/create')}}">ব্যয় যোগ করুন  </a>
                        <a class="collapse-item" href="{{url('admin/expense/')}}" > <span> ব্যয় এর রিপোর্ট  </a>
                    </div>
                </div>
            </li>


            <div class="sidebar-heading">
                অন্যান্য
            </div>


            <li class="nav-item active">
                <a class="nav-link" href="{{url('admin/meeting')}}">
                    <i class="fas fa-handshake"></i>
                    <span>মিটিং</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{url('admin/documents')}}">
                    <i class="far fa-file"></i>
                    <span>ডকুমেন্ট</span></a>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hrNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-compress-arrows-alt"></i>
                    <span>এইচআর বিভাগ</span>
                </a>
                <div id="hrNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('admin/users')}}" >কর্মচারী </a>
                        <a class="collapse-item" href="{{url('admin/roles')}}" >পদবি </a>
                        <a class="collapse-item" href="{{url('admin/hr/salary-setup')}}" > বেতন সেট করুন  </a>
                        <a class="collapse-item" href="{{url('admin/hr/salary-payment')}}" > <span>বেতন পরিশোধ করুন  </a>
                    </div>
                </div>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reportNav"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-chart-bar"></i>
                    <span>রিপোর্ট</span>
                </a>
                <div id="reportNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <a class="collapse-item" href="{{url('admin/statement/customize')}}" >দৈনিক/মাসিক/ বাৎসরিক </a> --}}
                        <a class="collapse-item" href="{{url('admin/statement/daily-statement')}}" >স্টেটমেন্ট </a>

                    </div>
                </div>
            </li>




            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="/search">
                        <div class="input-group">
                            {{-- <input type="text" value="{{$_GET['q']??''}}" class="form-control bg-light border-0 small" placeholder="বারকোড স্ক্যান করুন ..."
                                aria-label="Search" aria-describedby="basic-addon2" name="q"> --}}

                            <input type="text" value="" class="form-control bg-light border-0 small" placeholder="বারকোড স্ক্যান করুন ..."
                            aria-label="Search" aria-describedby="basic-addon2" name="q">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search" action="/search">
                                    <div class="input-group">
                                        <input type="text" value="{{$_GET['q']??''}}" class="form-control bg-light border-0 small"
                                            placeholder="বারকোড স্ক্যান করুন ..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        {{--
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="/admin/img/undraw_profile_1.svg"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="/admin/img/undraw_profile_2.svg"
                                            alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="/admin/img/undraw_profile_3.svg"
                                            alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>--}}

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{Auth::user()->photo??''}}" onerror="this.src='/admin/img/undraw_profile.svg';">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-full">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/admin/vendor/jquery/jquery.min.js"></script>
    <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/admin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/admin/js/demo/chart-area-demo.js"></script>
    <script src="/admin/js/demo/chart-pie-demo.js"></script>

    <script src='/admin/js/moment.min.js'></script>
    <script src="{{asset('admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>



    <!-- Latest compiled and minified JavaScript -->
    <script src="/admin/plugins/selectpicker/bootstrap-select.min.js"></script>




    <script src="/admin/plugins/datatable/datatablescripts.bundle.js"></script>

    <script src="/admin/plugins/datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="/admin/plugins/datatable/buttons/buttons.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatable/buttons/buttons.colVis.min.js"></script>
    <script src="/admin/plugins/datatable/buttons/buttons.html5.min.js"></script>
    <script src="/admin/plugins/datatable/buttons/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>




<script>
    $(function() {
        $('.dataTable').DataTable({
            //dom: 'lBfrtp',
            dom: 'lBfrtp',
            bFilter:true,
            //"lengthMenu": [[ 25, -1], [25, "All"]],
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],

            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
                // {
                //     extend: 'csv',
                //     exportOptions: {
                //         columns: ':gt(0)'
                //     }
                // },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':gt(0)'
                    }
                },
            ],

            order:[],
            paging: false,
        });
    });
    </script>

    <script>
        $('select').selectpicker();
    </script>
    <script>

        $('.timepicker').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            clearButton: true,
            date: false
        });
        $('.datepicker').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            clearButton: true,
            weekStart: 1,
            maxDate: moment(),
            time: false
        });
    </script>


    @yield('script')
</body>

</html>
