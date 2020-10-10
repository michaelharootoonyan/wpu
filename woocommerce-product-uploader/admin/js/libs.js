/*Loading methods*/
var ServerCall = function (_url, _data, _callback, _option) {
    _data = _data == null ? {}: _data;
    _option = _option == null ? {}: _option;
    var i   = _option.dataType ? _option.dataType : "json";
    if(_option.submit){
        _option.submit.button('loading');
    }
    tab_loading.show();
    var s = {
        type : _option.type ? _option.type : "POST",
        url : _url,data : _data,dataType : i,
        success : function (_d) {
            tab_loading.hide();_callback(_d);
        }
    };
    var o = jQuery.ajax(s);
};
/*

        ServerCall(ASL_REMOTE.URL + '?action=asl_delete_all_stores', {}, function(_response) {

          $this.bootButton('reset');
          atoastr.success(_response.msg);
          table.fnDraw();
        }, 'json');
      };

*/