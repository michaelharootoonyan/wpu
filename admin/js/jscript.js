jQuery(document).ready(function($)
{
    let requirementsCheckList = {}  // boolean key value list
    const $wpuCustomAddedTabsList = $('#wpu-your-custom-added-tabs'),
          $wpuAddCustomTabRequirement = $('#wpu-add-custom-tab-requirement'),
          $wpuIntegerDataTypeFields = $(".wpu-integer-data-type"),
          $wpuSubmitProductRequirements = $('#wpu-submit-product-requirements-btn'),
          $wpuRequiresName = $('#wpu-required-attributes-for-each-product-name'),
          $wpuRequiresDescription = $('#wpu-required-attributes-for-each-product-description'),
          $wpuRequiresShortDescription = $('#wpu-required-attributes-for-each-product-short-description'),
          $wpuRequiresSku = $('#wpu-required-attributes-for-each-product-sku'),
          $wpuRequiresStockStatus = $('#wpu-required-attributes-for-each-product-stock-status'),
          $wpuRequiresPrice = $('#wpu-required-attributes-for-each-product-price'),
          $wpuRequiresCategories = $('#wpu-required-attributes-for-each-product-categories'),
          $wpuRequiresTags = $('#wpu-required-attributes-for-each-product-tags');
          //.is(':checked')
    const $wpuDeleteCustomFieldBtns = $wpuCustomAddedTabsList.find('.wpu-delete-custom-field-btn');
    let n = $wpuDeleteCustomFieldBtns.size();
    let wpuOptions = null;

    const getRequirementsCheckListFromDB = function(){
      var option = {};
      option.dataType = "json";
      option.type = "GET";
      ServerCall(WPU_REMOTE.ADMIN_URL + "?action=wpu_get_requirements", null, function(_response) {
        if (_response.success) {
          if(_response.options == "") return;
          let options = JSON.parse(_response.options);
          // 
          requirementsCheckList = options;
          return;
        } else if (_response.error) {
          console.log("Failed: did not get data back from the db");
          return;
        } else {
          console.log("try again");
        }
      }, option);
    
    }

    getRequirementsCheckListFromDB();

    const markRequirementsCheckList = function(e){
      e.preventDefault();
      e.stopPropagation();
      function markCheckBox($cb, key){requirementsCheckList[key] = $cb.is(':checked') ? true : false;}
      function markInput(inp, key){requirementsCheckList[key] = $(inp).val();}
      markCheckBox($wpuRequiresName, 'name');
      markCheckBox($wpuRequiresDescription, 'description');
      markCheckBox($wpuRequiresShortDescription, 'shortDescription');
      markCheckBox($wpuRequiresPrice, 'price');
      markCheckBox($wpuRequiresSku, 'sku');
      markCheckBox($wpuRequiresStockStatus, 'stockStatus');
      markCheckBox($wpuRequiresTags, 'tags');
      markCheckBox($wpuRequiresCategories, 'categories');
      markInput($wpuIntegerDataTypeFields[0],'featuredImageWidth');
      markInput($wpuIntegerDataTypeFields[1],'featuredImageHeight');
      markInput($wpuIntegerDataTypeFields[2],'galleryImageWidth');
      markInput($wpuIntegerDataTypeFields[3],'galleryImageHeight');

      // let $customTabs = $('.wpu-custom-tab-values');
      // $customTabs.each(function( key, value ) {
      //   alert( value.innerHTML );
      //   requirementsCheckList['customTabs'].push(value.innerHTML);
      // });
      // console.log(requirementsCheckList);
    }

    const addCustomField = function(event) {
      if (event.keyCode != 13) return;  // soon as they press enter let the code run below
      const $self = $(this);
      let customAddTabName = $self.val();
      if (requirementsCheckList['customTabs'] === undefined){
        requirementsCheckList['customTabs'] = [customAddTabName];
      } else {
        requirementsCheckList['customTabs'].push(customAddTabName);
      }
      console.log(requirementsCheckList['customTabs'])
      // appending to the custom tabs list
      var li = document.createElement("li");
      li.className = "list-group-item wpu-just-added";
      li.style.backgroundColor='rgba(41, 241, 195, 0.33)';

      var txtNode = document.createTextNode(customAddTabName);
      $self.val('');

      let $li = $(li);
      var span =  document.createElement("span"); // <span class="wpu-custom-tab-values">
      // span.className = "wpu-custom-tab-values";
      let $span = $(span);
      $(span).append(txtNode);
      $li.append(span);

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
      let $customTabValues = $li.find('.wpu-custom-tab-values');
      $customTabValues.each(function(key, value){
        value.innerHTML;
        let customTabs = requirementsCheckList['customTabs'];
        var n = customTabs.length;
        for (var i = 0; i < n; i++)
        {
          if (customTabs[i] === value.innerHTML) {
            // found lets delete it
            customTabs.splice(i, 1);
            break;
          }
          
        }
      });
      // todo remove from list
      // requirementsCheckList[]
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
    $wpuSubmitProductRequirements.on('click', function(e){
      e.stopPropagation();
      // prepare product requirements checklist form data
      markRequirementsCheckList(e);
      console.log(WPU_REMOTE.ADMIN_URL);
      let formData = {};
      formData['action'] = 'wpu_add_new_requirements';
      formData['meta_key'] = "options";
      formData['meta_value'] =  JSON.stringify(requirementsCheckList);
      console.log(formData);

      ServerCall(WPU_REMOTE.ADMIN_URL, formData, function(_response) {
        if (_response.success) {
          console.log("Success: saved to db");
          return;
        } else if (_response.error) {
          console.log("Failed: did not save to db");
          return;
        } else {
          console.log("try again");
        }
      }, 'json');
    });
    
});

