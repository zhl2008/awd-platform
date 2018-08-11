package g

import (
	"github.com/slene/blackfriday"
)

func RenderMarkdown(mdStr string) string {
	htmlFlags := 0
	htmlFlags |= blackfriday.HTML_USE_XHTML
	htmlFlags |= blackfriday.HTML_SKIP_SCRIPT
	htmlFlags |= blackfriday.HTML_GITHUB_BLOCKCODE
	htmlFlags |= blackfriday.HTML_OMIT_CONTENTS
	htmlFlags |= blackfriday.HTML_COMPLETE_PAGE
	renderer := blackfriday.HtmlRenderer(htmlFlags, "", "")

	// set up the parser
	extensions := 0
	extensions |= blackfriday.EXTENSION_NO_INTRA_EMPHASIS
	extensions |= blackfriday.EXTENSION_TABLES
	extensions |= blackfriday.EXTENSION_FENCED_CODE
	extensions |= blackfriday.EXTENSION_AUTOLINK
	extensions |= blackfriday.EXTENSION_STRIKETHROUGH
	extensions |= blackfriday.EXTENSION_HARD_LINE_BREAK
	extensions |= blackfriday.EXTENSION_SPACE_HEADERS
	extensions |= blackfriday.EXTENSION_NO_EMPTY_LINE_BEFORE_BLOCK

	body := blackfriday.Markdown([]byte(mdStr), renderer, extensions)

	return string(body)
}
