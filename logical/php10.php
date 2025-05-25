<!DOCTYPE html>
<html>
<head>
    <title>Array Challenges</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color: #2c3e50;
        }

        section {
            background: #ffffff;
            margin: 20px auto;
            padding: 25px;
            border-radius: 16px;
            max-width: 700px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s;
        }

        section:hover {
            transform: scale(1.01);
        }

        h2 {
            color: #00796b;
            margin-bottom: 10px;
            font-size: 1.4rem;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            margin: 8px 0;
            width: 90%;
            max-width: 400px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #004d40;
        }

        strong {
            display: block;
            margin-top: 15px;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        form {
            margin-top: 10px;
        }

        input[maxlength="1"] {
            width: 40px;
            text-align: center;
            font-size: 1rem;
            margin: 5px;
        }
    </style>
</head>
<body>
    <h1>PHP Array and Logic Challenges</h1>

    <!-- Sum of Two Section -->
    <section>
        <h2>1. Sum of Two</h2>
        <form method="post">
            <input type="hidden" name="form_type" value="sum">
            Array A (comma-separated): <input type="text" name="a"><br>
            Array B (comma-separated): <input type="text" name="b"><br>
            Target Value: <input type="number" name="target"><br>
            <button type="submit">Check</button>
        </form>
        <?php
        if ($_POST && $_POST['form_type'] == 'sum') {
            $a = explode(',', $_POST['a']);
            $b = explode(',', $_POST['b']);
            $v = $_POST['target'];

            for ($i = 0; $i < count($a); $i++) $a[$i] = (int)trim($a[$i]);
            for ($i = 0; $i < count($b); $i++) $b[$i] = (int)trim($b[$i]);

            function sumOfTwo($a, $b, $v) {
                for ($i = 0; $i < count($a); $i++) {
                    for ($j = 0; $j < count($b); $j++) {
                        if ($a[$i] + $b[$j] == $v) return true;
                    }
                }
                return false;
            }

            echo "<strong>Result:</strong> " . (sumOfTwo($a, $b, $v) ? "true" : "false");
        }
        ?>
    </section>

    <!-- Keys and Values Section -->
    <section>
        <h2>2. Keys and Values</h2>
        <form method="post">
            <input type="hidden" name="form_type" value="keysvals">
            Object (key:value, comma-separated): <input type="text" name="object"><br>
            <button type="submit">Convert</button>
        </form>
        <?php
        if ($_POST && $_POST['form_type'] == 'keysvals') {
            $input = explode(',', $_POST['object']);
            $assoc = [];

            foreach ($input as $pair) {
                $kv = explode(':', $pair);
                $k = trim($kv[0]);
                $v = trim($kv[1]);
                $assoc[$k] = $v;
            }

            function keysAndValues($obj) {
                $keys = [];
                foreach ($obj as $k => $v) $keys[] = $k;

                // Manual sort
                for ($i = 0; $i < count($keys); $i++) {
                    for ($j = $i + 1; $j < count($keys); $j++) {
                        if ($keys[$i] > $keys[$j]) {
                            $tmp = $keys[$i];
                            $keys[$i] = $keys[$j];
                            $keys[$j] = $tmp;
                        }
                    }
                }

                $values = [];
                foreach ($keys as $k) $values[] = $obj[$k];

                return [$keys, $values];
            }

            $result = keysAndValues($assoc);
            echo "<strong>Keys:</strong> [" . implode(', ', $result[0]) . "]<br>";
            echo "<strong>Values:</strong> [" . implode(', ', $result[1]) . "]";
        }
        ?>
    </section>

    <!-- Tic-Tac-Toe Section -->
    <section>
        <h2>3. Tic-Tac-Toe</h2>
        <form method="post">
            <input type="hidden" name="form_type" value="tictactoe">
            Enter 9 cells (X or O):<br>
            <?php
            for ($i = 0; $i < 9; $i++) {
                echo "<input type='text' name='cells[]' maxlength='1'>";
                if (($i + 1) % 3 == 0) echo "<br>";
            }
            ?>
            <br>
            <button type="submit">Check Winner</button>
        </form>
        <?php
        if ($_POST && $_POST['form_type'] == 'tictactoe') {
            $c = $_POST['cells'];
            $b = [
                [strtoupper(trim($c[0])), strtoupper(trim($c[1])), strtoupper(trim($c[2]))],
                [strtoupper(trim($c[3])), strtoupper(trim($c[4])), strtoupper(trim($c[5]))],
                [strtoupper(trim($c[6])), strtoupper(trim($c[7])), strtoupper(trim($c[8]))],
            ];

            function whoWon($b) {
                $x = $o = false;

                for ($i = 0; $i < 3; $i++) {
                    if ($b[$i][0] == $b[$i][1] && $b[$i][1] == $b[$i][2]) {
                        if ($b[$i][0] == "X") $x = true;
                        if ($b[$i][0] == "O") $o = true;
                    }
                    if ($b[0][$i] == $b[1][$i] && $b[1][$i] == $b[2][$i]) {
                        if ($b[0][$i] == "X") $x = true;
                        if ($b[0][$i] == "O") $o = true;
                    }
                }

                if ($b[0][0] == $b[1][1] && $b[1][1] == $b[2][2]) {
                    if ($b[0][0] == "X") $x = true;
                    if ($b[0][0] == "O") $o = true;
                }

                if ($b[0][2] == $b[1][1] && $b[1][1] == $b[2][0]) {
                    if ($b[0][2] == "X") $x = true;
                    if ($b[0][2] == "O") $o = true;
                }

                if ($x && $o) return "Tie";
                if ($x) return "X";
                if ($o) return "O";
                return "Tie";
            }

            echo "<strong>Winner:</strong> " . whoWon($b);
        }
        ?>
    </section>

</body>
</html>
