<?php

namespace Jhu\Wse\LaravelShibboleth\Providers;

use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;

class ShibbolethUserProvider implements UserProvider
{
    /**
     * The user model.
     *
     * @var string
     */
    protected $model;

    /**
     * Create a new Shibboleth user provider.
     *
     * @param  string  $model
     * @return void
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Auth\Authenticatable | null
     */
    public function retrieveById($identifier)
    {
        $user = $this->retrieveByCredentials(['id' => $identifier]);
        return ($user && $user->getAuthIdentifier() == $identifier) ?
            $user : null;
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return Illuminate\Auth\Authenticatable | null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (count($credentials) == 0) {
            return null;
        }

        $class = '\\' . ltrim($this->model, '\\');
        $user = new $class;

        $query = $user->newQuery();
        foreach ($credentials as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $creds)
    {
        return isset($creds['password'])
            ? Hash::check($creds['password'], $user->getAuthPassword())
            : true;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // Not Implemented
    }

    /**
     * Retrieve a user by by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Auth\Authenticatable | null
     */
    public function retrieveByToken($identifier, $token)
    {
        // Not Implemented
    }

    public function rehashPasswordIfRequired(Authenticatable $user, #[\SensitiveParameter] array $credentials, bool $force = false)
    {
       // Shibboleth don't use local password, do nothing
       return;
    }
}
