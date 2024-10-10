<?php

$servername = "localhost"; // כתובת השרת
$username = "root"; // שם משתמש למסד הנתונים
$password = ""; // סיסמת המסד נתונים
$dbname = "reservation_db"; // שם מסד הנתונים

// יצירת חיבור
$conn = new mysqli($servername, $username, $password, $dbname);

// בדיקת החיבור
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// קבלת נתוני הטופס
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $details = $conn->real_escape_string($_POST['details']);

    // SQL ליצירת רשומה חדשה
    $sql = "INSERT INTO reservations (name, date, time, details) VALUES ('$name', '$date', '$time', '$details')";

    if ($conn->query($sql) === TRUE) {
        echo "ההזמנה בוצעה בהצלחה!";
    } else {
        echo "שגיאה: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "שגיאה: לא נשלחו נתונים.";
}

$conn->close();
?>
