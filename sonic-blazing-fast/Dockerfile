FROM ubuntu:18.04

LABEL maintainer="CHERIEF Yassine <fy_cherief@esi.dz>"

RUN apt update && \
    apt install -y \
    apache2 \
    php \
    libapache2-mod-php

ENTRYPOINT service apache2 start && /bin/bash
