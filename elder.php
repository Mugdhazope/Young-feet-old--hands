<!DOCTYPE html>
<html>
<head>
    <title>Elder</title>
</head>
<body>

<h2>Elder Panel</h2>

<form action="elder.php" method="post">
    <input type="submit" name="help" value="Need Help">
</form>

<form action="elder.php" method="post">
    <input type="submit" name="response" value="Don't Need Future Help">
</form>

<form action="elder.php" method="post">
    <input type="submit" name="response" value="Need More Help">
</form>

</body>
</html>

<?php
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["help"])) {
        $help = $_POST["help"];
        if ($help == "need_help") {
            // Update the help column in elder table to 'Y'
            $update_query = "UPDATE elder SET help='Y'";
            if ($conn->query($update_query) === TRUE) {
                echo "Help request submitted successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    } elseif (isset($_POST["response"])) {
        $response = $_POST["response"];
        if ($response == "donot_need_help") {
            // Update the help column in elder table to 'N'
            $update_query = "UPDATE elder SET help='N'";
            if ($conn->query($update_query) === TRUE) {
                echo "Response recorded successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } elseif ($response == "need_more_help") {
            // Update the help column in elder table to 'Y'
            $update_query = "UPDATE elder SET help='Y'";
            if ($conn->query($update_query) === TRUE) {
                echo "Response recorded successfully.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>
