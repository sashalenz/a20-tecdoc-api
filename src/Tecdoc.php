<?php

namespace Sashalenz\Tecdoc;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Sashalenz\Tecdoc\Exceptions\TecdocException;

abstract class Tecdoc
{
    private const TIMEOUT = 3;
    private const RETRY_TIMES = 3;
    private const RETRY_SLEEP = 100;

    protected array $properties = [];

    protected function search(string $search): self
    {
        $this->properties['search'] = $search;
        return $this;
    }

    public function property(string $key, $value): self
    {
        $this->properties[$key] = $value;
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
        $response = Http::timeout(self::TIMEOUT)
            ->retry(self::RETRY_TIMES, self::RETRY_SLEEP)
            ->withHeaders([
                'Authorization' => 'Bearer ' . config('a20-tecdoc-api.key'),
                'Accept' => 'application/json'
            ])
            ->post(config('a20-tecdoc-api.url') . $url, $this->properties)
            ->throw();
        } catch (RequestException $e) {
            throw new TecdocException('Request error. '.$e->getMessage());
        }

        return collect($response);
    }
}
