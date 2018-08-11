'use strict';

/**
 * 动态生成html的模态窗口
 * @param  {[type]} $ [description]
 * @return {[type]}   [description]
 */
(function($) {
	var tpl = '<div class="modal fade">\
              <div class="modal-dialog">\
                <div class="modal-content">\
                  <div class="modal-header">\
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>\
                    <h4 class="modal-title">弹出框标题</h4>\
                  </div>\
                  <div class="modal-body">\
                  	正在加载...\
                  </div>\
                  <div class="modal-footer">\
	 			</div></div></div></div>';
	var tpl_close = '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">关闭</button>';
	var tpl_save = '<button type="button" class="btn btn-primary btn-save">保存</button>';

	/**
	 * 创建弹出框
	 */
	function create(config) {
		var config = $.extend({
			'title': "对话框",
			'body': {
				type: "html",
				content: "正在加载..."
			},
			'btns': ['save', 'close']
		}, config);

		var $tpl = $(tpl);
		config.id = config.id || Math.floor(Math.random() * 1000000);
		$tpl.attr('id', config.id);
		$(".modal-title", $tpl).text(config.title);
		$(".modal-body", $tpl).text(config.body.content);

		if ($.inArray("close", config.btns)) {
			$(".modal-footer", $tpl).append(tpl_close);
		}
		if ($.inArray("save", config.btns)) {
			$(".modal-footer", $tpl).append(tpl_save);
		}

		$("body").append($tpl);
		return $tpl;
	}

	var modal = {};
	modal.create = create;
	window.modal = modal;

	$(function() {
		$(document).on('click', ".btn-form", function(event) {
			var remote = $(this).attr('href');
			var newDialog = $("#btn-form-modal");
			if (!$("#btn-form-modal").length) {
				newDialog = modal.create({
					id: "btn-form-modal"
				});
			}
			newDialog.find(".modal-content").text("加载中...");
			newDialog.data("bs.modal", null);
			newDialog.modal({
				"remote": remote
			});
			return false;
		});
	});
})(jQuery);