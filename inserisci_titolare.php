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
    <?php
        echo '<p class="titolo_dark">Inserisci i dati del titolare</p>';
    ?>
    <form method="POST" action="./php/registra_titolare.php">
        <div style="margin-top: 20px">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>
        </div>
        <div style="margin-top: 20px">
            <label for="cognome">Cognome:</label>
            <input type="text" name="cognome" required><br>
        </div>
        <div style="margin-top: 20px">
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
        </div>
        <div style="margin-top: 20px">
            <label for="telefono">Telefono:</label>
            <input type="tel" name="telefono" required><br>
        </div>
        <div style="margin-top: 20px">
            <input type="submit" value="Registra titolare" class="buttonform">
        </div>
        <div style="margin-top: 20px">
        <?php if (isset($_GET['msg'])){
                    if ($_GET['msg']=='KO') echo "<p style=\"color: red\">ATTENZIONE! operazione non andata a buon fine!</p>";
                    elseif ($_GET['msg']=='OK') echo "<p style=\"color: blue\">REGISTRATO! Operazione avvenuta con sucesso
                                                      <br>ora puoi ritornare alla <a href=\"home.php\">HOME</a></p>";
                  }        
          ?>
         </div>
    </form>
</div>
<?php
include ("./templates/footer.php");
?>