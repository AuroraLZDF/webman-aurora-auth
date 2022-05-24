<?php

namespace app\model;

use Kriss\WebmanAuth\Interfaces\IdentityInterface;
use Kriss\WebmanAuth\Interfaces\IdentityRepositoryWithTokenInterface;
use support\Model;

class User extends Model implements IdentityInterface, IdentityRepositoryWithTokenInterface
{
    // 其他方法

    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return $this->{$this->primaryKey};
    }

    /**
     * @inheritDoc
     */
    public function refreshIdentity()
    {
        return $this->refresh();
    }

    /**
     * @inheritDoc
     */
    public function findIdentityByToken(string $token, string $type = null): ?IdentityInterface
    {
        return static::query()->where('access_token', $token)->first();
    }

    /**
     * 刷新 token
     * @param false|string|null $token
     */
    public function refreshToken($token = false)
    {
        if ($token === false) {
            $token = Str::random(32);
        }
        $this->access_token = $token;
        $this->save();
    }
}