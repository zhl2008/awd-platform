// +build OMIT

package main

import "fmt"

const typedHello string = "Hello, 世界"

func main() {
	// START OMIT
	var s string
	s = typedHello
	fmt.Println(s)
	// STOP OMIT
}
