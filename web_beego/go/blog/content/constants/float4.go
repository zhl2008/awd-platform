// +build OMIT

package main

import "fmt"

func main() {
	const Huge = 1e1000
	// START OMIT
	fmt.Println(Huge / 1e999)
	// STOP OMIT
}
