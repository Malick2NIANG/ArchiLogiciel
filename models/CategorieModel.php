<?php
/**
 * MODÈLE : accès aux données de la table Categorie.
 */
require_once __DIR__ . '/../config.php';

class CategorieModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = getConnexion();
    }

    /** Toutes les catégories, triées par libellé. */
    public function getToutes(): array
    {
        return $this->pdo->query('SELECT * FROM Categorie ORDER BY libelle')->fetchAll();
    }
}
