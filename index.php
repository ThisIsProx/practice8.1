<HTML lang="en">
 <HEAD>
     <TITLE>«Суперглобальні змінні PHP</TITLE>
     <link rel="stylesheet" type="text/css" href="style.css">
 </HEAD>
 <BODY>
 <form method="get" action = "">

     <label>
         <input type="text" name="email">
     </label>
 </form>
 <form method="post" action="" enctype="multipart/form-data">
     Name: <label>
         <input type="text" name="fname">
         <input type="file" name='myfile'>
         <br/>
         <input type="submit" value="upload">
     </label>
 </form>
 <table>
     <thead>
     <tr>
         <th scope="col">Позначення змінної</th>
         <th scope="col">Характеристика</th>
         <th scope="col">Отримане значення</th>
     </tr>
     </thead>
     <tbody>
     <tr>
         <th scope="row">$GLOBALS</th>
         <td>Посилання на всі зміни глобальної області видимості</td>
         <td><?php
             function test() {
                 $foo = "Локальна змінна";

                 echo '$foo в глобальній зоні видомості: ' . $GLOBALS["foo"] . "<br>";
                 echo '$foo в данній зоні видимості: ' . $foo;
             }

             $foo = "Приклад";
             test();
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_SERVER</th>
         <td>Інформація про сервер та середовище виконання</td>
         <td><?php
             echo $_SERVER['SERVER_NAME'] . "<br>";
             echo $_SERVER['SERVER_ADDR'] . "<br>";
             echo $_SERVER['SERVER_ADMIN']. "<br>";
             echo $_SERVER['SERVER_PORT']. "<br>";
             echo $_SERVER['SERVER_PROTOCOL']. "<br>";
             echo $_SERVER['SERVER_SIGNATURE']. "<br>";
             echo $_SERVER['SERVER_SOFTWARE']. "<br>";
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_GET</th>
         <td>Асоціативний масив змінних, переданих скрипту через параметри URL</td>
         <td><?php
             $get_email=$_GET["email"];
             echo "email - " . $_GET["email"];
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_POST</th>
         <td>Асоціативний масив даних, переданих скрипту через HTTP методом POST при використанні application/x-www-form-urlencoded або multipart/form-data у заголовку Content-Type запиту HTTP.</td>
         <td><?php
             if ($_SERVER["REQUEST_METHOD"] == "POST") {
                 $name = $_POST['fname'];
                 if (empty($name)) {
                     echo "Name is empty";
                 } else {
                     echo $name;
                 }
             }
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_FILES</th>
         <td>Асоціативний масив (array) елементів, завантажених поточний скрипт через метод HTTP POST.</td>
         <td> <?php
             $image=$_FILES['myfile'];
             echo "File Name<b>::</b> ".$image['name'];

             move_uploaded_file($image['tmp_name'],"photos/".$image['name']);

             ?></td>
     </tr>
     <tr>
         <th scope="row">$_COOKIE</th>
         <td>Асоціативний масив значень, переданих скрипту через HTTP Cookies.</td>
         <td><?php
             $cookie_name = "user";
             $cookie_value = $_POST['fname'];
             setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
             if(!isset($_COOKIE[$cookie_name])) {
                 echo "Cookie named '" . $cookie_name . "' is not set!";
             } else {
                 echo "Cookie '" . $cookie_name . "' is set!<br>";
                 echo "Value is: " . $_COOKIE[$cookie_name];
             }
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_SESSION</th>
         <td>Асоціативний масив, що містить змінні сесії, доступні для поточного скрипта.</td>
         <td><?php
             session_start();
             $_SESSION['test'] = 1;
             echo $_SESSION['test'];
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_REQUEST</th>
         <td>Асоціативний масив (array), який за замовчуванням містить дані змінних $_GET, $_POST та $_COOKIE.</td>
         <td><?php
             $_GET['foo'] = 'a';
             $_POST['bar'] = 'b';
             var_dump($_GET);
             var_dump($_POST);
             var_dump($_REQUEST);
             ?></td>
     </tr>
     <tr>
         <th scope="row">$_ENV</th>
         <td>Асоціативний масив (array) значень, переданих скрипту через змінні оточення.

             Ці значення імпортуються у глобальний простір імен PHP із системних змінних оточення, у якому запущено парсер PHP. Більшість значень передається з командної оболонки, під якою запущено PHP, і в різних системах, ймовірно, використовуються різні типи оболонок, тому остаточний список неможливо уявити. Будь ласка, вивчіть документацію до вашої командної оболонки для отримання списку змінних оточення.

             Деякі змінні оточення включають CGI-змінні, причому їх наявність не залежить від того, чи PHP запущений як модуль сервера або як препроцесор CGI.</td>
         <td><?php
             echo "Path: " . getenv("PATH");
             ?></td>
     </tr>
     </tbody>
 </table>
</BODY>
</HTML>