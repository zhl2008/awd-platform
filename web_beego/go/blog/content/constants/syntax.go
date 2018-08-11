// +build OMIT

package main

import "fmt"

func main() {
	// START OMIT
	fmt.Printf("%T %v\n", 0, 0)
	fmt.Printf("%T %v\n", 0.0, 0.0)
	fmt.Printf("%T %v\n", 'x', 'x')
	fmt.Printf("%T %v\n", 0i, 0i)
	// STOP OMIT
}
