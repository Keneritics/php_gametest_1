<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dicsosegfal:</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
        }
        .leaderboard-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 3rem;
        }
        .leaderboard-table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .leaderboard-table th, .leaderboard-table td {
            text-align: center;
        }
        .leaderboard-table thead {
            background-color: #28a745;
            color: #ffffff;
        }
        .highlighted-row {
            background-color: #f8d7da;
        }
    </style>
</head>
<body>
    <div class="container leaderboard-container">
        <div class="col-md-8">
            <table class="table table-striped table-bordered leaderboard-table">
                <thead>
                    <tr>
                        <th>Felhasznalonev</th>
                        <th>Szint</th>
                        <th>Regisztracio ideje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Csatlakozas
                    require_once "config.php";

                    // Lekerdezes rendezve
                    $sql = "SELECT felhasznalonev, maxszint, regisztralas_ideje FROM felhasznalo ORDER BY maxszint DESC, regisztralas_ideje DESC";

                    // A bejelentkezett felhasznalo sorat pirossal kiemeljuk
                    session_start();
                    $logged_in_user = isset($_SESSION["felhasznalonev"]) ? $_SESSION["felhasznalonev"] : '';

                    $result = mysqli_query($link, $sql);
                    while($row = mysqli_fetch_array($result)){
                        $highlight = ($row['felhasznalonev'] == $logged_in_user) ? 'highlighted-row' : '';
                        echo "<tr class='$highlight'>";
                        echo "<td>" . htmlspecialchars($row['felhasznalonev']) . "</td>";
                        echo "<td>" . $row['maxszint'] . "</td>";
                        echo "<td>" . $row['regisztralas_ideje'] . "</td>";
                        echo "</tr>";
                    }

                    mysqli_free_result($result);
                    mysqli_close($link);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>