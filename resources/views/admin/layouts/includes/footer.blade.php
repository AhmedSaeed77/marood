

    
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{url('/')}}/public/admin/assets/js/jquery.min.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/bootstrap-rtl.min.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/detect.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/fastclick.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/jquery.slimscroll.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/jquery.blockUI.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/waves.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/wow.min.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/jquery.nicescroll.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/jquery.scrollTo.min.js"></script>
        <!-- jQuery  -->
        <script src="{{url('/')}}/public/admin/assets/plugins/moment/moment.js"></script>


       
        <script src="{{url('/')}}/public/admin/assets/plugins/raphael/raphael-min.js"></script>

         <!-- <script src="{{url('/')}}/public/admin/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script> -->

        <!-- Todojs  -->
        <script src="{{url('/')}}/public/admin/assets/pages/jquery.todo.js"></script>

        <!-- chatjs  -->
        <script src="{{url('/')}}/public/admin/assets/pages/jquery.chat.js"></script>

        <script src="{{url('/')}}/public/admin/assets/plugins/peity/jquery.peity.min.js"></script>
		
		<script src="{{url('/')}}/public/admin/assets/js/jquery.core.js"></script>
        <script src="{{url('/')}}/public/admin/assets/js/jquery.app.js"></script>

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
        @yield('afterscript')

    </body>
</html>