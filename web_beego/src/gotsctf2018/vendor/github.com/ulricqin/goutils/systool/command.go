package systool

import (
	"bytes"
	log "github.com/ulricqin/goutils/logtool"
	"github.com/ulricqin/goutils/strtool"
	"os/exec"
	"time"
)

func CmdOut(name string, arg ...string) (string, error) {
	cmd := exec.Command(name, arg...)
	var out bytes.Buffer
	cmd.Stdout = &out
	err := cmd.Run()
	return out.String(), err
}

func CmdOutBytes(name string, arg ...string) ([]byte, error) {
	cmd := exec.Command(name, arg...)
	var out bytes.Buffer
	cmd.Stdout = &out
	err := cmd.Run()
	return out.Bytes(), err
}

func CmdOutNoLn(name string, arg ...string) (out string, err error) {
	out, err = CmdOut(name, arg...)
	if err != nil {
		return
	}

	return strtool.TrimRightSpace(string(out)), nil
}

func CmdRunWithTimeout(cmd *exec.Cmd, timeout time.Duration) (error, bool) {
	done := make(chan error)
	go func() {
		done <- cmd.Wait()
	}()

	var err error
	select {
	case <-time.After(timeout):
		//timeout
		if err = cmd.Process.Kill(); err != nil {
			log.Error("failed to kill: %s, error: %s", cmd.Path, err)
		}
		go func() {
			<-done // allow goroutine to exit
		}()
		log.Info("process:%s killed", cmd.Path)
		return err, true
	case err = <-done:
		return err, false
	}
}
