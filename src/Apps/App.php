<?php

namespace BeyondCode\LaravelWebSockets\Apps;

use BeyondCode\LaravelWebSockets\Exceptions\InvalidClient;

class App
{
    /** @var int */
    public $appId;

    /** @var string */
    public $appKey;

    /** @var string */
    public $appSecret;

    /** @var string|null */
    public $name;

    public static function findById(int $appId)
    {
        return app(AppProvider::class)->findById($appId);
    }

    public static function findByKey(string $appKey): ?App
    {
        return app(AppProvider::class)->findByKey($appKey);
    }

    public function __construct($appId, string $appKey, string $appSecret, ?string $name)
    {
        if (!is_numeric($appId)) {
            throw InvalidClient::appIdIsNotNumeric($appId);
        }

        if ($appKey === '') {
            throw InvalidClient::valueIsRequired('appKey', $appId);
        }

        if ($appSecret === '') {
            throw InvalidClient::valueIsRequired('appSecret', $appId);
        }

        $this->appId = $appId;

        $this->appKey = $appKey;

        $this->appSecret = $appSecret;

        $this->name = $name;
    }
}