<?php
/**
 * MODÈLE : accès aux données de la table Article.
 * Le modèle ne contient AUCUN code HTML : uniquement la logique de données.
 */
require_once __DIR__ . '/../config.php';

class ArticleModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = getConnexion();
    }

    /** Tous les articles, du plus récent au plus ancien. */
    public function getTous(): array
    {
        return $this->pdo->query(
            'SELECT a.*, c.libelle AS categorieLibelle
             FROM Article a
             JOIN Categorie c ON a.categorie = c.id
             ORDER BY a.dateCreation DESC'
        )->fetchAll();
    }

    /** Les articles d'une catégorie donnée. */
    public function getParCategorie(int $categorieId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT a.*, c.libelle AS categorieLibelle
             FROM Article a
             JOIN Categorie c ON a.categorie = c.id
             WHERE a.categorie = :cat
             ORDER BY a.dateCreation DESC'
        );
        $stmt->execute(['cat' => $categorieId]);
        return $stmt->fetchAll();
    }

    /** Un article par son id, ou null s'il n'existe pas. */
    public function getParId(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT a.*, c.libelle AS categorieLibelle
             FROM Article a
             JOIN Categorie c ON a.categorie = c.id
             WHERE a.id = :id'
        );
        $stmt->execute(['id' => $id]);
        $article = $stmt->fetch();
        return $article ?: null;
    }
}
