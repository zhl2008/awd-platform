<?php
namespace clt;
class Tree {
    public $arr = array();
    public $icon = array('│','├','└');
    public $nbsp = "&nbsp;";
    public $ret = '';
    public $level = 0;

    public function __construct($arr=array()) {
        $this->arr = $arr;
        $this->ret = '';
        return is_array($arr);
    }

    public function getchild($bid){
        $a = $newarr = array();
        if(is_array($this->arr)){
            foreach($this->arr as $id => $a){
                if($a['parentid'] == $bid) $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }
    function get_tree($bid, $str, $sid = 0, $adds = '', $strgroup = ''){
        $number=1;
        $child = $this->getchild($bid);
        if(is_array($child)){
            $total = count($child);
            foreach($child as $id=>$a){
                $j=$k='';
                if($number==$total){
                    $j .= $this->icon[2];
                }else{
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $spacer = $adds ? $adds.$j : '';
                if(empty($a['selected'])){
                    $selected = ($a['id']==$sid) ? 'selected' : '';
                }
                @extract($a);
                if($a['module']=="page"){
                    $action='edit';
                    $files = 'id';
                }else{
                    $action='index';
                    $files = 'catid';
                }
                if($a['module']=="feedback"){
                    $module='plug';
                    $action='feedback';
                    $files = 'se';
                    $id = '48';
                }
                $parentid == 0 && $strgroup ? eval("\$newstr = \"$strgroup\";") : eval("\$newstr = \"$str\";");
                $this->ret .= $newstr;
                $nbsp = $this->nbsp;
                $this->get_tree($id, $str, $sid, $adds.$k.$nbsp,$strgroup);
                $number++;
            }
        }
        return $this->ret;
    }

    function get_nav($bid,$maxlevel,$effected_id='navlist',$style='filetree ' ,$homefont='',$recursion=FALSE ,$child='',$showenname='',$site_url='') {
        if($showenname) $indexen =  '<em>home</em>';
        if($homefont) $homefont='<li id="nav_0"><span class="fl_ico"></span><a href="'.$site_url.'"><span class="fl">'.$homefont.'</span>'.$indexen.'</a></li>';
        $number=1;
        if(!$child) $child = $this->getchild($bid);

        $total = count($child);
        $effected = $effected_id ?  ' id="'.$effected_id.'_box"' : '';
        $class=  $style? ' class="'.$style.'"' : '';
        if(!$recursion)	$this->ret .='<ul'.$effected.$class.'>'.$homefont;
        foreach($child as $id=>$a) {
            @extract($a);
            if(!$recursion) $this->level= $level+$maxlevel;
            $ischild =$this->getchild($id);
            $foldertype =  $ischild ? 'folder' : 'file';
            $floder_status = ' id="'.$effected_id.'_'.$id.'"';
            $first = $number==1 ?   'first ' : '';
            $floder_status .=  $number==$total ?  ' class="foot '.$foldertype.'"' :  ' class="'.$first.$foldertype.'"';
            $this->ret .= $recursion ? '<ul><li'.$floder_status.'>' : '<li'.$floder_status.'>';
            $recursion = FALSE;
            if($showenname){
                $enzm = $enname ? '<em>'.$enname.'</em>' :  '<em>'.$catdir.'</em>';
            }
            if($ischild && $level < $this->level){
                $this->ret .= '<span class="fd_ico"></span><a href="'.$url.'"><span class="fd">'.$catname.'</span>'.$enzm.'</a>';
                $this->get_nav($id,$maxlevel,$effected_id,$style,'',TRUE,$ischild,$showenname);
            } else {
                $this->ret .= '<span class="fl_ico"></span><a href="'.$url.'"><span class="fl">'.$catname.'</span>'.$enzm.'</a>';
            }
            $this->ret .=$recursion ? '</li></ul>': '</li>';
            $number++;
        }
        if(!$recursion)  $this->ret .='</ul>';
        return $this->ret;
    }
}
?>