

    <?php
    if($_SERVER['REQUEST_METHOD'] === "POST") {
      $name = $_POST['name'];
      $mail = $_POST['mail'];
      $contents = $_POST['contents'];

      $connect = mysqli_connect("127.0.0.1", "root", "", "nailsshop") or die("error");
      $result = mysqli_query($connect, "INSERT INTO kontakt (imie, email, wiadomosc) VALUES ('$name', '$mail', '$contents');");
      mysqli_close($connect);

      header("location: ../../index.html");
    }
    ?>
