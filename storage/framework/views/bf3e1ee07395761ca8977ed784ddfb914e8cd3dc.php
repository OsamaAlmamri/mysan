<!-- //banner one -->
<div class="banner-fourteen">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-fourteen-component :data="<?php echo e($data); ?>"></banner-fourteen-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner14.blade.php ENDPATH**/ ?>