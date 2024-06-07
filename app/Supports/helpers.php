<?php

if (! function_exists('auth_user')) {
    /**
     * Get user model from auth.
     *
     * @return \App\Modules\User\Models\User
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    function auth_user()
    {
        $user = auth()->user();

        if (! $user instanceof \App\Modules\User\Models\User) {
            throw new \Illuminate\Auth\AuthenticationException();
        }

        return $user;
    }
}

if (! function_exists('cast_to_string')) {
    /**
     * cast value to string
     *
     * @param  mixed  $value
     */
    function cast_to_string($value): string
    {
        if (
            is_string($value) ||
            is_scalar($value) || // Check if the variable is a scalar type (int, float, bool, string)
            is_null($value) ||
            (is_object($value) && method_exists($value, '__toString'))
        ) {
            return (string) $value;
        }

        throw new InvalidArgumentException('value cannot be casted to string');
    }
}
