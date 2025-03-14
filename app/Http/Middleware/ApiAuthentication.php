<?php

namespace App\Http\Middleware;

use App\Traits\ApiHelperTrait;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthentication
{
    use ApiHelperTrait;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('api')->check()){
            return $next($request);
        }
        return $this->returnWrong('UNAUTHORIZED', JsonResponse::HTTP_UNAUTHORIZED);
    }
}
