FROM raspbian/stretch
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get -y upgrade && apt-get install -y haproxy rsyslog
RUN mkdir /run/haproxy
COPY controller.pem /etc/haproxy/controller.pem
COPY haproxy.cfg /etc/haproxy/haproxy.cfg
CMD service rsyslog start && haproxy -f /etc/haproxy/haproxy.cfg && tail -F /var/log/haproxy.log
EXPOSE 443
EXPOSE 1936
