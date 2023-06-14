<?php
namespace App\models;
session_start();
/**

 * @return PDO;

 */
class Db {
static function  get_connection()
{
    return new \PDO('mysql:host=localhost;dbname=registration', 'root', '');
}

static function insert(array $data)
{
    $query = 'INSERT INTO users (name, email, password, created_at) VALUES(?, ?, ?, ?)';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}

static function  getUserByEmail(string $email)
{
    $query = 'SELECT * FROM users WHERE email = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}

static function  checkUser(string $name)
{
    $query = 'SELECT password FROM users WHERE name = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$name]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}

static function  getUserByName(string $name)
{ 
    $query = 'SELECT * FROM users WHERE name = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$name]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}

static function getImageList()
{
    $query = 'SELECT id,image FROM image ORDER BY id DESC';
    $db = Db::get_connection();
    return $db->query($query,\PDO::FETCH_ASSOC);
}

public static function insertImage(string $filePath)
{ 
   $db = Db::get_connection();
    $name = $_SESSION['nameUser'];
    $id_name = Db::getUserByName($name);
    $query = 'INSERT INTO image (id_name, image) VALUES (:id_name, :image)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':image', $filePath);
    $stmt->bindValue(':id_name', $id_name['id']);
    print_r ($id_name['id']);
    return $stmt->execute(); 
}

public static function insertComments(string $id_image,string $comment)
{
    $db = Db::get_connection();
    $created_at=(new \DateTime())->format('Y-m-d H:i:s');
    $author = $_SESSION['nameUser'];
    $query = 'INSERT INTO comments (id_image, comment,created_at,author) VALUES (:id_image, :comment, :created_at,:author)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id_image', $id_image);
    $stmt->bindValue(':comment', $comment);
    $stmt->bindValue(':created_at', $created_at); 
    $stmt->bindValue(':author', $author);   
    return $stmt->execute(); 
}

static function getCommentsList()
{
    $query = 'SELECT comments.id as comments_id ,image.id as image_id,comment,comments.created_at as created_at,author FROM comments JOIN image ON comments.id_image = image.id JOIN users ON image.id_name = users.id ORDER BY created_at DESC';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result ;
}

public static function deleteImageComments(string $id){
    $query = 'DELETE FROM image WHERE image.id = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute([$id]);   
}

public static function deleteComments(string $id){
    $query = 'DELETE FROM comments WHERE comments.id = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute([$id]);
    
}
static function  getUserByIdImage(string $id)
{ 
    $query = 'SELECT id_name FROM image WHERE id = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}
static function  getUserByIdComment(string $id)
{ 
    $query = 'SELECT author FROM comments WHERE id = ?';
    $db = Db::get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}


}
