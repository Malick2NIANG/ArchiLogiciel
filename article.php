<?php
/**
 * VERSION 1 - Architecture classique :
 * la page de détail contient aussi son SQL et son HTML.
 */
require_once 'config.php';

$pdo = getConnexion();

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare(
    'SELECT a.*, c.libelle AS categorieLibelle
     FROM Article a
     JOIN Categorie c ON a.categorie = c.id
     WHERE a.id = :id'
);
$stmt->execute(['id' => $id]);
$article = $stmt->fetch();

if (!$article) {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article ? htmlspecialchars($article['titre']) : 'Article introuvable' ?> - MGLSI News</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1><a href="index.php">MGLSI News</a></h1>
        <p class="slogan">Suivez à l'instant l'actualité sénégalaise</p>
    </header>

    <main>
        <?php if (!$article): ?>
            <p class="vide">Article introuvable. <a href="index.php">Retour à l'accueil</a></p>
        <?php else: ?>
            <article class="detail">
                <span class="badge"><?= htmlspecialchars($article['categorieLibelle']) ?></span>
                <h2><?= htmlspecialchars($article['titre']) ?></h2>
                <p class="date">
                    Publié le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?>
                    <?php if ($article['dateModification'] !== $article['dateCreation']): ?>
                        — Modifié le <?= date('d/m/Y à H:i', strtotime($article['dateModification'])) ?>
                    <?php endif; ?>
                </p>
                <div class="contenu">
                    <?= nl2br(htmlspecialchars($article['contenu'])) ?>
                </div>
                <a class="retour" href="index.php">← Retour aux actualités</a>
            </article>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> MGLSI News</p>
    </footer>
</body>
</html>
