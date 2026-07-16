<?php
/**
 * VERSION 1 - Architecture classique ("tout-en-un") :
 * chaque page contient à la fois l'accès aux données (SQL)
 * et l'affichage (HTML).
 */
require_once 'config.php';

$pdo = getConnexion();

// Catégories pour le menu de filtrage
$categories = $pdo->query('SELECT * FROM Categorie ORDER BY libelle')->fetchAll();

// Filtre par catégorie (optionnel)
$categorieId = isset($_GET['categorie']) ? (int) $_GET['categorie'] : 0;

// Les articles sont lus dans la base à CHAQUE chargement de la page :
// tout nouvel article apparaît donc dès qu'on réactualise.
if ($categorieId > 0) {
    $stmt = $pdo->prepare(
        'SELECT a.*, c.libelle AS categorieLibelle
         FROM Article a
         JOIN Categorie c ON a.categorie = c.id
         WHERE a.categorie = :cat
         ORDER BY a.dateCreation DESC'
    );
    $stmt->execute(['cat' => $categorieId]);
} else {
    $stmt = $pdo->query(
        'SELECT a.*, c.libelle AS categorieLibelle
         FROM Article a
         JOIN Categorie c ON a.categorie = c.id
         ORDER BY a.dateCreation DESC'
    );
}
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGLSI News - Actualités en temps réel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1><a href="index.php">MGLSI News</a></h1>
        <p class="slogan">Suivez à l'instant l'actualité sénégalaise</p>
        <nav>
            <a href="index.php" class="<?= $categorieId === 0 ? 'actif' : '' ?>">Toutes</a>
            <?php foreach ($categories as $cat): ?>
                <a href="index.php?categorie=<?= $cat['id'] ?>"
                   class="<?= $categorieId === (int) $cat['id'] ? 'actif' : '' ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </header>

    <main>
        <?php if (empty($articles)): ?>
            <p class="vide">Aucun article dans cette catégorie pour le moment.</p>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
                <article class="carte">
                    <span class="badge"><?= htmlspecialchars($article['categorieLibelle']) ?></span>
                    <h2>
                        <a href="article.php?id=<?= $article['id'] ?>">
                            <?= htmlspecialchars($article['titre']) ?>
                        </a>
                    </h2>
                    <p class="date">
                        Publié le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?>
                    </p>
                    <p class="extrait">
                        <?= htmlspecialchars(mb_substr($article['contenu'], 0, 200)) ?>...
                    </p>
                    <a class="lire-plus" href="article.php?id=<?= $article['id'] ?>">Lire la suite →</a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> MGLSI News</p>
    </footer>
</body>
</html>
