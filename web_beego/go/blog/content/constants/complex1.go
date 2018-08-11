// +build OMIT

package main

import "fmt"

func main() {
	// START OMIT
	type MyComplex128 complex128
	const I = (0.0 + 1.0i)
	const TypedI complex128 = (0.0 + 1.0i)
	var mc MyComplex128
	mc = (0.0 + 1.0i) // OK
	mc = I            // OK
	mc = TypedI       // Bad
	fmt.Println(mc)
	// STOP OMIT
}
