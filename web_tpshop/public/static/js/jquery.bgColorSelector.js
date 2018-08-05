(function($) {
    $.fn.sColor = function(d) {
        var f = {
            colors: '',
            colorsHeight: 26,
            curImg: 'images/cur.png',
            curTop: 0,
            form: 'drag',
            keyEvent: true,
            prevColor: false,
            defaultItem: 0
        };
        var g = $.extend(f, d);
        var h = 0;
        var j = 0;
        var k = true;
        var l = window.location.search;
        var m = '#bgColorSelector';
        var n = '#bgColorSelector #bscParent';
        var o = '#bgColorSelector #bscParent #bscDrag';
        var p = '#bgColorSelector #bscParent #bscDrop td';
        var q = g.colors;
        var r = parseInt(g.colorsHeight);
        var s = g.curImg;
        var t = g.curTop;
        var u = g.form;
        var v = g.keyEvent;
        var w = g.prevColor;
        var x = '<div id="bgColorSelector"><div id="bscParent"><div id="bscDrag" title="滑动一下，焕新色彩"><img src="' + s + '" alt="" /></div><table id="bscDrop" cellpadding="0" cellspacing="0"><tr>';
        $.each(q,
        function(i, a) {
            x += '<td><span style="background-color:' + a.c + '">&nbsp;</span></td>'
        });
        x += '</tr></table></div></div>';
        $(this).empty().append(x);
        j = q.length;
        var y = $(p).width();
        var z = r + 5;
        $(o).width(y);
        $(o).find('img').width(y + 17).css('left', '-9px');
        var A = r >= z ? r: z;
        z = A - 10;
        $(o).height(r);
        $(o).find('img').height(parseInt(r) + 1);
        $(n).height(A);
        $(o).css('top', t);
        $(p).height(r);
        $(p).find('span').height(r);
        var B = function(a) {
			$.cookie('bgColorSelectorPosition', a, { expires: 365 ,path:"/"});
			return true;
        };
        if (j > 0) {
            h = g.defaultItem;
            if (w) {
				if ($.cookie('bgColorSelectorPosition') != null) {
					h = $.cookie('bgColorSelectorPosition');
				}
            }
            if (h > j || h < 0 || h == '') {
                h = 0
            }
            var D = $(p).eq(h).find('span').offset().left - $(n).offset().left;
            if (h > 0) $(o).css('left', D);
            var E = $(p).eq(h).find('span').css('background-color');
            $('body').css('background-color', E);
            $(o).attr('title', $(p).eq(h).find('span').attr('title'));
            if (j > 1) {
                if (v) {
                    $(document).keydown(function(e) {
                        if (!k) {
                            return
                        }
                        if (e.keyCode == 37 && h > 0) {
                            h--;
                            k = false
                        } else if (e.keyCode == 39 && h < j - 1) {
                            h++;
                            k = false
                        } else {
                            return
                        }
                        B(h);
                        $(o).animate({
                            left: $(p).eq(h).find('span').offset().left - $(n).offset().left
                        },
                        200,
                        function() {
                            k = true;
                            var a = $(p).eq(h).find('span').css('background-color');
                            $('body').css('background-color', a);
                            $(this).attr('title', $(p).eq(h).find('span').attr('title'))
                        })
                    })
                }
                if (u == 'click') {
                    $(p).find('span').click(function() {
                        k = false;
                        h = $(p).find('span').index($(this));
                        B(h);
                        $(o).animate({
                            left: $(p).eq(h).find('span').offset().left - $(n).offset().left
                        },
                        200,
                        function() {
                            k = true;
                            var a = $(p).eq(h).find('span').css('background-color');
                            $('body').css('background-color', a);
                            $(this).attr('title', $(p).eq(h).find('span').attr('title'))
                        })
                    })
                } else if (u == 'drag') {
                    $(o).draggable({
                        axis: 'x',
                        containment: 'parent',
                        revert: 'invalid'
                    });
                    $(p).droppable({
                        accept: o,
                        over: function(a, b) {
                            var c = $(this).find('span').css('background-color');
                            $('body').css('background-color', c);
                            h = $(p).find('span').index($(this).find('span'))
                        },
                        drop: function(a, b) {
                            $(o).animate({
                                left: $(this).find('span').offset().left - $(n).offset().left
                            },
                            200,
                            function() {
                                $(this).attr('title', $(p).eq(h).find('span').attr('title'))
                            });
                            var c = $(this).find('span').css('background-color');
                            $('body').css('background-color', c);
                            h = $(p).find('span').index($(this).find('span'));
                            B(h)
                        }
                    })
                } else {
                    throw new Error('没有此移动方式');
                }
            }
        }
    }
})(jQuery)