
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
                    <br><br><br>
                    <b>Scegli le canzoni da aggiungere alla scaletta</b>
                    <br><br>
                    <?php Data::printCompleteCheckBox(Get::listSelfCanzoni(), "canzoni", "titolo")?>
                    <br>
                    <button type="submit">Crea</button>

                </form>
            </div>
        </div>
    </div>
</body>



