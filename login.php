<!DOCTYPE html>
<html>
<head>
  <title>Ouverture de session</title>
</head>

<body>
<h1>Ouverture de session</h1>
<p style="color: red; font-weight: bold;">
    Seuls les usagers autorisés peuvent utiliser cette application. Aucun usage inapproprié ne
    sera toléré, et les contrevenants seront poursuivis en justice.
</p>
<p>Entrez votre courriel, mot de passe et deuxième facteur</p>

<p>
<form method="post" action="check_auth.php">
<p>Courriel: <br><input type="text" name="email" /></p>
<p>Mot de passe: <br><input type="password" name="password" /></p>
<p>NIP à usage unique: <br><input type="text" name="pin" /></p>
<p><input type="submit" value="Valider"></p>

</form>
</p>

</body>
</html>
