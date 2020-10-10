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

                          <legend>Add Required Custom Tab Descriptions</legend>
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="wpu-add-custom-tab-requirement">Add Custom Tab Description</label>  
                            <div class="col-md-5">
                            <input id="wpu-add-custom-tab-requirement" name="wpu-add-custom-tab-requirement" type="text" placeholder="" class="form-control input-md" required="">
                            </div>
                          </div>
                          <legend>Your Custom Added tabs</legend>
                          <ul id="your-custom-added-tabs" class="list-group list-group-flush">
                          <?php
                              /* dummy data that gets populated here todo bring CONFIGS data form database here to populate list */
                              $dummyCustomTabs = ["Cras justo odio", "Dapibus ac facilisis in", "Morbi leo risus", "Porta ac consectetur ac", "Vestibulum at eros"];
                            foreach ($dummyCustomTabs as $key => $value) {
                                echo '<li class="list-group-item">' . $value . '<label class="wpu-delete-custom-field-btn"><a><img src="' . WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH . '/public/img/close__.png"></a></label></li>';
                            }
                            ?>
                          </ul>
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

                          <legend>Product Descriptions</legend>

                          <div class="form-group row">
                          <label class="col-4">Is Product Description Required?</label> 
                          <div class="col-8">
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input name="product-description-required" id="product-description-required_0" type="checkbox" class="custom-control-input" value="true"> 
                              <label for="product-description-required_0" class="custom-control-label">Yes</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-4">Is Short Product Description Required?</label> 
                          <div class="col-8">
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input name="product-short-description-required" id="product-short-description-required_0" type="checkbox" class="custom-control-input" value="true"> 
                              <label for="product-short-description-required_0" class="custom-control-label">Yes</label>
                            </div>
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-4">Is Product Price Required?</label> 
                          <div class="col-8">
                            <div class="custom-control custom-checkbox custom-control-inline">
                              <input name="product-product-price-required" id="product-product-price-required_0" type="checkbox" class="custom-control-input" value="true"> 
                              <label for="product-product-price-required_0" class="custom-control-label">Yes</label>
                            </div>
                          </div>
                        </div> 

                        </fieldset>
                        </form>
                        <legend>Product Attributes</legend>
                        <form>
                        <div class="form-group row">
                          <label class="col-4 col-form-label">Check each of the required attributes for products so that the folder error checker can reject incomplete product pack folders.</label> 
                          <div class="col-8">
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="required-attributes-for-each-product" id="required-attributes-for-each-product_0" type="checkbox" class="custom-control-input" value="product-name-required"> 
                                <label for="required-attributes-for-each-product_0" class="custom-control-label">Name</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="required-attributes-for-each-product" id="required-attributes-for-each-product_1" type="checkbox" class="custom-control-input" value="product-sku-required"> 
                                <label for="required-attributes-for-each-product_1" class="custom-control-label">SKU</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="required-attributes-for-each-product" id="required-attributes-for-each-product_2" type="checkbox" class="custom-control-input" value="product-stock-required"> 
                                <label for="required-attributes-for-each-product_2" class="custom-control-label">Stock Status</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="required-attributes-for-each-product" id="required-attributes-for-each-product_3" type="checkbox" class="custom-control-input" value="product-price-required"> 
                                <label for="required-attributes-for-each-product_3" class="custom-control-label">Price</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="required-attributes-for-each-product" id="required-attributes-for-each-product_4" type="checkbox" class="custom-control-input" value="product-categories-required"> 
                                <label for="required-attributes-for-each-product_4" class="custom-control-label">Categories</label>
                              </div>
                            </div>
                            <div class="custom-controls-stacked">
                              <div class="custom-control custom-checkbox">
                                <input name="required-attributes-for-each-product" id="required-attributes-for-each-product_5" type="checkbox" class="custom-control-input" value="product-tags-required"> 
                                <label for="required-attributes-for-each-product_5" class="custom-control-label">Tags</label>
                              </div>
                            </div>
                          </div>
                      </div> 
                      <div class="form-group row">
                        <div class="offset-4 col-8">
                          <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
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
<script>
jQuery(document).ready(function($){
    const $yourCustomAddedTabsList = $('#your-custom-added-tabs');
    const $wpuDeleteCustomFieldBtns = $('.wpu-delete-custom-field-btn');
    const n = $wpuDeleteCustomFieldBtns.size();
    var currentCustomFieldCount = n;

    const deleteCustomField = function(){
      const $a  = $(this);
      const $li = $a.parent();
      $a.unbind('click');
      $li.fadeOut('slow');
      currentCustomFieldCount--;
      if (currentCustomFieldCount == 0){
        $yourCustomAddedTabsList.hide();
        $yourCustomAddedTabsList.append('<li class="list-group-item none-added">None added!  Use the input field above to add custom tabs..</li>');
        $yourCustomAddedTabsList.fadeIn(2999);
      }
    }

    $wpuDeleteCustomFieldBtns.on('click', deleteCustomField);

    const $wpuAddCustomTabRequirement = $('#wpu-add-custom-tab-requirement');
    $wpuAddCustomTabRequirement.keypress(function(event) {
        if (event.keyCode == 13) {
          var li = document.createElement("li");
          li.className = "list-group-item";
          var txtNode = document.createTextNode($(this).val());
          $(li).append(txtNode);
          var label = document.createElement('label');
          label.className="wpu-delete-custom-field-btn";
          var a = document.createElement('a');
          $(label).bind('click', deleteCustomField);
          $(a).append('<img src="http://localhost/wpu/wp-content/plugins/woocommerce-product-uploader/public/img/close__.png"></a>');
          $(label).append(a);
          $(li).append(label);
          $(li).hide();
          $yourCustomAddedTabsList.append(li);
          $(li).fadeIn(1999);
          if (currentCustomFieldCount == 0){
            $yourCustomAddedTabsList.find('li.list-group-item.none-added').remove();
          }
          currentCustomFieldCount++;
          // $yourCustomAddedTabsList.append('<li class="list-group-item">' + $(this).val() + '<label class="wpu-delete-custom-field-btn"><a><img src="http://localhost/wpu/wp-content/plugins/woocommerce-product-uploader/public/img/close__.png"></a></label></li>')
                                  // .hide()
                                  // .fadeIn(1999)
                                  // .bind('click', deleteCustomField);
        }
    })
});
</script>

