<?php

namespace Resources\Backend\Middleware;

class ResourceMiddleware
{
  public function __construct($app) {
     $this->createMiddleware($app);
  }

  private function createMiddleware($app) {
    $app->add(function ($request, $response, $next) {
      // add media parser
      $request->registerMediaTypeParser(
        "text/javascript",
        function ($input) {
          return json_decode($input);
        }
      );

      return $next($request, $response);
    });
  }
}

?>
