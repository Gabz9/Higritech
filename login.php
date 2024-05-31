<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Higritech - Login</title>
    <link rel="stylesheet" href="Higritech_style/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="wrapper">
        <form action="testLogin.php" method="POST">
            <h1>Higritech</h1>
            <div class="input-box">
                <input type="text" name = "email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="senha" placeholder="Senha" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="Cadastro">
                <a href="cadastro.php"> Cadastre-se </a>
            </div>

            <input class="btn" type="submit" name="submit"  value="Login">
                
        </form>

    </div>
</body>
</html>