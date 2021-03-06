<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-89458636-1', 'auto');
    ga('send', 'pageview');
</script>

{{--libraries--}}

<script src="{{asset('lib/jquery-3.1.0.min.js')}}"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
{{--<script src="{{asset('lib/fancybox/lib/jquery-1.10.1.min.js')}}"></script>--}}
<script src="{{asset('lib/chosen-js/chosen.jquery.js')}}"></script>
<script src="{{asset('lib/OwlCarousel2-2.2.0/dist/owl.carousel.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script src="{{asset('lib/lightGallery-master/dist/js/lightgallery.min.js')}}"></script>
<!-- lightgallery plugins -->



<!-- Add mousewheel plugin (this is optional) -->
{{--<script type="text/javascript" src="{{asset('lib/fancybox/lib/jquery.mousewheel-3.0.6.pack.js')}}"></script>
<script type="text/javascript" src="{{asset('lib/fancybox/source/jquery.fancybox.pack.js')}}"></script>--}}




<!-- jQuery library -->

{{--<script type='text/javascript' src='http://yerevancar.am/wp-content/themes/yerevancar/incl/fancybox/source/jquery.fancybox.pack.js?ver=4.5.4'></script>--}}

<script src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('lib/angular/angular.min.js')}}"></script>
<script src="{{asset('lib/angular-route/angular-route.js')}}"></script>

<script src="{{asset('lib/angular-chosen-localytics/dist/angular-chosen.min.js')}}"></script>
<script src="{{asset('lib/angular-socialshare/dist/angular-socialshare.js')}}"></script>


<script src="{{asset('/ng/app.js')}}"></script>

{{--services--}}
<script src="{{asset('ng/service/services.js')}}"></script>
<script src="{{asset('ng/service/validationService.js')}}"></script>
<script src="{{asset('ng/service/helper.js')}}"></script>

{{--controllers--}}
<script src="{{asset('ng/controller/MapController.js')}}"></script>
<script src="{{asset('ng/controller/RootCtrl.js')}}"></script>
<script src="{{asset('ng/controller/currentCtrl.js')}}"></script>
<script src="{{asset('ng/controller/categoryController.js')}}"></script>
<script src="{{asset('ng/controller/homeCtrl.js')}}"></script>
<script src="{{asset('ng/controller/homeCtrl.js')}}"></script>
<script src="{{asset('ng/controller/footerController.js')}}"></script>

{{--directives--}}
<script src="{{asset('ng/directive/scroll.js')}}"></script>
<script src="{{asset('ng/directive/starRating.js')}}"></script>
<script src="{{asset('ng/directive/loader.js')}}"></script>
<script src="{{asset('ng/directive/validationDirective.js')}}"></script>
<script src="{{asset('ng/directive/owl.js')}}"></script>

{{--other js files--}}

{{--<script src="{{asset('lib/star/star.js')}}"></script>--}}

<script src="{{asset('js/animateMenu.js')}}"></script>
<script src="{{asset('js/slider2.js')}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places" async defer></script>
