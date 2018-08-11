package g

import (
	"crypto/sha512"
	"encoding/hex"
)

var (
	RootEmail      string
	RootName       string
	RootPass       string
	BlogTitle      string
	BlogResume     string
	BlogLogo       string
)

func initCfg() {
	RootName = Cfg.String("root_name")
	RootEmail = Cfg.String("root_email")
	hashed_pass := sha512.Sum384([]byte(Cfg.String("root_pass")))
	RootPass = hex.EncodeToString(hashed_pass[:])
	BlogTitle = Cfg.String("blog_title")
	BlogResume = Cfg.String("blog_resume")
	BlogLogo = Cfg.String("blog_logo")
}
