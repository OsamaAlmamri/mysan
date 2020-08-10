<script>
    function Active(route_url) {
        $(document).on('click', '.active_btn', function () {
            var data = '_token=' + encodeURIComponent("<?php echo e(csrf_token()); ?>") + '&status=' + encodeURIComponent($(this).attr('data-status')) + '&id=' + encodeURIComponent($(this).attr('data-id'));
            var url = route_url;
            var _this = $(this);
            $.ajax({
                url: url,//   var url=$('#news').attr('action');
                method: 'post',
                dataType: 'json',// data type that i want to return
                data: data,// var form=$('#news').serialize();
                success: function (data) {
                    if (data == 1) {
                        _this.html("<i class=\"fa fa-eye\"> </i>");
                        _this.attr("data-status", data);
                    } else {
                        _this.html("<i class=\"fa fa-eye-slash\"> </i>");
                        _this.attr("data-status", data);
                    }
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return (false);
        });

    }
</script>
<?php /**PATH F:\sites\mysan\resources\views/admin/common/active.blade.php ENDPATH**/ ?>