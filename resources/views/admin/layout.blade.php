<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <title>
        @section('title')
        @show
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet"/>
</head>

<body class="g-sidenav-show bg-gray-100 " id="body-show" style="overflow: auto">
@if (Session::has('success'))
    <ul class="notification">
        <li class="success toasts">
            <div class="column">
                <i class="fa fa-bud"></i>
                <span>{{ session('success') }}</span>
            </div>
            <i class="fa fa-xmark close-toast"></i>
        </li>
    </ul>
@elseif (Session::has('error'))
    <ul class="notification">
        <li class="error toasts">
            <div class="column">
                <i class="fa fa-xmark"></i>
                <span>{{ session('error') }}</span>
            </div>
            <i class="fa fa-xmark close-toast"></i>
        </li>
    </ul>
@endif
<ul class="notification">
</ul>
<div class="min-height-300 bg-primary position-absolute w-100"></div>
<aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps bg-white"
        id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a href="{{route('admin.dashboard.index')}}" class="navbar-brand m-0">
            <img src="{{ asset('images/logoCart.png') }}" alt="Fashion Logo"
                 class="navbar-brand-img h-100" style="opacity: .8">
            <span class="ms-1 font-weight-bold">Fashion</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="w-auto sidebar" id="sidenav-collapse-main">
        <ul class="navbar-nav" id="nav_accordion">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                   href="{{ url('admin/dashboard') }}">
                    <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ri-home-2-line text-primary text-sm opacity-10" style="margin-top: -5px"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @can('view-user')
                <li class="nav-item has-submenu">
                    <a class="nav-link" href="#">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-file-user-line text-primary text-sm opacity-10" style="margin-top: -5px"></i>
                        </div>
                        <span class="nav-link-text ms-1 active">Quản lý người dùng</span>
                    </a>
                    <ul class="submenu collapse" style="list-style: none">
                        @if(Auth::user()->hasRole('admin'))
                            <li><a class="nav-link {{ request()->is('admin/user/index') ? 'active' : '' }}"
                                   href="{{ url('admin/user/index') }}">Trang tài khoản </a></li>
                            <li><a class="nav-link {{ request()->is('admin/role/index') ? 'active' : '' }}"
                                   href="{{ url('admin/role/index') }}">Vai trò </a></li>
                            <li><a class="nav-link {{ request()->is('admin/permission/index') ? 'active' : '' }}"
                                   href="{{ url('admin/permission/index') }}">Quyền </a></li>
                        @endif
                    </ul>
                </li>
            @endcan
            @can('view-product')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/product/index') ? 'active' : '' }}"
                       href="{{route('admin.product.index')}}">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-shirt-line text-success text-sm opacity-10" style="margin-top: -5px"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sản phẩm</span>
                    </a>
                </li>
            @endcan
            @can('view-category')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/category/index') ? 'active' : '' }}"
                       href="{{url('admin/category/index')}}">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-clipboard-line mb-1 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Danh mục</span>
                    </a>
                </li>
            @endcan
            @can('view-brand')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/brand/index') ? 'active' : '' }}"
                       href="{{url('admin/brand/index')}}">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-handbag-line mb-1  text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Brand</span>
                    </a>
                </li>
            @endcan
            @can('view-attribute')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/attribute/index') ? 'active' : '' }}"
                       href="{{route('admin.attribute.index')}}">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-stock-line mb-1  text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Thuộc tính</span>
                    </a>
                </li>
            @endcan
            @can('view-value')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/value/index') ? 'active' : '' }}"
                       href="{{route('admin.value.index')}}">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-strikethrough mb-1  text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Giá trị thuộc tính</span>
                    </a>
                </li>
            @endcan
            @can('view-image')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/images/index') ? 'active' : '' }}"
                       href="{{url('admin/images/index')}}">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-image-line mb-1  text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ảnh sản phẩm</span>
                    </a>
                </li>
            @endcan

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Thao tác</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('home')}}">
                    <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ri-pages-line text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Trang người dùng</span>
                </a>
            </li>
            <li class="nav-item">
                <form role="form" style="margin-left: 20px" action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            style="outline: none; border: none; background-color: transparent;display: flex;">
                        <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ri-login-box-line text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1" style="font-size:14px; margin-top:4px;">Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                @section('breadcrumbs')
                @show
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                                                        aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Fashion...">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sản phẩm</p>
                                    <h5 class="font-weight-bolder">
                                        {{\App\Models\admin\Product::count()}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">Tổng sản phẩm</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ri-shirt-line text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Người dùng</p>
                                    <h5 class="font-weight-bolder">
                                        {{\App\Models\User::count()}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-primary text-sm font-weight-bolder">Tổng người dùng</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ri-file-user-line text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Brand</p>
                                    <h5 class="font-weight-bolder">
                                        {{\App\Models\admin\Brand::count()}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder">Tổng brand</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ri-store-2-line  text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Đánh giá</p>
                                    <h5 class="font-weight-bolder">
                                        {{\App\Models\admin\FeedBack::count()}}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-secondary text-sm font-weight-bolder">Tổng đánh giá</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ri-chat-1-line text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                @section('content')
                @show
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            ,
                            đồ án tốt nghiệp của <i class="fa fa-heart"></i>
                            <a href="https://www.facebook.com/vinh.dev.16/" class="font-weight-bold"
                               target="_blank">Xuan Vinh</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.facebook.com/vinh.dev.16/" class="nav-link text-muted"
                                   target="_blank">Xuan Vinh</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</main>
<div class="fixed-plugin ps" id="show-setting">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" id="setting">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Fashion</h5>
                <p>Thời trang và hơn thế nữa</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close" id="close-setting"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Màu thanh bar</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                              onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning"
                          onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger"
                          onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Chọn màu sidenav bar</h6>
                <p class="text-sm">Chọn 1 trong 2 loại sau</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                        onclick="sidebarType(this)">Trắng
                </button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                        onclick="sidebarType(this)">Đen
                </button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="d-flex my-3">
                <h6 class="mb-0">Ẩn thanh Navbar</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                           onclick="navbarFixed(this)">
                </div>
            </div>
            <hr class="horizontal dark my-sm-4">
            <div class="mt-2 mb-5 d-flex">
                <h6 class="mb-0">Trắng / Đen</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                           onclick="darkMode(this)">
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js
"></script>
<script>

    const notifications = document.querySelector('.notification');
    const toast = document.querySelector('.toasts');
    const timer = 3000;


    {{--        event--}}
    //     Pusher.logToConsole = true;
    // var pusher = new Pusher('0c39d13ebf28b8d3f138', {
    //     cluster: 'ap1'
    // });
    //
    // var  channel = pusher.subscribe('post-event');
    // channel.bind('my-handle', function(data) {
    //     createSuccessToast(data.name + ' đã đặt hàng');
    // });
    const removeSuccess = (success) => {
        success.classList.add("hide");
        if (success.timeoutId) clearTimeout(success.timeoutId);
        setTimeout(() => success.remove(), 400);
    };


    // Tao Toast

    function createSuccess(message) {
        const success = document.createElement('li');
        success.className = `toasts success`;
        success.innerHTML = `
                        <div class="column">
                         <i class="fa fa-check"></i>
                            <span>${message}</span>
                        </div>
                           <i class="fa fa-xmark close-toast"></i>
                        `
        notifications.appendChild(success);
        setTimeout(() => removeSuccess(success), 3000)
    };

    // Tao remove toast

    const removeToast = (toast) => {
        toast.classList.add("hide");
        if (toast.timeoutId) clearTimeout(toast.timeoutId);
        setTimeout(() => toast.remove(), 400);
    };


    document.querySelector('.notification').addEventListener('click', function (e) {
        if (e.target.classList.contains('close-toast')) {
            removeToast(e.target.parentElement);
        }
    });


    // Tao Toast

    function createToast(toastMessage) {
        const toast = document.createElement('li');
        toast.className = `toasts error`;
        toast.innerHTML = `
                <div class="column">
                   <i class="ri-bug-line"></i>
                    <span>${toastMessage}</span>
                </div>
                  <i class="fa fa-xmark close-toast" ></i>
                `
        notifications.appendChild(toast);
        setTimeout(() => removeToast(toast), 3000)
    };

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.sidebar .nav-link').forEach(function (element) {

            element.addEventListener('click', function (e) {

                let nextEl = element.nextElementSibling;
                let parentEl = element.parentElement;

                if (nextEl) {
                    e.preventDefault();
                    let mycollapse = new bootstrap.Collapse(nextEl);

                    if (nextEl.classList.contains('show')) {
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        var opened_submenu = parentEl.parentElement.querySelector(
                            '.submenu.show');
                        // if it exists, then close all of them
                        if (opened_submenu) {
                            new bootstrap.Collapse(opened_submenu);
                        }
                    }
                }
            }); // addEventListener
        }) // forEach
    });

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    const setting = document.querySelector('#setting');
    const showSetting = document.querySelector('#show-setting');
    const closeSetting = document.querySelector('#close-setting');
    setting.addEventListener('click', () => {
        if (!showSetting.classList.contains('show')) {
            showSetting.classList.add('show');
        }
    });
    closeSetting.addEventListener('click', () => {
        showSetting.classList.remove('show');
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.show')) {
            showSetting.classList.remove('show');
        }
    });

    const bodyShow = document.querySelector('#body-show');
    iconNavbarSidenav.addEventListener('click', (e) => {
        bodyShow.classList.toggle('g-sidenav-pinned');
    });

    function ChangeToSlug() {
        var slug;

        //Lấy text từ thẻ input title
        slug = document.getElementById("slug").value;
        slug = slug.toLowerCase();
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('convert_slug').value = slug;
    }
</script>
@if (Session::has('success') || Session::has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {


            function removeToast(toast) {
                toast.classList.add("hide");
                if (toast.timeoutId) clearTimeout(toast.timeoutId);
                setTimeout(() => toast.remove(), 400);
            }

            setTime();

            function setTime() {
                setTimeout(() => removeToast(toast), 3000)
            }
        });
    </script>
@endif
@section('javascript')
@show
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/argon-dashboard.min.js?v=2.0.4') }}"></script>

</body>

</html>
