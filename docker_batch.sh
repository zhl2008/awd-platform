#!/bin/sh

docker exec -ti root_flag_server_1 $@
docker exec -ti root_check_server_1 $@
docker exec -ti root_web1_1 $@
docker exec -ti root_web2_1 $@
docker exec -ti root_web3_1 $@
docker exec -ti root_web4_1 $@
