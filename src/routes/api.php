<?php

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use Monolog\Logger;
  use Monolog\Handler\StreamHandler;

  $container = $app->getContainer();

  $container['logger'] = function ($c) {
      // create a log channel
      $log = new Logger('api');
      $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::INFO));

      return $log;
  };



  /**
   * This method a url group. <br/>
   * <b>post: </b>establishes the base url '/public/api/app/users'.
   */
  $app->group('/api/app', function () use ($app) {

      $app->get('/ping/', function (Request $request,Response $response) {

          $data = array("code"=>200,"message"=>"connexion aboutie");
          $data['success'] = $data;
          $renderer = new RKA\ContentTypeRenderer\Renderer();
          $response = $renderer->render($request, $response, $data);

          return $response;


          return $response;
      });

  });

?>
