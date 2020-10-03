<!-- Container -->
<div class="wpu-p-cont wpu-new-bg">
  <div class="container">
    <div class="row wpu-inner-cont">
      <div class="col-md-12">
        <div class="card p-0 mb-4">
          <h3 class="card-title"><?php echo __('Woocommerce Product Uploader Dashboard','wpu_admin') ?></h3>
          <div class="card-body">
        
            <div class="alert alert-info" role="alert">
              <a target="_blank" href="https://wpu.com/wiki/"><?php echo __('Please visit the documentation page for help, for support please','wpu_admin') ?></a><a target="_blank" href="https://wordpress.org/support/plugin/woocommerce-product-uploader"><?php echo __('create a ticket','wpu_admin') ?></a>  <?php echo __(', or email me at michaelharootoonyan@gmail.com','wpu_admin') ?> 
            </div>

            <div class="dashboard-area">
              <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <form class="form-horizontal">
                          <fieldset>

                          <!-- Form Name -->
                          <legend>Featured Image Dimensions</legend>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-featured-image-width">Width (px)</label>  
                            <div class="col-md-5">
                            <input id="wpu-featured-image-width" name="wpu-featured-image-width" type="text" placeholder="enter digits only" class="form-control input-md" required="">
                              
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-featured-image-height">Height (px)</label>  
                            <div class="col-md-5">
                            <input id="wpu-featured-image-height" name="wpu-featured-image-height" type="text" placeholder="enter digits only" class="form-control input-md" required="">
                              
                            </div>
                          </div>

                          </fieldset>
                        </form>
                      </div>
                      <div class="col-md-6">
                        <form class="form-horizontal">
                          <fieldset>

                          <!-- Form Name -->
                          <legend>Gallery Image Dimensions</legend>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-gallery-image-width">Width (px)</label>  
                            <div class="col-md-5">
                            <input id="wpu-gallery-image-width" name="wpu-gallery-image-width" type="text" placeholder="enter digits only" class="form-control input-md" required="">
                              
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-gallery-image-height">Height (px)</label>  
                            <div class="col-md-5">
                            <input id="wpu-gallery-image-height" name="wpu-gallery-image-height" type="text" placeholder="enter digits only" class="form-control input-md" required="">
                              
                            </div>
                          </div>

                          </fieldset>
                        </form>
                      </div>
              </div>
              <div class="row"></div>
            </div>
            <div class="dump-message wpu-dumper"></div>
          </div>
        </div>
      </div>  
    </div>
  </div>


</div>
<!-- wpu-cont end-->


<!-- SCRIPTS -->