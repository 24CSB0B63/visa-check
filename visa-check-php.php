<?php
$message = "";
$messageColor = "red";
$visaInfo = "";
$name = "";
$passport = "";
$country = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $passport = trim($_POST["passport"]);
  $country = trim($_POST["country"]);
  if (empty($name) || empty($passport) || empty($country)) {
    $message = "All fields are required!";
  } elseif (strlen($passport) < 8 || strlen($passport) > 10) {
    $message = "Invalid passport number!";
  } else {
    $message = "Visa application submitted successfully!";
    $messageColor = "green";
  }
  if (!empty($country)) {
    switch ($country) {
      case "USA":
        $visaInfo = "Visa required for most applicants.";
        break;
      case "Canada":
        $visaInfo = "Visa required unless you have an eTA.";
        break;
      case "India":
        $visaInfo = "Visa required before travel.";
        break;
      case "UK":
        $visaInfo = "Visa depends on the duration of stay.";
        break;
      case "Australia":
        $visaInfo = "eVisa available for eligible travelers.";
        break;
      default:
        $visaInfo = "";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Visa Application</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
      background-image: url("https://wallpapers.com/images/featured/airplane-k2bvoms91kvb0tfp.jpg");
      background-size: cover;
      background-position: center;
    }
    .visa-container {
      background-color: #ffffffa4;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.066);
      max-width: 60%;
      width: 100%;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    h1 {    
      font-size: 60px;
      color: #333;
      margin-bottom: 20px;
      background: linear-gradient(to right, rgba(255, 78, 78, 0.642), rgba(81, 255, 81, 0.552), rgba(69, 69, 255, 0.68));
      border-radius: 10px;
      padding: 5px;
    }
    label {
      font-size: 1rem;
      margin-bottom: 10px;
      display: block;
      color: #555;
    }
    input, select {
      width: 80%;
      padding: 10px;
      font-size: 1rem;
      border: 2px solid #ddd;
      border-radius: 5px;
      margin-bottom: 20px;
      transition: border-color 0.3s;
    }
    input:focus, select:focus {
      outline: none;
      border-color: #007bff;
    }
    button {
      padding: 10px 20px;
      font-size: 1rem;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #0056b3;
    }
    #result {
      margin-top: 20px;
      font-weight: bold;
      font-size: 1.1rem;
    }
    #visaInfo {
      margin-top: 10px;
      font-weight: bold;
      font-size: 1.1rem;
      color: #007bff;
    }
  </style>
</head>
<body>
  <div class="visa-container">
    <h1>Visa Application</h1>
    <form method="post" action="">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter your full name" >
      <label for="passport">Passport Number:</label>
      <input type="text" id="passport" name="passport" placeholder="8-10 characters">
      <label for="country">Select your country:</label>
      <select id="country" name="country">
        <option value="">-- Select Country --</option>
        <option value="USA" <?php if($country === "USA") echo "selected"; ?>>USA</option>
        <option value="Canada" <?php if($country === "Canada") echo "selected"; ?>>Canada</option>
        <option value="India" <?php if($country === "India") echo "selected"; ?>>India</option>
        <option value="UK" <?php if($country === "UK") echo "selected"; ?>>United Kingdom</option>
        <option value="Australia" <?php if($country === "Australia") echo "selected"; ?>>Australia</option>
      </select>
      <button type="submit">Apply for Visa</button>
    </form>
    <p id="visaInfo"><?php echo $visaInfo; ?></p>
    <?php if (!empty($message)): ?>
      <p id="result" style="color: <?php echo $messageColor; ?>;"><?php echo $message; ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
