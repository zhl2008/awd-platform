// +build OMIT

package main

import "fmt"

func main() {
	// START OMIT
	type MyFloat64 float64
	const Zero = 0.0
	const TypedZero float64 = 0.0
	var mf MyFloat64
	mf = 0.0       // OK
	mf = Zero      // OK
	mf = TypedZero // Bad
	fmt.Println(mf)
	// STOP OMIT
}
