ARG APACHE_VERSION=""
FROM httpd:${APACHE_VERSION:+${APACHE_VERSION}-}alpine

RUN apk update; \
    apk upgrade;

COPY studee.apache.conf /usr/local/apache2/conf/studee.apache.conf
RUN echo "Include /usr/local/apache2/conf/studee.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
