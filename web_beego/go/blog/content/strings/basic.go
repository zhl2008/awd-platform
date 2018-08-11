// +build OMIT

// Copyright 2013 The Go Authors. All rights reserved.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

package main

import "fmt"

func main() {
	// const string OMIT
	const sample = "\xbd\xb2\x3d\xbc\x20\xe2\x8c\x98"
	// const string OMIT

	fmt.Println("Println:")
	// println OMIT
	fmt.Println(sample)
	// println OMIT

	fmt.Println("Byte loop:")
	// byte loop OMIT
	for i := 0; i < len(sample); i++ {
		fmt.Printf("%x ", sample[i])
	}
	// byte loop OMIT
	fmt.Printf("\n")

	fmt.Println("Printf with %x:")
	// percent x OMIT
	fmt.Printf("%x\n", sample)
	// percent x OMIT

	fmt.Println("Printf with % x:")
	// percent space x OMIT
	fmt.Printf("% x\n", sample)
	// percent space x OMIT

	fmt.Println("Printf with %q:")
	// percent q OMIT
	fmt.Printf("%q\n", sample)
	// percent q OMIT

	fmt.Println("Printf with %+q:")
	// percent plus q OMIT
	fmt.Printf("%+q\n", sample)
	// percent plus q OMIT
}
