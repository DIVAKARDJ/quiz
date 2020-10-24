<!-- All JavaScript files
================================================== -->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/wow.js')}}"></script>
<script src="{{asset('assets/js/Chart.min.js')}}"></script>
<!-- brain tree--->
<script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
<!-- Plugins for this template -->
<script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>

<script src="{{asset('assets/DataTables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/DataTables/js/dataTables.responsive.min.js')}}"></script>
<!--drag and drop js-->
<script src="{{asset('assets/dropify/js/dropify.min.js')}}"></script>
<script src="{{asset('assets/dropify/js/form-file-uploads.js')}}"></script>
<script src="{{asset('assets/js/jquery.toast.js')}}"></script>
<!-- Custom script for this template -->
<script src="{{asset('assets/js/script.js')}}"></script>
<script>
    new WOW().init();
    $(document).ready(function () {
        $(".myalert").fadeOut(6000);
    });

    // Window load event used just in case window height is dependant upon images
    $(window).bind("load", function () {
        var footerHeight = 0,
            footerTop = 0,
            $footer = $("#footer");

        positionFooter();

        function positionFooter() {

            footerHeight = $footer.height();
            footerTop = ($(window).scrollTop() + $(window).height() - footerHeight) + "px";

            if (($(document.body).height() + footerHeight) < $(window).height()) {
                $footer.css({
                    position: "absolute"
                }).animate({
                    top: footerTop
                })
            } else {
                $footer.css({
                    position: "static"
                })
            }

        }

        $(window)
            .scroll(positionFooter)
            .resize(positionFooter)

    });
</script>