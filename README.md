Instrukcja instalacji
========================

[1] Pobieramy na dysk

    git clone https://github.com/gustawdaniel/mario.git 

[2] Przechodzimy do katalogu

    cd mario

[3] Instalujemy composer

    sudo apt-get install composer

lub jeśli się nie uda
```
php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
php -r "if (hash('SHA384', file_get_contents('composer-setup.php')) === 'fd26ce67e3b237fffd5e5544b45b0d92c41a4afe3e3f778e942e43ce6be197b9cdc7c251dcde6e2a52297ea269370680') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

[4] Instalujemy pakiet do odbsługi mysql w php5, klienta mysql oraz serwer mysql
```
apt-get install php5-mysql
sudo apt-get install mysql-client
sudo apt-get install mysql-server
```
Potwierdzamy trzy razy za pomocą enter (nic nie wpisując - na komputerze domowym, nigdy nie robimy tak na serwerze!)

[5] Pobieramy biblioteki zewnętrzne

    composer install

Na koniec potwierdzamy za każdym razem wciskając enter

[6] Tworzymy bazę danych

     php bin/console doctrine:database:create
     
[7] Tworzymy tabele w bazie

    php bin/console doctrine:schema:update --force
    
[8] Wypełniamy bazę danych przykładowymi danymi

    php bin/console doctrine:fixtures:load
    
[9] Tworzymy dowiązania symboliczne źródeł do katalogu ze stroną

    php bin/console assets:install --symlink web
    
Nie zadziała przy niektórych sposobach organizacji danych na dyskach, które nie wspierają takich dowiązań, prawdopodobnie fat

[10] Zrzucamy skrypty i style do katalogu web za pomocą assetic

     php bin/console assetic:dump

[11] Nigdy nie zaszkodzi wyczyścić cache

    php bin/console cache:clear
    
[12] Tworzymy urzytkownika strony

    php bin/console fos:user:create admin

Podajemy adres email na który przychodziły by resety hasła
Oraz hasło

[13] Nadajemy urzytkownikowi prawa admina

    php bin/console fos:user:promote admin

wpisujemy: ```ROLE_ADMIN```   
[14] Włączamy serwer

    php bin/console server:run
    
[15] Po zalogowaniu możemy czytać dokumentację

    

Instrukcja obsługi
===================

Strona jest dostępna pod adresem

http://127.0.0.1:8000

panel admina pod adresem

http://127.0.0.1:8000/admin

Login: admin
Hasło: <wybrane w punkcie 12>

Dokumentacja dostępna dla admina pod adresem


http://127.0.0.1:8000/admin/doc
