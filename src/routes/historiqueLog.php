<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once  dirname(__DIR__).'/entities/HistoriqueLog.php';
include_once  dirname(__DIR__).'/entities/ProUsers.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$container = $app->getContainer();

$container['logger'] = function ($c) {
    // create a log channel
    $log = new Logger('historique');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/historique.log', Logger::INFO));

    return $log;
};


    /**
     * This method a url group. <br/>
     * <b>post: </b>establishes the base url '/public/webresources/mobile_app/'.
     */
    $app->group('/log', function () use ($app) {
        /**
         * This method finds a history log by id but first checks if the api_code is valid
         */
        $app->get('/find/{api_code}/{id}/{log}/', function (Request $request, Response $response) {

            $id = $request->getAttribute("id");
            $api_code = $request->getAttribute("api_code");
            $log = $request->getAttribute("log");
            if($api_code == null | $id == null | $log==null){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                // Gets the database connection
                $conn = PDOConnection::getConnection();
                $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                $verify = $user->verifyApiCode($conn);
                //$data['success']=$verify;
                if($verify ===-1){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                    $data['error'] = $dt;
                }else if($verify===-2){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                    $data['error'] = $dt;
                }else if($verify===0){
                    $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                    $data['error'] = $dt;
                }else{
                    $log = new HistoriqueLog($log, null, null,null, null, null,null,null);
                    $data = $log->logByid($conn);
                }

            }
            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });

        /**
         * This method return 10 last registred logs of a client
         */
        $app->get('/list/{api_code}/{id}/', function (Request $request, Response $response) {

            $api_code = $request->getAttribute("api_code");
            $id = $request->getAttribute("id");

            if($api_code == null | $id==null ){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                // Gets the database connection
                $conn = PDOConnection::getConnection();
                $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                $verify = $user->verifyApiCode($conn);
                //$data['success']=$verify;
                if($verify ===-1){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                    $data['error'] = $dt;
                }else if($verify===-2){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                    $data['error'] = $dt;
                }else if($verify===0){
                    $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                    $data['error'] = $dt;
                }else{

                    $log = new HistoriqueLog(null, null,null, null, null, $id,null,null);
                    $data = $log->logByProuser($conn);
                }



            }
            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });
        /**
         * This method
         */
        $app->get('/list/{api_code}/{id}/{nb}/{page}/', function (Request $request, Response $response) {

            $api_code = $request->getAttribute("api_code");
            $id = $request->getAttribute("id");

            if($api_code == null | $id==null ){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                // Gets the database connection
                $conn = PDOConnection::getConnection();
                $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                $verify = $user->verifyApiCode($conn);
                //$data['success']=$verify;
                if($verify ===-1){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                    $data['error'] = $dt;
                }else if($verify===-2){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                    $data['error'] = $dt;
                }else if($verify===0){
                    $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                    $data['error'] = $dt;
                }else{
                    $nb = $request->getAttribute("nb");
                    $page = $request->getAttribute("page");
                    if($page == null){
                        $page = 1;
                    }
                    if($nb == null){
                        $nb = 10;
                    }

                    $log = new HistoriqueLog(null, null,null, null, null, $id,null,null);
                    $data = $log->logByProuserPage($conn,$nb,$page);
                }



            }
            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });
        /**
         * This method delete a user
         */
        $app->delete('/delete/', function (Request $request, Response $response) {

            $api_code = $request->getParam("api_code");
            $id = $request->getParam("id");
            $log = $request->getParam("log");
            if($api_code == null | $id==null | $log==null ){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                // Gets the database connection
                $conn = PDOConnection::getConnection();
                $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                $verify = $user->verifyApiCode($conn);
                //$data['success']=$verify;
                if($verify ===-1){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                    $data['error'] = $dt;
                }else if($verify===-2){
                    $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                    $data['error'] = $dt;
                }else if($verify===0){
                    $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                    $data['error'] = $dt;
                }else{
                    $log = new HistoriqueLog($log, null,null, null, null, $id,null,null);
                    $data = $log->deleteLog($conn);
                }



            }

            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });



        /**
         * This method adds a new user (pro)
         */
        $app->post('/add/', function (Request $request, Response $response) {
            // Unique ID
            //$guid = uniqid();

            $api_code = $request->getParam("api_code");
            $id = $request->getParam("id");

            if($api_code == null | $id==null ){
                $dt = array("code"=>522,"message"=>"522  Missing arguments id and api_code");
                $data['error'] = $dt;
            }else {
                $desc = $request->getParam("description");
                $table = $request->getParam("table_name");
                $action_id = $request->getParam("action_id");

                if($desc == null | $table == null | $action_id == null ){
                    $dt= array("code"=>522,"message"=>"522  Missing arguments dsecription or table_name or action_id");
                    $data['error'] = $dt;
                }else {
                    // Gets the database connection
                    $conn = PDOConnection::getConnection();
                    $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                    $verify = $user->verifyApiCode($conn);
                    //$data['success']=$verify;
                    if($verify ===-1){
                        $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                        $data['error'] = $dt;
                    }else if($verify===-2){
                        $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                        $data['error'] = $dt;
                    }else if($verify===0){
                        $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                        $data['error'] = $dt;
                    }else{
                        $log = new HistoriqueLog(null, null,$desc, $table, $action_id, $id,null,null);
                        $data = $log->addLog($conn);
                    }
                }
            }

            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;

        });
        /**
         * This method update a user's informations (pro)
         */
        $app->put('/update/', function (Request $request, Response $response) {
            // Unique ID
            //$guid = uniqid();

            //extract parameters sent in url
            $api_code = $request->getParam("api_code");
            $id = $request->getParam("id");

            if($api_code == null | $id==null ){
                $dt = array("code"=>522,"message"=>"522  Missing arguments id or api_code");
                $data['error'] = $dt;
            }else {
                $desc = $request->getParam("description");
                $table = $request->getParam("table_name");
                $action_id = $request->getParam("action_id");
                $log = $request->getParam("log_id");

                if($desc == null | $table == null | $action_id == null | $log == null){
                    $dt= array("code"=>522,"message"=>"522  Missing arguments dsecription or table_name or action_id or log_id");
                    $data['error'] = $dt;
                }else {
                    // Gets the database connection
                    $conn = PDOConnection::getConnection();
                    $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                    $verify = $user->verifyApiCode($conn);
                    //$data['success']=$verify;
                    if($verify ===-1){
                        $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                        $data['error'] = $dt;
                    }else if($verify===-2){
                        $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                        $data['error'] = $dt;
                    }else if($verify===0){
                        $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                        $data['error'] = $dt;
                    }else{
                        $log = new HistoriqueLog($log, null,$desc, $table, $action_id, $id,null,null);
                        $data = $log->updateLog($conn);
                    }
                }
            }


            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;

        });
        /**
         * This method list the latest published messages
         */
        $app->get('/list/by-date/{api_code}/{id}/{start}/{end}/', function (Request $request, Response $response) {

            //extract parameters sent in url
            $api_code = $request->getAttribute("api_code");
            $id = $request->getAttribute("id");

            if($api_code == null | $id==null ){
                $dt = array("code"=>522,"message"=>"522  Missing arguments id or api_code");
                $data['error'] = $dt;
            }else {
                $start = $request->getAttribute("start");
                $end = $request->getAttribute("end");

                if($start == null | $end == null){
                    $dt= array("code"=>522,"message"=>"522  Missing arguments dsecription or table_name or action_id or log_id");
                    $data['error'] = $dt;
                }else {
                    // Gets the database connection
                    $conn = PDOConnection::getConnection();
                    $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
                    $verify = $user->verifyApiCode($conn);
                    //$data['success']=$verify;
                    if($verify ===-1){
                        $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
                        $data['error'] = $dt;
                    }else if($verify===-2){
                        $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
                        $data['error'] = $dt;
                    }else if($verify===0){
                        $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong api code ");
                        $data['error'] = $dt;
                    }else{
                        $log = new HistoriqueLog(null, null,null, null, null, $id,null,null);
                        $end = $end . " 00:00:00";
                        $start = $start . " 00:00:00";
                        $data = $log->listBydates($conn,$start,$end);
                        //$data = array();
                    }
                }
            }


            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;

        });

});

?>
