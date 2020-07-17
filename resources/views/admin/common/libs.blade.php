<script src="{!! asset('admin/plugins/jQuery/jQuery-2.2.0.min.js') !!}"></script>
<script src="{!! asset('admin/bootstrap/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/select2/select2.full.min.js') !!}"></script>

<!-- InputMask -->
<script src="{!! asset('admin/plugins/input-mask/jquery.inputmask.js') !!}"></script>
<script src="{!! asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') !!}"></script>
<script src="{!! asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') !!}"></script>
<script src="{!! asset('admin/js/jquery.validate.js') !!}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{!! asset('admin/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<script src="{!! asset('admin/js/dropzone.js') !!}"></script>
<script src="{!! asset('admin/js/image-picker.js') !!}"></script>
<script src="{!! asset('admin/js/image-picker.min.js') !!}"></script>
{{--fancy box--}}
<script src="{!! asset('admin/js/jquery.fancybox.min.js') !!}"></script>

<!-- bootstrap datepicker -->
<script src="{!! asset('admin/plugins/datepicker/bootstrap-datepicker.js') !!}"></script>

<!-- bootstrap color picker -->
<script src="{!! asset('admin/plugins/colorpicker/bootstrap-colorpicker.min.js') !!}"></script>
<!-- bootstrap time picker -->
<script src="{!! asset('admin/plugins/timepicker/bootstrap-timepicker.min.js') !!}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{!! asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') !!}"></script>
<!-- iCheck 1.0.1 -->
<script src="{!! asset('admin/plugins/iCheck/icheck.min.js') !!}"></script>
<!-- FastClick -->
<script src="{!! asset('admin/plugins/fastclick/fastclick.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('admin/dist/js/app.min.js') !!}"></script>
<script src="{{url('admin/js/clipboard.min.js')}}"></script>
@if(Request::path() == 'admin/dashboard/last_year' or Request::path() == 'admin/dashboard/last_month' or Request::path() == 'admin/dashboard/this_month')
    <!--<script src="{!! asset('dist/js/pages/dashboard.js') !!}"></script>-->
@endif
<!-- AdminLTE for demo purposes -->
<script src="{!! asset('admin/js/demo.js') !!}"></script>

<script src="{!! asset('admin/plugins/chartjs/Chart.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') !!}"></script>
<script src="{!! asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') !!}"></script>
<script src="{!! asset('admin/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

<script src="{!! asset('admin/plugins/sparkline/jquery.sparkline.min.js') !!}"></script>

<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{!! asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}"></script>

<!-- DataTable  -->
{{--<script src="{!! asset('admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>--}}

