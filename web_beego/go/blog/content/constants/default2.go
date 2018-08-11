// +build OMIT

package main

import "fmt"

const hello = "Hello, 世界"

func main() {
	// START OMIT
	fmt.Printf("%T: %v\n", "Hello, 世界", "Hello, 世界")
	fmt.Printf("%T: %v\n", hello, hello)
	// STOP OMIT
}
