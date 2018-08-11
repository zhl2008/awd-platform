package strtool

import (
	"crypto/md5"
	"fmt"
	"strings"
)

func TrimRightSpace(s string) string {
	return strings.TrimRight(string(s), "\r\n\t ")
}

func Md5(s string) string {
	h := md5.New()
	h.Write([]byte(s))
	return fmt.Sprintf("%x", h.Sum(nil))
}
