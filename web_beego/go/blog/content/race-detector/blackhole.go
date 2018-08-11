// +build OMIT

package main

var blackHole [4096]byte // shared buffer

func (devNull) ReadFrom(r io.Reader) (n int64, err error) {
	readSize := 0
	for {
		readSize, err = r.Read(blackHole[:])
		n += int64(readSize)
		if err != nil {
			if err == io.EOF {
				return n, nil
			}
			return
		}
	}
}
