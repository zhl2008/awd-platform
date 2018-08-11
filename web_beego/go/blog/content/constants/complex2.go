// +build OMIT

package main

import "fmt"

func main() {
	const Two = 2.0 + 0i
	// START OMIT
	s := Two
	fmt.Printf("%T: %v\n", s, s)
	// STOP OMIT
}
