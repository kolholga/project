<? if (isset($_SESSION['error']) && $_SESSION['error'] != ''): ?>
    <p style="color: red;"><?= $_SESSION['error'] ?></p>
    <? unset($_SESSION['error']); ?>
<? endif; ?>
<form action="/admin/main/login" method="post">
    <div class="input-group mb-3">
        <input type="text" name="login" class="form-control" placeholder="Login">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" value="1" id="remember">
                <label for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>
