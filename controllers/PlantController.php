

<?php
include "./models/Plant.php";
    class PlantController{

        public static function index(){
          $plants = Plant::all();
          return $plants;
        }

        public static function show()
        {
            $plant = Plant::find($_POST['id']);
            return $plant;
        }

        public static function store()
        {
            session_start();
            $hasErrors = false;
            if(empty($_POST['name'])){
                $hasErrors = true;
                $_SESSION['errors']['name'] = "Name is required";
                
            }
            if(empty($_POST['nameL'])){
                $hasErrors = true;
                
                return true;
            }            
            if(empty($_POST['age'])){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age is required";
                return true;
            }
            if(empty($_POST['height'])){
                $hasErrors = true;
                $_SESSION['errors']['height'] = "Height is required";
                return true;
            }
                if(strlen($_POST['name']) < 3){
                    $hasErrors = true;
                    $_SESSION['errors']['name'] = "Name must be at least 3 characters";
                    return true;
            }
            if(strlen($_POST['nameL']) < 3){
                $hasErrors = true;
                $_SESSION['errors']['nameL'] = "NameL must be at least 3 characters";
                return true;
            }
            if(strlen($_POST['age']) < 1){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age must be at least 1";
                return true;
            }
            if(strlen($_POST['height']) < 1){
                $hasErrors = true;
                $_SESSION['errors']['height'] = "Height must be at least 1";
                return true;
            }
            if($hasErrors){
                return true;
            }
          
            if($_POST['age'] == 0 && $_POST['height'] == 0){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age and Height cannot be 0";
                return true;
            }
            
            if(!is_numeric($_POST['age']) || !is_numeric($_POST['height'])){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age and Height must be a number";
                return true;
            }
            
            if($_POST['age'] < 0 || $_POST['height'] < 0){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age and Height cannot be negative";
                return true;
            }
            
            if($_POST['age'] > 100 || $_POST['height'] > 1000000){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age and Height cannot be more then 100";
                return true;
            }
        
            if(is_numeric($_POST['name']) || is_numeric($_POST['nameL'])){
                $hasErrors = true;
                $_SESSION['errors']['name'] = "Name and NameL cannot be numbers";
                return true;
            }
            
            if(strlen($_POST['name']) > 19){
                $hasErrors = true;
                $_SESSION['errors']['name'] = "Name too long";
                return true;
            }
            if(strlen($_POST['nameL']) > 22){
                $hasErrors = true;
                $_SESSION['errors']['nameL'] = "NameL too long";
                return true;
            }
            else{
                Plant::create();
                return false;
                die;
            }
        }

        public static function update()
        {
            session_start();
            $hasErrors = false;
            if(empty($_POST['name'])){
                $hasErrors = true;
                $_SESSION['errors']['name'] = "Name is required";
                echo "Name is required";
            }
            
            if(empty($_POST['nameL'])){
                $hasErrors = true;
                $_SESSION['errors']['nameL'] = "NameL is required";
                return true;
            }
            
            if(empty($_POST['age'])){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age is required";
                return true;
            }
            
            if(empty($_POST['height'])){
                $hasErrors = true;
                $_SESSION['errors']['height'] = "Height is required";
                return true;
            }

            if(strlen($_POST['name']) < 3){
                $hasErrors = true;
                $_SESSION['errors']['name'] = "Name must be at least 3 characters";
                return true;
            }

            if(strlen($_POST['nameL']) < 3){
                $hasErrors = true;
                $_SESSION['errors']['nameL'] = "NameL must be at least 3 characters";
                return true;
            }

            if(!is_numeric($_POST['age'])){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age must be a number";
                return true;
            }

            if(strlen($_POST['age']) < 1){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age must be at least 1";
                return true;
            }

            if(strlen($_POST['height']) < 1){
                $hasErrors = true;
                $_SESSION['errors']['height'] = "Height must be at least 1";
                return true;
            }

            if($_POST['age'] == 0 && $_POST['height'] == 0){
                $hasErrors = true;
                $_SESSION['errors']['age'] = "Age and Height cannot be 0";
                return true;
            }

            if($hasErrors){
                return true;
            }else{
                Plant::update();
                return false;
                die;
            }
        }

        public static function destroy()
        {
            Plant::destroy();
        }
    }

?>