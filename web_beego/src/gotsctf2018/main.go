package main

import (
	"github.com/astaxie/beego"
	"gotsctf2018/g"
	_ "gotsctf2018/routers"
)

func main() {
	g.InitEnv()
	beego.Run()
}
