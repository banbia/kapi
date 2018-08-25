<?php
/**
 * Created by PhpStorm.
 * User: nour
 * Date: 08/07/18
 * Time: 08:10 م
 */

class HistoriqueLog
{
    private $id;
    private $date_log;
    private $description;
    private $table_name;
    private $action_id;
    private $pro_user;
    private $etat;

    /**
     * HistoriqueLog constructor.
     * @param $id
     * @param $date_log
     * @param $description
     * @param $table_name
     * @param $action_id
     */
    public function __construct($id, $date_log, $description, $table_name, $action_id,$pro_user,$etat,$last_update)
    {
        $this->id = $id;
        $this->date_log = $date_log;
        $this->description = $description;
        $this->table_name = $table_name;
        $this->action_id = $action_id;
        $this->pro_user = $pro_user;
        $this->etat = $etat;
        $this->lat_update = $last_update;
    }
    /************************* find log by id *********************/
    public function logByid($pdo){
        try {
            $sql = "SELECT * FROM Historique_Log WHERE id = :id limit 0,1";
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
    /************************* find log by id *********************/
    public function logByProuserPage($pdo,$nb,$page){
        try {

            // build query

            $offset = $page * $nb;
            $n = intval($nb);

            $sql = "SELECT * FROM Historique_Log WHERE pro_user = :pro_user order by date_log desc limit :ofset,:nb";
            $req = $pdo->prepare($sql);
            $req->bindParam(':pro_user', $this->pro_user, PDO::PARAM_INT);
            $req->bindParam(':ofset', $o, PDO::PARAM_INT);
            $req->bindParam(':nb', $n, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0){
                $dt = $req->fetchAll();
                $data['success'] = $dt;
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong id");
                $data['error'] = $dt;
            }

        }catch(PDOException $ex){
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : database error","ee"=>$ex);
            $data['error'] = $dt;
        }catch (Exception $e) {
            $dt = array("code"=>500,"message"=>"500  Internal Server Error : server error");
            $data['error'] = $dt;
        }
        return $data;
    }
    public function logByProuser($pdo){
        try {

            // build query

            $sql = "SELECT * FROM Historique_Log WHERE pro_user = :pro_user order by date_log desc limit 0,10 ";
            $req = $pdo->prepare($sql);
            $req->bindParam(':pro_user', $this->pro_user, PDO::PARAM_INT);
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
    /**************************** list user's log from start date to end date**********************/
    public function listBydates($pdo,$start,$end){
        try {
            $sql = "SELECT * FROM Historique_Log WHERE pro_user = :pro_user and date_log >= :start and date_log <= :endd order by date_log desc limit 0,10";
            $req = $pdo->prepare($sql);
            $req->bindParam(':pro_user', $this->pro_user, PDO::PARAM_INT);
            $req->bindParam(':start', $start, PDO::PARAM_STR);
            $req->bindParam(':endd', $end, PDO::PARAM_STR);
            $req->execute();
            if($req->rowCount()>0){
                $dt = $req->fetchAll();
                $data['success'] = $dt;
            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong user id");
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
    /**************************** delete log **************************/
    public function deleteLog($pdo){
        try {
            $sql = "SELECT * FROM Historique_Log WHERE id = :id and pro_user = :user limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->bindParam(':user', $this->pro_user, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0) {
                // update status into -1 => deleted
                $sql = "UPDATE Historique_Log SET etat = '-1' WHERE id = :id";
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
    /************************************ insert new log ******************************/
    public function addLog($pdo){
        try {

            // Gets the log into the database
            //0 ajouté
            $sql = "INSERT INTO Historique_Log VALUES ('', :datec, :descr, :tablen, :action_id, :pro_user,'0', :lastu ) ";
            $date_creation = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":descr", $this->description);
            $stmt->bindParam(":tablen", $this->table_name);
            $stmt->bindParam(":action_id", $this->action_id);
            $stmt->bindParam(":pro_user", $this->pro_user);
            $stmt->bindParam(":datec", $date_creation);
            $stmt->bindParam(":lastu", $date_creation);
            $result = $stmt->execute();

            if($result=== true){
                $last_id = $pdo->lastInsertId();
                $this->id = $last_id;
                $data = $this->logByid($pdo);
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
    /************************************ update logs's informations ******************************/
    public function updateLog($pdo){
        try {
            $sql = "SELECT * FROM Historique_Log WHERE id = :id and pro_user = :user limit 0,1";
            $req = $pdo->prepare($sql);
            $req->bindParam(':id', $this->id, PDO::PARAM_INT);
            $req->bindParam(':user', $this->pro_user, PDO::PARAM_INT);
            $req->execute();
            if($req->rowCount()>0) {
                // Gets the user into the database
                $sql = "UPDATE Historique_Log SET descrirpion = :descr, table_name = :tablen, action_id = :actionn WHERE id = :id ";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":descr", $this->description);
                $stmt->bindParam(":tablen", $this->table_name);
                $stmt->bindParam(":actionn", $this->action_id);
                $stmt->bindParam(":id", $this->id);
                $result = $stmt->execute();

                if($result === true){
                    $data = $this->logByid($pdo);
                }else{
                    $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : update problem");
                    $data['error'] = $dt;
                }

            }else{
                $dt = array("code"=>422,"message"=>"422 Unprocessable Entity : wrong data");
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
    public function getLatUpdate()
    {
        return $this->lat_update;
    }

    /**
     * @param mixed $lat_update
     */
    public function setLatUpdate($lat_update)
    {
        $this->lat_update = $lat_update;
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
    public function getProUser()
    {
        return $this->pro_user;
    }

    /**
     * @param mixed $pro_user
     */
    public function setProUser($pro_user)
    {
        $this->pro_user = $pro_user;
    }


    /**
     * @return mixed
     */
    public function getDateLog()
    {
        return $this->date_log;
    }

    /**
     * @param mixed $date_log
     */
    public function setDateLog($date_log)
    {
        $this->date_log = $date_log;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->table_name;
    }

    /**
     * @param mixed $table_name
     */
    public function setTableName($table_name)
    {
        $this->table_name = $table_name;
    }

    /**
     * @return mixed
     */
    public function getActionId()
    {
        return $this->action_id;
    }

    /**
     * @param mixed $action_id
     */
    public function setActionId($action_id)
    {
        $this->action_id = $action_id;
    }

}