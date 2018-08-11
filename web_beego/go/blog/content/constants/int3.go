// +build OMIT

package main

func main() {
	// START OMIT
	var u8 uint8 = -1 // Error: negative value.
	// STOP OMIT
	_ = u8
}
