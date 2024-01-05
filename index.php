<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ceasar</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Raleway:wght@200;300;400;500;700&display=swap" rel="stylesheet">
   <style>
   body {
      margin: 0px;
      background-color: rgba(0,0,0, 0.05);
      font-family: 'Raleway', sans-serif;
   }

   body * {
      font-family: 'Raleway', sans-serif;
   }

   .header-container{
      background-color: rgba(0,0,0, 0.05);
      background-image: url('background-img.jpg');
      background-size: cover;
      height: 250px;
   }

   .card {
      height: calc(100vh - 218px);
      background-color: white;
      border-radius: 8px;
      margin-top: -22px;
      margin-left: 20px;
      margin-right: 20px;
      padding: 40px;
      display: flex;
      flex-direction: column;
   }

   form {
      display: flex;
      flex-direction: column;
      margin-top: 15px;
      /*background-color: rgba(0,0,0, 0.05);*/
   }

   h2, h4 {
      display: block;
      margin-left: auto;
      margin-right: auto;
   }

   h4 {
      font-size: 16px;
      font-weight: normal;
   }

   input {
      background-color: rgba(0,0,0, 0.05);
      height: 40px;
      width: 45%;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid rgba(0,0,0, 0.01);
      display: block;
      margin-left: auto;
      margin-right: auto;
      padding: 5px;
   }

   button {
      background-color: black;
      color: white;
      height: 30px;
      width: 45%;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid rgba(0,0,0, 0.01);
      cursor: pointer;
      display: block;
      margin-left: auto;
      margin-right: auto;
   }

   button:hover {
      background-color: rgba(0,0,0, 0.5);
   }

   .result {
      display: block;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 30px;
      font-size: 16px;
      font-weight: bold;

   }
   </style>

</head>

<body>
   <div class='header-container'></div>

   <?php
   $sondernChars = [' ', 'ü', 'ö', 'ä', '/', '?', '-', '´', 'ß', '#', '_', '=', ',', '!', '"', '§', '$', '%', '.', ';', ':', '&', '(', ')', '<', '>', '@'];
   ?>

   <div class='card'>

   <form>
      <h2>Text Verschlüsseln</h2>
      <input name='encrypt' type="text" placeholder='Fügen Sie heir ein Text hinzu...'>

      <div class="result">

      <?php

      if(isset($_GET['encrypt'])) {

         echo '<h4>Zu verschlüsseln: ' . $_GET['encrypt'] . '</h4>';

         $text = strtolower($_GET['encrypt']);
         $arrey = str_split($text);

         echo '<b>Dein Wort lautet: </b>';

         foreach($arrey as $char) {
            if(in_array($char, $sondernChars)) {
               echo $char;
            } else {
               echo toChar(toNum($char) + 10);
            }
         }
      }

      ?>

      </div>
      
      <button type='submit'>VERSCHLÜSSELN</button>

   </form>

   <form>
      <h2>Text Entschlüsseln</h2>
      <input name='decrypt' type="text" placeholder='Fügen Sie heir ein Text hinzu...'>
      <div class="result">

<?php

if(isset($_GET['decrypt'])) {

   echo '<h4>Zu entschlüsseln: ' . $_GET['decrypt'] . '</h4>';

   $text = strtolower($_GET['decrypt']);
   $arrey = str_split($text);


   echo '<b>Entschlüsseltes Wort lautet: </b>';

   foreach($arrey as $char) {
      if(in_array($char, $sondernChars)) {
      echo $char;
   } else {
      echo toChar(toNum($char) - 10);
   }
   }
}

?>

</div>
      <button type='submit'>ENTSCHLÜSSELN</button>
   </form>
   </div>
</body>
</html>

<?php

function toNum($data) {
   $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                      'f', 'g', 'h', 'i', 'j',
                      'k', 'l', 'm', 'n', 'o',
                      'p', 'q', 'r', 's', 't',
                      'u', 'v', 'w', 'x', 'y',
                      'z'
                     );
   $alpha_flip = array_flip($alphabet);
   $return_value = -1;
   $length = strlen($data);
   for ($i = 0; $i < $length; $i++) {
         $return_value += ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
   }
   return $return_value;
};

function toChar($number) {
   if($number < 0) {
      $number += 26;
   }

   if($number > 25) {
      $number -= 26;
   }

   $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                      'f', 'g', 'h', 'i', 'j',
                      'k', 'l', 'm', 'n', 'o',
                      'p', 'q', 'r', 's', 't',
                      'u', 'v', 'w', 'x', 'y',
                      'z'
                     );
   return $alphabet[$number];
};

?>