jQuery(document).ready(function($)
{
    let requirementsCheckList = [];  // boolean key value list
    const $wpuCustomAddedTabsList = $('#wpu-your-custom-added-tabs'),
          $wpuAddCustomTabRequirement = $('#wpu-add-custom-tab-requirement'),
          $wpuIntegerDataTypeFields = $(".wpu-integer-data-type"),
          $wpuSubmitProductRequirements = $('#wpu-submit-product-requirements-btn'),
          $wpuRequiresName = $('#wpu-required-attributes-for-each-product-name'),
          $wpuRequiresSku = $('#wpu-required-attributes-for-each-product-sku'),
          $wpuRequiresStockStatus = $('#wpu-required-attributes-for-each-product-stock-status'),
          $wpuRequiresPrice = $('#wpu-required-attributes-for-each-product-price'),
          $wpuRequiresCategories = $('#wpu-required-attributes-for-each-product-categories'),
          $wpuRequiresTags = $('#wpu-required-attributes-for-each-product-tags');
          //.is(':checked')
    const $wpuDeleteCustomFieldBtns = $wpuCustomAddedTabsList.find('.wpu-delete-custom-field-btn');
    let n = $wpuDeleteCustomFieldBtns.size();

    const markRequirementsCheckList = function(e){
      e.preventDefault();
      e.stopPropagation();
      function markRequirementsChecklistHelper($cb, key){requirementsCheckList[key] = $cb.is(':checked') ? true : false;}
      markRequirementsChecklistHelper($wpuRequiresName, 'name');
      markRequirementsChecklistHelper($wpuRequiresPrice, 'price');
      markRequirementsChecklistHelper($wpuRequiresSku, 'sku');
      markRequirementsChecklistHelper($wpuRequiresStockStatus, 'stock-status');
      markRequirementsChecklistHelper($wpuRequiresTags, 'tags');
      markRequirementsChecklistHelper($wpuRequiresCategories, 'categories');
      console.log(requirementsCheckList)
    }
    


    const addCustomField = function(event) {
      if (event.keyCode != 13) return;  // soon as they press enter let the code run below
      
      const $self = $(this);
      // appending to the custom tabs list
      var li = document.createElement("li");
      li.className = "list-group-item wpu-just-added";
      li.style.backgroundColor='rgba(41, 241, 195, 0.33)';

      var txtNode = document.createTextNode($self.val());
      $self.val('');

      let $li = $(li);
      $li.append(txtNode);

      var label = document.createElement('label');
      label.className="wpu-delete-custom-field-btn";

      let $label = $(label);

      var a = document.createElement('a');
      $label.bind('click', deleteCustomField);
    
      $(a).append('<img src="' + WPU_REMOTE.URL + '/public/img/close__.png"></a>');
      $label.append(a);
      $li.append(label);

      // animation of the appending
      if (n == 0){
        // remove the "add custom tabs to populate here" notice
        $wpuCustomAddedTabsList.find('li.list-group-item.wpu-none-added').fadeOut(999).remove();
      }

      n++;
      $li.hide();
      $wpuCustomAddedTabsList.append(li);
      $li.fadeIn(1999).animate({backgroundColor: "#fff"}, 1999);
    }
    const deleteCustomField = function(){
      const $a  = $(this);
      const $li = $a.parent();
      $a.unbind('click');
      $li.fadeOut('slow');
      n--;
      if (n == 0){
        $wpuCustomAddedTabsList.hide();
        $wpuCustomAddedTabsList.append('<li class="list-group-item wpu-none-added">None added!  Use the input field above to add custom tabs..</li>');
        $wpuCustomAddedTabsList.fadeIn(2999);
      }
    }
    const integerRegexValidator = function(event){
        // Backspace, tab, enter, end, home, left, right
        // We don't support the del key in Opera because del == . == 46.
        var controlKeys = [8, 9, 13, 35, 36, 37, 39];
        // IE doesn't support indexOf
        var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
        // Some browsers just don't raise events for control keys. Easy.
        // e.g. Safari backspace.
        if (!event.which || // Control keys in most browsers. e.g. Firefox tab is 0
            (49 <= event.which && event.which <= 57) || // Always 1 through 9
            (48 == event.which && !$(this).val() == 0) || // No 0 first digit
            isControlKey) { // Opera assigns values for control keys.
          return;
        } else {
          event.preventDefault();
        }
      }



    /**
     * Add Event Listeners
     */
    // featured and gallery image dimensions integer validation
    $wpuIntegerDataTypeFields.on('keypress', integerRegexValidator);

    // custom fields
    $wpuAddCustomTabRequirement.on('keypress', addCustomField);
    $wpuDeleteCustomFieldBtns.on('click', deleteCustomField);

    // btn on submit all form data
    $wpuSubmitProductRequirements.on('click', markRequirementsCheckList);
    
});

