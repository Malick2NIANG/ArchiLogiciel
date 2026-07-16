<?php
/**
 * CONTRÔLEUR : fait le lien entre les modèles et les vues.
 * Il reçoit la requête, interroge les modèles, puis charge la vue.
 * Il ne contient ni SQL, ni HTML.
 */
require_once __DIR__ . '/../models/ArticleModel.php';
require_once __DIR__ . '/../models/CategorieModel.php';

class ArticleController
{
    private ArticleModel $articleModel;
    private CategorieModel $categorieModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->categorieModel = new CategorieModel();
    }

    /** Page d'accueil : liste des articles (filtrable par catégorie). */
    public function liste(): void
    {
        $categorieId = isset($_GET['categorie']) ? (int) $_GET['categorie'] : 0;

        $categories = $this->categorieModel->getToutes();
        $articles = $categorieId > 0
            ? $this->articleModel->getParCategorie($categorieId)
            : $this->articleModel->getTous();

        $titre = 'MGLSI News - Actualités en temps réel';
        $vue = 'liste';
        require __DIR__ . '/../views/layout.php';
    }

    /** Page de détail d'un article. */
    public function detail(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $article = $this->articleModel->getParId($id);

        if (!$article) {
            http_response_code(404);
        }

        $titre = ($article ? $article['titre'] : 'Article introuvable') . ' - MGLSI News';
        $vue = 'detail';
        require __DIR__ . '/../views/layout.php';
    }
}
