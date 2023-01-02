
    <body>
        <div class="container" style="margin-top:150px">
            <div class="row">
                <h1 style="width:60%; margin: 0 20% 0 20%">Login</h1>
            </div>
            <br><br>
            <div class="row">
                <form method="POST" action="<?php echo URL; ?>login/index" class="form" style="width:100%">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="labelEmail" style="width:60%; margin: 0 20% 0 20%" >Username</label>
                        <input type="text" class="form-control" name="user" style="width:60%; margin: 0 20% 0 20%"/>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="labelPassword" style="width:60%; margin: 0 20% 0 20%">Password</label>
                        <input type="password" class="form-control" name="password" style="width:60%; margin: 0 20% 0 20%"/>
                    </div>

                    <!-- Adminstrator input -->
                    <div class="form-outline mb-4">
                        <input type="checkbox" name="administrator" style="margin-left: 20%">
                        <label for="vehicle1"> Administrator</label><br>
                    </div>
                    <br>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4" style="width:20%; margin: 0 40% 0 40%">Login</button>

                    <!-- Error -->
                    <?php if(isset($data['error'])): ?>
                        <div class="error">
                            <p>
                                Nome utente o password non corretti.
                                Riprova con le credenziali giuste, per favore
                            </p>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </body>
</html>