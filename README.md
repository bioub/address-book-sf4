AddressBook SF4
========================

Ceci est un projet d'exemple pour les formations Symfony 4 avancées de [formation.tech](http://formation.tech/)

Installation
--------------

Télécharger ce projet via le bouton de téléchargement en haut à droite.

Ou bien en ligne de commande :

    git clone https://github.com/bioub/address-book-sf4.git

Installer les dépendances via composer (répondre aux questions sur le paramétrage) :

    composer install
    
Créer la base de données :

    bin/console doctrine:database:create
    bin/console doctrine:database:import addressbook-mysql-dump.sql

Démarrer le serveur :

    bin/console server:run

Vérifier les prérequis de Symfony :

    bin/symfony_requirements
    
Et sur le web à [http://localhost:8000/config.php](http://localhost:8000/config.php)

Aller ensuite tester l'application sur [http://localhost:8000/](http://localhost:8000/)
