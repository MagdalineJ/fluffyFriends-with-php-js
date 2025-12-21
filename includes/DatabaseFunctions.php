<?php

function findAll(PDO $pdo, string $table): array
{
    // joined “view” of tables 
    $sql = "
        SELECT
            pets.petID AS petID,
            pets.nickname AS nickname,
            pets.gender AS gender,
            pets.origin AS origin,
            pets.img AS img,
            pets.dateAdded AS dateAdded,
            pets.type AS type,

            breed.pet AS category,
            providers.name AS provider
        FROM breed
        JOIN providers
            ON providers.providerID = breed.providerID
        JOIN pets
            ON pets.breedID = breed.breedID
        ORDER BY breed.pet, pets.petID DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getBreeds(PDO $pdo): array {
  $stmt = $pdo->query("SELECT breedID, pet FROM breed ORDER BY breedID");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function breedExists(PDO $pdo, int $breedID): bool {
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM breed WHERE breedID = ?");
  $stmt->execute([$breedID]);
  return (int)$stmt->fetchColumn() === 1;
}

/**
 * Inserts a pet into pets table.
 * Expected keys: nickname, gender, origin, img, dateAdded, breedID, type
 */
function addPet(PDO $pdo, array $data): int {
  $stmt = $pdo->prepare("
    INSERT INTO pets (nickname, gender, origin, img, dateAdded, breedID, type)
    VALUES (?, ?, ?, ?, ?, ?, ?)
  ");
  $stmt->execute([
    $data['nickname'],
    $data['gender'],
    $data['origin'],
    $data['img'],
    $data['dateAdded'],
    (int)$data['breedID'],
    $data['type'],
  ]);

  return (int)$pdo->lastInsertId();
}

function deletePet(PDO $pdo, int $petID): void {
  $stmt = $pdo->prepare("DELETE FROM pets WHERE petID = ?");
  $stmt->execute([$petID]);
}
?>