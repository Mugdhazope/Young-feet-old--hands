<?php
session_start();
include('conn.php');

$number = $_SESSION['number'];

// Query to get the help status of the logged-in user
$help_status_query = "SELECT help FROM elder WHERE number = '$number'";
$result = $conn->query($help_status_query);

if ($result) {
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $logged_in_elder_help = $row['help'];
        
        if ($logged_in_elder_help == "C") {
            echo "Help is on the way.<br>";
            echo "<form action='elder.php' method='post'>";
            echo "<input type='submit' name='response' value='Need More Help'>";
            echo "<input type='submit' name='response' value='Dont Need Any Help'>";
            echo "</form>";
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $response = $_POST["response"];
                if ($response == "Need More Help") {
                    // Update the help column in elder table to 'Y'
                    $update_query = "UPDATE elder SET help='Y'";
                    if ($conn->query($update_query) === TRUE) {
                        echo "Response recorded successfully. Help is still needed.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } elseif ($response == "Don't Need Any Help") {
                    // Update the help column in elder table to 'N'
                    $update_query = "UPDATE elder SET help='N'";
                    if ($conn->query($update_query) === TRUE) {
                        echo "Response recorded successfully. No further help needed.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
        } elseif ($logged_in_elder_help == "Y") {
            echo "We are still looking for volunteers.<br>";
            echo "<form action='elder.php' method='post'>";
            echo "<input type='submit' name='response' value='Dont Need Any Help'>";
            echo "</form>";
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $response = $_POST["response"];
                if ($response == "Don't Need Any Help") {
                    // Update the help column in elder table to 'N'
                    $update_query = "UPDATE elder SET help='N'";
                    if ($conn->query($update_query) === TRUE) {
                        echo "Response recorded successfully. No further help needed.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
        } elseif ($logged_in_elder_help == "N") {
            echo "We are still looking for volunteers.<br>";
            echo "<form action='elder.php' method='post'>";
            echo "<input type='submit' name='help' value='Need Help'>";
            echo "</form>";
    
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $help = $_POST["help"];
                if ($help == "Need Help") {
                    // Update the help column in elder table to 'Y'
                    $update_query = "UPDATE elder SET help='Y'";
                    if ($conn->query($update_query) === TRUE) {
                        echo "Help request submitted successfully.";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            }
        }
    } else {
        echo "Error fetching help status: " . $conn->error;
    }
} else {
    echo "Error fetching help status: " . $conn->error;
}

echo "<form action='logout.php' method='post'>";
echo "<input type='submit' name='logout' value='Logout'>";
echo "</form>";

$conn->close();
?>
