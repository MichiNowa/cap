<div class="container justify-content-center text-center box">
    <div class="row">
        <div class="col mt-4">
            <h1>Student Profile Information Sheet</h1>
            <form method="post" action="<?= assets('api/post/updateprofile') ?>">
                <div class="form-floating">
                    <input type="text" name="studentid" value="<?= showFormData('studentid') ?>"
                        class="form-control rounded-5" placeholder="username/email">
                    <label for="floatingInput">Student or Teacher ID</label>
                </div>
                <?= showError('studentid') ?>
                <div class="text-end mt-2">
                    <input type="checkbox" name="pswd_show" id="pswd_show" onclick="pswd_toggle()"><small> Show
                        Password</small>
                </div>
                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-5" id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <?= showError('password') ?>
                <?= showError('checkuser') ?>


                <div class="col-12 mt-3 text-center">
                    <span><small>Forgot Password? <a href="<?= assets('signup') ?>" class="text-decoration-none">Click
                                Here</a></small></span>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary col-12"><small class="text-light">Sign in</small></button>
                </div>
            </form>
        </div>
    </div>
</div>