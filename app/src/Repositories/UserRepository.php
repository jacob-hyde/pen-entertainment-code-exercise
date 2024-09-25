<?php

namespace App\Repositories;

class UserRepository extends BaseRepository
{
    /**
     * Get user by id
     *
     * @param int $id
     * @return array
     */
    public function get(int $id): array
    {
        $pdo = $this->databaseService->connect();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Get all users
     *
     * @return array
     */
    public function getAll(): array
    {
        $pdo = $this->databaseService->connect();
        $stmt = $pdo->query('SELECT * FROM users');
        return $stmt->fetchAll();
    }

    /**
     * Create new user
     *
     * @param array $userData
     * @return array
     */
    public function create(array $userData): array
    {
        $pdo = $this->databaseService->connect();
        $stmt = $pdo->prepare('INSERT INTO users (name, email, points_balance) VALUES (:name, :email, 0)');
        $stmt->execute($userData);
        return $this->get($pdo->lastInsertId());
    }

    /**
     * Add points to user
     *
     * @param int $id
     * @param array $userData
     * @return array
     */
    public function earn(int $id, array $userData): array
    {
        $pdo = $this->databaseService->connect();
        $user = $this->get($id);
        $userData['points_balance'] = $user['points_balance'] + $userData['points'];
        $stmt = $pdo->prepare('UPDATE users SET points_balance = :points_balance WHERE id = :id');
        $stmt->execute([':points_balance' => $userData['points_balance'], ':id' => $id]);
        return $this->get($id);
    }

    /**
     * Use points from user
     *
     * @param int $id
     * @param array $userData
     * @return array
     */
    public function redeem(int $id, array $userData): array
    {
        $pdo = $this->databaseService->connect();
        $user = $this->get($id);
        $userData['points_balance'] = $user['points_balance'] - $userData['points'];
        $stmt = $pdo->prepare('UPDATE users SET points_balance = :points_balance WHERE id = :id');
        $stmt->execute([':points_balance' => $userData['points_balance'], ':id' => $id]);
        return $this->get($id);
    }

    /**
     * Delete user by id
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $pdo = $this->databaseService->connect();
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }
}