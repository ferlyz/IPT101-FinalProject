<!DOCTYPE html>
<html>
<head>
	<title>BMI Calculator</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>BMI Calculator</h1>
			<form method="get">
				<div class="form-group">
					<label for="weight">Weight (in kg)</label>
					<input type="number" class="form-control" id="weight" name="weight" required>
				</div>
				<div class="form-group">
					<label for="height">Height (in m)</label>
					<input type="number" step="0.01" class="form-control" id="height" name="height" required>
				</div>
				<button type="submit" class="btn btn-primary">Calculate BMI</button>
			</form>
			<?php
			if (isset($_GET['weight']) && isset($_GET['height'])) {
				$weight = $_GET['weight'];
				$height = $_GET['height'];

				$curl = curl_init();

				curl_setopt_array($curl, [
					CURLOPT_URL => "https://body-mass-index-bmi-calculator.p.rapidapi.com/metric?weight={$weight}&height={$height}",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => [
						"X-RapidAPI-Host: body-mass-index-bmi-calculator.p.rapidapi.com",
						"X-RapidAPI-Key: 3bc5f3d5famsheb11393d6fa3da0p15715bjsn609fbc835508"
					],
				]);

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
					echo "<p class='text-danger'>cURL Error #:" . $err . "</p>";
				} else {
					$bmi = json_decode($response, true)['bmi'];
					$category = "";
					if ($bmi < 18.5) {
						$category = "Underweight";
					} else if ($bmi < 25) {
						$category = "Normal weight";
					} else if ($bmi < 30) {
						$category = "Overweight";
					} else {
						$category = "Obesity";
					}
					echo "<p class='text-success'>Your BMI is {$bmi} - {$category}</p>";
				}
			}
			?>
		</div>
	</div>
</div>

</body>
</html>
