
@include('site.layouts.includes.header')
@yield('content')
@include('site.layouts.includes.footer')

    <!-- vendor scripts -->
    <script src="{{url('/')}}/public/site/assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="{{url('/')}}/public/site/assets/vendor/venobox.min.js"></script>




    <!-- main.js -->
    <script src="{{url('/')}}/public/site/assets/js/main.js"></script>
    
    <script>
    
        $(document).ready(function(){
            console.log("color1:"+$('input[name="color1"]').val());
            var selected=0;
           
             var itemlist = $('.roww');
            var len=$(itemlist).children().length; 
            
            $(".roww div").click(function(){
                selected= $(this).index();
            });
              
        
             $(".up-arrow").click(function(e){
               e.preventDefault();
               if(selected>0)
               	{
               		jQuery($(itemlist).children().eq(selected-1)).before(jQuery($(itemlist).children().eq(selected)));
                 	selected=selected-1;
             	}
            });
        
             $(".down-arrow").click(function(e){
                 e.preventDefault();
                if(selected < len)
                {
                	jQuery($(itemlist).children().eq(selected+1)).after(jQuery($(itemlist).children().eq(selected)));
                 	selected=selected+1;
             	}
            });
    
        });
    
        window.onload = function () {
        	var upLink = document.querySelectorAll(".up-arrow");
        
        	for (var i = 0; i < upLink.length; i++) {
        		upLink[i].addEventListener('click', function () {
        			var wrapper = this.parentElement;
        
        			if (wrapper.previousElementSibling)
        			    wrapper.parentNode.insertBefore(wrapper, wrapper.previousElementSibling);
        		});
        	}
        
        	var downLink = document.querySelectorAll(".down-arrow");
        
        	for (var i = 0; i < downLink.length; i++) {
        		downLink[i].addEventListener('click', function () {
        			var wrapper = this.parentElement;
        
        			if (wrapper.nextElementSibling)
        			    wrapper.parentNode.insertBefore(wrapper.nextElementSibling, wrapper);
        		});
        	}
        }
    </script>
    

@yield('script')
    <!--========================== End Navbar ==========================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{url('/')}}/public/site/assets/js/toast.js"></script>
@if (\Session::has('alert'))
<script>
Swal.fire({
    icon: "{{ \Session::get('alert')['icon'] }}",
    title: "{{ \Session::get('alert')['title'] }}",
    text: "{{ \Session::get('alert')['text'] }}"
});

</script>
@endif
@if(\Session::has('message'))
<script>
     $.toast({
                title: "{{ \Session::get('message')}}",
                type: 'error',
                delay: 3000,
                dismissible: true,
            });
</script>
@endif

</body>

</html>