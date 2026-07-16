# MglsiNews

Site d'actualité en temps réel — PHP / HTML / CSS / MySQL.
Projet Architecture Logicielle (MGLSI).

## Branches

- `version-simple` : architecture classique (SQL + HTML dans chaque page)
- `version-mvc` : architecture MVC (models / views / controllers + front controller)

## Principe « temps réel »

Les deux versions lisent la base de données `mglsi_news` à chaque chargement de page, sans cache.
Toute donnée insérée dans la base apparaît donc sur le site dès qu'on réactualise.

## Installation

1. Copier le dossier dans `htdocs` (XAMPP) ou `www` (WAMP).
2. Importer `mglsi_news.sql` dans phpMyAdmin.
3. Ouvrir http://localhost/MglsiNews/

## Sécurité

- Requêtes préparées PDO (anti-injection SQL)
- `htmlspecialchars` sur toutes les sorties (anti-XSS)
