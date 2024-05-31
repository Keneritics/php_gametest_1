<?php
require_once "config.php";
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $param_id = $_SESSION["id"];
    
    // Maxszint novelese
    $sql_update = "UPDATE felhasznalo SET maxszint = 2 WHERE id = ?";
    if($stmt_update = mysqli_prepare($link, $sql_update)){
        mysqli_stmt_bind_param($stmt_update, "i", $param_id);
        if(mysqli_stmt_execute($stmt_update)){
            mysqli_stmt_close($stmt_update);
            
            // Atiranyitas
            header("location: level2.php");
            exit;
        } else {
            echo "<script>alert('Hiba t�rt�nt a maxszint be�ll�t�sa k�zben.');</script>";
        }
    } else {
        echo "<script>alert('Hiba t�rt�nt a maxszint be�ll�t�sa k�zben.');</script>";
    }
} else {
    echo "<script>alert('Felhaszn�l� nincs bejelentkezve.');</script>";
}

//Ez a "megold�s" persze r�helyes, csakis a level1-r�l a level2re tud ir�ny�tani
//Ez�rt is csin�ltam el�sz�r univerz�lisra, de n�ha a megfelel� p�ly�ra ir�ny�tott, n�ha nem
//Ut�na m�g ezzel sem volt konzisztens, m�r a p�ly�ra se tudott megfelel�en ir�ny�tani,
//A v�ltoz� pedig tov�bbra is volt, hogy egyszerre 3 al n�tt 1 helyett
//Megpr�b�ltam telerakni logokkal, de �gy se tudtam megoldani..
//Az al�bbi k�dot futtatva kider�l, hogy m�r azel�tt hozz�ad�dik az �rt�k, hogy kiiratn�nk, pedig k�s�bb k�vetkezik
//Megpr�b�ltam sleep-el elk�l�n�teni �ket, de nem seg�t, a scopeot v�ltoztatva sem javult
//St�gyenlem, hogy nem m�k�dik, de volt, hogy m�r (a generikus �tir�ny�t�s nagyobb szintre) m�k�d�tt..
// �gyhogy a szerver hib�ja is lehet, de sehol nem tal�ltam r� magyar�zatot :((

/*
echo "<script>alert('Require el�tt');</script>";
require_once "config.php";

echo "<script>alert('Session start el�tt');</script>";
session_start();

echo "<script>alert('Session start ut�n');</script>";

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo "<script>alert('Felhaszn�l� bejelentkezve');</script>";
    $param_id = $_SESSION["id"];

    $sql_select = "SELECT maxszint FROM felhasznalo WHERE id = ?";
    echo "<script>alert('Lek�rdez�s el�tt');</script>";
    if ($stmt_select = mysqli_prepare($link, $sql_select)) {
        mysqli_stmt_bind_param($stmt_select, "i", $param_id);
        if (mysqli_stmt_execute($stmt_select)) {
            mysqli_stmt_bind_result($stmt_select, $X);
            mysqli_stmt_fetch($stmt_select);
            mysqli_stmt_close($stmt_select);

            echo "<script>alert('Aktu�lis maxszint (X): " . $X . "');</script>";

            $Y = $X + 1;
            echo "<script>alert('�j maxszint (Y): " . $Y . "');</script>";

            $sql_update = "UPDATE felhasznalo SET maxszint = ? WHERE id = ?";
            if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                mysqli_stmt_bind_param($stmt_update, "ii", $Y, $param_id);
                if (mysqli_stmt_execute($stmt_update)) {
                    echo "<script>alert('Maxszint friss�tve Y �rt�kre.');</script>";

                    if ($stmt_select = mysqli_prepare($link, $sql_select)) {
                        mysqli_stmt_bind_param($stmt_select, "i", $param_id);
                        if (mysqli_stmt_execute($stmt_select)) {
                            mysqli_stmt_bind_result($stmt_select, $Z);
                            mysqli_stmt_fetch($stmt_select);
                            mysqli_stmt_close($stmt_select);

                            echo "<script>alert('�jonnan lek�rdezett maxszint (Z): " . $Z . "');</script>";
                        } else {
                            echo "<script>alert('�j lek�rdez�si hiba');</script>";
                        }
                    } else {
                        echo "<script>alert('�j lek�rdez�s el�k�sz�t�si hiba');</script>";
                    }
                } else {
                    echo "<script>alert('Maxszint friss�t�si hiba');</script>";
                }
                mysqli_stmt_close($stmt_update);
            } else {
                echo "<script>alert('Friss�t�s el�k�sz�t�si hiba');</script>";
            }
        } else {
            echo "<script>alert('Lek�rdez�si hiba');</script>";
        }
    } else {
        echo "<script>alert('Lek�rdez�s el�k�sz�t�si hiba');</script>";
    }
    mysqli_close($link);
} else {
    echo "<script>alert('Nincs bejelentkezett felhaszn�l�.');</script>";
}
*/

?>