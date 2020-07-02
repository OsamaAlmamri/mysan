<!-- //banner one -->
<div class="banner-nineteen">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-nineteen-component :data="<?php echo e($data); ?>"></banner-nineteen-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner19.blade.php ENDPATH**/ ?>