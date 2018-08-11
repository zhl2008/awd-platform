package formatter

import (
	"fmt"
)

func DisplaySize(raw float64) string {
	if raw < 1024 {
		return fmt.Sprintf("%.1fB", raw)
	}

	if raw < 1024*1024 {
		return fmt.Sprintf("%.1fK", raw/1024.0)
	}

	if raw < 1024*1024*1024 {
		return fmt.Sprintf("%.1fM", raw/1024.0/1024.0)
	}

	if raw < 1024*1024*1024*1024 {
		return fmt.Sprintf("%.1fG", raw/1024.0/1024.0/1024.0)
	}

	if raw < 1024*1024*1024*1024*1024 {
		return fmt.Sprintf("%.1fT", raw/1024.0/1024.0/1024.0/1024.0)
	}

	if raw < 1024*1024*1024*1024*1024*1024 {
		return fmt.Sprintf("%.1fP", raw/1024.0/1024.0/1024.0/1024.0/1024.0)
	}

	return "TooLarge"
}
