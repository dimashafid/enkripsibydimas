<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $password = $_POST["password"];
    $pkey = $_POST["pkey"];
    $usertext = $_POST["usertext"];


    $crypt_method = "aes-128-cbc";

    $key = hash("sha256", $password);

    $iv = substr(hash("sha256", $pkey), 0, 16);


    if ($_POST["action"] == "enkripsi") {
        $output = openssl_encrypt($usertext, $crypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if ($_POST["action"] == "dekripsi") {
        $output = base64_decode($usertext);
        $output = openssl_decrypt($output, $crypt_method, $key, 0, $iv);
    }
    else {
        header("Location: ./index.php");
        exit();
    }

}

?>

<!DOCTYPE html>
<html>
<head>

<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa; /* Set background color */

        background-image: url('latar.gif');        
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed
        
        }

        .custom-border {
            border: 1px solid #ccc; /* Add border */
            border-radius: 10px; /* Add border radius */
            padding: 20px;
            background-color: trasnsparent;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add box shadow */
            backdrop-filter: blur(2px);
        }

        h1 {
            color: #ffffff;
        }
        
        .form-label {
            color: #ffffff;
        }
        </style>

    <meta charset="utf-8">
    <title>Enkripsi dan Dekripsi</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="tkj.jpg">
</head>
<body>
    <div class="custom-border">
    <div class="container">
        <div class="text-center"> <h1>Enkripsi Dan Dekripsi</h1> </div>
        <div class="my-5">
            <form action="./index.php" method="POST">
                <div class="row row-cols-2">
                    <div class="p-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?php echo $password ?? null ?>">
                    </div>
                    <div class="p-3">
                        <label for="pkey" class="form-label">key</label>
                        <input type="text" class="form-control" id="pkey" name="pkey" value="<?php echo $pkey ?? null ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="usertext" class="form-label">Text</label>
                    <textarea class="form-control" id="usertext" name="usertext" rows="10"><?php echo $output ?? null ?></textarea>
                </div>
                <div class="mt-5 text-end">
                    <button class=" btn btn-primary me-2" type="submit" name="action" value="enkripsi">Enkripsi</button>
                    <button class="btn btn-primary" type="submit" name="action" value="dekripsi">Dekripsi</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>