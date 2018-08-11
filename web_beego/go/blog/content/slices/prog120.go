// +build OMIT

// Copyright 2013 The Go Authors. All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

package main

import (
	"fmt"
)

// Extend extends the slice by adding the element to the end.
func Extend(slice []int, element int) []int {
	n := len(slice)
	if n == cap(slice) {
		// Slice is full; must grow.
		// We double its size and add 1, so if the size is zero we still grow.
		newSlice := make([]int, len(slice), 2*len(slice)+1)
		copy(newSlice, slice)
		slice = newSlice
	}
	slice = slice[0 : n+1]
	slice[n] = element
	return slice
}

// Append appends the items to the slice.
// First version: just loop calling Extend.
func Append(slice []int, items ...int) []int {
	for _, item := range items {
		slice = Extend(slice, item)
	}
	return slice
}

func main() {
	// START1 OMIT
	slice := []int{0, 1, 2, 3, 4}
	fmt.Println(slice)
	slice = Append(slice, 5, 6, 7, 8)
	fmt.Println(slice)
	// END1 OMIT
}
