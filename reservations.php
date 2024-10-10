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

// שאילתת SQL כדי לקבל את כל ההזמנות
$sql = "SELECT name, date, time, details FROM reservations";
$result = $conn->query($sql);

// התחלת התצוגה
echo '<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>הזמנות מועדון הדיירים</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #e7f9ff;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #ff6347; /* צבע עיקרי */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left; /* טקסט מיועד לשמאל */
            border: 1px solid #ddd;
        }
        th {
            background-color: #ff6347;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a {
            display: block;
            text-align: center;
            margin: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>
<body>';

if ($result->num_rows > 0) {
    echo "<h1>הזמנות מועדון הדיירים</h1>";
    echo "<table><tr><th>פרטים נוספים</th><th>שעה</th><th>תאריך</th><th>שם</th></tr>";
    
    // הצגת הנתונים
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["details"] . "</td><td>" . $row["time"] . "</td><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h1>אין הזמנות.</h1>";
}

// סגירת החיבור
$conn->close();

echo '<a href="http://localhost/index.html">חזרה לטופס ההזמנות</a>';
echo '</body></html>';
?>
