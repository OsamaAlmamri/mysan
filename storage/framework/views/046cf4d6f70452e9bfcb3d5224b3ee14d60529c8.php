<!-- //banner one -->
<div class="banner-two">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-two-component :data="<?php echo e($data); ?>"></banner-two-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner2.blade.php ENDPATH**/ ?>