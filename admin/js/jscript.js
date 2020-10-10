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
        //   $(a).append('<img src="<?php echo WOOCOMMERCE_PRODUCT_UPLOADER_URL_PATH ?>/public/img/close__.png"></a>');
          $(a).append('<img src="' + WPU_REMOTE.URL + '/public/img/close__.png"></a>');
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