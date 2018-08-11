package controllers

import (
	"time"

	"gotsctf2018/g"
	"github.com/ulricqin/goutils/filetool"
	"math/rand"
)

const (
	UPLOAD_DIR = "static/uploads"
)

type ApiController struct {
	BaseController
}

func randomString(n int64) string {
	rand.Seed(time.Now().UnixNano())

	var letterRunes = []rune("1234567890")

	b := make([]rune, n)
	for i := range b {
		b[i] = letterRunes[rand.Intn(len(letterRunes))]
	}
	return string(b)
}

func (this *ApiController) Health() {
	this.Ctx.WriteString("ok")
}

func (this *ApiController) Upload() {
	result := map[string]interface{}{
		"success": false,
	}

	defer func() {
		this.Data["json"] = &result
		this.ServeJSON()
	}()

	_, header, err := this.GetFile("image")
	if err != nil {
		return
	}

	name := header.Filename

	path := this.GetString("savepath")
	if path != "" {
		path = UPLOAD_DIR + path + "/"
	} else {
		path = UPLOAD_DIR + "/usercontents/editor/"
	}

	imgPath := path + name

	filetool.InsureDir(path)
	err = this.SaveToFile("image", imgPath)
	if err != nil {
		return
	}

	imgUrl := "/" + imgPath

	result["link"] = imgUrl
	result["success"] = true

}

func (this *ApiController) Markdown() {
	if this.IsAjax() {
		result := map[string]interface{}{
			"success": false,
		}
		action := this.GetString("action")
		switch action {
		case "preview":
			content := this.GetString("content")
			result["preview"] = g.RenderMarkdown(content)
			result["success"] = true
		}
		this.Data["json"] = result
		this.ServeJSON()
	}
}