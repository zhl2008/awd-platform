<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: zhangyajun <448901948@qq.com>
// +----------------------------------------------------------------------

namespace clt;
use think\Config;
use think\Paginator;
class Bootstrap extends Paginator
{
    protected function getTotal(){
        $html='<li><span>共<strong>'.$this->total().'</strong>条数据</span></li>';
        return $html;
    }

    /**
     * 上一页按钮
     * @param string $text
     * @return string
     */
    protected function getPreviousButton($text = "上一页")
    {

        if ($this->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url(
            $this->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 下一页按钮
     * @param string $text
     * @return string
     */
    protected function getNextButton($text = '下一页')
    {
        if (!$this->hasMore) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->url($this->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text);
    }

    /**
     * 获取首页按钮
     */
    protected function getFirstButton($text = "首页")
    {
        $page_size=Config::get('paginate.page_size');
        $button='';
        if ($this->currentPage() > $page_size) {
            $url = $this->url(1);
            $button=$this->getPageLinkWrapper($url, $text);
        }
        return $button;
    }
    /**
     * 获取尾页按钮
     */
    protected function getLastButton($text = "尾页")
    {
        $page_size=Config::get('paginate.page_size');
        $button='';
        if ($this->lastPage >=$this->currentPage+$page_size) {
            $url = $this->url(
                $this->lastPage
            );
            $button=$this->getPageLinkWrapper($url, $text);
        }
        return $button;
    }
    /**
     * 页码按钮
     * @return string
     */
    protected function getLinks()
    {
        $page_cfg=Config::get('paginate.page_button');
        $page_size=Config::get('paginate.page_size');
        if ($this->simple)
            return '';

        $block = [
            'top'=>null,
            'first'  => null,
            'slider' => null,
            'last'   => null
        ];
        $cli=intval(($this->currentPage+($page_size-1))/$page_size);
        if ($this->lastPage <= $page_size) {
            $block['first'] = $this->getUrlRange(1, $this->lastPage);
        } elseif ($this->lastPage < $this->currentPage+$page_size) {
            if($this->currentPage>$page_size && $page_cfg['turn_group']) $block['top']=$this->getUrlRange($page_size*($cli-1)-4,$page_size*($cli-1)-4);
            $block['first'] = $this->getUrlRange($this->lastPage-$page_size+1, $this->lastPage);
        }else{
            if($this->currentPage>$page_size && $page_cfg['turn_group']) $block['top']=$this->getUrlRange($page_size*($cli-1)-4,$page_size*($cli-1)-4);
            $block['first'] = $this->getUrlRange($page_size*($cli-1)+1, $page_size*$cli);
            if($page_cfg['turn_group']) $block['last']  = $this->getUrlRange($page_size*$cli+1,$page_size*$cli+1);
        }
        $html = '';
        if(is_array($block['top'])){
            $html .= $this->getUrlGroup($block['top'],'top');
        }
        if (is_array($block['first'])) {
            $html .= $this->getUrlLinks($block['first']);
        }
        if (is_array($block['slider'])) {
            $html .= $this->getDots();
            $html .= $this->getUrlLinks($block['slider']);
        }
        if (is_array($block['last'])) {
            $html .= $this->getUrlGroup($block['last'],'last');
        }
        return $html;
    }


    /**
     * 渲染分页html
     * @return mixed
     */
    public function render()
    {
        if ($this->hasPages()) {
            if ($this->simple) {
                return sprintf(
                    '<ul class="pager">%s %s</ul>',
                    $this->getPreviousButton(),
                    $this->getNextButton()
                );
            } else {
                $btn_cfg=Config::get('paginate.page_button');
                $btn_str='<ul class="pagination">';
                $btn_str.=$btn_cfg['total_rows']?'%s1':'';
                $btn_str.=$btn_cfg['first_page']?'%s2':'';
                $btn_str.=$btn_cfg['turn_page']?'%s3':'';
                $btn_str.='%s4';
                $btn_str.=$btn_cfg['turn_page']?'%s5':'';
                $btn_str.=$btn_cfg['last_page']?'%s6':'';

                $page_str=str_replace(array('%s1','%s2','%s3','%s4','%s5','%s6'),array($this->getTotal(),$this->getFirstButton(),$this->getPreviousButton(),$this->getLinks(),$this->getNextButton(),$this->getLastButton()),$btn_str);
                return $page_str;
            }
        }else{
            return sprintf(
                '<ul class="pagination">%s</ul>',
                $this->getTotal()
            );
        }
    }


    /**
     * 生成一个可点击的按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<li><a href="' . htmlentities($url) . '">' . $page . '</a></li>';
    }

    protected function getnextGroup($url,$tn=null)
    {
        $page_size=Config::get('paginate.page_size');
        $str=$tn=='top'?'上':'下';
        return '<li><a href="' . htmlentities($url) . '">' . $str . $page_size . '页</a></li>';
    }

    /**
     * 生成一个禁用的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="disabled"><span>' . $text . '</span></li>';
    }

    /**
     * 生成一个激活的按钮
     *
     * @param  string $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="active"><span>' . $text . '</span></li>';
    }

    /**
     * 生成省略号按钮
     *
     * @return string
     */
    protected function getDots()
    {
        return $this->getDisabledTextWrapper('...');
    }

    /**
     * 批量生成页码按钮.
     *
     * @param  array $urls
     * @return string
     */
    protected function getUrlLinks(array $urls)
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getPageLinkWrapper($url, $page);
        }
        return $html;
    }
    protected function getUrlGroup(array $urls,$tn='top')
    {
        $html = '';

        foreach ($urls as $page => $url) {
            $html .= $this->getGroupWrapper($url,$tn);
        }
        return $html;
    }

    /**
     * 生成普通页码按钮
     *
     * @param  string $url
     * @param  int    $page
     * @return string
     */
    protected function getPageLinkWrapper($url, $page)
    {
        if ($page == $this->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page);
    }
    protected function getGroupWrapper($url,$tn=null)
    {
        return $this->getnextGroup($url,$tn);
    }
}