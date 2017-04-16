<?php

include('funkcie.php'); 

?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link rel="stylesheet" href="css/styles.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
<section>

<?php
function prihlas_form(){
?>
<p class='prihlasenie'>Najprv sa musíte prihlásiť</p>
<form method="post">
<fieldset>
	<legend>Prihlásenie</legend>
	<label for="id">Prihlasovacie meno:</label>
  <input name="id" id="id" type="text" value="" size="20" maxlength="20">
	<br>
	<label for="password">Prihlasovacie heslo: </label>
	<input name="password" id="password" type="password" size="20" maxlength="20">
	<br>
	<p><input name="prihlas" type="submit" id="submit" value="Prihlás"></p>
</fieldset>
</form>
</section>
</body>
</html>
<?php
}

if (isset($_POST['prihlas'])) {
      if (isset($_POST["id"]) && isset($_POST["password"]) 
      && $udaje=login_employee(($_POST['id']),($_POST['password']))){
        $_SESSION['login'] = $udaje['employee_id'];
        $_SESSION['admin'] = $udaje['position_id'];
        $_SESSION['branch'] = $udaje['branch_id'];
        
        ?>
        
      <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
      <script type="text/javascript">

      
      

      </script>
      <?php
      } 
      else
      {
      echo "<p class='stred'><strong>Zadali ste, nesprávne prihlasovacie údaje</strong></p>";
      }
}
 


 if (isset($_SESSION['login'])) {
     header('Location: main.php');    
 echo "<p class='si'>SI PRIHLASENY</p><br>";
 echo "Vitaj v systéme: <strong>" .  $_SESSION['login'] . "";
  

 }
 else
 prihlas_form();
 
?>

