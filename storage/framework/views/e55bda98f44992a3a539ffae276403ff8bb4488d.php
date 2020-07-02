<!-- //banner one -->
<div class="banner-fifteen">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-fifteen-component :data="<?php echo e($data); ?>"></banner-fifteen-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner15.blade.php ENDPATH**/ ?>