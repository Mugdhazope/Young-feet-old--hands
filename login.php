<form action="login.php" method="post">
    Number: <input type="text" name="number" pattern="\d{10}" required><br>
    Age: <input type="number" name="age" required><br>
    Area: <input type="text" name="area" required><br>
    <input type="submit" value="Login">
</form>

<?php
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"];
    $age = $_POST["age"];
    $area = $_POST["area"];

    $check_query = "SELECT * FROM volunteer WHERE number='$number' AND age='$age' AND area='$area'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        header("Location: volunteer.php"); // Redirect to index.php if all conditions match
        exit();
    } else {
        echo "Invalid credentials. Please try again.";
    }
}

$conn->close();
?>
