<!-- //banner one -->
<div class="banner-eight">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-eight-component :data="<?php echo e($data); ?>"></banner-eight-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner8.blade.php ENDPATH**/ ?>