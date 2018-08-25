<?php
/**
 * Created by PhpStorm.
 * User: nour
 * Date: 04/07/18
 * Time: 08:34 م
 */
/**
 * The ProUsers class models a professional user with a specific attributes.
 */
class ProUsers{

    // private variable
    private $id;   // db id of the
    private $email;   // email of the user
    private $api_code; // api code of the user
    private $username; // api code of the user
    private $genre;   // genre of the user
    private $prenom;   // firstname  of the user
    private $nom;   // firstname  of the user
    private $date_naissance;   // lastname  of the user
    private $comp_adresse;   // complementary  of the user
    private $code_postal;   // zip code of the user
    private $tel;   // tel of the user
    private $ind_tel;   // tel's index of the user
    private $mobile;   // mobile of the user
    private $ind_mob;   // mobile's index of the user
    private $date_creation;   // creation date of the user
    private $longitude;   // longitude of the user
    private $latitude;   // latitude of the user
    private $password;   // password of the user
    private $etat;   // status of the user
    private $last_update;

    /**
     * ProUsers constructor.
     * @param $id
     * @param $email
     * @param $api_code
     * @param $username
     * @param $genre
     * @param $prenom
     * @param $nom
     * @param $date_naissance
     * @param $comp_adresse
     * @param $code_postal
     * @param $tel
     * @param $ind_tel
     * @param $mobile
     * @param $ind_mob
     * @param $date_creation
     * @param $longitude
     * @param $latitude
     * @param $password
     * @param $etat
     * @param $last_update
     */
    public function __construct($id, $email, $api_code, $username, $genre, $prenom, $nom, $date_naissance, $comp_adresse, $code_postal, $tel, $ind_tel, $mobile, $ind_mob, $date_creation, $longitude, $latitude, $password, $etat, $last_update)
    {
        $this->id = $id;
        $this->email = $email;
        $this->api_code = $api_code;
        $this->username = $username;
        $this->genre = $genre;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->date_naissance = $date_naissance;
        $this->comp_adresse = $comp_adresse;
        $this->code_postal = $code_postal;
        $this->tel = $tel;
        $this->ind_tel = $ind_tel;
        $this->mobile = $mobile;
        $this->ind_mob = $ind_mob;
        $this->date_creation = $date_creation;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->password = $password;
        $this->etat = $etat;
        $this->last_update = $last_update;
    }

    /************************* find user by id *********************/
    public function userByid($pdo){
        try {
            $sql = "SELECT * FROM ProUsers WHERE id = :id limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0){
                $dt = $req->fetchObject();
                $data['success'] = $dt;
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong id");
                $data['error'] = $dt;
            }

        }catch(PDOException $ex){
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        }catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    /************************* find user by id *********************/
    public function userByIdAndApi($pdo){
        try {
            $sql = "SELECT * FROM ProUsers WHERE id = :id and code_api = :api limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->bindParam(':api', $this->api_code, PDO::PARAM_STR);
            $req->execute();
            if($req->rowCount()>0){
                $dt = $req->fetchObject();
                $data['success'] = $dt;
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong id or api code");
                $data['error'] = $dt;
            }

        }catch(PDOException $ex){
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        }catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    /************ List all professional users *******************/
    public function listUsers($pdo){
        try {

                // Gets the user from the database
                $sql = "SELECT * FROM ProUsers";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $dt = $stmt->fetchAll();
                $data['success'] = $dt;


        } catch (PDOException $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        } catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }

    /************************** login professional user *********************/
    public function login($pdo){
        try {

            //get username and password from url
            $email = $this->email;
            $pass = $this->password;

            // Gets the user from the database
            $sql = "SELECT * FROM ProUsers WHERE email = :mail";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":mail", $email);
            $stmt->execute();
            $user = $stmt->fetchObject();

            // If user exist
            if ($user) {
                // If password is correct
                if (password_verify($pass, $user->password)) {
                    $this->setId($user->id);
                    $data = $this->userByid($pdo);

                } else {
                    $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong password");
                    $data['error'] = $dt;
                }
            } else {
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong email");
                $data['error'] = $dt;
            }




        } catch (PDOException $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        } catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    /************************** login professional user *********************/
    public function userByEmail($pdo){

            //get username and password from url
            $email = $this->email;

            // Gets the user from the database
            $sql = "SELECT * FROM ProUsers WHERE email = :mail";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":mail", $email);
            $stmt->execute();
            $user = $stmt->fetchObject();

            // If user exist
            if ($user) {

                    $this->setId($user->id);


            }





        return 1;
    }
    /**************************** update token (code_api) **************************/
    public function updateToken($pdo,$code){
        try {

            // Gets the user from the database
            $sql = "UPDATE ProUsers SET code_api = :code WHERE id=:id ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":code", $code);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();

            return 1;

        } catch (PDOException $e) {
           return -1;
        } catch (Exception $e) {
            return 0;
        }
        return 1;
    }
    /**************************** change user password **************************/
    public function changePassword($pdo){
        try {

            // Gets the user from the database
            $sql = "UPDATE ProUsers SET password = :pass WHERE id=:id ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":pass", $this->password);
            $stmt->bindParam(":id", $this->id);
            $res = $stmt->execute();

            if($res===true){
                $data = $this->userByid($pdo);
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : update problem");
                $data['error'] = $dt;
            }


        } catch (PDOException $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        } catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    /**************************** verify token (code_api) of user **************************/
    public function verifyApiCode($pdo){
        try {

            // Gets the user from the database
            $sql = "SELECT * FROM ProUsers WHERE id = :id AND code_api = :code";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":code", $this->api_code);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();
            if($stmt->rowCount()>0){
                return 1;//OK
            }else{
                return 0;//not found
            }



        } catch (PDOException $e) {
            return -1;//prblm bd
        } catch (Exception $e) {
            return -2;//prblm server
        }
    }
    /**************************** delete user **************************/
    public function deleteUser($pdo){
        try {
            $sql = "SELECT * FROM ProUsers WHERE id = :id limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0) {
                // Gets the user from the database
                $sql = "UPDATE ProUsers SET etat = '-1' WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $this->id);
                $stmt->execute();

                $dt = array("code" => 200, "message" => "200  OK");
                $data['succes'] = $dt;
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong id");
                $data['error'] = $dt;
            }
        } catch (PDOException $e) {
            $data = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $data;
        } catch (Exception $e) {
            $data = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $data;
        }
        return $data;
    }
    /************************************ insert new user ******************************/
    public function addUser($pdo){
        try {
            // Gets the user into the database
            $sql = "INSERT INTO ProUsers VALUES ('', :email, 'not assigned', :username, :genre, :prenom, :nom, :date_naiss, :comp_adresse, :code_postal, :tel, :ind_tel, :mobile,:ind_mobile, :date_creation, :longitude, :latitude,:password,:etat, '' ) ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":username", $this->email);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":date_naiss", $this->date_naissance);
            $stmt->bindParam(":comp_adresse", $this->comp_adresse);
            $stmt->bindParam(":code_postal", $this->code_postal);
            $stmt->bindParam(":tel", $this->tel);
            $stmt->bindParam(":ind_tel", $this->ind_tel);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":ind_mobile", $this->ind_mob);
            $stmt->bindParam(":date_creation", $this->date_creation);
            $stmt->bindParam(":longitude", $this->longitude);
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":etat", $this->etat);
            $result = $stmt->execute();

            if($result=== true){
                $last_id = $pdo->lastInsertId();
                $code_api = JWTAuth::getToken($last_id, $this->username);
                $this->id = $last_id;
                $this->updateToken($pdo,$code_api);

                $data = $this->userByid($pdo);
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : insert problem");
                $data['error'] = $dt;
            }
        } catch (PDOException $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        } catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    /************************************ update user's informations ******************************/
    public function updateUser($pdo){
        try {
            // Gets the user into the database
            $sql = "UPDATE ProUsers SET email = :email, username = :username, genre = :genre, prenom= :prenom, nom = :nom, date_naissance = :date_naiss, comp_adresse = :comp_adresse, code_postal = :code_postal, tel = :tel, ind_tel = :ind_tel, mobile = :mobile, ind_mobile = :ind_mobile, longitude = :longitude, latitude = :latitude, password = :password, etat = :etat WHERE id = :id ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":date_naiss", $this->date_naissance);
            $stmt->bindParam(":comp_adresse", $this->comp_adresse);
            $stmt->bindParam(":code_postal", $this->code_postal);
            $stmt->bindParam(":tel", $this->tel);
            $stmt->bindParam(":ind_tel", $this->ind_tel);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":ind_mobile", $this->ind_mob);
            $stmt->bindParam(":longitude", $this->longitude);
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":etat", $this->etat);
            $stmt->bindParam(":id", $this->id);
            $result = $stmt->execute();

            if($result === true){


                $data = $this->userByid($pdo);
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : update problem");
                $data['error'] = $dt;
            }
        }catch (PDOException $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $dt;
        }catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getApiCode()
    {
        return $this->api_code;
    }

    /**
     * @param mixed $api_code
     */
    public function setApiCode($api_code)
    {
        $this->api_code = $api_code;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getCompAdresse()
    {
        return $this->comp_adresse;
    }

    /**
     * @param mixed $comp_adresse
     */
    public function setCompAdresse($comp_adresse)
    {
        $this->comp_adresse = $comp_adresse;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal)
    {
        $this->code_postal = $code_postal;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getIndTel()
    {
        return $this->ind_tel;
    }

    /**
     * @param mixed $ind_tel
     */
    public function setIndTel($ind_tel)
    {
        $this->ind_tel = $ind_tel;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getIndMob()
    {
        return $this->ind_mob;
    }

    /**
     * @param mixed $ind_mob
     */
    public function setIndMob($ind_mob)
    {
        $this->ind_mob = $ind_mob;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * @param mixed $last_update
     */
    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
    }


}