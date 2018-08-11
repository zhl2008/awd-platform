// +build OMIT

package main

import "fmt"

const typedHello string = "Hello, 世界"

func main() {
	type MyString string
	var m MyString
	// START OMIT
	const myStringHello MyString = "Hello, 世界"
	m = myStringHello // OK
	fmt.Println(m)
	// STOP OMIT
}
