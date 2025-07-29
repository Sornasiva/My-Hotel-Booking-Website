<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room_Booking</title>
</head>
<body>
    <div class="container">
        <h2>Book a Room</h2>
    <form method="POST">
        Room Type : <select name="room_type" required>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Suite">Suite</option>
        </select><br><br>

        Check-in Date : <input type="date" name="check-in" required><br><br>
        Check-out Date : <input type="date" name="check-out" required><br><br>
        Number of Guests : <input type="number" name="guests" min=1 required><br><br>
        <button type="submit">Book Now</button>
    </form>
    </div>
</body>
</html>
<?php
    session_start();
    include('db.php');
    if(isset($_POST['book']))
    {
        // $user_id = $_SESSION['user_id'];
        $room_type = $_POST['room_type'];
        $check_in = $_POST['check-in'];
        $check_out = $_POST['check-out'];
        $guests = $_POST['guests'];

        if($check_in >= $check_out) //17 >= 15
        {
            echo "<p style='color:red;'>Check-out date must be after check-in date.</p>";
        }
        else
        {
            $stmt = $conn->prepare("insert into booking (room_type, check_in, check_out, guests) values (?,?,?,?)");
            $stmt->bind_param('sssi', $room_type, $check_in, $check_out, $guests);
            if($stmt->execute())
            {
                echo "<p style='color:green;'>Room Booked Successfully!</p>";
            }
            else
            {
                 echo "<p style='color:red;'>Room Booked Failed.Try Again...</p>";   
            }
            $stmt->close();
        }
    }
    
?>
<style>
    body{
        margin: 0;
        padding: 0;
        background-size: cover;
        background-repeat: no-repeat;
        background-image: url(backgroundhotel.jpg);
    }
    .container h2{
        font-size: 36px;
    }
    .container{
        width: 500px;
        height: 470px;
        position: relative;
        background-color: rgba(245, 245, 245, 0.514);
        padding-left: 150px;
        font-size: 20px;
        align-content: center;
        margin-top: 140px;
        margin-left: 390px;
        position: fixed;
    }
    .container form button{
        position: relative;
        height: 50px;
        width: 140px;
        margin: 50px;
        margin-left: 70px;
        margin-top: 20px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        background-color: orangered;
        border-radius: 20px;
    }

</style>