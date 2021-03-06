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

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Days</th>
            <th scope="col">From</th>
            <th scope="col">Until</th>
        </tr>
        </thead>

        <?php $form = \App\Core\Form\Form::begin("", "get");?>

        <tbody>

        <?php foreach ($days as $id => $day){


            $attr = 'until_' . $id;
            $attr2 = 'from_' . $id;

            if ($model->hasError($attr)) {
                echo $form->setTimeField($id, $day, "is-invalid", $model->getFirstError($attr),$model);
            }
            else
                echo $form->setTimeField($id, $day, "", "",$model);
        }?>

        </tbody>
    </table>

    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <input type="submit" class="btn btn-primary btn-lg" value="Go">
    </div>

    <?php $form::end()?>

    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <a href="<?= $back ?>"><button class="btn btn-danger rounded-0 py-2" style="padding:205px">Back</button></a>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>