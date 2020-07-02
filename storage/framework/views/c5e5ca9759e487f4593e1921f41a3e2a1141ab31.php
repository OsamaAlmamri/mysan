<!-- //banner one -->
<div class="banner-six">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-six-component :data="<?php echo e($data); ?>"></banner-six-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner6.blade.php ENDPATH**/ ?>