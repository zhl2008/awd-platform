package controllers

import (
	"gotsctf2018/g"
	"crypto/sha512"
	"encoding/hex"
)

type LoginController struct {
	BaseController
}

func (this *LoginController) Login() {
	this.TplName = "login/login.html"
}

func (this *LoginController) DoLogin() {
	name := this.GetString("name")
	if name == "" {
		this.Ctx.WriteString("name is blank")
		return
	}

	if this.GetString("password") == "" {
		this.Ctx.WriteString("password is blank")
		return
	}
	hashed_pass := sha512.Sum384([]byte(this.GetString("password")))
	password := hex.EncodeToString(hashed_pass[:])

	if g.RootName != name {
		this.Ctx.WriteString("name is incorrect")
		return
	}

	if g.RootPass != password {
		this.Ctx.WriteString("password is incorrect")
		return
	}

	this.Ctx.SetCookie("bb_name", g.RootName, 2592000, "/")
	this.Ctx.SetCookie("bb_password", g.RootPass, 2592000, "/")
	this.Ctx.WriteString("login success")
}

func (this *LoginController) Logout() {
	this.Ctx.ResponseWriter.Header().Add("Set-Cookie", "bb_name="+g.RootName+"; Max-Age=0; Path=/;")
	this.Ctx.ResponseWriter.Header().Add("Set-Cookie", "bb_password="+g.RootPass+"; Max-Age=0; Path=/;")
	this.Redirect("/", 302)
}
