<?php /* VUE : détail d'un article. Ne contient que de l'affichage. */ ?>
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
