<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeePagination
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
	public function handle(Request $request, Closure $next)
	{
		$response = $next($request);

		$data = $response->getData(true);
        
		if (isset($data['links'])) {
			unset($data['links']);
		}
		if (isset($data['meta'], $data['meta']['links'])) {
			unset($data['meta']['links']);
		}

		$response->setData($data);

		return $response;
	}
}
