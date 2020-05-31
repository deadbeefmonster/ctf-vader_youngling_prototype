#!/bin/sh
export EXTERNAL_IP=10.42.42.1
docker-compose rm &&  docker-compose pull &&  docker-compose build --no-cache &&  docker-compose up -d --force-recreate

