// +build OMIT

package main

func main() {
	// START OMIT
	const MaxUint uint = ^0 // Error: overflow
	// STOP OMIT
}
