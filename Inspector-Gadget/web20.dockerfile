FROM nginx:1.17-alpine

LABEL maintainer="CHERIEF Yassine <fy_cherief@esi.dz>"

COPY source/ /usr/share/nginx/html