<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];

    public function createUser($data)
    {
        $user = $this->where('login', $data['login'])->first();
        if ($user !== null) {
            return null;
        }
        $create = $this->create($data);
        if (!empty($create->login)) {
            return $create->login;
        }

        throw new \RuntimeException();
    }

    public function loginUser($data)
    {
        $errors = [];
        $login = $this->where('login', $data['login'])->first();
        if ($login) {
            $login = $login->toArray();
            $checkPassword = password_verify($data['password'], $login['password']);
            if (!$checkPassword) {
                $errors[] = 'Неверный пароль';
            }
        } else {
            $errors[] = 'Пользователь с таким логином не найден';
        }
        return $errors;
    }

    public function getUser($id)
    {
        return $this->where('id', $id)->first()->toArray();
    }

    public function getAllUsers($sort)
    {
        return $this->orderBy('age', $sort)->get()->toArray();
    }

    public function deleteUser($id)
    {
        $user = $this->find(['id' => $id])->toArray();
        if (!empty($user)) {
            $this->destroy($id);
        }
        return $user[0]['login'];
    }
}
