<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Baza</title>
</head>
<body>
    <h1>Baza studentów</h1>

    <?php
        $connection = @mysqli_connect('localhost','root','', 'baza');

        //dodawanie 
        if(isset($_POST['dodaj']))
        {
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $wiek = $_POST['wiek'];

            $sql = "INSERT INTO studenci(imie,nazwisko,wiek) VALUES('$imie','$nazwisko','$wiek')";
            $dodaj = mysqli_query($connection,$sql);
        }

        //kasowanie
        if(isset($_POST['kasuj']))
        {
            $id = $_POST['id'];

            $sql = "DELETE FROM studenci WHERE id='$id'";
            $usun = mysqli_query($connection,$sql);
        }

        //edycja
        if(isset($_POST['edytuj']))
        {
            $id = $_POST['id'];
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $wiek = $_POST['wiek'];

            $sql = "UPDATE studenci SET imie='$imie',nazwisko='$nazwisko', wiek='$wiek' WHERE id='$id'";
            $edytuj = mysqli_query($connection,$sql);
        }

        //wyswietlanie
        $sql = "SELECT id, imie, nazwisko, wiek FROM studenci";
        $wynik = mysqli_query($connection,$sql);
        while($linia=mysqli_fetch_array($wynik))
        {
            echo "<hr>";
            echo $linia['imie']. " " .$linia['nazwisko']. " " .$linia['wiek'];

            //form do kasowania
            echo "<form action='database.php' method='post'>";
            echo "<input type='submit' name='kasuj' value='kasuj'>";
            echo "<input type='hidden' name='id' value='".$linia['id']."'>";
            echo"</form>";

            //form do edycji
            echo "<form action='database.php' method='post'>";
            echo "<input type='hidden' name='id' value='".$linia['id']."'>";
            echo "<label>Imię: </label><input type='text' name='imie' value='".$linia['imie']."'> ";
            echo "<label>Nazwisko: </label><input type='text' name='nazwisko' value='".$linia['nazwisko']."'> ";
            echo "<label>Wiek: </label><input type='text' name='wiek' value='".$linia['wiek']."'>";
            echo "<input type='submit' name='edytuj' value='edytuj'>";
            echo"</form>";
        }

        mysqli_close($connection);
    ?>

    <form action="database.php" method="post">
        <h4>Dodaj do bazy</h4>
        <label>Imię: </label><input type='text' name='imie'>
        <label>Nazwisko: </label><input type='text' name='nazwisko'>
        <label>Wiek: </label><input type='text' name='wiek'>
        <input type='submit' name='dodaj' value='dodaj'>
    </form>
</body>
</html>
