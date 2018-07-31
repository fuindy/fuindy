/**
 * Created by kevinpurwono on 10/11/17.
 */
$(document).ready(function () {

    /* AJAX SETUP FOR ALL AJAX REQUEST */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            // alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
            let xhrResponse = JSON.parse(xhr.responseText);
            let errorMsg = 'Request Status: ' + xhr.status + ' Error: ' + xhrResponse.message + ' Exception: ' + xhrResponse.exception;

            $('.page-container').pgNotification({
                style: 'bar',
                message: errorMsg,
                position: 'top',
                timeout: 0,
                type: 'error'
            }).show();
        }
    });


    // Feather Icons
    feather.replace({
        'width': 16,
        'height': 16
    });

    // Sieve Search
    $('.filter-container').sieve({
        searchInput: $('#search-box'),
        itemSelector: ".filter-item"
    });

    // close column search
    $('#overlay-search').addClass('hide');

    // Cards
    $('.card').card({
        progress: 'bar',
        onRefresh: function () {
            setTimeout(function () {
                // Hides progress indicator
                $('.card').card({
                    refresh: false
                });
            }, 2000);
        }
    });

    //Date picker
    // on init
    $('.datepicker').datepicker({format: 'dd/mm/yyyy', todayHighlight: true, autoclose: true,});

    $(function ($) {
        $(".datepicker").mask("99/99/9999");
    });

    $(function ($) {
        $(".time-mask").mask("99:99");
    });

    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // disable mousewheel on a input number field when in focus
    // (to prevent Cromium browsers change the value when scrolling)
    $('body').on('focus', 'input[type=number]', function (e) {
        $(this).on('mousewheel.disableScroll', function (e) {
            e.preventDefault()
        })
    })

    $('body').on('blur', 'input[type=number]', function (e) {
        $(this).off('mousewheel.disableScroll')
    })


    /**
     * Check if user is using Chrome, use this, to alert
     * other browser users to use Chrome for better perfomance
     */

    function isChrome() {
        let isChromium = window.chrome,
            winNav = window.navigator,
            vendorName = winNav.vendor,
            isOpera = winNav.userAgent.indexOf("OPR") > -1,
            isIEedge = winNav.userAgent.indexOf("Edge") > -1,
            isIOSChrome = winNav.userAgent.match("CriOS");

        if (isIOSChrome) {
            return true;
        } else if (
            isChromium !== null &&
            typeof isChromium !== "undefined" &&
            vendorName === "Google Inc." &&
            isOpera === false &&
            isIEedge === false
        ) {
            return true;
        } else {
            return false;
        }
    }

    if (!isChrome()) {
        $('.page-container').pgNotification({
            style: 'flip-right',
            message: 'GXApp currently only supports <b>Chrome</b> browser, ' +
            '<b>it is recommended to use Chrome</b> for better performances and to avoid existing bugs on other browser. ' +
            'We are still working on to make it compatible with other browser too.',
            position: 'top-right',
            timeout: 20000,
            type: 'warning'
        }).show();
    }


    // Button Page-Sidebar
    $('#custom-btn-page').click(function(){
        var x = $('.page-sidebar').hasClass('custom-page-sidebar');
        if(x){
            $('.page-sidebar').removeClass('custom-page-sidebar');
            $('.content').removeClass('custom-content');
            $('.page-sidebar').removeAttr("style");
        }else{
            $('.page-sidebar').addClass('custom-page-sidebar');
            $('.content').addClass('custom-content');
            $('.page-sidebar').attr("style", "transform: translate3d(0px, 0px, 0px) !important");
        }

        $(document).ready(function(){
            $('.custom-page-sidebar').hover(
                function(){
                    $('.custom-page-sidebar').attr("style", "transform: translate(210px, 0px) !important; left: -210px");
                },
                function () {
                    $('.custom-page-sidebar').attr("style", "transform: translate3d(0px, 0px, 0px) !important");
                }
            );
        });

        $(window).on('resize', function(){
            var screen = $(window).width();
            if(screen < 1215){
                $('.page-sidebar').removeClass('custom-page-sidebar');
                $('.content').removeClass('custom-content');
            }
        });
    });


});