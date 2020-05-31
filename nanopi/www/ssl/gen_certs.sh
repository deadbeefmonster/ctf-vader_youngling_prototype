#!/bin/bash
openssl req -new -out controller.csr -key controller.key -config controller.cnf
openssl x509 -req -days 1337 -in controller.csr -signkey controller.key -out controller.crt -extensions v3_req -extfile controller.cnf
openssl x509 -text -noout -in controller.crt

