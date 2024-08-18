<!-- regiuster form -->
<div class="container fluid text-center justify-content-center">
    <div class="tw-flex tw-justify-center tw-items-start tw-mt-8">
        <div class="tw-object-contain tw-p-4 tw-max-w-64 aspect-square">
            <img class="mb-4" src="<?= pathname('images/logo.jpg') ?>" alt="Guidance Logo">
        </div>
    </div>
    <div class="row justify-content-center">
        <h3>SMCC GUIDANCE CENTER</h3>
        <div class="col-sm-10 col-lg-4 bg-white border p-4 box">
            <form method="post" action="<?= pathname('api/post/signup') ?>">
                <h1 class="h5 mb-3 text-muted">Register Account</h1>
                <?php
                if (isset($_SESSION['newuser'])) {
                    ?>
                    <p style="text-align:center;" class="text-light bg-success rounded-1 p-1">Registration Successful</p>
                    <?php
                    unset($_SESSION['newuser']);
                }
                ?>
                <div class="form-floating mt-1">
                    <input type="text" name="studentid" value="<?= showFormData('studentid') ?>"
                        class="form-control rounded-3 " placeholder="">
                    <label for="floatingInput">Student or Teacher ID</label>
                </div>
                <?= showError('studentid') ?>

                <div class="d-flex mt-1">
                    <div class="form-floating mt-1 col-6 tw-pr-1">
                        <input type="text" name="first_name" value="<?= showFormData('first_name') ?>"
                            class="form-control rounded-3 " placeholder="">
                        <label for="floatingInput">First Name</label>
                    </div>
                    <div class="form-floating mt-1 col-6 tw-pl-1">
                        <input type="text" name="last_name" value="<?= showFormData('last_name') ?>"
                            class="form-control rounded-3 " placeholder="">
                        <label for="floatingInput">Last Name</label>
                    </div>
                </div>
                <?= showError('first_name') ?>
                <?= showError('last_name') ?>

                <!-- <div class="d-flex gap-3 my-3">
                    <label for="form-check" class="ms-1">Gender: </label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1"
                            <?= isset($_SESSION['formdata']) ? '' : 'checked' ?><?= showFormData('gender') == 1 ? 'checked' : '' ?>>
                        <label class="form-check-label " for="exampleRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input custom radio" type="radio" name="gender" id="exampleRadios3"
                            value="2" <?= showFormData('gender') == 2 ? 'checked' : '' ?>>
                        <label class="form-check-label " for="exampleRadios3">
                            Female
                        </label>
                    </div>
                </div> -->
                <div class="form-floating mt-2">
                    <input type="email" name="email" value="<?= showFormData('email') ?>"
                        class="form-control rounded-3 " placeholder="">
                    <label for="floatingInput">G-Suite Email</label>
                </div>
                <?= showError('email') ?>
                <div class="form-floating mt-1 position-relative">
                    <button type="button" id="pswd_show" class="position-absolute tw-right-0 tw-top-0 tw-h-full tw-aspect-square p-2 z-100" onclick="pswd_toggle()" data-show="false"><i class="bi bi-eye-slash-fill"></i></button>
                    <input type="password" name="password" class="form-control rounded-3 " id="floatingPassword"
                        placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <?= showError('password') ?>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn col-12 btn-primary text-light" type="submit">Sign Up</button>
                </div>
            </form>
        </div>
        <div class="col-12 mt-3 text-center">
            <span><small>Already Have an Account? <a href="<?= pathname('login') ?>" class="text-decoration-none">Login Here</a></small></span>
        </div>
    </div>
</div>

<script>
    // see passweord
    function pswd_toggle() {
        var x = document.getElementById("floatingPassword");
        var box = document.getElementById("pswd_show");

        if (box.dataset.show == "false") {
            x.type = "text";
            box.firstElementChild.classList.remove("bi-eye-slash-fill");
            box.firstElementChild.classList.add("bi-eye-fill");
            box.setAttribute("data-show", "true");
        } else {
            x.type = "password";
            box.firstElementChild.classList.remove("bi-eye-fill");
            box.firstElementChild.classList.add("bi-eye-slash-fill");
            box.setAttribute("data-show", "false");
        }
    }
</script>