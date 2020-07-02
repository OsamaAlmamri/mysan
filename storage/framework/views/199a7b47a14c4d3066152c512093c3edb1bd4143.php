<!-- //banner one -->
<div class="banner-one">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <ad-banner1-component :data="<?php echo e($data); ?>"></ad-banner1-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\ad_banner1.blade.php ENDPATH**/ ?>