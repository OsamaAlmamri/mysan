<!-- //banner one -->
<div class="banner-twelve">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-twelve-component :data="<?php echo e($data); ?>"></banner-twelve-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner12.blade.php ENDPATH**/ ?>