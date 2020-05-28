<style>
.top-alert {
  position: fixed;
  top: 0px;
  width: 100%;
  z-index: 100000;
  left: 0;
  padding: 20px;
  display: inline-block;
  text-align: center;
}
.top-alert .alert {
  width: auto !important;
  height: 100%;
  display: inline;
  position: relative;
  margin: 0;
}
.top-alert .alert .close {
  position: absolute;
  top: 11px;
  right: 10px;
  color: inherit;
}

</style>
  <div class="top-alert" id="alert-pro" style="display:none;">
    <div class="alert alert-success ">
      <i class="glyphicon glyphicon-exclamation-sign"></i>
       
      <?php echo app('translator')->get('website.Product added successfully!'); ?>
      </button>
    </div>
  </div>
  <div class="top-alert" id="alert-exceed" style="display:none;">
    <div class="alert alert-danger ">
      <i class="glyphicon glyphicon-exclamation-sign"></i>
      <?php echo app('translator')->get('website.Ops! Product is available in stock But Not Active For Sale. Please contact to the admin'); ?>
    </div>
  </div>
  <div class="top-alert" id="alert-compare" style="display:none;">
    <div class="alert alert-success ">
      <i class="glyphicon glyphicon-exclamation-sign"></i>
        <?php echo app('translator')->get('website.Product Is Ready To Comapre!'); ?>
      </button>
    </div>
  </div>
  <div class="top-alert" id="alert-liked" style="display:none;">
    <div class="alert alert-success ">
      <i class="glyphicon glyphicon-exclamation-sign"></i>
        <?php echo app('translator')->get('website.Product Is Liked!'); ?>
      </button>
    </div>
  </div>
  <div class="top-alert" id="alert-disliked" style="display:none;">
    <div class="alert alert-success ">
      <i class="glyphicon glyphicon-exclamation-sign"></i>
        <?php echo app('translator')->get('website.Product Is DisLiked!'); ?>
      </button>
    </div>
  </div>
  <div class="top-alert" id="alert-login-first" style="display:none;">
    <div class="alert alert-success ">
      <i class="glyphicon glyphicon-exclamation-sign"></i>
        <?php echo app('translator')->get('website.Please Login First!'); ?>
      </button>
    </div>
  </div>
<?php /**PATH F:\sites\laravel-ecommerce-universal v4.0.12 preinstalled\resources\views/web/common/notifications.blade.php ENDPATH**/ ?>