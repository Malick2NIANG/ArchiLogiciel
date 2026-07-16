<?php /* VUE : gabarit commun (en-tête + pied de page). La variable $vue indique la vue à inclure. */ ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1><a href="index.php">MGLSI News</a></h1>
        <p class="slogan">Suivez à l'instant l'actualité sénégalaise</p>
        <?php if (isset($categories)): ?>
        <nav>
            <a href="index.php" class="<?= ($categorieId ?? 0) === 0 ? 'actif' : '' ?>">Toutes</a>
            <?php foreach ($categories as $cat): ?>
                <a href="index.php?action=liste&amp;categorie=<?= $cat['id'] ?>"
                   class="<?= ($categorieId ?? 0) === (int) $cat['id'] ? 'actif' : '' ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <?php endif; ?>
    </header>

    <main>
        <?php require __DIR__ . '/' . $vue . '.php'; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> MGLSI News</p>
    </footer>
</body>
</html>
