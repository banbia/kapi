<?php
/**
 * Created by PhpStorm.
 * User: nour
 * Date: 17/07/18
 * Time: 08:32 م
 */

class ProuserClients
{
    private $id;
    private $prouser;
    private $client;
    private $email;
    private $etat;

    /**
     * ProuserClients constructor.
     * @param $id
     * @param $prouser
     * @param $client
     * @param $email
     */
    public function __construct($id, $prouser, $client, $email,$etat)
    {
        $this->id = $id;
        $this->prouser = $prouser;
        $this->client = $client;
        $this->email = $email;
        $this->etat = $etat;
    }
    /**************************** delete **************************/
    public function deleteLink($pdo){
        try {
            $sql = "DELETE FROM Prouser_client WHERE client = :client and pro_user = :pro";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->bindParam(':pro', $this->pro_user, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0) {


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
    /******************************** add link ****************************/
    public function addLink($pdo){
        try {
            $sql = "INSERT INTO Prouser_client VALUES ('',:pro,:client,:email,'1')";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->pro_user, PDO::PARAM_INT);
            $req->bindParam(':pro', $this->client, PDO::PARAM_INT);
            $req->bindParam(':email', $this->email, PDO::PARAM_STR);
            $req->execute();

        } catch (PDOException $e) {
            $data = array("code"=>500,"message"=>"500  Internal Server Error : database error");
            $data['error'] = $data;
        } catch (Exception $e) {
            $data = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $data;
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
    public function getProuser()
    {
        return $this->prouser;
    }

    /**
     * @param mixed $prouser
     */
    public function setProuser($prouser)
    {
        $this->prouser = $prouser;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
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

}