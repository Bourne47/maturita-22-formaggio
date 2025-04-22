<?php
include_once("./templates/header_riservata.php");
?>
<div id="menusx">
    <div>
        <?php
            echo "<div><button type=\"button\" onClick=\"location.href='./home.php'\" class=\"buttonform menubutton\">RITORNA ALLA HOME</button></div>";
        ?>
    </div>
</div>
<div id="central" style="width: 100%; text-align: center;">
    <p class="titolo_dark">Seleziona un titolare da modificare</p>
    <form method="POST" action="./php/cambio_titolare.php">
        <div style="margin-top: 20px">
            <label for="id_t">Titolare:</label>
            <select name="id_t" required>
                <option value="">-- Seleziona un titolare --</option>
                <?php
                require("./conf/db_config.php");
                $stmt = $conn->prepare("SELECT id_t, nome, cognome, email, telefono FROM TITOLARI ORDER BY cognome, nome");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $id_t = htmlspecialchars($row['id_t']);
                    $nome = htmlspecialchars($row['nome']);
                    $cognome = htmlspecialchars($row['cognome']);
                    $email = htmlspecialchars($row['email']);
                    $telefono = htmlspecialchars($row['telefono']);
                    echo "<option value=\"$id_t\">$cognome $nome - $email - $telefono</option>";
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div style="margin-top: 20px">
            <input type="submit" value="Modifica titolare" class="buttonform">
        </div>
        <div style="margin-top: 20px">
        <?php if (isset($_GET['msg'])){
                    if ($_GET['msg']=='KO') echo "<p style=\"color: red\">ATTENZIONE! operazione non andata a buon fine!</p>";
                    elseif ($_GET['msg']=='OK') echo "<p style=\"color: blue\">MODIFICATO! Operazione avvenuta con sucesso
                                                      <br>ora puoi ritornare alla <a href=\"home.php\">HOME<a></p>";
                  }        
          ?>
         </div>
    </form>
</div>
<?php
include("./templates/footer.php");
?>
