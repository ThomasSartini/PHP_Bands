
<body>

    <div class="container" style="margin-top:100px">
        <div class="row">
            <div class="col">
                <form action="<?php echo URL; ?>login/home" method="POST">
                    <button type="submit">Indietro</button>
                </form>
            </div>
            <div class="col">
                <form action="<?php echo URL; ?>login/addCanzone" method="POST">
                    <button type="submit" class="float-right">Nuova</button>
                </form>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col">
               <h1>Lista Canzoni</h1>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <?php
                    Get::CanzoniTable(Get::listSelfCanzoni());
                ?>
            </div>
        </div>
    </div>
</body>