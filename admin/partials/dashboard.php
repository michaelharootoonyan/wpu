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

                          <!-- 
                            =================================================================
                                                Featured Image Dimensions
                            =================================================================
                           -->
                          <legend>Featured Image Dimensions</legend>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-featured-image-width">Width (px)</label>  
                            <div class="col-md-5">
                              <input id="wpu-featured-image-width" value="<?php if (isset($options)) echo $options->featuredImageWidth ?>" name="wpu-featured-image-width" type="text" placeholder="enter digits only" class="form-control input-md wpu-integer-data-type" required="" maxlength="4">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-featured-image-height">Height (px)</label>  
                            <div class="col-md-5">
                              <input id="wpu-featured-image-height" value="<?php if (isset($options)) echo $options->featuredImageHeight ?>" name="wpu-featured-image-height" type="text" placeholder="enter digits only" class="form-control input-md wpu-integer-data-type" required="" maxlength="4">
                            </div>
                          </div>

                          <legend>Add Required Custom Tab Descriptions</legend>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-add-custom-tab-requirement">Add Custom Tab Description</label>  
                            <div class="col-md-5">
                            <input id="wpu-add-custom-tab-requirement" name="wpu-add-custom-tab-requirement" type="text" placeholder="" class="form-control input-md" required="">
                            </div>
                          </div>
                          <legend>Your Custom Added tabs</legend>
                          <ul id="wpu-your-custom-added-tabs" class="list-group list-group-flush">
                          <?php
                            if (!isset($options) || (isset($options) && sizeof($options->customTabs) == 0)) 
                              echo '<li class="list-group-item wpu-none-added">None added!  Use the input field above to add custom tabs.</li>';
                            else
                              foreach ($options->customTabs as $value) {
                                  if( is_string($value))
                                  echo '<li class="list-group-item"><span class="wpu-custom-tab-values">' . $value . '</span><label class="wpu-delete-custom-field-btn"><a><img src="' . WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . '/public/img/close__.png"></a></label></li>';
                              }
                            ?>
                          </ul>
                          </fieldset>
                        </form>
                      </div>
                      <div class="col-md-6">
                        <form class="form-horizontal">
                          <fieldset>
                          <!-- 
                            =================================================================
                                                Gallery Image Dimensions
                            =================================================================
                           -->
                          <legend>Gallery Image Dimensions</legend>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-gallery-image-width">Width (px)</label>  
                            <div class="col-md-5">
                              <input id="wpu-gallery-image-width" value="<?php if (isset($options)) echo $options->galleryImageWidth ?>" name="wpu-gallery-image-width" type="text" placeholder="enter digits only" class="form-control input-md wpu-integer-data-type" required="" maxlength="4">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-gallery-image-height">Height (px)</label>  
                            <div class="col-md-5">
                              <input id="wpu-gallery-image-height" value="<?php if (isset($options)) echo $options->galleryImageHeight ?>" name="wpu-gallery-image-height" type="text" placeholder="enter digits only" class="form-control input-md wpu-integer-data-type" required="" maxlength="4">
                            </div>
                          </div>
                         
                          <!-- 
                            =================================================================
                                                 Product Attributes
                            =================================================================
                           -->
                        <legend>Product Attributes</legend>
                        <div class="form-group row">
                          <label class="col-4 col-form-label">Check each of the required attributes for products so that the folder error checker can reject incomplete product pack folders.</label> 
                          <div class="col-8">
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-name" id="wpu-required-attributes-for-each-product-name" type="checkbox" class="custom-control-input" value="product-name-required" <?php if(isset($options)) { if ($options->name) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-name" class="custom-control-label">Name</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-description" id="wpu-required-attributes-for-each-product-description" type="checkbox" class="custom-control-input" value="product-name-required" <?php if(isset($options)) { if ($options->description) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-description" class="custom-control-label">Description</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-short-description" id="wpu-required-attributes-for-each-product-short-description" type="checkbox" class="custom-control-input" value="product-name-required" <?php if(isset($options)) { if ($options->shortDescription) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-short-description" class="custom-control-label">Short Description</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-sku" id="wpu-required-attributes-for-each-product-sku" type="checkbox" class="custom-control-input" value="product-sku-required" <?php if(isset($options)) { if ($options->sku) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-sku" class="custom-control-label">SKU</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-stock-status" id="wpu-required-attributes-for-each-product-stock-status" type="checkbox" class="custom-control-input" value="product-stock-required" <?php if(isset($options)) { if ($options->stockStatus) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-stock-status" class="custom-control-label">Stock Status</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-price" id="wpu-required-attributes-for-each-product-price" type="checkbox" class="custom-control-input" value="product-price-required" <?php if(isset($options)) { if ($options->price) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-price" class="custom-control-label">Price</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-categories" id="wpu-required-attributes-for-each-product-categories" type="checkbox" class="custom-control-input" value="product-categories-required" <?php if(isset($options)) { if ($options->categories) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-categories" class="custom-control-label">Categories</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="wpu-required-attributes-for-each-product-tags" id="wpu-required-attributes-for-each-product-tags" type="checkbox" class="custom-control-input" value="product-tags-required" <?php if(isset($options)) { if ($options->tags) {echo 'checked';}}?>> 
                                <label for="wpu-required-attributes-for-each-product-tags" class="custom-control-label">Tags</label>
                              </div>
                            </div>
                          </div>
                      </div> 
                      <div class="form-group row">
                        <div class="offset-4 col-8">
                          <button id="wpu-submit-product-requirements-btn" name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
              </div>
              <div class="row">                      
                <form id="upload" enctype="multipart/form-data">
                  <div id="drop">
                    Drop Here

                    <a>Browse</a>
                    <input type="file" name="upl" multiple />
                  </div>

                  <ul>
                    <!-- The file uploads will be shown here -->
                  </ul>
                </form>
              </div>
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