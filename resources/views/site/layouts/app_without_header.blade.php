
<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <?php $setting=\App\Models\setting::get(); ?>
<head>
    <meta charset="UTF-8">
 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{url('/')}}/public/storage/{{$setting->where('name','favicon')->first()->value}}" sizes="16x16" type="image/png"> 

    <title>@lang('site.siteName')</title>
    <!-- vendor styles -->
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/FontAwesome/all.css">
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/bootstrap/css/bootstrap.css">
     <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/owl.carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/owl.carousel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/vendor/venobox.css">

    <!-- main style -->
    <link rel="stylesheet" href="{{url('/')}}/public/site/assets/css/style.css">

    <!--======================== remove comment to make the site (ltr) ======================-->
    <!-- <link rel="stylesheet" href="{{url('/')}}/public/site/assets/css/style-ltr.css"> -->
    
        @yield('style')

</head>

<body>
    <input type="hidden" value="{{$setting->where('name','MainColor')->first()->value}}" name="color1">
        <input type="hidden" value="{{$setting->where('name','SecondColor')->first()->value}}" name="color2">

@yield('content')

 <!-- vendor scripts -->
    <script src="{{url('/')}}/public/site/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/venobox.min.js"></script>
    


   

@yield('script')


    <!-- main.js -->
    <script src="{{url('/')}}/public/site/assets/js/main.js"></script>

 <!--========================== End Navbar ==========================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (\Session::has('alert'))
<script>
Swal.fire({
    icon: "{{ \Session::get('alert')['icon'] }}",
    title: "{{ \Session::get('alert')['title'] }}",
    text: "{{ \Session::get('alert')['text'] }}"
});

</script>
@endif







    <!--========================== End Navbar ==========================-->

</body>

</html>