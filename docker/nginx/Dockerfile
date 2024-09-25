# Use the official Nginx image as a base
FROM nginx:alpine

# Remove the default configuration
RUN rm /etc/nginx/conf.d/default.conf

# Copy your custom Nginx configuration to the sites-available directory
COPY ./docker/nginx/sites-available/penn-entertainment.conf /etc/nginx/sites-available/penn-entertainment.conf

# Ensure the sites-enabled directory exists
RUN mkdir -p /etc/nginx/sites-enabled

# Create a symbolic link from sites-available to sites-enabled
RUN ln -s /etc/nginx/sites-available/penn-entertainment.conf /etc/nginx/sites-enabled/

# Expose port 80
EXPOSE 80

# Start Nginx in the foreground
CMD ["nginx", "-g", "daemon off;"]
