FROM ubuntu:18.04

LABEL maintainer="CHERIEF Yassine <fy_cherief@esi.dz>"
ENV TZ=Africa/Algiers

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && apt update && DEBIAN_FRONTEND=noninteractive apt install -y apache2 \
    php \
    libapache2-mod-php \
    iputils-ping


ENTRYPOINT service apache2 start && /bin/bash
