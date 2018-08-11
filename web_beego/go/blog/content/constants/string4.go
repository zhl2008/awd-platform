// +build OMIT

package main

import "fmt"

const typedHello string = "Hello, 世界"

func main() {
	type MyString string
	var m MyString
	// START OMIT
	m = MyString(typedHello)
	fmt.Println(m)
	// STOP OMIT
}
