<!DOCTYPE html>
<html>
<head>
  <title>New user</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    h1 {
      color: #333;
      font-size: 3em;
      margin-bottom: 20px;
    }

    p {
      margin: 10px 0;
    }

    a {
      text-decoration: none;
      color: #007BFF;
      font-size: 1.2em;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #0056b3;
    }

    .container {
      text-align: center;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
<h1>New user</h1>
<form method="post" action="add_user.php">
<p>Username: <br><input type="text" name="name" /></p>
<p>Email: <br><input type="text" name="email" /></p>
<p>Password: <br><input type="password" name="password" /></p>
<p><input type="submit" value="Create"></p>

</form>
</p>

</body>
</html>
