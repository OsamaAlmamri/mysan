<!-- //banner one -->
<div class="banner-seventeen">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-seventeen-component :data="<?php echo e($data); ?>"></banner-seventeen-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner17.blade.php ENDPATH**/ ?>