<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3887BE;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: red;
        }
    </style>
</head>
<body>
    <?php
    include 'koneksi.php';
    session_start();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM admins WHERE username='$username' AND Password='$password'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            header('Location: index.php');
            exit();
        } else {
            echo '<p style="color: red;">Username atau password salah.</p>';
        }
    }
    ?>

    <form action="#" method='POST'>
        <h1>Halaman Login Admin</h1>
        <label for="username">Username</label>
        <input type="text" name="username" required><br>

        <label for="password">Password</label>
        <input type="password" name="password" required><br>
        
        <button name='submit' class='btn' type='submit'>Login</button>
    </form>
</body>
</html>
