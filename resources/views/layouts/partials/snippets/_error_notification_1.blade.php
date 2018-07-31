@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @foreach(['bar','flip','simple','circle'] as $style)
        @foreach(['top','bottom','top-right','bottom-right'] as $position)
            @if(Session::has('alert-' . $msg .'-'.$style.'-'.$position))
                <script>
                    (function ($) {
                        $('.page-container').pgNotification({
                            style: "{{$style}}",
                            message: "{{ Session::get('alert-' . $msg .'-'.$style.'-'.$position) }}",
                            position: "{{$position}}",
                            timeout: 3500,
                            type: "{{$msg}}"
                        }).show();
                    })(window.jQuery);
                </script>
            @endif
        @endforeach
    @endforeach
@endforeach