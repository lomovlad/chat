<?php

namespace App;

use PDO;

class Chat
{
    private PDO $db;

    public function __construct()
    {
        $this->db = new PDO('sqlite:my_db.db');
    }

    /**
     * Метод отправляет уже подготовленное сообщение
     * @param string $data Данные сообщения
     * @return void
     */
    public function sendMessage(string $data): void
    {
        $message = $this->prepareMessage($data);

        $sql = 'INSERT INTO messages (message) VALUES (?)';
        $res = $this->db->prepare($sql);
        $res->execute([$message]);
    }

    /**
     * Геттер сообщений из бд
     * @return array массив сообщений из бд
     */
    public function getMessages(): array
    {
        $sql = 'SELECT * FROM messages ORDER BY created_at DESC';
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Метод валидирует данные сообщения на пустую строку и готовит их к оптравке
     * @param string $data данные сообщенияк
     * @return string заготовка сообщения для отправки
     */
    private function prepareMessage(string $data): string
    {
        $data = trim($data);

        if ($data === '') {
            return '';
        }

        return htmlspecialchars($data);
    }
}