<?php
/**
 * VERSION 2 - Architecture MVC.
 * FRONT CONTROLLER : point d'entrée unique de l'application.
 * Toutes les requêtes passent par ici ; il choisit le contrôleur
 * et l'action à exécuter selon le paramètre ?action=...
 *
 * Routes :
 *   index.php                          → liste des articles
 *   index.php?action=liste&categorie=2 → liste filtrée
 *   index.php?action=detail&id=5       → détail d'un article
 */
require_once __DIR__ . '/controllers/ArticleController.php';

$controller = new ArticleController();

$action = $_GET['action'] ?? 'liste';

switch ($action) {
    case 'detail':
        $controller->detail();
        break;
    case 'liste':
    default:
        $controller->liste();
        break;
}
