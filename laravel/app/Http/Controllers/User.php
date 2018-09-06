<?php
namespace App\Http\Controllers;

use App\Http\Controllers;

class User extends Biblioglobus
{
    function __construct()
    {
        parent::__construct('user');
        //echo "Class is ready ($this->tableName)";
    }

    public function addNewUser($email, $passwd, $firstname, $lastname)
    {
        if($this->isUserByEmail($email)!=0){
            return 0;
        }
        else{
            try{
                $passwd = md5($passwd);
                $query = "INSERT INTO bookuser (useremail, userpassword, userfirstname, userlastname) VALUES (\"$email\", \"$passwd\", \"$firstname\", \"$lastname\")";
                $result = $this->dbh->query($query);
            } catch (PDOException $e){
                die('Не удалось записать комментарий: ' . $e->getMessage());
            }
            return 1;
        }
    }

    public function isUserByEmail($email)
    {
        try {
            $query = "SELECT COUNT(*) FROM bookuser WHERE useremail='$email'";
            $result = $this->dbh->query($query);
        } catch (PDOException $e) {
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        return $result->fetchColumn();
    }

    public function checkUser($email, $passwd){
        $userData = 0;
        try{
            $passwd=md5($passwd);
            $query = "SELECT userid FROM bookuser WHERE useremail=\"$email\" AND userpassword=\"$passwd\"";
            $result = $this->dbh->query($query);
        } catch (PDOException $e){
            die('Не удалось прочитать записи из таблицы: ' . $e->getMessage());
        }
        foreach($row = $result->fetchAll(PDO::FETCH_ASSOC) as $list=>$elements){
            $userData = $elements['userid'];
        }
        return $userData;
    }
}