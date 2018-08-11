/**
 * Admin/ResourceController
 *
 * 文件上传API 
 */
var AllowTypes = [
    "text/plain",
    "image/gif",
    "image/jpeg",
    "image/png",
    "video/mpeg",
    "application/pdf",
    "application/msword"
];
var path = require("path");
var fs = require("fs");

module.exports = {

    // 文件上传插件
    index: function(req, res, next) {
        res.setHeader("Content-Type","text/html; charset=utf-8");
        req.file('imgFile').upload({
            // don't allow the total upload size to exceed ~10MB
            maxBytes: 10000000
        }, function whenDone(err, uploadedFiles) {
            try {
                if (err) {
                    throw "upload error";
                }

                if (uploadedFiles.length === 0) {
                    throw "No file was uploaded";
                }

                // 目前支持单个文件上传
                var currentFile = uploadedFiles[0];
                var type = currentFile.type;
                if (AllowTypes.indexOf(type) == -1) {
                    throw "error file type";
                }

                var now = new Date();
                var dateStr = now.toLocaleDateString().replace(/\//g, "_");
                var uploadDir = sails.config.paths['public'] + path.sep + "uploads" + path.sep + dateStr;
                var extName = path.extname(currentFile.filename);
                var baseName = ((new Date()).getTime() + "" + Math.floor(Math.random() * 10000)).substr(-12, 12) + extName;
                var targeFileName = uploadDir + path.sep + baseName;
                var url = "/uploads/" + dateStr + "/" + baseName;

                if (!fs.existsSync(uploadDir)) {
                    if (fs.mkdirSync(uploadDir, 775)) {
                        throw "mkdir fail";
                    }
                }
                fs.rename(currentFile.fd, targeFileName, function(err) {
                    if (err) {
                        throw err;
                    }
                    return res.json({
                        "error": 0,
                        "url": url
                    });
                });

            } catch (err) {
                return res.json({
                    "error": 1,
                    "url": null,
                    "message":err
                });
            }
        });
    }
};