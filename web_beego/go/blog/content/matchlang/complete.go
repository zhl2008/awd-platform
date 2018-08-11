// +build OMIT

package main

import (
	"fmt"

	"golang.org/x/text/language"
	"golang.org/x/text/language/display"
)

var userPrefs = []language.Tag{
	language.Make("gsw"), // Swiss German
	language.Make("fr"),  // French
}

var serverLangs = []language.Tag{
	language.AmericanEnglish, // en-US fallback
	language.German,          // de
}

var matcher = language.NewMatcher(serverLangs)

func main() {
	tag, index, confidence := matcher.Match(userPrefs...)

	fmt.Printf("best match: %s (%s) index=%d confidence=%v\n",
		display.English.Tags().Name(tag),
		display.Self.Name(tag),
		index, confidence)
	// best match: German (Deutsch) index=1 confidence=High
}
