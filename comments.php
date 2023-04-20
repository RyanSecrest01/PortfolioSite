<?php
    //connect to MySQL
    $host = 'sql310.epizy.com';
    $user = 'epiz_33189621';
    $password = 'w95TrJE8LC';
    $database = 'epiz_33189621_Comments';
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $Name = $_POST['Name'];
        $Comment = $_POST['Comment'];

        // Insert form data into database
        $sql = "INSERT INTO Comments (name, comment, timestamp) VALUES ('$Name', '$Comment', CURRENT_TIMESTAMP)";

        if (mysqli_query($conn, $sql)) {
            

            // Redirect to thank you page
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>My Portfolio</title>
</head>
<body>
    <header>
        <h1>Ryan Secrest</h1>
    </header>

    <div class="topnav">
        <a href="index.html">Home</a>
        <a href="projects.html">Projects</a>
        <a href="contact.php">Contact</a>
        <a class="active" href="comments.php">Comments</a>
    </div>

    <h2>Leave a Comment</h2>
    
    <div class="contact-form">
        <form method="POST" action="comments.php">
            <div class="form-row">
                <label for="Name">Name:</label>
                <input type="text" id="Name" name="Name" placeholder="Enter your name" required>
            </div>

            <div class="form-row">
                <label for="Comment">Commment:</label>
                <textarea id="Comment" name="Comment" placeholder="Enter your comment" required></textarea>
            </div>

            <div class="form-row">
                <button type="submit" class="submit-button">Comment</button>
            </div>
        </form>
    </div>

    <h2>Comments</h2>
    <?php
        // Retrieve comments from the database
        $sql = "SELECT Name, Comment, timestamp FROM Comments";
        $result = mysqli_query($conn, $sql);

        // Display comments
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='comment'>";
                echo "<strong>" . $row['Name'] . "</strong> - " . $row['timestamp'];
                echo "<p>" . $row['Comment'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "No comments yet.";
        }
    ?>

    <footer>
        &copy; 2023 Ryan Secrest
    </footer>
</body>
</html>
