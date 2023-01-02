
<body>
    <?php if($_SESSION["errorMessage"] !== false) :?>
            <div class="p-3 mb-2 bg-danger text-white fixed-top" >
                <?php echo strtoupper($_SESSION["errorMessage"]); ?>
            </div>
    <?php endif; ?>

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
               <h1>Nuova Canzone</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <form action="<?php echo URL; ?>login/writeCanzone" method="POST">
                    <label for="titolo">Titolo:</label><br>
                    <input type="text" id="tirolo" name="titolo"><br>

                    <label for="autore">Autore:</label><br>
                    <input type="text" id="autore" name="autore"><br>

                    <label for="anno">Anno:</label><br>
                    <input type="text" id="anno" name="anno"><br>

                    <label for="descrizione">Descrizione:</label><br>
                    <input type="text" id="descrizione" name="descrizione"><br>

                    <label for="audio">Audio:</label><br>
                    <input type="text" id="audio" name="audio"><br>

                    <label for="testo">Testo:</label><br>
                    <input type="text" id="testo" name="testo"><br>

                    <label for="album">Album:</label><br>
                    <input type="text" id="album" name="album"><br>

                    <label for="bpm">Bpm:</label><br>
                    <input type="text" id="bpm" name="bpm"><br>

                    <label for="genere">Genere:</label><br>
                    <select name="genere" id="genere">
                        <?php echo Data::getSelect(Get::generi()); ?>
                    </select><br>

                    <label for="tipologia">Tipologia:</label><br>
                    <select name="tipologia" id="tipologia">
                        <?php echo Data::getSelect(Get::tipologie()); ?>
                    </select><br>

                    <label for="ltipologia">Strumenti:</label><br>
                    <?php Data::printCheckBox(Get::strumenti(), "strumenti")?>

                    <input type="submit" value="submit">
                </form> 
            </div>
        </div>
    </div>
</body>



