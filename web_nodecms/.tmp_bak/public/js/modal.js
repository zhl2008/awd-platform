/**
 * 远程模态窗口
 */

'use strict';
(function($) {
	var tpl = '<div class="modal">\
              <div class="modal-dialog">\
                <div class="modal-content">\
                  <div class="modal-header">\
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>\
                    <h4 class="modal-title">弹出框标题</h4>\
                  </div>\
                  <div class="modal-body">\
                  	内容\
                  </div>\
                  <div class="modal-footer">\
	
                  </div>\
                </div>\
              </div>\
            </div>';
    var tpl_close = '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>';
    var tpl_save = '<button type="button" class="btn btn-primary btn-save">保存</button>';

	/**
	 * 创建弹出框
	 */
	function create(config) {
		var ins = {
			parent: modal
		};
		var config = $.extend({
			'title': "弹出框!",
			'body': {
				type: "html"
			},
			'btns': ['save', 'close']
		}, config);
		$tpl = $(tpl);

		var id = ins.id = Math.floor(Math.random() * 1000000);
		tpl.attr('id', id);
		$(".modal-title", $tpl).text(config.title);
		$(".modal-body", $tpl).text(config.body);

		if ($.inArray("close", config.btns)) {
			$(".modal-footer", $tpl).append(tpl_close);
		}
		if ($.inArray("save", config.btns)) {
			$(".modal-footer", $tpl).append(tpl_save);
		}

		$tpl.appendTo('body');
		return $tpl;
	}

	var modal = {};
	modal.create = create;
	window.modal = modal;
})(JQuery);


var ma = modal.create();
ma.show();
