
<body>
    <?php if($_SESSION["errorMessage"] !== false) :?>
            <div class="p-3 mb-2 bg-danger text-white fixed-top" >
                <?php echo strtoupper($_SESSION["errorMessage"]); ?>
            </div>
    <?php endif; ?>

    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="col">
                <form action="<?php echo URL; ?>login/scalette" method="POST">
                    <button type="submit">Indietro</button>
                </form>
            </div>
            
        </div>
        <br><br>
        <div class="row">
            <div class="col">
               <h1>Nuova Scaletta</h1>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col">
                <form action="<?php echo URL; ?>login/writeScaletta" method="POST">
                        <label>Titolo</label><br>
                        <input type="text" name="titolo">
                        <br><br>
                        <label>Data</label><br>
                        <input type='date' name='data'>
                        <br><br>
                        <label>Ora inizio (formato HH:MM:SS)</label><br>
                        <input type='text' name='inizio'>
                        <br><br>
                        <label>Ora fine (formato HH:MM:SS)</label><br>
                        <input type='text' name='fine'>
                        <br><br><br>
                        <?php if(isset($_POST["automatico"])): ?>
                            <b>Seleziona Tipologia e/o genere per generare la scaletta o </b>
                            <button type="submit" name="manuale">Crea in modo manuale</button>
                        <?php else : ?>
                            <b>Scegli le canzoni da aggiungere alla scaletta o </b>
                            <button type="submit" name="automatico">Genera in modo automatico</button>
                        <?php endif; ?>
                        <br><br>
                    <?php if(isset($_POST["automatico"])): ?>
                        <label for="genere">Genere:</label><br>
                        <select name="genere" id="genere">
                            <option>tutti</option>
                            <?php echo Data::getSelect(Get::generi()); ?>
                        </select><br>

                        <label for="tipologia">Tipologia:</label><br>
                        <select name="tipologia" id="tipologia">
                            <option>tutte</option>
                            <?php echo Data::getSelect(Get::tipologie()); ?>
                        </select><br>
                    <?php else : ?>
                        <?php Data::printCompleteCheckBox(Get::listSelfCanzoni(), "canzoni", "titolo")?>
                        
                    <?php endif; ?>
                    <br>
                    <button type="submit">Crea</button>

                </form>
            </div>
        </div>
    </div>
</body>



