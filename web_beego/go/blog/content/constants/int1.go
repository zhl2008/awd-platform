// +build OMIT

package main

import "fmt"

func main() {
	// START OMIT
	type MyInt int
	const Three = 3
	const TypedThree int = 3
	var mi MyInt
	mi = 3          // OK
	mi = Three      // OK
	mi = TypedThree // Bad
	fmt.Println(mi)
	// STOP OMIT
}
