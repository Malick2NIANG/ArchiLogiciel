<?php
// Ancienne URL conservée pour compatibilité : redirige vers le front controller.
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
header('Location: index.php?action=detail&id=' . $id, true, 301);
exit;
