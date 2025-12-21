<?php
require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/DatabaseConnection.php';
require __DIR__ . '/includes/DatabaseFunctions.php';


try {
    // 1) load pets list
    $result = findAll($pdo, 'breed');

    $pets = [];
    foreach ($result as $row) {
        $pets[] = [
            'petID'     => $row['petID'],
            'nickname'  => $row['nickname'],
            'gender'    => $row['gender'],
            'origin'    => $row['origin'],
            'img'       => $row['img'],
            'dateAdded' => $row['dateAdded'],
            'type'      => $row['type'],
            'category'  => $row['category'],
            'provider'  => $row['provider'],
        ];
    }

    $hideAbout = true; // hide about section on this page

    // 2) cart info (used by cart.html.php include)
    $cart = $_SESSION['cart'] ?? [];
    $cartIds = array_keys($cart);

    $petsInCart = [];
    $totalQty = array_sum($cart);

    if (!empty($cartIds)) {
        $placeholders = implode(',', array_fill(0, count($cartIds), '?'));

        $sql = "
            SELECT petID, nickname, gender, type
            FROM pets
            WHERE petID IN ($placeholders)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($cartIds);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $r) {
            $id = (int)$r['petID'];
            $r['quantity'] = $cart[$id] ?? 1;
            $petsInCart[] = $r;
        }
    }

    $title = 'New Friends';

    ob_start();
    include __DIR__ . '/templates/petlist.html.php';
    include __DIR__ . '/templates/cart.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include __DIR__ . '/templates/homepage.html.php';