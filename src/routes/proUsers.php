<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

include_once  dirname(__DIR__).'/entities/ProUsers.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$container = $app->getContainer();

$container['logger'] = function ($c) {
    // create a log channel
    $log = new Logger('pro_users');
    $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/pro_users.log', Logger::INFO));

    return $log;
};


    /**
     * This method a url group. <br/>
     * <b>post: </b>establishes the base url '/public/webresources/mobile_app/'.
     */
    $app->group('/pro_users', function () use ($app) {
        /**
         * This method list the latest published messages
         */
        $app->get('/user/{id}/', function (Request $request, Response $response) {

            $id = $request->getAttribute("id");

            $user = new ProUsers($id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

            // Gets the database connection
            $conn = PDOConnection::getConnection();

            $data =$user->userByid($conn);

            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });

        /**
         * This method list the latest published messages
         */
        $app->get('/list/', function (Request $request, Response $response) {

            $user = new ProUsers(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            // Gets the database connection
            $conn = PDOConnection::getConnection();
            $data = $user->listUsers($conn);

            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });
        /**
         * This method delete a user
         */
        $app->delete('/delete/', function (Request $request, Response $response) {

            $id = $request->getParam("id");
            $user = new ProUsers($id, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            // Gets the database connection
            $conn = PDOConnection::getConnection();
            $data = $user->deleteUser($conn);

            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response, $data);

            return $response;
        });


        /**
         * This method gets a user into the database.
         * @param string $user - username
         * @param string $password - password
         */
        $app->get('/login/{email}/{password}/', function (Request $request, Response $response) {

            // get data from url
            $email = $request->getAttribute("email");
            $password = $request->getAttribute("password");
            if($email == null | $password == null){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                $user = new ProUsers(null, $email, null, $email, null, null, null, null, null, null, null, null, null, null, null, null, null, $password, null, null);
                // Gets the database connection
                $conn = PDOConnection::getConnection();

                $data = $user->login($conn);
                if($data[0]=="sucess"){
                    $user->userByEmail($conn);
                    $desc = "login";
                    $table = "ProUsers";
                    $action_id = $user->getId();

                    $id = $user->getId();
                    $log = new HistoriqueLog(null, null,$desc, $table, $action_id, $id,null,null);
                    $x =$log->addLog($conn);
                }

            }
            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;
        });
        /**
         * This method allows to edit the api code.
         * @param id int
         * @param string $old_api_code - new_api_code
         */
        $app->put('/update/code_api/', function (Request $request, Response $response) {

            // get data from url
            $id = $request->getParam("id");
            $old = $request->getParam("old_api_code");
            $new = $request->getParam("new_api_code");
            if($id == null | $old == null | $new==null){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                $user = new ProUsers($id, null, $old, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $password, null, null);
                // Gets the database connection
                $conn = PDOConnection::getConnection();

                $dt = $user->userByIdAndApi($conn);
                if($dt[0]=="success"){
                    $data = $user->updateToken($conn,$new);
                }else{
                    $data = $dt;
                }
            }
            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;
        });

        /**
         * This method adds a new user (pro)
         */
        $app->post('/add/', function (Request $request, Response $response) {
            // Unique ID
            //$guid = uniqid();

            //extract parameters sent in url
            $password = $request->getParam("password");

            $email = $request->getParam("email");

            if( $email == null | $password == null){
                $dt= array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                $genre = $request->getParam("genre");
                $username = $request->getParam("email");
                $prenom = $request->getParam("prenom");
                $nom = $request->getParam("nom");
                $date_naissance = $request->getParam("date_naissance");
                $comp_adresse = $request->getParam("comp_adresse");
                $code_postal = $request->getParam("code_postal");
                $tel = $request->getParam("tel");
                $ind_tel = $request->getParam("ind_tel");
                $mobile = $request->getParam("mobile");
                $ind_mobile = $request->getParam("ind_mobile");
                $longitude = $request->getParam("longitude");
                $latitude = $request->getParam("latitude");
                // Date of created
                $date_creation = date('Y-m-d H:i:s');
                //hash password
                $password = password_hash($request->getParam("password"), PASSWORD_DEFAULT);
                //instaciate user and add its parameters (from url)
                $user = new ProUsers(null, $email, 'not assigned', $username, $genre, $prenom, $nom, $date_naissance, $comp_adresse, $code_postal, $tel, $ind_tel, $mobile, $ind_mobile, $date_creation, $longitude, $latitude, $password, 1, $date_creation);

                // Gets the database connection
                $conn = PDOConnection::getConnection();
                $data = $user->addUser($conn);
                if($data[0]=="sucess"){
                    $user->userByEmail($conn);
                    $desc = "create account";
                    $table = "ProUsers";
                    $action_id = $user->getId();

                    $id = $user->getId();
                    $log = new HistoriqueLog(null, null,$desc, $table, $action_id, $id,null,null);
                    $x =$log->addLog($conn);
                }
            }

            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;

        });

        /**
         * This method update a user's informations (pro)
         */
        $app->put('/update-user/', function (Request $request, Response $response) {
            // Unique ID
            //$guid = uniqid();

            //extract parameters sent in url
            $id = $request->getParam("id");
            $api_code = $request->getParam("api_code");
            $username = $request->getParam("username");
            $email = $request->getParam("email");
            $genre = $request->getParam("genre");
            $prenom = $request->getParam("prenom");
            $nom = $request->getParam("nom");
            $date_naissance = $request->getParam("date_naissance");
            $comp_adresse = $request->getParam("comp_adresse");
            $code_postal = $request->getParam("code_postal");
            $tel = $request->getParam("tel");
            $ind_tel = $request->getParam("ind_tel");
            $mobile = $request->getParam("mobile");
            $ind_mobile = $request->getParam("ind_mobile");
            $longitude = $request->getParam("longitude");
            $latitude = $request->getParam("latitude");
            $etat = $request->getParam("etat");
            if($api_code == null | $username == null | $email == null | $genre == null | $prenom == null |
                $nom == null | $date_naissance== null | $comp_adresse == null | $code_postal == null |
                $tel == null | $ind_tel == null | $mobile == null | $ind_mobile == null | $longitude == null |
                $latitude == null | $etat == null |$id == null){
                $dt= array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else {
                //hash password
                $password = password_hash($request->getParam("password"), PASSWORD_DEFAULT);
                //instaciate user and add its parameters (from url)
                $user = new ProUsers($id, $email, $api_code, $username, $genre, $prenom, $nom, $date_naissance, $comp_adresse, $code_postal, $tel, $ind_tel, $mobile, $ind_mobile, null, $longitude, $latitude, $password, $etat, null);

                // Gets the database connection
                $conn = PDOConnection::getConnection();
                $verify = $user->verifyApiCode($conn);

                //$data['success']=$verify;
                if ($verify === -1) {
                    $dt = array("code" => 500, "message" => "500  Internal Server Error : database error");
                    $data['error'] = $dt;
                } else if ($verify === -2) {
                    $dt = array("code" => 500, "message" => "500  Internal Server Error : server error");
                    $data['error'] = $dt;
                } else if ($verify === 0) {
                    $dt = array("code" => 422, "message" => "422 Unprocessable Entity : wrong api code ");
                    $data['error'] = $dt;
                } else {
                    $data = $user->updateUser($conn);
                    if($data[0]=="sucess"){
                        $user->userByEmail($conn);
                        $desc = "update profile";
                        $table = "ProUsers";
                        $action_id = $id;
                        $log = new HistoriqueLog(null, null,$desc, $table, $action_id, $id,null,null);
                        $x =$log->addLog($conn);
                    }
                }
            }


            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;

        });
        /**
         * This method updates a user (pro) password
         */
        $app->put('/change-password/', function (Request $request, Response $response) {

            // Gets the database connection
            $conn = PDOConnection::getConnection();
            //extract parameters sent in url
            $api_code = $request->getParam("api_code");
            $pass = $request->getParam("password");
            $id = $request->getParam("id");
            if($api_code == null | $pass == null | $id == null){
                $dt = array("code"=>522,"message"=>"522  Missing arguments");
                $data['error'] = $dt;
            }else{
                //hash password
                $password = password_hash($pass, PASSWORD_DEFAULT);
                //instaciate user and add its parameters (from url)
                $user = new ProUsers($id, null, $api_code, null, null, null, null, null, null, null, null, null, null, null, null, null, null, $password, null, null);

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
                    $data = $user->changePassword($conn);
                    if($data[0]=="sucess"){
                        $user->userByEmail($conn);
                        $desc = "update password";
                        $table = "ProUsers";
                        $action_id = $id;
                        $log = new HistoriqueLog(null, null,$desc, $table, $action_id, $id,null,null);
                        $x =$log->addLog($conn);
                    }
                }
            }




            $renderer = new RKA\ContentTypeRenderer\Renderer();
            $response = $renderer->render($request, $response,$data);

            return $response;

        });


});

?>
