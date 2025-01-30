<?php

namespace App;

use PDO;

class Chat
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function sendMessage(string $message): void
    {
        $message = trim($message);
        if ($message == '') {
            return;
        }

        $sql = "INSERT INTO messages (message) VALUES (?)";
        $res = $this->db->prepare($sql);
        $res->execute([$message]);
    }

    public function getMessages(): array
    {
        $sql = "SELECT * FROM messages ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }
}