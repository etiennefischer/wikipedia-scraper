# Symfony Wikipedia Scraper

Ce projet est un outil CLI développé avec Symfony pour scraper des pages Wikipedia en fonction d'un mot clé et générer des classes correspondantes.

## Prérequis

- PHP 7.2 ou supérieur
- [Composer](https://getcomposer.org/)

## Installation

1. Clonez ce dépôt :

git clone https://github.com/etiennefischer/wikipedia-scraper.git

2. Accédez au répertoire du projet :

cd wikipedia-scraper

3. Installez les dépendances à l'aide de Composer :

composer install

## Utilisation

Pour utiliser cet outil, exécutez la commande suivante dans un terminal :

php bin/console wiki-scraper "VotreMotClé"

Remplacez `"VotreMotClé"` par le mot clé pour lequel vous souhaitez extraire les informations de la page Wikipedia. La commande va scraper la page Wikipedia correspondant au mot clé recherché, extraire les titres de section et créer des classes dans le dossier `src/Entity` basées sur ces titres.

### Exemple

Pour rechercher des informations sur "Symfony", exécutez la commande suivante :

php bin/console wiki-scraper "Symfony"
