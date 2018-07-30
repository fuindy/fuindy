{{--start of theme css--}}
<link href="{{asset(mix('plugins/css/pace-theme-flash.css'))}}" rel="stylesheet" type="text/css" />
<link href="{{asset(mix('plugins/css/bootstrap.min.css'))}}" rel="stylesheet" type="text/css" />  <!--bootstrap -->
<link href="{{asset('plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" /> <!--font awesome-->
<link href="{{asset(mix('plugins/css/jquery.scrollbar.css'))}}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{asset(mix('plugins/css/select2.min.css'))}}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{asset(mix('plugins/css/datepicker3.css'))}}" rel="stylesheet" type="text/css" media="screen"/>
<link href="{{asset(mix('plugins/css/bootstrap-timepicker.min.css'))}}" rel="stylesheet" type="text/css" media="screen"/>

@stack('child-styles')

<link href="{{asset(mix('scaffolding/core/css/theme-icons.css'))}}" rel="stylesheet" type="text/css">  <!--icons-->
<link class="main-stylesheet" href="{{asset(mix('scaffolding/core/css/core-theme.css'))}}" rel="stylesheet" type="text/css" />  <!--core template-->
{{--end of theme css--}}

<link rel="stylesheet" href="{{asset(mix('scaffolding/css/app.css'))}}">  <!-- app -->

<link rel="stylesheet" href="{{asset('plugins/jquery-easy-autocomplete/easy-autocomplete.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/jquery-easy-autocomplete/easy-autocomplete.themes.min.css')}}">