FROM nginx:alpine

RUN rm /etc/nginx/conf.d/default.conf

COPY ./docker/nginx/sites-available/penn-entertainment.conf /etc/nginx/sites-available/penn-entertainment.conf

RUN mkdir -p /etc/nginx/sites-enabled

RUN ln -s /etc/nginx/sites-available/penn-entertainment.conf /etc/nginx/sites-enabled/

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
