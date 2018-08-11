// +build OMIT

package main

func main() {
	// START OMIT
	var i8 int8 = 128 // Error: too large.
	// STOP OMIT
	_ = i8
}
