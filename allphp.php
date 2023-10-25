<form action="register.php" method="post">
    Name: <input type="text" name="name" required><br>
    Number: <input type="text" name="number" pattern="\d{10}" required><br>
    Gender: <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female" required> Female<br>
    Age: <input type="number" name="age" required><br>
    Area: <input type="text" name="area" required><br>
    <input type="submit" value="Register">
</form>

<?php
include('conn.php');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $number = $_POST["number"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $area = $_POST["area"];

    // Check if the volunteer is already registered
    $check_query = "SELECT * FROM volunteer WHERE number='$number'";
    $result = $conn->query($check_query);

    if ($result->num_rows == 0) {
        // If not registered, insert into database
        $insert_query = "INSERT INTO volunteer (name, number, gender, age, area)
                         VALUES ('$name', '$number', '$gender', '$age', '$area')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        // If already registered, redirect to login page
        header("Location: login.php");
        exit();
    }

    $conn->close();
}
?>