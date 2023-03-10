<?php

namespace Sashalenz\Tecdoc;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Sashalenz\Tecdoc\Exceptions\TecdocException;
use Xite\Wireforms\Traits\Makeable;

abstract class Tecdoc
{
    use Makeable;

    private const TIMEOUT = 3;
    private const RETRY_TIMES = 3;
    private const RETRY_SLEEP = 100;

    protected array $properties = [
        'limit' => 20
    ];

    public function property(string $key, $value): self
    {
        $this->properties[$key] = $value;

        return $this;
    }

    public function search(?string $search = null): self
    {
        $this->property('search', $search);

        return $this;
    }

    public function limit(int $limit): self
    {
        $this->property('limit', $limit);

        return $this;
    }

    /**
     * @param string $url
     * @return Collection
     * @throws TecdocException
     */
    protected function request(string $url): Collection
    {
        try {
            return Http::timeout(self::TIMEOUT)
                ->retry(
                    self::RETRY_TIMES,
                    self::RETRY_SLEEP
                )
                ->withHeaders([
                    'Authorization' => 'Bearer ' . Config::get('a20-tecdoc-api.key'),
                    'Accept' => 'application/json'
                ])
                ->post(
                    Config::get('a20-tecdoc-api.url') . $url,
                    $this->properties
                )
                ->throw()
                ->collect();
        } catch (RequestException $e) {
            throw new TecdocException('Request error. '.$e->getMessage());
        }
    }
}
