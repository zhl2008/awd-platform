// +build OMIT

package main

import "fmt"

type MyString string

const myStringHello MyString = "Hello, 世界"

func main() {
	// START OMIT
	fmt.Printf("%T: %v\n", myStringHello, myStringHello)
	// STOP OMIT
}
