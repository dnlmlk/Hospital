<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Profile/css/bootstrap.min.css">
    <link rel="stylesheet" href="Profile/css/bootstrap/bootstrap.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="Profile/css/style.css">

    <title>Contact Form #6</title>
  </head>
  <body>
  

  <div class="content">
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6">
              
              <h3 class="heading mb-4">Please Complete Form</h3>
              <p>have a nice day</p>

              <p><img src="Profile/images/undraw-contact.svg" alt="Image" class="img-fluid"></p>


            </div>
            <div class="col-md-6">

            <?php if (\App\Core\Application::$app->session->getFlash("updateForm")){?>
            <div class="alert alert-success" style="margin-top: 85px;">
                <?= \App\Core\Application::$app->session->getFlash("updateForm");?>
            </div>
            <?php }?>
<!-- 111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111 -->
              <form class="mb-5" method="post" id="contactForm" enctype="multipart/form-data" name="contactForm" action="">
                  <div class="row">
                      <div class="col-md-12 form-group">
                          <input type="text" class="form-control" name="name" value="<?= $details->name ?>" id="name" placeholder="Your name">
                      </div>
                  </div>

                  <?php $filed = \App\Core\Application::$app->session->get("role")=="Doctor" ? "doctorateId" : "age" ?>

                  <div class="row">
                    <div class="col-md-12 form-group">
                      <input type="number" class="form-control" name="<?= $filed?>" value="<?= $details->{$filed} ?>" id="<?= $filed?>" placeholder="<?= $filed?>">
                    </div>
                  </div>

                  <?php if (\App\Core\Application::$app->session->get("role")=="Doctor"){?>

                      <div class="row">
                          <div class="col-md-12 form-group">
                              <select class="form-select" aria-label="Default select example" name="partId">
                                  <option selected value="<?= $details->partId == '' ? '' : $details->partId?>"><?= $details->partId == null ? "Choose your section" : \App\Model\FormModel::findOne(['id' => $details->partId], 'hospital_parts')->partName ?></option>

                                  <?php
                                  foreach ($sectionDetails as $sectionDetail) {
                                      echo \App\Core\Form\Form::selectField($sectionDetail);
                                  }
                                  ?>

                              </select>
                          </div>
                      </div>

                  <?php } ?>

                <div class="row">
                   <img src="<?= $details->profileImage == null ? 'ProfileImages/user.png?>' : $details->profileImage ?>"class="col-md-6 image img-fluid">
                  <div class="col-md-6 form-group">
                    <input type="file" class="form-control" name="profileImage"  id="image" placeholder="Upload a profile image" accept="image/png, image/gif, image/jpeg">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <textarea class="form-control" name="history" id="history" cols="30" rows="7" placeholder="Write about your history"><?= $details->history ?></textarea>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-12">
                    <input type="submit" value="Update" class="btn btn-primary rounded-0 py-2 px-4">
                  </div>
                </div>
              </form>
<!-- 111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111 -->
              <div class="">
                <a href="<?= $back ?>"><button class="btn btn-danger rounded-0 py-2" style="padding:205px">Back</button></a>
              </div>

              <div id="form-message-warning mt-4"></div> 
              <div id="form-message-success">
                Your message was sent, thank you!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>