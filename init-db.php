<?php

$pdo = new PDO('sqlite:my_db.db');

$sql = 'CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    message TEXT NOT NULL,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);
';

$pdo->query($sql);
echo "Database initialized.\n";