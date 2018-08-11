package rpctool

import (
	"net"
	"net/rpc"
	"net/rpc/jsonrpc"
	"time"
)

func DialTimeout(network, address string, timeout time.Duration) (*rpc.Client, error) {
	conn, err := net.DialTimeout(network, address, timeout)
	if err != nil {
		return nil, err
	}
	return jsonrpc.NewClient(conn), err
}
