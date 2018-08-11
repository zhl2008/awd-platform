// +build OMIT

package main

func main() {
	// START OMIT
	var u uint
	const v = -1
	u = uint(v) // Error: negative value
	// STOP OMIT
	_ = u
}
