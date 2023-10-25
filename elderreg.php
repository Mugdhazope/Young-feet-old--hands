<form action="elderreg.php" method="post">
    Name: <input type="text" name="name" required><br>
    Number: <input type="text" name="number" pattern="\d{10}" required><br>
    Gender: <input type="radio" name="gender" value="Male" required> Male
            <input type="radio" name="gender" value="Female" required> Female<br>
    Age: <input type="number" name="age" required><br>
    Area: <input type="text" name="area" required><br>
    <input type="submit" value="Register">
</form>

<?php
session_start();
include('conn.php');


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $number = $_POST["number"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $area = $_POST["area"];


    // Check if the elder is already registered
    $check_query = "SELECT * FROM elder WHERE number='$number'";
    $result = $conn->query($check_query);

    if ($result->num_rows == 0) {
        // If not registered, insert into database
        $insert_query = "INSERT INTO elder (name, number, gender, age, area)
                         VALUES ('$name', '$number', '$gender', '$age', '$area')";
        if ($conn->query($insert_query) === TRUE) {
            $_SESSION['number'] = $number;
            echo "Registration successful!";
            // Save elder number in session
            header("Location: elder.php");
            exit();

        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        // If already registered, redirect to login page
        header("Location: elderlogin.php");
        exit();
    }

    $conn->close();
}
?>