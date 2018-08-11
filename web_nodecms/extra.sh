#!/bin/bash

su -c "export PATH=/app/node/bin:$PATH; node server.js --port=8080" ctf
