package slicetool

func SliceContains(sl []interface{}, v interface{}) bool {
	for _, vv := range sl {
		if vv == v {
			return true
		}
	}
	return false
}

func SliceContainsInt(sl []int, v int) bool {
	for _, vv := range sl {
		if vv == v {
			return true
		}
	}
	return false
}

func SliceContainsInt64(sl []int64, v int64) bool {
	for _, vv := range sl {
		if vv == v {
			return true
		}
	}
	return false
}

func SliceContainsString(sl []string, v string) bool {
	for _, vv := range sl {
		if vv == v {
			return true
		}
	}
	return false
}

// SliceMerge merges interface slices to one slice.
func SliceMerge(slice1, slice2 []interface{}) (c []interface{}) {
	c = append(slice1, slice2...)
	return
}

func SliceMergeInt(slice1, slice2 []int) (c []int) {
	c = append(slice1, slice2...)
	return
}

func SliceMergeInt64(slice1, slice2 []int64) (c []int64) {
	c = append(slice1, slice2...)
	return
}

func SliceMergeString(slice1, slice2 []string) (c []string) {
	c = append(slice1, slice2...)
	return
}

func SliceUniqueInt64(s []int64) []int64 {
	size := len(s)
	if size == 0 {
		return []int64{}
	}

	m := make(map[int64]bool)
	for i := 0; i < size; i++ {
		m[s[i]] = true
	}

	realLen := len(m)
	ret := make([]int64, realLen)

	idx := 0
	for key := range m {
		ret[idx] = key
		idx++
	}

	return ret
}

func SliceUniqueInt(s []int) []int {
	size := len(s)
	if size == 0 {
		return []int{}
	}

	m := make(map[int]bool)
	for i := 0; i < size; i++ {
		m[s[i]] = true
	}

	realLen := len(m)
	ret := make([]int, realLen)

	idx := 0
	for key := range m {
		ret[idx] = key
		idx++
	}

	return ret
}

func SliceUniqueString(s []string) []string {
	size := len(s)
	if size == 0 {
		return []string{}
	}

	m := make(map[string]bool)
	for i := 0; i < size; i++ {
		m[s[i]] = true
	}

	realLen := len(m)
	ret := make([]string, realLen)

	idx := 0
	for key := range m {
		ret[idx] = key
		idx++
	}

	return ret
}

func SliceSumInt64(intslice []int64) (sum int64) {
	for _, v := range intslice {
		sum += v
	}
	return
}

func SliceSumInt(intslice []int) (sum int) {
	for _, v := range intslice {
		sum += v
	}
	return
}

func SliceSumFloat64(intslice []float64) (sum float64) {
	for _, v := range intslice {
		sum += v
	}
	return
}
