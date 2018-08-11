// +build OMIT

package main

func main() {
	// START OMIT
	var u uint
	var v = -1
	u = uint(v)
	// STOP OMIT
	_ = u
}
