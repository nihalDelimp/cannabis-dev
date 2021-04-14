<footer class="main-footer">

</footer>
<!-- <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}" defer></script> -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- jQuery UI 1.11.4 -->

<!-- <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}" defer></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.7 -->

<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}" defer></script>
<script src="{{ asset('bower_components/raphael/raphael.min.js') }}" defer></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js') }}" defer></script>
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}" defer></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" defer></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" defer></script>
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}" defer></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}" defer></script>
<!-- <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" defer></script> -->
<!-- <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}" defer></script> -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" defer></script>
<script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}" defer></script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}" defer></script>
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}" defer></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}" defer></script>

<script src="{{ asset('bower_components/moment/moment.js') }}"></script>
<script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<!-- <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script> -->

<script src="{{ asset('dist/js/demo.js') }}" defer></script>
<script src="{{ asset('js/custom/jquery.form.js') }}" defer></script>
<script src="{{ asset('js/custom/jquery.validate.js') }}" defer></script>
<script src="{{ asset('js/custom/custom-main.js') }}" defer></script>
<script type="text/javascript">
  var base_url = '{{ url('') }}';
  $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
