@extends('layouts.main')

@push('child-styles')
<!-- push needed plugins for this page-->

@endpush

@push('child-scripts-plugins')
<!-- push needed plugins for this page -->
@endpush

@push('child-page-controller')

<script>
    $('#notify').click(function (e) {
        e.preventDefault()
        $.get('/testing/broadcast')
    })
</script>

@include('layouts.partials.snippets._notification_to_zoom_out80')

@endpush

@section('content')
    <div class="page-content-wrapper full-height">
        <!-- START PAGE CONTENT -->
        <div class="content full-height">
            <!-- START APP -->
            <!-- START SECONDARY SIDEBAR MENU-->
            <nav class="secondary-sidebar light">
                <div class=" m-b-30 m-l-30 m-r-30 hidden-sm-down">
                    <a href="email_compose.html" class="btn btn-primary btn-block btn-compose">Compose</a>
                </div>
                <p class="menu-title">BROWSE</p>
                <ul class="main-menu">
                    <li class="active">
                        <a href="#">
                            <span class="title"><i class="pg-inbox"></i> Inbox</span>
                            <span class="badge pull-right">5</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <span class="title"><i class="pg-folder"></i> All mail</span>
                        </a>
                        <ul class="sub-menu no-padding">
                            <li>
                                <a href="#">
                                    <span class="title">Important</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="title">Labeled</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title"><i class="pg-sent"></i> Sent</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title"><i class="pg-spam"></i> Spam</span>
                            <span class="badge pull-right">10</span>
                        </a>
                    </li>
                </ul>
                <p class="menu-title m-t-20 all-caps">Quick view</p>
                <ul class="sub-menu no-padding">
                    <li>
                        <a href="#">
                            <span class="title">Documents</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Flagged</span>
                            <span class="badge pull-right">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="title">Images</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- END SECONDARY SIDEBAR MENU -->
            <div class="inner-content full-height">
                <!-- START PAGE CONTENT -->
                <div class="selection-hide">
                    <!-- START JUMBOTRON -->
                    <div class="jumbotron" data-pages="parallax">
                        <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
                            <div class="inner">
                                <!-- START BREADCRUMB -->
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    {{--<li class="breadcrumb-item active">Layout</li>--}}
                                </ol>
                                <!-- END BREADCRUMB -->
                            </div>
                        </div>
                    </div>
                    <!-- END JUMBOTRON -->
                    <!-- START CONTAINER FLUID -->
                    <div class="container-fluid container-fixed-lg">
                        {{--<button id="notify">Notify</button>--}}
                        <div class="center-margin text-center p-t-200">
                            <h2><b>Coming Soon!</b></h2>
                            <h3> We are still not ready. Feature is currently being developed :)</h3>
                        </div>

                    </div>
                    <!-- END CONTAINER FLUID -->
                </div>
                <!-- END PAGE CONTENT -->
            </div>
            <!-- END APP -->
        </div>
        <!-- END PAGE CONTENT -->
    </div>


@endsection