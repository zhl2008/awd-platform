// +build OMIT

// Copyright 2013 The Go Authors. All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

package main

import (
	"fmt"
)

func main() {
	slice := make([]int, 10, 15)
	fmt.Printf("len: %d, cap: %d\n", len(slice), cap(slice))
	newSlice := make([]int, len(slice), 2*cap(slice))
	copy(newSlice, slice)
	slice = newSlice
	fmt.Printf("len: %d, cap: %d\n", len(slice), cap(slice))
}
