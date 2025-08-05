# Base image
FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive

# Update and install Apache + PHP
RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php gcc coreutils && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Create vulnerable SUID binary
RUN echo '#include <stdio.h>\n#include <stdlib.h>\nint main(){setuid(0); system("/bin/bash"); return 0;}' > /tmp/suidsh.c && \
    gcc /tmp/suidsh.c -o /usr/local/bin/suidsh && \
    chmod 4755 /usr/local/bin/suidsh && \
    rm /tmp/suidsh.c && \
    apt-get purge -y gcc && apt-get autoremove -y
RUN chmod u+s /usr/bin/find
# Copy fake web files
RUN rm  /var/www/html/*
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/
# Copy entrypoint script
COPY entrypoint.sh entrypoint.sh
RUN chmod +x entrypoint.sh
RUN mv entrypoint.sh /root/entrypoint.sh
# Expose HTTP
EXPOSE 80

# Run entrypoint (will create flag each time)
ENTRYPOINT ["/root/entrypoint.sh"]
