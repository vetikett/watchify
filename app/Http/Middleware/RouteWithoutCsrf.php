<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class RouteWithoutCsrf extends VerifyCsrfToken{

    protected $routes = [
        'search',
        'search-title'
    ];

    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if ($this->isReading($request) || $this->allowRoutes($request) || $this->tokensMatch($request))
        {
            return $this->addCookieToResponse($request, $next($request));
        }

        throw new TokenMismatchException;
	}

    protected function allowRoutes($request) {

        foreach($this->routes as $route) {
            if( $request->is($route) ) {
                return true;
            }
        }
        return false;

    }

}
