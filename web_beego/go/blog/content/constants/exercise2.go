// +build OMIT

package main

func main() {
	// START OMIT
	const MaxUint uint = uint(-1) // Error: negative value
	// STOP OMIT
}
