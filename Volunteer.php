<?php
session_start();
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["check_help"])) {
        $volunteer_number = $_SESSION['number']; // Use the session variable to get the volunteer's number

        $query = "SELECT * FROM elder WHERE help='Y' AND area IN (SELECT area FROM volunteer WHERE number='$volunteer_number')";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Number</th><th>Age</th><th>Area</th><th>Help</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["number"]."</td>";
                echo "<td>".$row["age"]."</td>";
                echo "<td>".$row["area"]."</td>";
                echo "<td><form action='elder.php' method='post'>";
                echo "<input type='hidden' name='elder_number' value='".$row["number"]."'>";
                echo "<input type='submit' name='help_this_elder' value='Help this one'>";
                echo "</form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No elders need help in your area.";
        }
    }
}

$conn->close();
?>
