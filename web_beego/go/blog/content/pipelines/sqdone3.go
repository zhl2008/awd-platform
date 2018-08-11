// +build OMIT

package main

import (
	"fmt"
	"sync"
)

// gen sends the values in nums on the returned channel, then closes it.
func gen(done <-chan struct{}, nums ...int) <-chan int {
	out := make(chan int, len(nums))
	for _, n := range nums {
		// We ignore done here because these sends cannot block.
		out <- n
	}
	close(out)
	return out
}

// sq receives values from in, squares them, and sends them on the returned
// channel, until in or done is closed.  Then sq closes the returned channel.
func sq(done <-chan struct{}, in <-chan int) <-chan int {
	out := make(chan int)
	go func() {
		defer close(out) // HL
		for n := range in {
			select {
			case out <- n * n:
			case <-done:
				return // HL
			}
		}
	}()
	return out
}

// merge receives values from each input channel and sends them on the returned
// channel.  merge closes the returned channel after all the input values have
// been sent or after done is closed.
func merge(done <-chan struct{}, cs ...<-chan int) <-chan int {
	var wg sync.WaitGroup
	out := make(chan int)

	// Start an output goroutine for each input channel in cs.  output
	// copies values from c to out until c or done is closed, then calls
	// wg.Done.
	output := func(c <-chan int) {
		defer wg.Done() // HL
		for n := range c {
			select {
			case out <- n:
			case <-done:
				return // HL
			}
		}
	}
	// ... the rest is unchanged ...

	wg.Add(len(cs))
	for _, c := range cs {
		go output(c)
	}

	// Start a goroutine to close out once all the output goroutines are
	// done.  This must start after the wg.Add call.
	go func() {
		wg.Wait()
		close(out)
	}()
	return out
}

func main() {
	// Set up a done channel that's shared by the whole pipeline,
	// and close that channel when this pipeline exits, as a signal
	// for all the goroutines we started to exit.
	done := make(chan struct{}) // HL
	defer close(done)           // HL

	in := gen(done, 2, 3)

	// Distribute the sq work across two goroutines that both read from in.
	c1 := sq(done, in)
	c2 := sq(done, in)

	// Consume the first value from output.
	out := merge(done, c1, c2)
	fmt.Println(<-out) // 4 or 9

	// done will be closed by the deferred call. // HL
}
