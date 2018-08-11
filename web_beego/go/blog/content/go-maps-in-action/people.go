// Copyright 2013 The Go Authors.  All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

// +build OMIT

package main

import "fmt"

func main() {
	// START1 OMIT
	type Person struct {
		Name  string
		Likes []string
	}
	var people []*Person

	likes := make(map[string][]*Person) // HL
	for _, p := range people {
		for _, l := range p.Likes {
			likes[l] = append(likes[l], p) // HL
		}
	}
	// END1 OMIT

	// START2 OMIT
	for _, p := range likes["cheese"] {
		fmt.Println(p.Name, "likes cheese.")
	}
	// END2 OMIT

	fmt.Println(len(likes["bacon"]), "people like bacon.")
}
