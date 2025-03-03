<?php
include("database.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $number = filter_input(INPUT_POST, "number", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($name)) {
        $error_message = "Please enter your name.";
    } elseif (empty($number)) {
        $error_message = "Please enter your phone number.";
    } elseif (empty($email)) {
        $error_message = "Please enter a valid email address.";
    } elseif (empty($address)) {
        $error_message = "Please enter your address.";
    } else {
    
        $stmt = $conn->prepare("INSERT INTO `contact` (`name`, `number`, `email`, `address`) VALUES (?, ?, ?, ?)");
 

        if ($stmt->execute()) {
            $success_message = "User registered successfully!"."<br>";
            header("Location: contact.php?success=1");
            exit();
        } else {
            $error_message = "Registration unsuccessful: " . $stmt->error;
        }
        $stmt->close();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPCOT</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css" 
          integrity="sha512-pmAAV1X4Nh5jA9m+jcvwJXFQvCBi3T17aZ1KWkqXr7g/O2YMvO8rfaa5ETWDuBvRq6fbDjlw4jHL44jNTScaKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<section class="header">
    <a href="home.php" class="logo"><h1>SIPCOT</h1></a>
    <nav class="nav">
        <ul class="ul-item">
            <li><a href="home.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</section>

<div class="contact">
    <h1>Contact Us</h1>
    <div class="contact-details">
     

     

        <form action="contact.php" method="post">
            <label>Name</label>
            <input type="text" placeholder="Your name" name="name" required /><br/>

            <label>Phone Number</label>
            <input type="text" placeholder="Your phone number" name="number" required/><br/>

            <label>Email</label>
            <input type="email" placeholder="Your email" name="email" required/><br/>

            <label>Address</label>
            <input type="text" placeholder="Your Address" name="address" required/><br/>
            <?php if (!empty($success_message)): ?>
            <p style="color: green; font-size:24px; font-weight:700"><?php echo $success_message; ?></p>
           <?php endif; ?>
           <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

            <button id="btn-1" class="btn-primary" name="submit">Submit</button>
           
        </form>
    </div>
</div>

<footer>
    <div class="footer">
        <div class="address">
            <p><i class="fas fa-map-marker-alt"></i> 11/122 Gangai Amman Kovil Street, Vengaivasal, Chennai - 600126</p>
            <p><i class="fas fa-phone-alt"></i> +91 7358226627</p>
            <p><i class="fas fa-envelope"></i> kevinjoshuae2002@gmail.com</p>
        </div>

        <div class="social-media">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>

        <div class="newsletter">
            <h1>Newsletter</h1>
            <p>Subscribe to our newsletter to get the latest updates.</p>
            <form>
                <input type="text" placeholder="Your email address" />
            </form>
        </div>

        <div class="mandatories">
            <h1>Mandatories</h1>
            <ul>
                <li><a href="#">Disclaimer</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Refund Policy</a></li>
                <li><a href="#">Hyperlink Policy</a></li>
                <li><a href="#">Copyright Policy</a></li>
            </ul>
        </div>
    </div>

    <hr/>
    <div class="copy-rights">
        <p>&copy; <span id="current-year"></span> All rights belong to Kevin</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"></script>


<script>
    document.getElementById("current-year").textContent = new Date().getFullYear();
</script>

</body>
</html>
