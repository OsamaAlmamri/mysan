<!-- //banner one -->
<div class="banner-one">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <carousal-banner-component :data="<?php echo e($data); ?>"></carousal-banner-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\carousal_banner1.blade.php ENDPATH**/ ?>