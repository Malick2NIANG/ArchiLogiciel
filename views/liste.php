<?php /* VUE : liste des articles. Ne contient que de l'affichage. */ ?>
<?php if (empty($articles)): ?>
    <p class="vide">Aucun article dans cette catégorie pour le moment.</p>
<?php else: ?>
    <?php foreach ($articles as $article): ?>
        <article class="carte">
            <span class="badge"><?= htmlspecialchars($article['categorieLibelle']) ?></span>
            <h2>
                <a href="index.php?action=detail&amp;id=<?= $article['id'] ?>">
                    <?= htmlspecialchars($article['titre']) ?>
                </a>
            </h2>
            <p class="date">
                Publié le <?= date('d/m/Y à H:i', strtotime($article['dateCreation'])) ?>
            </p>
            <p class="extrait">
                <?= htmlspecialchars(mb_substr($article['contenu'], 0, 200)) ?>...
            </p>
            <a class="lire-plus" href="index.php?action=detail&amp;id=<?= $article['id'] ?>">Lire la suite →</a>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
