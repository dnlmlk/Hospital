<?php if (\App\Core\Application::$app->session->getFlash("visit")){?>
    <div class="alert alert-success" style="margin-top: 85px;">
        <?= \App\Core\Application::$app->session->getFlash("visit");?>
    </div>
<?php }?>

</div>

<section id="doctors" class="doctors">
      <div class="container">

        <div class="section-title">
          <h2>Doctors List</h2>
        </div>

          <?php $form = \App\Core\Form\Form::begin(" ", "get");?>

          <div class="container mt-4">
              <div class="row d-flex justify-content-center">
                  <div class="col-md-12">
                      <div class="card p-4 mt-3">
                          <div class="d-flex justify-content-center px-5">
                              <div class="search">
                                  <input type="text" class="search-input" placeholder="Search..." name="search">
                                  <button  class="btn search-icon">
                                      <i class="fa fa-search"></i>
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-3 py-3 m-auto">
            <select class="form-select" aria-label="Default select example" name="partId">
                  <option selected value="">Choose your section</option>

                <?php
                foreach ($sectionDetails as $sectionDetail) {
                    echo \App\Core\Form\Form::selectField($sectionDetail);
                }
                ?>
            </select>
          </div>

          <?php $form::end();?>

          <div class="row">

            <?php

            $form2 = \App\Core\Form\Form::begin(" ", "post");

            foreach ($doctors as $doctor) {
                echo \App\Core\Form\Form::doctorCardPlusVisit($doctor);
            }

            $form2::end();
            ?>




        </div>

      </div>
    </section>