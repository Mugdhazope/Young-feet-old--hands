<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <form>
        Enter Number:   <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </form>
<form action="elderlogin.php" method="post">
    Number: <input type="text" name="number" pattern="\d{10}" required><br>
    Age: <input type="number" name="age" required><br>
    Area: <input type="text" name="area" required><br>
    <input type="submit" value="Login">
</form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>

<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"];
    $age = $_POST["age"];
    $area = $_POST["area"];


    $check_query = "SELECT * FROM elder WHERE number='$number' AND age='$age' AND area='$area'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        $_SESSION['number'] = $number;
        header("Location: elder.php");
     // Redirect to index.php if all conditions match
        exit();
    } else {
        echo "Invalid credentials. Please try again.";
    }
}

$conn->close();
?>