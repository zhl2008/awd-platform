<?php
namespace clt;
use clt\Leftnav;
class Form{
    public $data = array();

    public function __construct($data=array()) {
        $this->data = $data;
    }
    public function catid($info,$value){
        $validate = getvalidate($info);

        $list = db('category')->select();;
        foreach ($list as $lk=>$v){
            $category[$v['id']] = $v;
        }
        $id = $field = $info['field'];
        $value = $value ? $value : $this->data[$field];
        $moduleid =$info['moduleid'];
        foreach ($category as $r){
            if($r['type']==1){
                continue;
            }
            $arr= explode(",",$r['arrchildid']);
            $show=0;
            foreach((array)$arr as $rr){
                if($category[$rr]['moduleid']==$moduleid){
                    $show=1;
                }
            }
            if(empty($show)){
                continue;
            }
            if($r['child']){
                $r['disabled'] = ' disabled';
            }else{
                $r['disabled'] = ' ';
            }
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$disabled \$selected>\$spacer \$catname</option>";
        $tree = new Tree ($array);
        $parseStr = '<select  id="'.$id.'" lay-verify="required" name="'.$field.'"  '.$validate.'>';
        $parseStr .= '<option value="">请选择'.$info['name'].'</option>';
        $parseStr .= $tree->get_tree(0, $str, $value);
        $parseStr .= '</select>';
        return $parseStr;
    }

    public function title($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $style=$info['setup']['style'];
        $thumb=$info['setup']['thumb'];
        $field = $info['field'];
        $name = $info['name'];
        $value = $value ? $value : $this->data[$field];
        $style_color='';
        $style_bold='';
        $title_thumb=$this->data['thumb'];
        if(array_key_exists('title_style',$this->data)){
            if($this->data['title_style']){
                $title_style = explode(';',$this->data['title_style']);
                $style_color = explode(':',$title_style[0]);
                $style_bold = explode(':',$title_style[1]);
                $style_color = $style_color[1];
                $style_bold = $style_bold[1];
            }
        }
        $boldchecked= $style_bold=='bold' ? 'checked' : '';
        $titleThumb =$title_thumb?__PUBLIC__.$title_thumb:config('view_replace_str.__ADMIN__')."/images/tong.png";
        if(empty($info['setup']['upload_maxsize'])){
            $info['setup']['upload_maxsize'] =  intval(byte_format(config('attach_maxsize')));
        }
        if($info['pattern']!='defaul'){
            $pattern='|'.$info['pattern'];
        }
        $parseStr   = '<input type="text" name="'.$field.'" data-required="'.$info['required'].'" value="'.$value.'" data-min="'.$info['minlength'].'" data-max="'.$info['maxlength'].'" data-errormsg="'.$info['errormsg'].'" title="'.$name.'" placeholder="请输入'.$name.'" lay-verify="defaul'.$pattern.'" class="'.$info['class'].' layui-input"/> ';
        $stylestr ='</div>';
        if($info['required']==1){
            $stylestr .='<div class="layui-form-mid layui-word-aux red">*必填</div>';
        }
        $stylestr .='</div>';

        //标题颜色及是否加粗
        $stylestr .='<div class="layui-form-item"><label class="layui-form-label">标题颜色</label>';
        $stylestr .='<div class="layui-input-4"><input type="text" name="style_color" id="style_color" value="'.$style_color.'"/></div></div>';
        $stylestr .='<div class="layui-form-item"><label class="layui-form-label">加粗</label>';
        $stylestr .='<div class="layui-input-4"><input type="checkbox" name="style_bold" value="bold" '.$boldchecked.' title="加粗">';

        //缩略图
        $thumbstr ='</div></div>';
        $thumbstr .='<div class="layui-form-item"><label class="layui-form-label">缩略图</label>';
        $thumbstr .='<div class="layui-input-4"><input type="hidden" name="thumb" id="thumb" value="'.$title_thumb.'"><div class="layui-upload">';
        $thumbstr .='<button type="button" class="layui-btn layui-btn-primary" id="thumbBtn"><i class="icon icon-upload3"></i>点击上传</button>';
        $thumbstr .='<div class="layui-upload-list"><img class="layui-upload-img" id="cltThumb" src="'.$titleThumb.'"><p id="thumbText"></p>';
        $thumbstr .='</div></div>';
        if($style){
            $parseStr = $parseStr.$stylestr;
        }
        if($thumb){
            $parseStr = $parseStr.$thumbstr;
        }
        return $parseStr;
    }

    public function text($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $name = $info['name'];

        $info['setup']['ispassword'] ? $inputtext = 'password' : $inputtext = 'text';
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        $pattern='';
        if($info['pattern']!='defaul'){
            $pattern='|'.$info['pattern'];
        }
        $parseStr   = '<input type="'.$inputtext.'" data-required="'.$info['required'].'" min="'.$info['minlength'].'" max="'.$info['maxlength'].'" errormsg="'.$info['errormsg'].'" title="'.$name.'" placeholder="请输入'.$name.'" lay-verify="defaul'.$pattern.'" class="'.$info['class'].' layui-input" name="'.$field.'" value="'.$value.'" /> ';
        if($info['required']==1){
            $parseStr .='</div>';
            $parseStr .='<div class="layui-form-mid layui-word-aux red">*必填';
        }
        return $parseStr;
    }

    public function textarea($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $name = $info['name'];
        if($info['pattern']!='defaul'){
            $pattern='|'.$info['pattern'];
        }
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }

        $parseStr   = '<textarea data-required="'.$info['required'].'" min="'.$info['minlength'].'" max="'.$info['maxlength'].'" errormsg="'.$info['errormsg'].'" title="'.$name.'" placeholder="请输入'.$name.'" lay-verify="defaul'.$pattern.'"  class="'.$info['class'].' layui-textarea" name="'.$field.'" />'.$value.'</textarea>';
        if($info['required']==1){
            $parseStr .='</div>';
            $parseStr .='<div class="layui-form-mid layui-word-aux red">*必填';
        }
        return $parseStr;
    }

    public function editor($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $name = $info['name'];
        $pattern = ($info['pattern']!='defaul')?'|'.$info['pattern']:'';
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        if($info['setup']['edittype']=='UEditor'){
            //配置文件
            $str ='';
            $str .='<input type="hidden" id="editType" value="1">';
            $str .='<textarea name="'.$field.'" class="'.$info['class'].'" id="'.$info['class'].'">'.$value.'</textarea>';
            $str .='<script>var editor = new UE.ui.Editor();editor.render("'.$info['class'].'");</script>';
        }else{
            $str ='';
            $str .='<input type="hidden" id="editType" value="0">';
            if($value){
                $str .='<textarea name="'.$field.'" min="'.$info['minlength'].'" max="'.$info['maxlength'].'" errormsg="'.$info['errormsg'].'" title="'.$name.'" placeholder="请输入'.$name.'" lay-verify="defaul'.$pattern.'" class="'.$info['class'].'" id="'.$info['class'].'" >'.$value.'</textarea>';
            }else{
                $str .='<textarea name="'.$field.'" min="'.$info['minlength'].'" max="'.$info['maxlength'].'" errormsg="'.$info['errormsg'].'" title="'.$name.'" placeholder="请输入'.$name.'" lay-verify="defaul'.$pattern.'" class="'.$info['class'].'" id="'.$info['class'].'" >请输入……</textarea>';
            }
            $str .='<script>layui.use("layedit", function () {var layedit = layui.layedit;layedit.set({uploadImage: {url: \''.url("UpFiles/editUpload").'\',type: \'post\'}});edittext[\''.$info['class'].'\'] = layedit.build("'.$info['class'].'");})</script>';
        }
        return $str;
    }

    public function datetime($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $name = $info['name'];
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : '';
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        $value = $value ?  toDate($value,"Y-m-d H:i:s") : toDate(time(),"Y-m-d H:i:s");

        $parseStr = '<input type="datetime" title="'.$name.'" name="'.$field.'" data-required="'.$info['required'].'" placeholder="请输入'.$name.'" value="'.$value.'" class="'.$info['class'].' layui-input" id="addtime">';
        if($info['required']==1){
            $parseStr .='</div>';
            $parseStr .='<div class="layui-form-mid layui-word-aux red">*必填';
        }
        return $parseStr;
    }

    public function number($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $id = $field = $info['field'];
        $validate = getvalidate($info);
        if(isset($info['setup']['ispassowrd'])){
            $inputtext = 'passowrd';
        }else{
            $inputtext = 'text';
        }
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        if(isset($info['setup']['size'])){
            $size = $info['setup']['size'];
        }else{
            $size = "";
        }
        $parseStr   = '<input type="'.$inputtext.'"   class="input-text '.$info['class'].' layui-input" name="'.$field.'"  id="'.$id.'" value="'.$value.'" size="'.$size.'"  '.$validate.'/> ';
        return $parseStr;
    }

    public function select($info,$value){

        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $id = $field = $info['field'];
        $validate = getvalidate($info);
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        if($value != '') $value = strpos($value, ',') ? explode(',', $value) : $value;
        if(is_array($info['options'])){
            $optionsarr = $info['options'];
        }else{
            $options    = $info['setup']['options'];
            $options = explode("\n",$info['setup']['options']);
            foreach($options as $r) {
                $v = explode("|",$r);
                $k = trim($v[1]);
                $optionsarr[$k] = $v[0];
            }
        }
        if(!empty($info['setup']['multiple'])) {
            $onchange = '';
            if(isset($info['setup']['onchange'])){
                $onchange = $info['setup']['onchange'];
            }
            $parseStr = '<select id="'.$id.'" name="'.$field.'"  onchange="'.$onchange.'" class="'.$info['class'].'"  '.$validate.' size="'.$info['setup']['size'].'" multiple="multiple" ><option value=""></option>';
        }else {
            $onchange = '';
            if(isset($info['setup']['onchange'])){
                $onchange = $info['setup']['onchange'];
            }
            $parseStr = '<select id="'.$id.'" name="'.$field.'" onchange="'.$onchange .'"  class="'.$info['class'].'" '.$validate.'>';
        }

        if(is_array($optionsarr)) {
            foreach($optionsarr as $key=>$val) {
                if(!empty($value)){
                    $selected='';
                    if(is_array($value)){
                        if(in_array($key,$value)){
                            $selected = ' selected="selected"';
                        }
                    }else{
                        if($value==$key){
                            $selected = ' selected="selected"';
                        }
                    }
                    $parseStr   .= '<option '.$selected.' value="'.$key.'">'.$val.'</option>';
                }else{
                    $parseStr   .= '<option value="'.$key.'">'.$val.'</option>';
                }
            }
        }
        $parseStr   .= '</select>';
        return $parseStr;
    }

    public function checkbox($info,$value){

        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $id = $field = $info['field'];
        $validate = getvalidate($info);
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        $labelwidth = $info['setup']['labelwidth'];


        if(is_array($info['options'])){
            $optionsarr = $info['options'];
        }else{
            $options    = $info['setup']['options'];
            $options = explode("\n",$info['setup']['options']);
            foreach($options as $r) {
                $v = explode("|",$r);
                $k = trim($v[1]);
                $optionsarr[$k] = $v[0];
            }
        }
        if($value != '') $value = strpos($value, ',') ? explode(',', $value) : array($value);
        $i = 1;
        $parseStr ='';
        foreach($optionsarr as $key=>$r) {
            $key = trim($key);
            if($i>1){
                $validate='';
            }
            $checked = ($value && in_array($key, $value)) ? 'checked' : '';
            $parseStr .= '<input name="'.$field.'['.$i.']" id="'.$id.'_'.$i.'" '.$checked.' value="'.htmlspecialchars($key).'"  '.$validate.' type="checkbox" class="ace" title="'.htmlspecialchars($r).'">';
            $i++;
        }
        return $parseStr;

    }

    public function radio($info,$value){
        $info['setup'] = is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $id = $field = $info['field'];
        $validate = getvalidate($info);

        $action = ACTION_NAME;
        if ($action == 'add') {
            $value = $value ? $value : $info['setup']['default'];
        } else {
            $value = $value ? $value : $this->data[$field];
        }
        $labelwidth = $info['setup']['labelwidth'];
        $parseStr='';
        if (isset($info['options'])) {
            if (is_array($info['options'])) {
                $optionsarr = $info['options'];
            }
        } else if (isset($info['setup']['options'])) {
            $options = $info['setup']['options'];
            $options = explode("\n", $info['setup']['options']);
            foreach ($options as $r) {
                $v = explode("|", $r);
                $k = trim($v[1]);
                $optionsarr[$k] = $v[0];
            }
        }else {
            return $parseStr;
        }
        $i = 1;
        foreach($optionsarr as $key=>$r) {
            if($i>1){
                $validate ='';
            }
            $checked = trim($value)==trim($key) ? 'checked' : '';
            if(empty($value) && empty($key) ){
                $checked = 'checked';
            }
            $parseStr .= '<input name="'.$field.'" id="'.$id.'_'.$i.'" '.$checked.' value="'.$key.'" '.$validate.' type="radio" class="ace" title="'.$r.'" />';
            $i++;
        }
        return $parseStr;
    }

    public function groupid($info,$value){
        $newinfo = $info;
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $list = db('role')->select();;
        foreach ($list as $lk=>$v){
            $groups[$v['id']] = $v;
        }
        $options=array();
        foreach($groups as $key=>$r) {
            if($r['status']){
                $options[$key]=$r['name'];
            }
        }
        $newinfo['options']=$options;
        $fun=$info['setup']['inputtype'];
        return $this->$fun($newinfo,$value);
    }

    public function posid($info,$value){
        $newinfo = $info;
        $list = db('posid')->select();
        foreach ($list as $lk=>$v){
            $posids[$v['id']] = $v;
        }

        $options=array();
        $options[0]= "请选择";
        foreach($posids as $key=>$r) {
            $options[$key]=$r['name'];
        }
        $newinfo['options']=$options;
        if(isset($info['setup']['inputtype'])){
            $fun=$info['setup']['inputtype'];
        }
        return $this->select($newinfo,$value);
    }

    public function typeid($info,$value){
        $newinfo = $info;
        $list = db('type')->select();
        foreach ($list as $lk=>$v){
            $types[$v['id']] = $v;
        }

        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);

        $parentid=$info['setup']['default'];

        $options=array();
        $options[0]= '请选择';
        foreach($types as $key=>$r) {
            if($r['parentid']!=$parentid || empty($r['status'])) continue;
            $options[$key]=$r['name'];
        }
        $newinfo['options']=$options;
        $fun=$info['setup']['inputtype'];
        return $this->$fun($newinfo,$value);
    }

    public function template($info,$value){
        $templates= template_file(MODULE_NAME);
        $newinfo = $info;
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $options=array();
        $options[0]= "请选择";
        if($templates){
            foreach($templates as $key=>$r) {
                if(strstr($r['value'],'_show')){
                    $options[$r['value']]=$r['filename'];
                }
            }
        }
        $newinfo['options']=$options;
        //$fun=$info['setup']['inputtype'];
        return $this->select($newinfo,$value);
    }

    public function image($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $action = ACTION_NAME;
        if($action=='add'){
            $value =$value?__PUBLIC__.$value:config('view_replace_str.__ADMIN__')."/images/tong.png";
        }else{
            if($this->data[$field]){
                $value = $value ?$value :  __PUBLIC__.$this->data[$field];
            }else{
                $value = config('view_replace_str.__ADMIN__')."/images/tong.png";
            }

        }


        $thumbstr ='<div class="layui-input-4"><input type="hidden" name="'.$field.'" id="'.$field.'Val" value="'.$this->data[$field].'"><div class="layui-upload">';
        $thumbstr .='<button type="button" class="layui-btn layui-btn-primary" id="'.$info['class'].'"><i class="icon icon-upload3"></i>点击上传</button>';
        $thumbstr .='<div class="layui-upload-list"><img class="layui-upload-img" id="'.$info['class'].'Img" src="'.$value.'"><p id="thumbText"></p>';
        $thumbstr .='</div></div></div>';
        $thumbstr.="<script> 
                        layui.use('upload', function () {
                            var upload = layui.upload;
                            upload.render({
                                elem:'#".$info['class']."', 
                                url: '".url('upFiles/upload')."',
                                title: '上传图片',
                                ext: '".$info['setup']['upload_allowext']."', 
                                done: function(res){
                                    $('#".$field."Img').attr('src', '".__PUBLIC__."'+res.url);
                                    $('#".$field."Val').val(res.url);
                                }
                            });
                        });
                    </script>";
        return $thumbstr;
    }

    public function images($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        $data='';
        $i=0;
        if($value){
            $options = explode(";",mb_substr($value,0,-1));
            if(is_array($options)){
                foreach($options as  $r) {
                    $data .='<div class="layui-col-md3"><div class="dtbox"><img src="'.__PUBLIC__.$r.'" class="layui-upload-img"><input type="hidden" class="imgVal" value="'.$r.'"><i class="delimg layui-icon">&#x1006;</i></div></div>';
                }
            }
        }
        $parseStr   = '<div id="images" class="images"></div><div id="upImg" class="upImg" data-i="'.$i.'">'.$data.'</div>';
        $parseStr   = '<div class="layui-upload">';
        $parseStr   .= '<button type="button" class="layui-btn" id="test2">多图片上传</button>';
        $parseStr   .= '<blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">';
        $parseStr   .= '预览图：<div class="layui-upload-list" id="demo2"><div class="layui-row layui-col-space10">'.$data.'</div></div> </blockquote></div>';
        return $parseStr;
    }
    public function file($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $field = $info['field'];
        $action = ACTION_NAME;
        $fileArr=explode('.',$this->data[$field]);
        $ext=$fileArr[1];
        if($action=='add' or $ext==''){
            $value ="__STATIC__/common/images/file.png";
        }else{
            $value = "__STATIC__/common/images/".$ext.".png";
        }
        $thumbstr ='<div class="layui-input-4"><input type="hidden" name="'.$field.'" id="'.$field.'fval" value="'.$this->data[$field].'"><div class="layui-upload">';
        $thumbstr .='<button type="button" class="layui-btn layui-btn-primary" id="'.$info['class'].'"><i class="icon icon-upload3"></i>点击上传</button>';
        $thumbstr .='<div class="layui-upload-list"><img class="layui-upload-img" id="'.$info['class'].'File" src="'.$value.'"><p id="thumbText"></p>';
        $thumbstr .='</div></div></div>';
        $thumbstr.="<script> 
                        layui.use('upload', function () {
                            var upload = layui.upload;
                            upload.render({
                                elem:'#".$info['class']."', 
                                accept:'file',
                                url: '".url('upFiles/file')."',
                                title: '上传文件',
                                ext: '".$info['setup']['upload_allowext']."', 
                                done: function(res){
                                    $('#".$field."File').attr('src', '__STATIC__/common/images/'+res.ext+'.png');
                                    $('#".$field."fval').val(res.url);
                                }
                            });
                        });
                    </script>";
        return $thumbstr;
    }
    public function linkage($info){
        $field = $info['field'];
        $value = '';
        if($this->data[$field]){
            $value = explode(',',$this->data[$field]);
        }
        $region = db('region')->where(['pid'=>1])->select();
        $html='<div class="layui-input-inline">';
        $html .='<select name="'.$field.'[]" id="province" lay-filter="province">';
        $html .='<option value="">请选择省</option>';
        foreach ($region as $k=>$v){
            if($value[0] == $v['id']){
                $html .='<option selected value="'.$v['id'].'">'.$v['name'].'</option>';
            }else{
                $html .='<option value="'.$v['id'].'">'.$v['name'].'</option>';
            }
        }
        $html .='</select>';
        $html .='</div>';

        $city ='';
        if($value[0]){
            $city = db('region')->where(['pid'=>$value[0]])->select();
        }

        $html .='<div class="layui-input-inline">';
        $html .='<select name="'.$field.'[]" id="city" lay-filter="city">';
        $html .='<option value="">请选择市</option>';
        if($city){
            foreach ($city as $k=>$v){
                if($value[1] == $v['id']){
                    $html .='<option selected value="'.$v['id'].'">'.$v['name'].'</option>';
                }else{
                    $html .='<option value="'.$v['id'].'">'.$v['name'].'</option>';
                }
            }
        }

        $html .='</select>';
        $html .='</div>';

        $district ='';
        if($value[1]){
            $district = db('region')->where(['pid'=>$value[1]])->select();
        }


        $html .='<div class="layui-input-inline">';
        $html .='<select name="'.$field.'[]" id="district" lay-filter="district">';
        $html .='<option value="">请选择县/区</option>';

        if($district){
            foreach ($district as $k=>$v){
                if($value[2] == $v['id']){
                    $html .='<option selected value="'.$v['id'].'">'.$v['name'].'</option>';
                }else{
                    $html .='<option value="'.$v['id'].'">'.$v['name'].'</option>';
                }
            }
        }

        $html .='</select>';
        $html .='</div>';
        return $html;
    }

    /*public function files($info,$value){
        $info['setup']=is_array($info['setup']) ? $info['setup'] : string2array($info['setup']);
        $id = $field = $info['field'];
        $validate = getvalidate($info);
        $action = ACTION_NAME;
        if($action=='add'){
            $value = $value ? $value : $info['setup']['default'];
        }else{
            $value = $value ? $value : $this->data[$field];
        }
        $data='';
        $i=0;
        if($value){
            $options = explode(":::",$value);
            if(is_array($options)){
                foreach($options as  $r) {
                    $v = explode("|",$r);
                    $k = trim($v[1]);
                    $optionsarr[$k] = $v[0];
                    $data .='<div id="uplistd_'.$i.'" class="col-md-6 ">
                    <div class="upimgs">
                    <input type="text"  class="form-control" name="'.$field.'[]" value="'.$v[0].'" style="margin-bottom:5px;"/> 
                    <input type="text" class="form-control" name="'.$field.'_name[]" value="'.$v[1].'" placeholder="请填写文件标题"/>
                    <textarea class="form-control" name="'.$field.'_text[]" rows="2" cols="" style="margin:5px 0;" placeholder="请填写文件简介">'.$v[2].'</textarea>
                    <div class="clearfix"></div>
                    <a href="javascript:remove_this(\'uplistd_'.$i.'\');" class="btn btn-danger btn-block btn-xs">移除</a>
                    </div></div>';
                    $i++;
                }
            }
        }
        if(empty($info['setup']['upload_maxsize'])){
            $info['setup']['upload_maxsize'] =  intval(byte_format(config('attach_maxsize')));
        }
        $parseStr   = '<fieldset class="images_box">
        <legend>文件上传<span style="font-size: 16px;">（最多同时可以上传 <font color=\'red\'>'.$info['setup']['upload_maxnum'].'</font>张）</span></legend><center></center>
		<div id="'.$field.'_images" class="imagesList row">'.$data.'</div>
		</fieldset>
		<input type="button" class="btn btn-success btn-sm" value="文件上传" onclick="javascript:swfupload(\''.$field.'_uploadfile\',\''.$field.'\',\'文件上传\','.$info['setup']['more'].',0,\''.$info['setup']['upload_maxnum'].'\',\''.$info['setup']['upload_allowext'].'\','.$info['setup']['upload_maxsize'].','.$info['moduleid'].',up_images,nodo)">  ';

        return $parseStr;
    }*/
}
?>