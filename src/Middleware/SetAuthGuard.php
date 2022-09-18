<?php

namespace WebmanTech\Auth\Middleware;

use Webman\Http\Request;
use Webman\Http\Response;
use Webman\MiddlewareInterface;

/**
 * 设置路由下的当前 auth 的 guardName
 */
class SetAuthGuard implements MiddlewareInterface
{
    public const REQUEST_GUARD_NAME = 'auth_current_guard_name';

    protected string $guardName;

    public function __construct(string $guardName = null)
    {
        $this->guardName = $guardName;
    }

    /**
     * @inheritDoc
     */
    public function process(Request $request, callable $handler): Response
    {
        if ($this->guardName) {
            $request->{static::REQUEST_GUARD_NAME} = $this->guardName;
        }

        return $handler($request);
    }
}