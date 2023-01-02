
    <body>
        <div class="container" style="margin-top:100px">
            <div class="row">
                <div class="col">
                    <h1>Benvenuto <?php echo $_SESSION['user'] ?></h1>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo URL; ?>login/canzoni" >
                        <button class='btn btn-primary' type='submit'>Canzoni</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo URL; ?>login/scalette" >
                        <button class='btn btn-primary' type='submit'>Scalette</button>
                    </form>
                </div>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo URL; ?>login/" >
                        <button class='btn btn-secondary' type='submit'>Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>