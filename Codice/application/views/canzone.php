

<body>
    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="col">
                <form action="<?php echo URL; ?>login/canzoni" method="POST">
                    <button type="submit">Indietro</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col">
               <h1><?php echo Get::canzoneTitolo();?></h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <form action="<?php echo URL; ?>login/writeAnnotazione" method="post">
                    <label for="posizione">Posizione:</label><br>
                    <input type="number" id="posizione" name="posizione"><br>
                    <label for="testo">Testo:</label><br>
                    <input type="text" id="testo" name="testo"><br><br>
                    <input type="submit" value="aggiungiAnnotazione">
                    <input type="hidden" name="canzoneId" value="<?php echo $_POST["canzoneId"] ?>">
                </form>
                <?php
                    Get::CanzoneTable();
                ?>
            </div>
        </div>
    </div>
</body>