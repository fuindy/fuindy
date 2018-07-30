<!-- BEGIN VENDOR JS -->
<script src="{{asset('plugins/feather-icons/feather.min.js')}}" type="text/javascript"></script> <!-- feather icons -->
<script src="{{asset(mix('plugins/js/pace.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/jquery-1.11.1.min.js'))}}" type="text/javascript"></script> <!-- jquery -->
<script src="{{asset(mix('plugins/js/modernizr.custom.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/jquery-ui.min.js'))}}" type="text/javascript"></script> <!-- jquery UI -->
<script src="{{asset(mix('plugins/js/tether.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/bootstrap.min.js'))}}" type="text/javascript"></script> <!-- bootstrap-->
<script src="{{asset(mix('plugins/js/jquery-easy.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/jquery.unveil.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/jquery.bez.min.js'))}}"></script>
<script src="{{asset(mix('plugins/js/jquery.ioslist.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/imagesloaded.pkgd.min.js'))}}"></script>
<script src="{{asset(mix('plugins/js/jquery.actual.min.js'))}}"></script>
<script src="{{asset(mix('plugins/js/jquery.scrollbar.min.js'))}}"></script>
<script src="{{asset(mix('plugins/js/classie.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/jquery.sieve.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/select2.full.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/jquery.inputmask.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/moment.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/bootstrap-datepicker.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/bootstrap-timepicker.min.js'))}}" type="text/javascript"></script>
<script src="{{asset(mix('plugins/js/accounting.min.js'))}}" type="text/javascript"></script>

<script src="{{asset(mix('scaffolding/core/js/core-theme.js'))}}" type="text/javascript"></script> <!-- core theme -->

<script src="{{asset(mix('scaffolding/js/app.js'))}}" type="text/javascript"></script> <!-- app -->

<script src="{{asset('plugins/jquery-easy-autocomplete/jquery.easy-autocomplete.js')}}"></script>

@stack('child-scripts-plugins') <!-- Make sure it is put below app.js -->
@stack('child-page-controller') <!-- Make sure it is put below app.js -->

