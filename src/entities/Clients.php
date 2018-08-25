<?php
/**
 * Created by PhpStorm.
 * User: nour
 * Date: 17/07/18
 * Time: 08:16 م
 */

class Clients
{
    private $id;
    private $email;
    private $username;
    private $password;
    private $genre;
    private $nom;
    private $prenom;
    private $date_naissance;
    private $com_adresse;
    private $code_postal;
    private $tel;
    private $ind_tel;
    private $mobile;
    private $ind_mobile;
    private $date_creation;
    private $longitude;
    private $latitude;
    private $etat;
    private $last_update;

    /**
     * Clients constructor.
     * @param $id
     * @param $email
     * @param $username
     * @param $password
     * @param $genre
     * @param $nom
     * @param $prenom
     * @param $date_naissance
     * @param $com_adresse
     * @param $code_postal
     * @param $tel
     * @param $ind_tel
     * @param $mobile
     * @param $ind_mobile
     * @param $date_creation
     * @param $longitude
     * @param $latitude
     * @param $etat
     * @param $last_update
     */
    public function __construct($id, $email, $username, $password, $genre, $nom, $prenom, $date_naissance, $com_adresse, $code_postal, $tel, $ind_tel, $mobile, $ind_mobile, $date_creation, $longitude, $latitude, $etat, $last_update)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->genre = $genre;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->com_adresse = $com_adresse;
        $this->code_postal = $code_postal;
        $this->tel = $tel;
        $this->ind_tel = $ind_tel;
        $this->mobile = $mobile;
        $this->ind_mobile = $ind_mobile;
        $this->date_creation = $date_creation;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->etat = $etat;
        $this->last_update = $last_update;
    }


    /************************* find client by id *********************/
    public function clientByid($pdo){
        try {
            $sql = "SELECT * FROM Clients WHERE id = :id limit 0,1";
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
    /************************* find all client by pro user *********************/
    public function clientsByPro($pdo,$pro){
        try {
            $sql = "SELECT * FROM Clients c INNER JOIN Prouser_client p on c.id = p.client WHERE p.pro_user = :pro limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':pro', $pro, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0){
                $dt = $req->fetchAll();
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
    /************************** find client by his email *********************/
    public function userByEmail($pdo){

        //get email
        $email = $this->email;

        // Gets the client data from the database
        $sql = "SELECT * FROM ProUsers WHERE email = :mail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mail", $email);
        $stmt->execute();
        $user = $stmt->fetchObject();

        // If client exist
        if ($user) {
            $this->setId($user->id);
        }
        return 1;
    }
    /**************************** delete client **************************/
    public function deleteClient($pdo,$client){
        try {

            $sql = "SELECT * FROM Prouser_client WHERE id = :id and client = :cl limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->bindParam(':id', $client, PDO::PARAM_INT);
            $req->execute();

            if($req->rowCount()>0) {

                // update status into -1 => deleted
                $sql = "UPDATE Prouser_client SET etat = '-1' WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $this->id);
                $stmt->execute();

                $dt = array("code" => 200, "message" => "200  OK");
                $data['succes'] = $dt;

            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong data");
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
    public function addClient($pdo,$prouser,$valid_api){
        try {

            // Gets the user into the database
            $sql = "INSERT INTO Clients VALUES ('', :email, :username, :password, :genre, :nom, :prenom, :date_naiss, :comp_adresse, :code_postal, :tel, :ind_tel, :mobile,:ind_mobile, :date_creation, :longitude, :latitude,:etat, '' ) ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":username", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":nom", $this->nom);
            $stmt->bindParam(":prenom", $this->prenom);
            $stmt->bindParam(":date_naiss", $this->date_naissance);
            $stmt->bindParam(":comp_adresse", $this->com_adresse);
            $stmt->bindParam(":code_postal", $this->code_postal);
            $stmt->bindParam(":tel", $this->tel);
            $stmt->bindParam(":ind_tel", $this->ind_tel);
            $stmt->bindParam(":mobile", $this->mobile);
            $stmt->bindParam(":ind_mobile", $this->ind_mobile);
            $stmt->bindParam(":date_creation", $this->date_creation);
            $stmt->bindParam(":longitude", $this->longitude);
            $stmt->bindParam(":latitude", $this->latitude);
            $stmt->bindParam(":etat", $this->etat);
            $result = $stmt->execute();

            if($result=== true){
                if($valid_api === true){
                    $last_id = $pdo->lastInsertId();
                    // Gets the user into the database
                    $sql = "INSERT INTO Prouser_client VALUES ('', :prouser, :client, :email, :etat)";

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":prouser", $prouser);
                    $stmt->bindParam(":client", $last_id);
                    $stmt->bindParam(":email", $this->email);
                    $stmt->bindParam(":etat", $this->etat);
                    $result = $stmt->execute();
                }


                $this->id = $last_id;

                $data = $this->clientByid($pdo);
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
    public function getIndMobile()
    {
        return $this->ind_mobile;
    }

    /**
     * @param mixed $ind_mobile
     */
    public function setIndMobile($ind_mobile)
    {
        $this->ind_mobile = $ind_mobile;
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
    public function getComAdresse()
    {
        return $this->com_adresse;
    }

    /**
     * @param mixed $com_adresse
     */
    public function setComAdresse($com_adresse)
    {
        $this->com_adresse = $com_adresse;
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