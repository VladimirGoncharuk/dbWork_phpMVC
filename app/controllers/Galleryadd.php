<?php
namespace App\controllers;
session_start();
class Galleryadd extends  \App\core\Controller
{
    public function index(){
        $this->view->render('gallery.php','template.phtml');
        $this->actionGetcommentsImage ();  
        print_r ($_SESSION['nameUser']);
    } 

    public function load(){
    $errors = $this->loader();
        if(!empty($errors)){
        http_response_code(401);
        echo json_encode([
          'errors' => $errors
        ]);
    }
    }

    public function loader(){
        $errors = [];
        if (!empty($_FILES)) {    
            for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                $fileName = $_FILES['files']['name'][$i];
                if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
                    $errors[]['size'] = 'Недопустимый размер файла ' . $fileName;
                    continue;
                }
                if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
                    $errors[]['type'] = 'Недопустимый формат файла ' . $fileName;
                    continue;
                }
                $filePath = UPLOAD_DIR . '/' . basename($fileName);
         
                if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath)) {
                    $errors[]['load'] = 'Ошибка загрузки файла ' . $fileName;
                    continue;
                }
                \App\models\Db::insertImage($filePath);    
            }
        }
    return $errors;
    } 

    public static function actionGetcommentsImage (){
        $images = \App\models\Db::getImageList();
        $comments = \App\models\Db::getCommentsList(); 
        if(!empty($images)): 
        foreach($images as $image): ?>
           <div class="block_user">
             <div>
                 <img id="img_id<?= $image['id'] ?>" class="img rounded float-start pt-2" src=" <?= $image['image'] ?>" alt=" <?= $image['id'] ?>"> 
             <div class="text">Кликните по картинке,чтобы оставить комментарий <br> Чтобы удалить комментарий или картинку кликните правой кнопкой мыши!  </div>                    
           </div>
           <div class="comments_user"> 
                 <?php //Вывод комментариев 
                 foreach($comments as $comment){
                     if($comment['image_id'] === $image['id']){       
                       ?>
                     <p class="text" id="comment_id<?= $comment['comments_id'] ?>">
                     <?php print_r($comment['comment']); ?> <br><?php print_r($comment['author']) ; ?><br><?php print_r($comment['created_at'] );?>
                     </p> 
                     <script>  
                     // вызов формы для удаления  комментария
                      document.querySelector(`#comment_id<?= $comment['comments_id'] ?>`).addEventListener("contextmenu", function(e) {
                      e.preventDefault();    
                      document.querySelector(".commentsDelete").classList.toggle("d-block")
                      var div = document.getElementById('delete_id_image');
                     div.innerHTML = 'c<?= $comment['comments_id'] ?>';          
                     });
                     </script>
                <?php }
                }?>
           </div>
           </div>
     
       <script> 
       //вызов формы для добавления комментария
       document.querySelector(`#img_id<?= $image['id'] ?>`).onclick = function() {
       document.querySelector(".comments").classList.toggle("d-block") 
       var div = document.getElementById('text_id_image');
        div.innerHTML = '<?= $image['id'] ?>';
       }
       // вызов формы для удаления картинки 
       
       document.querySelector(`#img_id<?= $image['id'] ?>`).addEventListener("contextmenu", function(e) {
        e.preventDefault();
       document.querySelector(".commentsDelete").classList.toggle("d-block")
       var div = document.getElementById('delete_id_image');
       div.innerHTML = 'i<?= $image['id'] ?>';          
        })
       </script>   
       <?php endforeach; ?>
       <?php endif; ?>
       <?php
       }
       public static function setCommentsImage (){
        $comment = $_POST['textcomment'];
        $id_image = $_POST['text_id_image'];
        if(!empty($comment)){
        \App\models\Db::insertComments($id_image,$comment);
        }else{
            $errors[]['comment'] = 'Введите свой комментарий';
            http_response_code(401);
            echo json_encode([
              'errors' => $errors
            ]);   
        }
       }
       public static function deleteCommentsImage (){    
        $id_del=trim($_POST['delete_id_image']);
        $id = substr($id_del, 1); 
        $identificator = substr($id_del,0,1);   
        if(($identificator === 'i') ){
            if(isset($_SESSION['nameUser']) && !empty($_POST['delete_id_image']) && isset($_POST['checkbox'])){ 
                $user = \App\models\Db::getUserByName($_SESSION['nameUser']) ;  
                $userСompare = \App\models\Db::getUserByIdImage($id);
                if($user['id']===$userСompare['id_name']){
                 \App\models\Db::deleteImageComments($id);      
                }else{ $errors[]['img'] = 'Нет прав для этого действия ';
                http_response_code(401);
                echo json_encode([
                  'errors' => $errors
                ]);
             }  
                     
            } elseif(!isset($_SESSION['nameUser'])){
                $errors[]['img'] = 'Авторизуйтесь для выполнения действия ';
                http_response_code(401);
                echo json_encode([
                  'errors' => $errors
                ]);   
            }elseif(empty($_POST['delete_id_image']) || !isset($_POST['checkbox'])){
                $errors[]['img'] = 'Подтвердите удаление';
                http_response_code(401);
                echo json_encode([
               'errors' => $errors
            ]);   
        }
        }elseif($identificator === 'c'){
            if(isset($_SESSION['nameUser']) && !empty($_POST['delete_id_image']) && isset($_POST['checkbox'])){ 
                $user = $_SESSION['nameUser'] ;  
                $userСompare = \App\models\Db::getUserByIdComment($id);
                if($user===$userСompare['author']){
                 \App\models\Db::deleteComments($id);      
                }else{ $errors[]['img'] = 'Нет прав для этого действия ';
                http_response_code(401);
                echo json_encode([
                  'errors' => $errors
                ]);
             }  
                     
            } elseif(!isset($_SESSION['nameUser'])){
                $errors[]['img'] = 'Авторизуйтесь для выполнения действия ';
                http_response_code(401);
                echo json_encode([
                  'errors' => $errors
                ]);   
            }elseif(empty($_POST['delete_id_image']) || !isset($_POST['checkbox'])){
                $errors[]['img'] = 'Подтвердите удаление';
                http_response_code(401);
                echo json_encode([
               'errors' => $errors
            ]);   
        }    
        }
        
        
}
}



