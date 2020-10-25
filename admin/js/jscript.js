jQuery(document).ready(function($)
{
    let requirementsCheckList = {}  // boolean key value list
    const $wpuCustomAddedTabsList = $('#wpu-your-custom-added-tabs'),
          $wpuAddAttributeRequirement = $('#wpu-add-attribute-requirement'),
          $wpuIntegerDataTypeFields = $(".wpu-integer-data-type"),
          $wpuSubmitProductRequirements = $('#wpu-submit-product-requirements-btn'),
          $wpuRequiresName = $('#wpu-required-meta-for-each-product-name'),
          $wpuRequiresDescription = $('#wpu-required-meta-for-each-product-description'),
          $wpuRequiresShortDescription = $('#wpu-required-meta-for-each-product-short-description'),
          $wpuRequiresSku = $('#wpu-required-meta-for-each-product-sku'),
          $wpuRequiresStockStatus = $('#wpu-required-meta-for-each-product-stock-status'),
          $wpuRequiresPrice = $('#wpu-required-meta-for-each-product-price'),
          $wpuRequiresCategories = $('#wpu-required-meta-for-each-product-categories'),
          $wpuRequiresTags = $('#wpu-required-meta-for-each-product-tags');
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
    }

    const addCustomField = function(event) {
      if (event.keyCode != 13) return;  // soon as they press enter let the code run below
      const $self = $(this);
      let customAddTabName = $self.val();
      if (requirementsCheckList['productAttributes'] === undefined){
        requirementsCheckList['productAttributes'] = [customAddTabName];
      } else {
        requirementsCheckList['productAttributes'].push(customAddTabName);
      }
      console.log(requirementsCheckList['productAttributes'])
      // appending to the custom tabs list
      var li = document.createElement("li");
      li.className = "list-group-item wpu-just-added";
      li.style.backgroundColor='rgba(41, 241, 195, 0.33)';

      var txtNode = document.createTextNode(customAddTabName);
      $self.val('');

      let $li = $(li);
      var span =  document.createElement("span");
      let $span = $(span);
      $span.append(txtNode);
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
      let $customTabValues = $li.find('.wpu-attribute-values');
      $customTabValues.each(function(key, value){
        let productAttributes = requirementsCheckList['productAttributes'];
        n = productAttributes.length;
        for (var i = 0; i < n; i++)
        {
          if (productAttributes[i] === value.innerHTML) {
            // found lets delete it
            productAttributes.splice(i, 1);
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

    const uploadZipFile = function(){
        var $form = $('#upload');
        var ul = $form.find('ul');

        $('#drop a').click(function(){
            // Simulate a click on the file input button
            // to show the file browser dialog
            $(this).parent().find('input').click();
        });

        // Initialize the jQuery File Upload plugin
        $form.fileupload({
            // This element will accept file drag/drop uploading
            dropZone: $('#drop'),
            // This function is called when a file is added to the queue;
            // either via the browse button, or via drag/drop:
            add: function (e, data) {
                var jqXHR = new XMLHttpRequest();
                var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

                // Append the file name and file size
                tpl.find('p').text(data.files[0].name)
                            .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                // Add the HTML to the UL element
                data.context = tpl.appendTo(ul);

                // Initialize the knob plugin
                tpl.find('input').knob();

                // Listen for clicks on the cancel icon
                tpl.find('span').click(function(){

                    if(tpl.hasClass('working')){
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function(){
                        tpl.remove();
                    });

                });
                var post_data = new FormData();
                post_data.append('action', 'wpu_upload_zip_file');
                post_data.append('upl', data.files[0]);

                // for (var key of post_data.entries()) {
                //     console.log(key[0] + ', ' + key[1]);
                // }
                // data.submit() same call below...
   

                jqXHR = $.ajax({
                //   xhr: function() {
                //     var xhr = new window.XMLHttpRequest();
                //     xhr.upload.addEventListener("progress", function(evt) {
                //         if (evt.lengthComputable) {
                //             var percentComplete = evt.loaded / evt.total;
                //             //Do something with upload progress here
                //         }
                //    }, false);
            
                //    xhr.addEventListener("progress", function(evt) {
                //        if (evt.lengthComputable) {
                //            var percentComplete = evt.loaded / evt.total;
                //            //Do something with download progress
                //        }
                //    }, false);
            
                //    return xhr;
                // },
                  url: WPU_REMOTE.ADMIN_URL,
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: post_data,
                  type: 'POST',
                  success: function(response) {
                      console.log(response);
                  },
                  error: function(error) {
                      console.log(error);
                  }
              });
                // end of template server call code
                // Automatically upload the file once it is added to the queue
                // var jqXHR = 
                data.submit(); // doing this to pass that data to progress function.
            
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }
    
    }

    const main = function(){
      getRequirementsCheckListFromDB();
      uploadZipFile();

      /**
       * Add Event Listeners
       */
      // featured and gallery image dimensions integer validation
      $wpuIntegerDataTypeFields.on('keypress', integerRegexValidator);

      // custom fields
      $wpuAddAttributeRequirement.on('keypress', addCustomField);
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
    }
    main();
});

