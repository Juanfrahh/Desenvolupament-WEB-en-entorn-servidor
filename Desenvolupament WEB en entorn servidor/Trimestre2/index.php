<?php
$xml=simplexml_load_file("books.xml");
foreach($xml->children() as $books) {
 echo $books->title['lang'];
 echo "<br>";
}
?>

<h