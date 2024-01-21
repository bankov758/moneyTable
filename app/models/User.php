<?php

namespace app\models;

class User extends Model
{
    private array $errors;

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function create(string $email, string $name, string $password): int
    {
        $userCreateStatement = $this->getDb()->prepare(' insert into users (full_name, email, password, created_at)
                                                              values (?, ?, ?, now()) ');
        $userCreateStatement->execute([$name, $email, $password]);
        return (int)$this->getDb()->lastInsertId();
    }

    public function getByEmail(string $email): array
    {
        $selectStatement = $this->getDb()->prepare(' select * from users where email = ? ');
        $selectStatement->execute([$email]);
        $user = $selectStatement->fetch();
        return $user ? $user : [];
    }

    public function isEmailInUse(string $email): bool
    {
        $result = $this->getDb()->prepare(' select * from users where email = ? ');
        $result->execute([$email]);
        return $result->fetch() != null;
    }

    public function validateLogin($data): bool
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
            return false;
        }

        $user = $this->getByEmail($data['email']);
        if ($user == null || !password_verify($data["password"], $user["password"])) {
            $this->errors['login'] = "Invalid email or password";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }

    public function validateSignup($data): bool
    {
        $this->errors = [];

        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        }

        if ($this->isEmailInUse($data['email'])) {
            $this->errors['email'] = "Email is already in use";
        }

        if (empty($data['username'])) {
            $this->errors['username'] = "A username is required";
        } else if (!preg_match("/^[a-zA-Z0-9]+$/", $data['username'])) {
            $this->errors['username'] = "Username can only have letters and digits";
        }

        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }

        if (empty($data['confirmPassword'])) {
            $this->errors['confirmPassword'] = "Password conformation is required";
        }

        if ($data['password'] !== $data['confirmPassword']){
            $this->errors['confirmPassword'] = "Passwords do not match";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }


}