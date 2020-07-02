<!-- //banner one -->
<div class="banner-four">
      <div class="container">
        <div class="group-banners" id="app">
          <?php  $data = json_encode($result); ?>
          <banner-four-component :data="<?php echo e($data); ?>"></banner-four-component>
        </div>
      </div>
</div>
<?php /**PATH F:\sites\mysan\resources\views\admin\banners_views\banner4.blade.php ENDPATH**/ ?>