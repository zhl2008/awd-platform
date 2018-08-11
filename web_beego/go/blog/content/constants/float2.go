// +build OMIT

package main

import "fmt"

func main() {
	const Zero = 0.0
	const TypedZero float64 = 0.0
	// START OMIT
	var f32 float32
	f32 = 0.0
	f32 = Zero      // OK: Zero is untyped
	f32 = TypedZero // Bad: TypedZero is float64 not float32.
	fmt.Println(f32)
	// STOP OMIT
}
