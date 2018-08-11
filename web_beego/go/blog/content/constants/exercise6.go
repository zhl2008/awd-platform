// +build OMIT

package main

import "fmt"

func main() {
	// START OMIT
	const MaxUint = ^uint(0)
	fmt.Printf("%x\n", MaxUint)
	// STOP OMIT
}
