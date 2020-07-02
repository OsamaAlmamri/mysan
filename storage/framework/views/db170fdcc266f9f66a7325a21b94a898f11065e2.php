<!-- //banner one -->
<div class="banner-five">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-five-component :data="<?php echo e($data); ?>"></banner-five-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner5.blade.php ENDPATH**/ ?>