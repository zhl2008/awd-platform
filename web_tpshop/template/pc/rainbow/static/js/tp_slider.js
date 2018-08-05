	
;(function($) {
    $.fn.nc_slider = function(options) {
        var defaults = {
            animate: 400, 
            timeout: 5000, 
            pagination: true,
            pagination_class: 'full-screen-slides-pagination'
        };
        var settings = $.extend({}, defaults, options);

        function nc_slider($slider) {
            var slider = {
                timer: null,
                $items: null,
                items_count: null,
                max_index: null,
                $pagination: null,
                auto: true,
                current: 0
            };

            function init() {
                slider.$items = $slider.children();
                slider.items_count = slider.$items.length;
                if(slider.items_count <= 1) {
                    return;
                }
                slider.max_index = slider.items_count - 1;
                slider.$items.hide();

                //初始化导航
                if(settings.pagination) {
                    //生成导航按钮
                    var pagination_html = '<ul class="' + settings.pagination_class + '">';
                    for (var i = 1; i <= slider.items_count; i++) {
                        pagination_html += '<li>' + '<a href="javascript:;">' + i + '</a>' + '</li>';
                    }
                    pagination_html += '</ul>';
                    $slider.after(pagination_html);

                    slider.$pagination = $slider.next('ul').find('li');

                    //导航按钮单击切换
                    slider.$pagination.on('click', function() {
                        var next = $(this).index();
                        go(next);
                    });

                    //鼠标移动到导航按钮上暂停自动播放
                    slider.$pagination.mouseenter(function() {
                        slider.auto = false;
                    });
                    slider.$pagination.mouseleave(function() {
                        slider.auto = true;
                    });
                }

                next();
            }

            function go(next) {
                slider.$items.eq(slider.current).fadeOut(settings.animate);
                slider.$items.eq(next).fadeIn(settings.animate);
                slider.current = next;

                if(settings.pagination) {
                    slider.$pagination.eq(next).addClass('current').siblings('li').removeClass('current');
                }
            }

            function next() {
                if (slider.auto) {
                    if (slider.current >= slider.max_index || slider.timer === null) {
                        go(0);
                    } else {
                        go(slider.current + 1);
                    }
                }
                slider.timer = setTimeout(next, settings.timeout);
            }

            init();
        }

        return this.each(function() {
            nc_slider($(this));
        });
    };
})(jQuery);