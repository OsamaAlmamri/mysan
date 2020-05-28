<script>
function myFunction2(currency_id) {
 jQuery(function ($) {
  jQuery.ajax({
    beforeSend: function (xhr) { // Add this line
            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
     },
    url: '<?php echo e(URL::to("/change_currency")); ?>',
    type: "POST",
    data: {"currency_id":currency_id,"_token": "<?php echo e(csrf_token()); ?>"},
    success: function (res) {
      window.location.reload();
    },
  });
});
}
</script>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/common/scripts/changeCurrency.blade.php ENDPATH**/ ?>