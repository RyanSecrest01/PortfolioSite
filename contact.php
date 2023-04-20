<?php
    //connect to MySQL
    $host = 'sql310.epizy.com';
    $user = 'epiz_33189621';
    $password = 'w95TrJE8LC';
    $database = 'epiz_33189621_Contacts';
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Insert form data into database
        $sql = "INSERT INTO Contacts (name, email, message) VALUES ('$name', '$email', '$message')";

        if (mysqli_query($conn, $sql)) {
            // Send email notification
            $to = "rcs2019@gmail.com";
            $subject = "New Message from Contact Form";
            $body = "Name: $name\nEmail: $email\nMessage: $message";
            $headers = "From: noreply@example.com";
            mail($to, $subject, $body, $headers);

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
        <a class="active" href="contact.php">Contact</a>
        <a href="comments.php">Comments</a>
    </div>

    <h2>Contact Me</h2>
    
    <div class="contact-form">
        <form method="POST" action="contact.php">
            <div class="form-row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-row">
                <label for="message">Message:</label>
                <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
            </div>

            <div class="form-row">
                <button type="submit" class="submit-button">Submit</button>
            </div>
        </form>
    </div>

    <footer>
        &copy; Ryan Secrest
    </footer>
</body>
</html>
