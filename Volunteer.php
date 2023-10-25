

<?php

include('conn.php');

 // Use the session variable to get the volunteer's number
        $query = "SELECT * FROM elder WHERE help='Y'";
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
                echo "<td><form action='volunteer.php' method='post'>";
                echo "<input type='hidden' name='elder_number' value='".$row["number"]."'>";
                echo "<input type='submit' name='help_this_elder' value='Help this one'>";
                echo "</form></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No elders need help in your area.";
        }



        if (isset($_POST['help_this_elder'])) {
            $elder_number = $_POST['elder_number'];
        
            // Update the help column in elder table to 'C'
            $update_query = "UPDATE elder SET help='C' WHERE number='$elder_number'";
        
            if ($conn->query($update_query) === TRUE) {
                $query = "SELECT * FROM elder WHERE number='$elder_number'";
                $result = $conn->query($query);
        
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
        
                    $name = $row['name'];
                    $number = $row['number'];
                    $area = $row['area'];
                    $age = $row['age'];
        
                    echo "<script>alert('Elder Information:\\nName: $name\\nNumber: $number\\nArea: $area\\nAge: $age');</script>";
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        
echo "<form action='logout.php' method='post'>";
echo "<input type='submit' name='logout' value='Logout'>";
echo "</form>";

$conn->close();
?>
