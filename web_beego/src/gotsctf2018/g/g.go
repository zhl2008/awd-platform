package g

import (
	"fmt"
	"github.com/astaxie/beego"
	"github.com/astaxie/beego/orm"
	_ "github.com/go-sql-driver/mysql"
)

var catalogCacheExpire int64
var RunMode string
var Cfg = beego.AppConfig

func InitEnv() {
	// database
	dbUser := Cfg.String("db_user")
	dbPass := Cfg.String("db_pass")
	dbHost := Cfg.String("db_host")
	dbPort := Cfg.String("db_port")
	dbName := Cfg.String("db_name")
	maxIdleConn, _ := Cfg.Int("db_max_idle_conn")
	maxOpenConn, _ := Cfg.Int("db_max_open_conn")
	dbLink := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?charset=utf8", dbUser, dbPass, dbHost, dbPort, dbName) + "&loc=Asia%2FChongqing"

	orm.RegisterDriver("mysql", orm.DRMySQL)
	orm.RegisterDataBase("default", "mysql", dbLink, maxIdleConn, maxOpenConn)

	RunMode = Cfg.String("runmode")
	if RunMode == "dev" {
		orm.Debug = true
	}

	initCfg()
}
