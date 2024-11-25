<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nails Shop - Admin</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon" />
  </head>
  <body>
    <div class="container">
      <div class="nav">
        <h2>Nails Shop</h2>

        <nav class="navbar">
          <ul class="nav-list">
            <li class="nav-item">
              <a href="../../index.html">Powróć na stronę główną</a>
            </li>
          </ul>
        </nav>
      </div>

      <div class="main">
        <?php
          $connect = mysqli_connect("127.0.0.1", "root", "", "nailsshop") or die("error");
          
          if(isset($_GET['list'])) {
            $result = mysqli_query($connect, "SELECT * FROM kontakt ORDER BY id ASC;");
            
            if(mysqli_num_rows($result) > 0) {
              echo "<table class='contents-table'>";
              echo "<tr class='table-header'><td>ID</td><td>Imię</td><td>E-mail</td><td>Wiadomość</td><td colspan='2'>Przyciski funkcyjne</td></tr>";
              
              $i = 0;
              while($row = mysqli_fetch_array($result)) {
                $i ++;

                $id = $row['id'];
                $name = $row['imie'];
                $mail = $row['email'];
                $contents = $row['wiadomosc'];
    
                echo "<tr class='table-content'><td>$i.</td><td>$name</td><td>$mail</td><td>$contents</td><td><a class='editBtn' href='apanel.php?editId=$id'/>Edytuj</a></td><td><a class='deleteBtn' href='apanel.php?deleteId=$id' />Usuń</a></td></tr>";
              }
    
              echo "</table>";            
            } else {
              echo "<p class='error-msg'>Brak wpisów w bazie danych.</p>";
            }
          }

          if(isset($_GET['editId'])) {
            $id = $_GET['editId'];
            $result = mysqli_query($connect, "SELECT * FROM kontakt WHERE id=$id LIMIT 1;");

            if(mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_array($result);

              ?>
                <form method="post">
                  <h2>Edycja ID: <?php echo $id; ?></h2>

                  <div class="form-item">
                    <label for="name">Imię:</label>
                    <input
                      type="text"
                      placeholder="<?php echo $row['imie']; ?>"
                      id="form-name"
                      name="name"
                      required
                    />
                  </div>

                  <div class="form-item">
                    <label for="mail">Adres e-mail:</label>
                    <input
                      type="email"
                      placeholder="<?php echo $row['email']; ?>"
                      id="form-mail"
                      name="mail"
                      required
                    />
                  </div>

                  <div class="form-item">
                    <label for="contents">Treść:</label>
                    <textarea
                      placeholder="<?php echo $row['wiadomosc']; ?>"
                      id="form-contents"
                      name="contents"
                      required
                    ></textarea>
                  </div>

                  <input
                    type="submit"
                    value="Edytuj"
                    name="button"
                    class="btn"
                  />
                </form>
              <?php

              if(isset($_POST['button'])) {
                $name = $_POST['name'];
                $mail = $_POST['mail'];
                $contents = $_POST['contents'];
                
                $_result = mysqli_query($connect, "UPDATE kontakt SET imie='$name', email='$mail', wiadomosc='$contents' WHERE id=$id LIMIT 1;");
                if($_result) {
                  header("location: ./apanel.php?list");
                }
              }
            }
          }

          if(isset($_GET['deleteId'])) {
            $id = $_GET['deleteId'];
            $result = mysqli_query($connect, "SELECT * FROM kontakt WHERE id=$id LIMIT 1;");
            
            if(mysqli_num_rows($result) > 0) {
              $_result = mysqli_query($connect, "DELETE FROM kontakt WHERE id=$id LIMIT 1;");
              if($_result) {
                header("location: ./apanel.php?list");
              }
            }
          }

          mysqli_close($connect);
        ?>
      </div>

      <footer class="footer">
        <p>Strona stworzona przez: <b>XXXX</b>.</p>
      </footer>
    </div>
  </body>
</html>