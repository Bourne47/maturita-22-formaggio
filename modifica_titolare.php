<?php
include_once("./templates/header_riservata.php");
?>
<div id="menusx">
        <div>
            <?php
                echo "<div><button type=\"button\" onClick=\"location.href='./home.php'\" class=\"buttonform menubutton\">RITORNA ALLA HOME</button></div>";
                //echo "<div><button type=\"button\" onClick=\"location.href='./visualizza_animali.php'\" class=\"buttonform menubutton\">RITORNA ALLA VISTA ANIMALI</button></div>";
            ?>
        </div>
</div>
<div id="central" style="width: 100%; text-align: center;">
    <?php
        //devo ricevere l'id del titolare del caseificio tramite GET
        $id_t = $_GET['id_t'];
        require("./conf/db_config.php");
        $stmt = $conn->prepare("SELECT * FROM TITOLARI WHERE id_t = ?");
        $stmt->bind_param("i", $id_t);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //print_r($row);
        $conn->close();
        echo '<p class="titolo_dark">Modifica i dati del titolare</p>';
    ?>
    <form method="POST" action="./php/aggiorna_titolare.php">
        <?php
        echo '<input type="hidden" name="id_t" value="'.$id_t.'">'
        ?>
        <div style="margin-top: 20px">
            <label for="nome">Nome:</label>
            <?php
            echo '<input type="text" name="nome" required value="'.$row['nome'].'"><br>'
            ?>   
        </div>
        <div style="margin-top: 20px">
            <label for="cognome">Cognome:</label>
            <?php
            echo '<input type="text" name="cognome" required value="'.$row['cognome'].'"><br>'
            ?>   
        </div>
        <div style="margin-top: 20px">
            <label for="email">Email:</label>
            <?php
            echo '<input type="email" name="email" required value="'.$row['email'].'"><br>'
            ?>   
        </div>
        <div style="margin-top: 20px">
            <label for="telefono">Telefono:</label>
            <?php
            echo '<input type="tel" name="telefono" required value="'.$row['telefono'].'"><br>'
            ?>   
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
include ("./templates/footer.php");
?>