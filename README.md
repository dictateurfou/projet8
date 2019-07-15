# installation
1) configure you bdd in app/config/parameter.yml
edit with you bdd info
this file is auto-generated during the composer install
parameters:
    database_host: 127.0.0.1
    database_port: null
    database_name: projet8
    database_user: root
    database_password: null
    mailer_transport: smtp
    mailer_host: 127.0.0.1
    mailer_user: null
    mailer_password: null
    secret: ThisTokenIsNotSoSecretChangeIt
#test database
    test_database_driver: pdo_mysql
    test_database_host: localhost
    test_database_port: null
    test_database_name: testp8
    test_database_user: root
    test_database_password: null

2) open you console in root folder.
3) type : composer install
4) type : php bin/console doctrine:schema:update --force
