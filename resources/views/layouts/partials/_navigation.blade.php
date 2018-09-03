<!-- START PAGE HEADER WRAPPER -->
<!-- START HEADER -->
<div class="header bg-primary-dark"></div>
<div class="header light bg-primary" style="margin-top: 8px">
    <!-- START MOBILE SIDEBAR TOGGLE -->
    <a href="#" data-toggle="sidebar" class="btn-link toggle-sidebar hidden-lg-up pg pg-menu custom-btn-page"></a>
    <!-- END MOBILE SIDEBAR TOGGLE -->
    <div class="">
        <div class="custom-div-btn-page"><a id="custom-btn-page" href="#" class="btn-link pg-menu custom-btn-page"></a>
        </div>
        <div class="brand inline p-l-0" style="width: 230px; margin-top: -7px;">
            <img src="{{asset('scaffolding/core/img/logo_crm.png')}}" alt="logo"
                 data-src="{{asset('scaffolding/core/img/logo_crm.png')}}"
                 data-src-retina="{{asset('scaffolding/core/img/logo_crm.png')}}" width="165">
            <span class="text-white fs-14 ">v.</span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="easy-autocomplete eac-square eac-description" id="input-group">
            <input type="text"
                   id="search-box"
                   class="form-control"
                   placeholder="Click here to search">
        </div>
    </div>

    <div class="d-flex align-items-center">
        <!-- START NOTIFICATION LIST -->
        <ul class="hidden-md-down notification-list no-margin hidden-sm-down b-grey b-r no-style p-l-30 p-r-20">
            <li class="p-r-10 inline">
                <div class="dropdown">
                    <notification-button></notification-button>
                </div>
            </li>
            <li class="p-r-10 inline">
                <a href="#" class="header-icon fa fa-comment white cursor m-b-5"
                   style="font-size: 18px"></a>
            </li>
            <li class="p-r-10 inline">
                <a href="#" class="header-icon pg pg-thumbs white"></a>
            </li>
        </ul>
        <!-- END NOTIFICATIONS LIST -->
        <!-- START User Info-->
        <div class="pull-left p-r-10 fs-14 font-heading hidden-md-down m-l-20">
            <span class="semi-bold white">Admin-Name</span>
        </div>
        <div class="dropdown pull-right hidden-md-down">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline">
              <img src="{{asset('scaffolding/core/img/profiles/avatar_small2x.jpg')}}"
                   alt=""
                   width="32" height="32">

              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                <a href="#" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
                <a href="#" class="dropdown-item"><i class="fa fa-envelope"></i>
                    Notifications</a>
                <a href="#" class="dropdown-item"><i class="pg-signals"></i> Help</a>
                <a href="#" id="logout-btn" class="clearfix bg-master-lighter dropdown-item">
                    <span class="pull-left">Logout</span>
                    <span class="pull-right"><i class="pg-power"></i></span>
                </a>
            </div>
        </div>
        <!-- END User Info-->
        {{--<a href="#" class="header-icon pg pg-alt_menu btn-link m-l-10 sm-no-margin d-inline-block"--}}
        {{--data-toggle="quickview" data-toggle-element="#quickview"></a>--}}

        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
            {{csrf_field()}}
        </form>
    </div>
</div>
<!-- END HEADER -->
<!-- END PAGE HEADER WRAPPER -->

@push('child-page-controller')
<script>

    $(document).ready(function () {
//        $('.easy-autocomplete, .eac-square').css('width', '100% !important')
        $('.easy-autocomplete, .eac-square').addClass('search-easy-autocomplete');

        var options = {

            url: "resources/countries",

            getValue: function(element) {
                return element.name;
            },

            template: {
                type: "links",
                fields: {
                    link: "id"
                }
            },

            list: {
                maxNumberOfElements: 100,
                match: {
                    enabled: true
                },
                sort: {
                    enabled: true
                }
            },
            theme: "square"
        };

        $("#search-box").easyAutocomplete(options);
    });
</script>
@endpush
