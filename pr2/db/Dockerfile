FROM mysql:5.7

# Переменные окружения для настройки MySQL
ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_DATABASE=mydb
ENV MYSQL_USER=myuser
ENV MYSQL_PASSWORD=mypassword

# Копирование файла инициализации базы данных
COPY init.sql /docker-entrypoint-initdb.d/