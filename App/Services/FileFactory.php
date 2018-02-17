<?php namespace App\Services;

 class FileFactory {
     protected $folder;
     protected $name = '';

     function __construct($folder) {
        $this->folder = $folder;
     }

     public function getName() {
         return $this->name;
     }

     public function save(array $file) {
         $info = pathinfo($file['name']);
         $ext = $info['extension'];
         $new_name = $this->generateRandomString() . '.' .$ext;

         $this->name = $new_name;

         $target = $this->folder . $new_name;
         move_uploaded_file( $file['tmp_name'], $target);
     }

     private function generateRandomString($length = 10) {
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $charactersLength = strlen($characters);
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
             $randomString .= $characters[rand(0, $charactersLength - 1)];
         }
         return $randomString;
     }
 }