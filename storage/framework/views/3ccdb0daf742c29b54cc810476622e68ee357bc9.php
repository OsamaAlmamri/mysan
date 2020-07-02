<!-- //banner one -->
<div class="banner-one">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-one-component :data="<?php echo e($data); ?>"></banner-one-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner1.blade.php ENDPATH**/ ?>