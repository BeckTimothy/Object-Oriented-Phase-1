<?php
use BeckTimothy\ObjectOrientedPhase1\Author;
use Ramsey\Uuid\Uuid;
require_once("../classes/Author.php");

$timothy = new Author("f7286cc1-5d88-4a91-844e-588cbb940c67",
	"f6cac5f10e4d14bf1cf85cfec2a0a24c",
	"http://i.imgur.com/eBa3VXG.jpg",
	"barricuda1993@yahoo.com",
	"4a21312be53b16e88c5f78bcfddd16058f773cbc15ead7985b4dcb967dc85c698fcd080fe5ff93a9399c2003084abc3d8",
	"Tbeck6"
);
echo($timothy->getAuthorUsername());
?>