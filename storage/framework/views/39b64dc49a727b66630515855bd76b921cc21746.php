<!-- //banner one -->
<div class="banner-seven">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-seven-component :data="<?php echo e($data); ?>"></banner-seven-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner7.blade.php ENDPATH**/ ?>