// +build OMIT

package main

func main() {
	// START OMIT
	type Char byte
	var c Char = '世' // Error: '世' has value 0x4e16, too large.
	// STOP OMIT
	_ = c
}
