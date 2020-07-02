<!-- //banner one -->
<div class="banner-nine">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-nine-component :data="<?php echo e($data); ?>"></banner-nine-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner9.blade.php ENDPATH**/ ?>