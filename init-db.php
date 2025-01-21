<?php

$sql = 'CREATE TABLE messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    message TEXT NOT NULL,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);
';

$pdo = new PDO('sqlite:my_db.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

if (!file_exists('my_db.db')) {
    $pdo->query($sql);
    echo "Database initialized.\n";
} else {
    echo "Database already exists.\n";
}
