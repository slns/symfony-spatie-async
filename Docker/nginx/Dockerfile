FROM nginx:latest

# Copiar o arquivo de configuração do Nginx
COPY Docker/nginx/nginx.conf /etc/nginx/conf.d/

# Copiar os arquivos do projeto para o Nginx
COPY ./project/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html/
WORKDIR /var/www/html/
