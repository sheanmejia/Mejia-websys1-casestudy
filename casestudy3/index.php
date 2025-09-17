<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Activity 3</title>
    <style>
          body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle,  #d8bfd8, #d8bfd8, #d8bfd8, #ffd700, #f4a460, #f4a460);
            padding: 20px;
          }

        table {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 1);
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            border: 5px solid;
            }

        th, td {
            border: 2px solid #C5172E;
            padding: 12px 15px;
            text-align: center;
            font-weight: 600;
            }

        .odd-number {
            background-color: #FCF259;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>X</th>
        <?php
        for ($header = 1; $header <= 10; $header++) {
            echo "<th>$header</th>";
        }
        ?>
    </tr>

    <?php
    for ($row = 1; $row <= 10; $row++) {
        echo "<tr>";
        // Row header
        echo "<th>$row</th>";
        
        for ($col = 1; $col <= 10; $col++) {
            $value = $row * $col;
            $class = ($value % 2 !== 0) ? 'odd-number' : '';
            echo "<td class='$class'>$value</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>