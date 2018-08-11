package filetool

import (
	"strconv"
)

func FileToUint64(file string) (uint64, error) {
	content, err := ReadFileToStringNoLn(file)
	if err != nil {
		return 0, err
	}

	var ret uint64
	if ret, err = strconv.ParseUint(content, 10, 64); err != nil {
		return 0, err
	}
	return ret, nil
}

func FileToInt64(file string) (int64, error) {
	content, err := ReadFileToStringNoLn(file)
	if err != nil {
		return 0, err
	}

	var ret int64
	if ret, err = strconv.ParseInt(content, 10, 64); err != nil {
		return 0, err
	}
	return ret, nil
}
