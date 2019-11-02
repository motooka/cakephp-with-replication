FROM mysql:8.0

# Files in "/docker-entrypoint-initdb.d/" will be asynchronously executed just after executing "docker-compose up -d"
# If a SQL command in these files causes an error, the Docker container exits.

# see "context" setting in docker-compose.yml
COPY 1_db_and_user.sql /docker-entrypoint-initdb.d/
COPY 2_tables.sql /docker-entrypoint-initdb.d/


