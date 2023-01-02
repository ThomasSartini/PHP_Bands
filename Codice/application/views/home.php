
    <body>
        <div class="container" style="margin-top:150px">
            <div class="row">
                <div class="col">
                    <h1 style="width:60%; margin: 0 20% 0 20%">Benvenuto <?php echo $_SESSION['user'] ?></h1>
                </div>
            </div>
            <br><br><br>
            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo URL; ?>login/canzoni" >
                        <button type="submit" class="btn btn-primary btn-block mb-4" style="width:60%; margin: 0 20% 0 20%">Canzoni</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo URL; ?>login/scalette" >
                        <button type="submit" class="btn btn-primary btn-block mb-4" style="width:60%; margin: 0 20% 0 20%">Scalette</button>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col">
                    <form method="POST" action="<?php echo URL; ?>login/" >
                    <button type="submit" class="btn btn-Secondary btn-block mb-4" style="width:20%; margin: 0 40% 0 40%">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>