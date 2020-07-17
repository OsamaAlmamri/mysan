<script>
    function getCategories(id, data_list, type = 'noAll') {
        var zone = $('#' + data_list);
        var _this = $(this);
        return $.ajax({
            url: '<?php echo e(route('info.getCategories')); ?>',
            method: 'POST',
            dataType: 'json',// data type that i want to return
            data: '_token=' + ("<?php echo e(csrf_token()); ?>") +
                '&id=' + id + '&type=' + type,
            success: function (data) {
                zone.html(data.data);
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });

    }
    function getProducts(sub_id, main_id, data_list) {
        var list_view = $('#' + data_list);
        var _this = $(this);
        return $.ajax({
            url: '<?php echo e(route('info.getProducts')); ?>',
            method: 'POST',
            dataType: 'json',// data type that i want to return
            data: '_token=' + ("<?php echo e(csrf_token()); ?>") +
                '&sub_id=' + sub_id + '&main_id=' + main_id,
            success: function (data) {
                list_view.html(data.data);
                $('#products_list').change();
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
    $(document).ready(function () {
        $.when(getCategories(0, 'main_categories', 'all')).then(function (category) {
            $('#main_categories').change();
        });
        $(document).on('change', '#main_categories', function () {
            var main_id = $(this).val();
            $.when(getCategories(main_id, 'subCategories', 'all')).then(function (category) {
                $('#subCategories').change();
            });
        });
        $(document).on('change', '#subCategories', function () {
            var id = $(this).val();
            return getProducts(id, $("#main_categories").val(), 'products_list')
        });
    });
</script>

<?php /**PATH F:\sites\mysan\resources\views/admin/common/filters/catetegories_products_scripts.blade.php ENDPATH**/ ?>