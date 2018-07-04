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
    private $genre;   // genre of the user
    private $prenom;   // firstname  of the user
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
    private $last_update;

    /**
     * ProUsers constructor.
     * @param $id
     * @param $email
     * @param $api_code
     * @param $genre
     * @param $prenom
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
     * @param $last_update
     */
    public function __construct($id, $email, $api_code, $genre, $prenom, $date_naissance, $comp_adresse, $code_postal, $tel, $ind_tel, $mobile, $ind_mob, $date_creation, $longitude, $latitude, $last_update)
    {
        $this->id = $id;
        $this->email = $email;
        $this->api_code = $api_code;
        $this->genre = $genre;
        $this->prenom = $prenom;
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
        $this->last_update = $last_update;
    }


    /**
     * Destructor - invoked just before the instance is deallocated.
     */
    public function __destruct() {
        echo true;
        //echo 'Destructed instance ', $this, ' of ', __CLASS__, ".\n";
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