<!-- BEGIN SIDEBAR -->
<!-- BEGIN SIDEBPANEL-->
<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu">

    </div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <img src="{{asset('scaffolding/core/img/logo_blue.png')}}" alt="logo" class="brand"
             data-src="{{asset('scaffolding/core/img/logo_blue.png')}}" data-src-retina="{{asset('scaffolding/core/img/logo_blue_2x.png')}}"
             width="78" height="22">
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">

            @include('layouts.partials.sidebar._dashboard')
            @include('layouts.partials.sidebar._student')

        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
<!-- END SIDEBAR -->
<!-- END SIDEBAR -->