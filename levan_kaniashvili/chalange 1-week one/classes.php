<?php


$name1 = '';
$lastname1 = '';
$image1 = "";
$errors1 = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name1 = $_POST['name'];
    $lastname1 = $_POST['lastname'];
    $image1 = $_FILES['image'];
    $errors1 = [];
}


    class Person {
        public $name;
        public $lastname;
        public $errors = [];
        public $image;

   

        public function __construct($name, $lastname, $errors, $image){
            $this->name = $name;
            $this->lastname = $lastname;
            $this->errors = $errors;
            $this->image = $image;
        }

        public function validationfields(){
            
            if(empty( $this->name) || empty( $this->lastname)){
                
                return $this->errors = "Fill Empty Fields";
            }
            elseif(!preg_match( '/^[a-zA-Z ]*$/', $this->name ) || !preg_match( '/^[a-zA-Z ]*$/', $this->lastname)  ){
                
                return $this->errors = "Required Only Characters";
            }  
            else{
                return "Wellcome to Bitoid, PHP Juniors Club:  " ."$this->name" .  " $this->lastname";
            }
        }


        public function photovalidation(){
           if(isset($_FILES['image'])){
              return move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);
           }else{
               return ;
           }
        }


    }



$result = new Person($name1, $lastname1, $errors1, $image1);

$result1 = $result->validationfields();

$result2 = $result->photovalidation();

// $validation = $result->invalidfield();
// var_dump($result1);
// var_dump($errors1);
//var_dump($_FILES);
//var_dump($image1);



