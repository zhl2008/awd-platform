(function(a) {
    a.fn.qqFace = function(c) {
        var g = {
            id: "facebox",
            path: "face/",
            assign: "content",
            tip: "#"
        };
        var d = a.extend(g, c);
        var b = a("#" + d.assign);
        var h = d.id;
        var f = d.path;
        var e = d.tip;
        if (b.length <= 0) {
            alert("缺少表情赋值对象。");
            return false
        }
        a(this).click(function(l) {
            var o, n;
            if (a("#" + h).length <= 0) {
                o = '<div id="' + h + '" style="position:fixed;display:none;z-index:1000;background: #fff;" class="qqFace">' + '<table border="0" cellspacing="0" cellpadding="0"><tr>';
                for (var j = 1; j <= 75; j++) {
                    n = "[/" + e + j + "]";
                    o += '<td><img src="' + f + j + '.gif" onclick="$(\'#' + d.assign + "').setCaret();$('#" + d.assign + "').insertAtCaret('" + n + "');\" /></td>";
                    if (j % 15 == 0) {
                        o += "</tr><tr>"
                    }
                }
                o += "</tr></table></div>"
            }
            a("body").append(o);
            var m = a(this).position();
            var k = m.top + a(this).outerHeight() - 160;
            //a("#" + h).css("top", k);
            //a("#" + h).css("left", m.left);
			a("#" + h).css("bottom","40px");
			a("#" + h).css("right","15px");
            a("#" + h).show();
            l.stopPropagation()
        });
        a(document).click(function() {
            a("#" + h).hide();
            a("#" + h).remove()
        })
    }
})(jQuery);


jQuery.extend({
    unselectContents: function() {
        if (window.getSelection) {
            window.getSelection().removeAllRanges()
        } else {
            if (document.selection) {
                document.selection.empty()
            }
        }
    }
});
jQuery.fn.extend({
    selectContents: function() {
        $(this).each(function(b) {
            var d = this;
            var c, a, f, e;
            if ((f = d.ownerDocument) && (e = f.defaultView) && typeof e.getSelection != "undefined" && typeof f.createRange != "undefined" && (c = window.getSelection()) && typeof c.removeAllRanges != "undefined") {
                a = f.createRange();
                a.selectNode(d);
                if (b == 0) {
                    c.removeAllRanges()
                }
                c.addRange(a)
            } else {
                if (document.body && typeof document.body.createTextRange != "undefined" && (a = document.body.createTextRange())) {
                    a.moveToElementText(d);
                    a.select()
                }
            }
        })
    },
    setCaret: function() {
    	
        if (!$.browser.msie) {
            return
        }
        var a = function() {
            var b = $(this).get(0);
            b.caretPos = document.selection.createRange().duplicate()
        };
        $(this).click(a).select(a).keyup(a)
    },
    insertAtCaret: function(c) {
        var b = $(this).get(0);
        if (document.all && b.createTextRange && b.caretPos) {
            var d = b.caretPos;
            d.text = d.text.charAt(d.text.length - 1) == "" ? c + "": c
        } else {
            if (b.setSelectionRange) {
                var g = b.selectionStart;
                var f = b.selectionEnd;
                var h = b.value.substring(0, g);
                var e = b.value.substring(f);
                b.value = h + c + e;
                b.focus();
                var a = c.length;
                b.setSelectionRange(g + a, g + a);
                b.blur()
            } else {
                b.value += c
            }
        }
    }
});
