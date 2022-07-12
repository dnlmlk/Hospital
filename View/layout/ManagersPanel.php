<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clinic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="ManagersPanel/ManagersPanel.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

<section class="vh-130 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-12 col-xl-10">

                <div class="card mask-custom">
                    <div class="card-body p-4 text-white">

                        <div class="text-center pt-3 pb-2">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-todo-list/check1.webp"
                                 alt="Check" width="60">
                            <h2 class="my-4">User Status</h2>
                        </div>

                        <table class="table text-white mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col">Accessibility</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $form = \App\Core\Form\Form::begin(" ", "post");?>

                            <?php foreach ($managersDetails as $manager){

                                if ($manager->email != \App\Core\Application::$app->session->get("email") && $manager->email != "admin@admin.com")
                                echo $form->managersPanelField($manager, "Manager");
                            }?>

                            <?php foreach ($doctorsDetails as $doctor){

                                echo $form->managersPanelField($doctor, "Doctor");
                            }?>



                            </tbody>
                        </table>

                    </div>
                    <div class="m-auto">
                        <input type="submit" value="Submit" class="btn btn-success rounded-2 py-2 px-3 m-2">
                    </div>

                    <?php $form::end()?>


                    <div class="m-auto">
                        <a href="<?= $back ?>"><button class="btn btn-danger rounded-3 py-2 m-2" style="padding:205px">Back</button></a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>