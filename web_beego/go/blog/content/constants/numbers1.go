// +build OMIT

package main

import "fmt"

func main() {
	// START OMIT
	var f float32 = 1
	var i int = 1.000
	var u uint32 = 1e3 - 99.0*10.0 - 9
	var c float64 = '\x01'
	var p uintptr = '\u0001'
	var r complex64 = 'b' - 'a'
	var b byte = 1.0 + 3i - 3.0i

	fmt.Println(f, i, u, c, p, r, b)
	// STOP OMIT
}
