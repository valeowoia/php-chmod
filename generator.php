<!DOCTYPE html>
<html>
<head>
    <title>chmod</title>
    <style>
        @font-face {
            font-family: 'IBM VGA8';
            src: url('imb.woff') format('woff');
        }

        * {
            font-family: 'IBM VGA8', Arial, sans-serif;
        }
        
        body {
            background-color: #303030;
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background-color: #444;
            border-radius: 10px;
            padding: 20px;
            width: 400px;
        }

        h1 {
            color: #fff;
            font-weight: normal;
        }

        form {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
            margin-top: 20px;
        }

        label {
            display: flex;
            align-items: center;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #128459;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0d553a;
        }

        .result {
            margin-top: 20px;
        }

        .result p {
            font-size: 18px;
        }

        .result input[type="text"] {
            background-color: #666;
            color: #fff;
            padding: 10px;
            border: none;
            width: 95%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h1>CHMOD Generator</h1>

            <form method="post" action="">
                <label for="r">
                    <input type="checkbox" name="permissions[]" value="r" id="r"> Read
                </label>
                <label for="w">
                    <input type="checkbox" name="permissions[]" value="w" id="w"> Write
                </label>
                <label for="x">
                    <input type="checkbox" name="permissions[]" value="x" id="x"> Execute
                </label>
                <label for="s">
                    <input type="checkbox" name="permissions[]" value="s" id="s"> Setuid
                </label>
                <label for="t">
                    <input type="checkbox" name="permissions[]" value="t" id="t"> Sticky
                </label>
                <label for="u">
                    <input type="checkbox" name="permissions[]" value="u" id="u"> User read
                </label>
                <label for="g">
                    <input type="checkbox" name="permissions[]" value="g" id="g"> Group read
                </label>
                <label for="o">
                    <input type="checkbox" name="permissions[]" value="o" id="o"> Other read
                </label>
                <label for="a">
                    <input type="checkbox" name="permissions[]" value="a" id="a" checked> All
                </label>

                <br>
                <input type="submit" value="Submit">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $permissions = $_POST["permissions"];
                $chmod = "";

                if (in_array("a", $permissions)) {
                    $chmod = "777";
                } else {
                    $chmod = "-";
                    $chmod .= in_array("r", $permissions) ? "r" : "-";
                    $chmod .= in_array("w", $permissions) ? "w" : "-";
                    $chmod .= in_array("x", $permissions) ? "x" : "-";
                    $chmod .= in_array("s", $permissions) ? "s" : "-";
                    $chmod .= in_array("t", $permissions) ? "t" : "-";
                    $chmod .= in_array("u", $permissions) ? "u" : "-";
                    $chmod .= in_array("g", $permissions) ? "g" : "-";
                    $chmod .= in_array("o", $permissions) ? "o" : "-";
                }

                echo "<div class='result'>";
                echo "<h2>Result:</h2>";
                echo "<p><input type='text' value='chmod " . $chmod . "' readonly></p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
