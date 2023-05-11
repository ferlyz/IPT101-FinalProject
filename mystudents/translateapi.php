<?php
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://text-translator2.p.rapidapi.com/translate",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "source_language=en&target_language=id&text=What%20is%20your%20name%3F",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: text-translator2.p.rapidapi.com",
		"X-RapidAPI-Key: 3bc5f3d5famsheb11393d6fa3da0p15715bjsn609fbc835508",
		"content-type: application/x-www-form-urlencoded"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$responseObj = json_decode($response);
	$translatedText = $responseObj->data->translatedText;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Translation Message</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style>
        *{
            background-color:black;
            color:white;
        }

        body{
            background-color:black;
        }
    </style>

</head>
<body>
	<div class="container mt-5">
		<h1>Translation Message</h1>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Original Text:</h5>
				<p class="card-text">What is your name?</p>
			</div>
		</div>
		<div class="card mt-3">
			<div class="card-body">
				<h5 class="card-title">Translated Text:</h5>
				<p class="card-text"><?php echo $translatedText; ?></p>
			</div>
		</div>
	</div>
	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
