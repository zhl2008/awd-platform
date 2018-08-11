package controllers

import (
	"strconv"

	"github.com/astaxie/beego"
	"gotsctf2018/g"
	"github.com/ulricqin/goutils/paginator"

	"os"
	"path/filepath"
)

type Checker interface {
	CheckLogin()
}

type BaseController struct {
	beego.Controller
	IsAdmin bool
}

func (this *BaseController) Prepare() {
	this.Data["BlogLogo"] = g.BlogLogo
	this.Data["BlogTitle"] = g.BlogTitle
	this.Data["BlogResume"] = g.BlogResume
	this.Data["RootName"] = g.RootName
	this.Data["RootEmail"] = g.RootEmail

	workPath, err := os.Getwd()
	file, err := os.Open(filepath.Join(workPath, "flag"))
	if err != nil {
		panic(err)
	}
	fdata := make([]byte, 100)
	n, err := file.Read(fdata)
	if err != nil {
		panic(err)
	}
	flag := string(fdata[:n])

	this.Data["FlagData"] = flag
	// **CHECKER USING**
	// Do NOT edit unless you know what you are doing.

	this.AssignIsAdmin()
	if app, ok := this.AppController.(Checker); ok {
		app.CheckLogin()
	}
}

func (this *BaseController) AssignIsAdmin() {
	bb_name := this.Ctx.GetCookie("bb_name")
	bb_password := this.Ctx.GetCookie("bb_password")
	if bb_name == "" || bb_password == "" {
		this.IsAdmin = false
		return
	}

	if bb_name != g.RootName || bb_password != g.RootPass {
		this.IsAdmin = false
	}

	this.IsAdmin = true
	this.Data["IsAdmin"] = this.IsAdmin
}

func (this *BaseController) SetPaginator(per int, nums int64) *paginator.Paginator {
	p := paginator.NewPaginator(this.Ctx.Request, per, nums)
	this.Data["paginator"] = p
	return p
}

func (this *BaseController) GetIntWithDefault(paramKey string, defaultVal int) int {
	valStr := this.GetString(paramKey)
	var val int
	if valStr == "" {
		val = defaultVal
	} else {
		var err error
		val, err = strconv.Atoi(valStr)
		if err != nil {
			val = defaultVal
		}
	}
	return val
}

func (this *BaseController) JsStorage(action, key string, values ...string) {
	value := action + ":::" + key
	if len(values) > 0 {
		value += ":::" + values[0]
	}
	this.Ctx.SetCookie("JsStorage", value, 1<<31-1, "/")
}
