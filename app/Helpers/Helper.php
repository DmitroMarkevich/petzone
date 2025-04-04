<?php

/**
 * Check if the current route matches the given pattern and return "active" class.
 *
 * @param string $route The route or pattern to check.
 * @return string "active" if the current route matches, otherwise an empty string.
 */
function is_active(string $route): string
{
    return request()->is($route) ? 'active' : '';
}
