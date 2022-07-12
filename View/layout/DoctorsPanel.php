<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clinic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-12 col-xl-10">

                <div class="card">
                    <div class="card-header p-3 text-center">
                        <h5 class="">Your visits</h5>
                    </div>
                    <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 420px">

                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th scope="col">Patient</th>
                                <th scope="col">Age</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $form = \App\Core\Form\Form::begin(" ", "get");

                            foreach ($list as $patient) {
                                echo $form->patientsList($patient);
                            }

                            $form::end();
                            ?>

                            </tbody>
                        </table>
                    </div>

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
