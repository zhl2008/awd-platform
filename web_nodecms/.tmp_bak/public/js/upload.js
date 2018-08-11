$(function(){
    var uploader =  new AjaxUpload('#upload_input',{
        // 提交目标
        action: "/admin/resource/index?dir=image",
        name: "imgFile",
        autoSubmit:true,
        onChange: function (file, extension) {
            if (!new RegExp(/(jpg)|(jpeg)|(bmp)|(gif)|(png)/i).test(extension)) {
                alert("只限上传图片文件，请重新选择！");
                return false;
            } 
        },
        // 上传完成之后
        onComplete: function (file, data) {
            console.log(data);
            var response = JSON.parse(data);
            if (response.error == 0){
                $("#thumb").val(response.url);
                alert("上传成功");
            }else{
                alert("上传失败"+response.message);
            }
        }
    });
});