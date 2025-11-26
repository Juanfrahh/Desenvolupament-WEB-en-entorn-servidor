<?php
$xml=simplexml_load_file("books.xml");
foreach($xml->book as $books) {
 echo $books->title." ";
 echo $books->price."$";
 echo "<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>