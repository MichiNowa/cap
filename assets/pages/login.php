<!-- login form -->
<div class="container fluid text-center justify-content-center">
    <div class="tw-flex tw-justify-center tw-items-start tw-mt-8">
        <div class="tw-object-contain tw-p-4 tw-max-w-64 aspect-square">
            <img class="mb-4" src="<?= pathname('images/logo.jpg') ?>" alt="Guidance Logo">
        </div>
    </div>
    <div class="row justify-content-center">
        <h3>SMCC GUIDANCE CENTER</h3>
        <div class="col-sm-10 col-lg-4 bg-white border p-4 box">
            <form method="post" action="<?= pathname('api/post/login') ?>">
                <h1 class="h5 mb-3 text-muted">Login</h1>

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
                    <span><small>Forgot Password? <a href="<?= pathname('signup') ?>" class="text-decoration-none">Click
                                Here</a></small></span>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary col-12"><small class="text-light">Sign in</small></button>
                </div>
            </form>
        </div>
        <div class="col-12 mt-3 text-center">
            <span><small>Don't Have an Account? <a href="<?= pathname('signup') ?>" class="text-decoration-none">Register
                        Here</a></small></span>
        </div>
    </div>
</div>

<!-- see password -->
<script>
    function pswd_toggle() {
        var x = document.getElementById("floatingPassword");
        var box = document.getElementById("pswd_show");
        if (box.checked == 1) {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>