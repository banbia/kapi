<?php

require '../vendor/autoload.php';

$app = new \Slim\App;

require '../src/autoload.php';
        $app->add(function ($request, $response, $next) {
            $format = $request->getParam('format');
            if ($format) {
                $mapping = [
                    'html' => 'text/html',
                    'xml' => 'application/xml',
                    'json' => 'application/json',
                ];
                if (isset($mapping[$format])) {
                    $request = $request->withHeader('Accept', $mapping[$format]);
                }
            }
            return $next($request, $response, $next);
        });
$app->run();

?>
