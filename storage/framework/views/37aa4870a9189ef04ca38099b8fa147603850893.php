<!-- //banner one -->
<div class="banner-thirteen">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-thirteen-component :data="<?php echo e($data); ?>"></banner-thirteen-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner13.blade.php ENDPATH**/ ?>