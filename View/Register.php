<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

<?php $form = \App\Core\Form\Form::begin(" ", "post");?>

<div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
    <div class="btn-group form-outline flex-fill mb-0">
        <input type="radio" class="btn-check" name="role" value="Patient" id="btnradio1" autocomplete="off" required>
        <label class="btn btn-outline-primary" for="btnradio1">Patient</label>

        <input type="radio" class="btn-check" name="role" value="Manager" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio2">Manager</label>

        <input type="radio" class="btn-check" name="role" value="Doctor" id="btnradio3" autocomplete="off">
        <label class="btn btn-outline-primary" for="btnradio3">Doctor</label>
    </div>
</div>

<div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
    <?= $form->field($model, "email");?>
</div>

<div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
    <?= $form->field($model, "password")->passwordField();?>
</div>

<div class="d-flex flex-row align-items-center mb-4">
    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
    <?= $form->field($model, "confirmPassword")->passwordField();?>

</div>

<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
    <input type="submit" class="btn btn-primary btn-lg" value="Register">
</div>

<?= \App\Core\Form\Form::end()?>

<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
    <a class="btn btn-outline-danger" href="/Loginn">or login here</a>
</div>
</div>
<div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
         class="img-fluid" alt="Sample image">