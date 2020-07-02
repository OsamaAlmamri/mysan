<!-- //banner one -->
<div class="banner-eighteen">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-eighteen-component :data="<?php echo e($data); ?>"></banner-eighteen-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner18.blade.php ENDPATH**/ ?>