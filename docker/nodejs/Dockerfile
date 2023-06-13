FROM node:16-alpine

#
# Installing vue/cli globaly
#
#RUN npm -g i @vue/cli
RUN set -xe \
		&& apk update \
		&& apk upgrade


#
# Configure user
#
ENV DOCKER_USER=www

ENV DOCKER_UID=1000
ENV DOCKER_GID=1000


#
# Add host user and group into container
#
RUN set -xe \
		&& deluser node \
		&& addgroup -g $DOCKER_GID $DOCKER_USER \
		&& adduser -g "web user" -s /bin/sh -D -u $DOCKER_UID -G $DOCKER_USER $DOCKER_USER \
		&& delgroup $DOCKER_USER $DOCKER_USER \
		&& echo "$DOCKER_USER:$DOCKER_USER" | chpasswd

#
# Working directory
#
WORKDIR /www

#
# Acting as service and gracefully shutdown
#
CMD ["node", "-e", "setInterval(() => {}, 60000); process.on('SIGTERM', () => { process.exit(0); });"]
