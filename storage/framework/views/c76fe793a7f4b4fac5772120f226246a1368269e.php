<!-- //banner one -->
<div class="banner-ten">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-ten-component :data="<?php echo e($data); ?>"></banner-ten-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner10.blade.php ENDPATH**/ ?>