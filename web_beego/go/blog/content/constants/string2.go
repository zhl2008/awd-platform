// +build OMIT

package main

import "fmt"

const typedHello string = "Hello, 世界"

func main() {
	// START OMIT
	type MyString string
	var m MyString
	m = typedHello // Type error
	fmt.Println(m)
	// STOP OMIT
}
