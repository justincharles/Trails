<html>
<head>
<title>Future Trail</title>
</head>


<body>


<div class ="results">

<?php 



/* initial code from http://support.qualityunit.com/061754-How-to-make-REST-calls-in-PHP */

/* Pull + Decode JSON */
$service_url	= "http://helloimalex.com/nycmlhearst/Trails/future.json";

$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occurred during curl exec. Additional info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occurred: ' . $decoded->response->errormessage);
}

/* Set Variable For Total Number Of Articles in Trail */
$count	= ($decoded->count);


/* Pull Article Elements from Trail */
for ($i = 0; $i < $count; $i++){

	$TrailStep			= ($decoded->items[$i]->screen);
	$ArticleTitle	 	= ($decoded->items[$i]->articleName);
	$ArticleTeaser		= ($decoded->items[$i]->articleTeaser);
	$PubDate 			= ($decoded->items[$i]->articleDate);
	$Keywords 			= ($decoded->items[$i]->keywords);
	$PermUrl 			= ($decoded->items[$i]->articleURL);
	$ThumbSrc			= ($decoded->items[$i]->imgURL);


	/* Show Results */
	/* if ($TrailStep == "future"){ */ /* Limit Screen (replace 'future' with clicked tag */
		print "<div>";
		print "<p>";
		/* print "$TrailStep<br>"; */
		print "<img src='";
		print "$ThumbSrc'></p>";
		print "<p><h1>$ArticleTitle</h1>";
		print "<h2>$Keywords</h2>";
		print "<h3>$ArticleTeaser</h3>";
		print "<a href='$PermUrl' target='_blank'>See Article</a>";
		print "</div>";
	/* } */

}

/* end PHP */
?>
</div>
</body>
</html>