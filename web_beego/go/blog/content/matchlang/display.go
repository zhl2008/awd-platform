// +build OMIT

package main

import (
	"fmt"

	"golang.org/x/text/language"
	"golang.org/x/text/language/display"
)

func main() {
	// START OMIT
	var supported = []language.Tag{
		language.English,            // en
		language.French,             // fr
		language.Dutch,              // nl
		language.Make("nl-BE"),      // nl-BE
		language.SimplifiedChinese,  // zh-Hans
		language.TraditionalChinese, // zh-Hant
		language.Russian,            // ru
	}

	en := display.English.Tags()
	for _, t := range supported {
		fmt.Printf("%-20s (%s)\n", en.Name(t), display.Self.Name(t))
	}
	// END OMIT
}
