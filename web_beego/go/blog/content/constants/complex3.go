// +build OMIT

package main

import "fmt"

func main() {
	const Two = 2.0 + 0i
	// START OMIT
	var f float64
	var g float64 = Two
	f = Two
	fmt.Println(f, "and", g)
	// STOP OMIT
}
