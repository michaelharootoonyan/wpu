jQuery(document).ready(function($)
{
    const $yourCustomAddedTabsList = $('#your-custom-added-tabs'),
          $wpuAddCustomTabRequirement = $('#wpu-add-custom-tab-requirement');

    const $wpuDeleteCustomFieldBtns = $yourCustomAddedTabsList.find('.wpu-delete-custom-field-btn');

    let n = $wpuDeleteCustomFieldBtns.size();

    const deleteCustomField = function(){
      const $a  = $(this);
      const $li = $a.parent();
      $a.unbind('click');
      $li.fadeOut('slow');
      n--;
      if (n == 0){
        $yourCustomAddedTabsList.hide();
        $yourCustomAddedTabsList.append('<li class="list-group-item wpu-none-added">None added!  Use the input field above to add custom tabs..</li>');
        $yourCustomAddedTabsList.fadeIn(2999);
      }
    }

    $wpuDeleteCustomFieldBtns.click(deleteCustomField);

    $wpuAddCustomTabRequirement.keypress(function(event) {
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
          $yourCustomAddedTabsList.find('li.list-group-item.wpu-none-added').fadeOut(999).remove();
        }

        n++;
        $li.hide();
        $yourCustomAddedTabsList.append(li);
        $li.fadeIn(1999).animate({backgroundColor: "#fff"}, 1999);
    })

});