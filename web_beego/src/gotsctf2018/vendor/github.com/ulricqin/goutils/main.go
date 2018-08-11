package main

import (
	"fmt"
	"github.com/ulricqin/goutils/systool"
	"github.com/ulricqin/goutils/timetool"
	"time"
)

func main() {
	fmt.Println(systool.IntranetIP())
	fmt.Println(timetool.DateFormat(time.Now(), "YYYY-MM-DD"))
}
