<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clinic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="ManagersPanel/ManagersHandleSections.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                    <div class="card-body py-4 px-4 px-md-5">

                        <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                            <i class="fas fa-check-square me-1"></i>
                            <u>Sections</u>
                        </p>

                        <?php $form = \App\Core\Form\Form::begin(" ", "post");?>

                        <div class="pb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row align-items-center">
                                        <input type="text" class="form-control form-control-lg" name="newSection"
                                               placeholder="Add new...">
                                        <div>
                                            <input type="submit" class="btn btn-primary" value="Add">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <?php foreach ($sectionDetails as $sectionDetail) {

                            $doctorExist = \App\Core\DbModel::findSome(["partId" => $sectionDetail->id], "doctors");
                            echo $form->managersSectionField($sectionDetail, $doctorExist);
                        }?>


                    </div>


                    <div class="m-auto">
                        <input type="submit" class="btn btn-success" value="Submit">
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