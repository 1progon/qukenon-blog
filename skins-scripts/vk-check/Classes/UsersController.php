<?php


namespace App\Classes;


use PDO;
use PDOException;

class UsersController
{

    private PDO $pdo;


    public function __construct(Database $conn)
    {
        $this->pdo = $conn->pdo;
    }


    /**
     * @param string|int $find
     * @param string $column
     * @return bool
     */
    private function isExist($find, string $column = 'id'): bool
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE ' . $column . '= ?');
        $stmt->bindParam(1, $find);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function isExistId(string $login)
    {
        return $this->isExist($login);
    }

    public function isExistLogin(string $login)
    {
        return $this->isExist($login, 'login');
    }

    public function isExistEmail(string $email)
    {
        return $this->isExist($email, 'email');
    }


    public function saveUser(array $data): bool
    {
        $dataKeys = array_keys($data);

        $columns = implode(",", $dataKeys);

        $dataKeysWithColon = array_map(
            function ($item) {
                return ':' . $item;
            },
            $dataKeys
        );

        $values = implode(',', $dataKeysWithColon);

        $sql = sprintf(
            "INSERT INTO users (%s) VALUES (%s)",
            $columns,
            $values
        );

        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            throw new PDOException('PDO Statement error');
        }

        $result = $stmt->execute($data);

        if (!$result) {
            throw new PDOException('PDO Execute failed');
        }

        return true;
    }

    /**
     * @param string|int $find
     * @param string $column
     * @return array|null
     */
    private function getUser($find, string $column = 'id'): ?array
    {
        //status  - 0 = registered,  1 = onCheck, 2 = approved
        //blocked - 0 = not blocked, 1 = blocked
        $sql = 'SELECT id,username,lastname,login,password,email,phone,country,region,city, bonuses, token, token_expire, status, blocked FROM users WHERE ' .
            $column . '= ?';

        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) {
            throw new PDOException('PDO Statement error');
        }
        $stmt->bindParam(1, $find);

        $result = $stmt->execute();

        if (!$result) {
            throw new PDOException('PDO Execute error');
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById(int $id): ?array
    {
        return $this->getUser($id);
    }

    public function getUserByLogin(string $login): ?array
    {
        return $this->getUser($login, 'login');
    }

    public function getUserByEmail(string $email): ?array
    {
        return $this->getUser($email, 'email');
    }


    public function generateToken(): array
    {
        $token['token'] = bin2hex(random_bytes(32));
        $token['expire'] = time() + 86400; // within 24 hours

        return $token;
    }


    public function saveToken(string $userLogin, string $token, int $expire): bool
    {
        $sql = 'UPDATE users SET token = ?, token_expire = ? WHERE login=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $token);
        $stmt->bindParam(2, $expire);
        $stmt->bindParam(3, $userLogin);

        return $stmt->execute();
    }

    public function invalidateToken(string $userLogin)
    {
        $timeExpire = null;
        $token = null;

        $sql = 'UPDATE users SET token = ?, token_expire = ? WHERE login=?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(1, $token);
        $stmt->bindParam(2, $timeExpire);
        $stmt->bindParam(3, $userLogin);

        return $stmt->execute();
    }


}
