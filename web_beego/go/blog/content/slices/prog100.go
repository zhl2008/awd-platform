// +build OMIT

// Copyright 2013 The Go Authors. All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

package main

import (
	"fmt"
)

// Insert inserts the value into the slice at the specified index,
// which must be in range.
// The slice must have room for the new element.
func Insert(slice []int, index, value int) []int {
	// Grow the slice by one element.
	slice = slice[0 : len(slice)+1]
	// Use copy to move the upper part of the slice out of the way and open a hole.
	copy(slice[index+1:], slice[index:])
	// Store the new value.
	slice[index] = value
	// Return the result.
	return slice
}

func main() {
	slice := make([]int, 10, 20) // Note capacity > length: room to add element.
	for i := range slice {
		slice[i] = i
	}
	fmt.Println(slice)
	slice = Insert(slice, 5, 99)
	fmt.Println(slice)
	// OMIT
}
