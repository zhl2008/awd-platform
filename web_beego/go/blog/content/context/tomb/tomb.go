// +build OMIT

// Package tomb provides a Context implementation that is canceled when either
// its parent Context is canceled or a provided Tomb is killed.
package tomb

import (
	"golang.org/x/net/context"
	tomb "gopkg.in/tomb.v2"
)

// NewContext returns a Context that is canceled either when parent is canceled
// or when t is Killed.
func NewContext(parent context.Context, t *tomb.Tomb) context.Context {
	ctx, cancel := context.WithCancel(parent)
	go func() {
		select {
		case <-t.Dying():
			cancel()
		case <-ctx.Done():
		}
	}()
	return ctx
}
