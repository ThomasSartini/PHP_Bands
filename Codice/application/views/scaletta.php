
<body>

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
           <h1><?php echo Get::scalettaNome() ?></h1>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <form action="<?php echo URL; ?>login/canzone" method="POST">
                <?php Get::CanzoniTable(Get::listCanzoniScaletta()); ?>
            </form>
        </div>
    </div>
</div>
</body>