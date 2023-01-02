
    <body>
        <div class="container">
            <form method="POST" action="<?php echo URL; ?>login/index" class="form">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="labelEmail">Username</label>
                    <input type="text" class="form-control" name="user" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="labelPassword">Password</label>
                    <input type="password" class="form-control" name="password" />
                </div>

                <!-- Adminstrator input -->
                <div class="form-outline mb-4">
                    <input type="checkbox" name="administrator">
                    <label for="vehicle1"> Administrator</label><br>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

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
    </body>
</html>