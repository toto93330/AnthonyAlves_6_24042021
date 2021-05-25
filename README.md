[![Codacy Badge](https://app.codacy.com/project/badge/Grade/5dad21e71c4c49ee9a6a4637133f7e0d)](https://www.codacy.com/gh/toto93330/AnthonyAlves_6_24042021/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=toto93330/AnthonyAlves_6_24042021&amp;utm_campaign=Badge_Grade)

[![CodeFactor](https://www.codefactor.io/repository/github/toto93330/anthonyalves_6_24042021/badge)](https://www.codefactor.io/repository/github/toto93330/anthonyalves_6_24042021)

## CONTEXT : 

Jimmy Sweat est un entrepreneur ambitieux passionné de snowboard. Son objectif est la création d'un site collaboratif pour faire connaître ce sport auprès du grand public et aider à l'apprentissage des figures (tricks).

Il souhaite capitaliser sur du contenu apporté par les internautes afin de développer un contenu riche et suscitant l’intérêt des utilisateurs du site. Par la suite, Jimmy souhaite développer un business de mise en relation avec les marques de snowboard grâce au trafic que le contenu aura généré.

Pour ce projet, nous allons nous concentrer sur la création technique du site pour Jimmy.
Votre mission : créer un site communautaire pour apprendre les figures de snowboard

## DESCRIPTION DU BESOIN:

Vous êtes chargé de développer le site répondant aux besoins de Jimmy. Vous devez ainsi implémenter les fonctionnalités suivantes : 

    un annuaire des figures de snowboard. Vous pouvez vous inspirer de la liste des figures sur Wikipédia. Contentez-vous d'intégrer 10 figures, le reste sera saisi par les internautes ;
    la gestion des figures (création, modification, consultation) ;
    un espace de discussion commun à toutes les figures.

Pour implémenter ces fonctionnalités, vous devez créer les pages suivantes :

    la page d’accueil où figurera la liste des figures ; 
    la page de création d'une nouvelle figure ;
    la page de modification d'une figure ;
    la page de présentation d’une figure (contenant l’espace de discussion commun autour d’une figure).

L’ensemble des spécifications détaillées pour les pages à développer est accessible ici : [Spécifications détaillées][PlGh].

## Installation : 

Clonez ou téléchargez le repository GitHub dans le dossier voulu :
```sh
git clone https://github.com/toto93330/AnthonyAlves_6_24042021.git
```
Configurez vos variables d'environnement tel que la connexion à la base de données ou votre serveur SMTP ou adresse mail dans le fichier .env.local qui devra être crée à la racine du projet en réalisant une copie du fichier .env.

Téléchargez et installez les dépendances back-end du projet avec Composer :
```sh
composer install
```
Téléchargez et installez les dépendances front-end du projet avec Npm :
```sh
npm install
```
Créer un build d'assets (grâce à Webpack Encore) avec Npm :
```sh
npm run build
```
Créez la base de données si elle n'existe pas déjà, taper la commande ci-dessous en vous plaçant dans le répertoire du projet :
```sh
php bin/console doctrine:database:create
```
Créez les différentes tables de la base de données en appliquant les migrations :
```sh
php bin/console doctrine:migrations:migrate
```
(Optionnel) Installer les fixtures pour avoir une démo de données fictives :
```sh
php bin/console doctrine:fixtures:load
```
(Optionnel) Si vous utilisez les fixtures voici l'identifiant administrateur :

```sh
contact@snowtricks.com
```
```sh
root
```

Félications le projet est installé correctement, vous pouvez désormais commencer à l'utiliser à votre guise !



[PlGh]: <https://s3-eu-west-1.amazonaws.com/course.oc-static.com/projects/DAPHPSF_P8/DAPHP_P6_spe%CC%81cifications.zip/>
