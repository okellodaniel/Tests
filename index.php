<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <?php

    $name = $email = $website = $comment = $gender = "";
    $nameError = $genderError = $emailError = $websiteError = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["name"])) {
            $nameError = "Name is required";
            echo "<h1>Checking this $nameError</h1>";
        } else {
            # code...
            $name = test_input($_POST["name"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                # code...
                $nameError = "Only letters and white space allowed";
            }
        }



        if (empty($_POST["email"])) {
            $emailError = "Email is required";
        } else {
            # code...
            $email = test_input($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid Email Format";
            }
        }



        if (empty($_POST["website"])) {
            $website = "";
        } else {
            # code...
            $website = test_input($_POST["website"]);
            if (!preg_match("/\b(?:(?https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
                $websiteError = "Invalid Url";
            }
        }


        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            # code...
            $comment = test_input($_POST["comment"]);
        }



        if (empty($_POST["gender"])) {
            $genderError = "Gender is required";
        } else {
            # code...
            $gender = test_input($_POST["gender"]);
        }
    }





    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Name: <input type="text" name="name">
        <span class="error">* <?php echo "$nameError"; ?></span>
        <br><br>
        E-mail: <input type="text" name="email">
        <span class="error">* <?php echo $emailError; ?></span>
        <br><br>
        Website: <input type="text" name="website">
        <span class="error"> <?php echo $websiteError; ?></span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40"></textarea>
        Gender:
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other
        <span class="error">*<?php echo $genderError; ?></span>
        <br><br>
        <input type="submit" value="submit" name="submit">
    </form>
    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comment;
    echo "<br>";
    echo $gender;
    ?>
</body>

</html>