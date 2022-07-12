<?php

namespace App\Core\Form;


use App\Core\DbModel;
use App\Core\Model;

class Form
{

    public static function begin($action, $method, $options = [])
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }
        echo sprintf('<form action="%s" method="%s" %s>', $action, $method, implode(" ", $attributes));
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

    public function managersPanelField($details, $role){
        return sprintf('  <tr class="fw-normal">
                                <th>
                                    <img src="%s"
                                         alt="avatar 1" style="width: 45px; height: auto;">
                                    <span class="ms-2">%s</span>
                                </th>
                                <td class="align-middle">
                                    <span>%s</span>
                                </td>
                                <td class="align-middle">
                                    <h6 class="mb-0"><span class="badge %s">%s</span></h6>
                                </td>
                                <td class="align-middle">

                                    <input type="radio" class="btn-check" id="btncheck%s1" name="%s" value="Confirmed">
                                    <label class="btn btn-outline-success bi bi-check-lg" for="btncheck%s1"></label>

                                    <input type="radio" class="btn-check" id="btncheck%s2" name="%s" value="Not accepted">
                                    <label class="btn btn-outline-danger bi bi-x-lg" for="btncheck%s2"></label>

                                </td>
                            </tr>',
        $details->profileImage,
        $details->email,
        $role,
        $details->status == "Confirmed" ? "bg-success" : "bg-danger",
        $details->status,
        "$details->email\\$role",
        "$details->email\\$role",
        "$details->email\\$role",
        "$details->email\\$role",
        "$details->email\\$role",
        "$details->email\\$role"
        );
    }

    public function managersSectionField($sections, $doctorExistInSection){

        return sprintf(' <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                            <li
                                    class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                <p class="lead fw-normal mb-0">%s</p>
                            </li>

                            <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">


                                <div class="d-flex flex-row justify-content-end mb-1">


                                    <button class="btn text-info" type="button" data-mdb-toggle="tooltip" title="Edit" data-bs-toggle="modal" data-bs-target="#modal%s">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>

                                    <div class="modal fade" id="modal%s" tabindex="-1" aria-labelledby="modal%s" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal%s">Rename</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="rename%s" class="col-form-label">New name:</label>
                                                            <input type="text" class="form-control-label" name="rename\%s" id="rename%s">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="radio" class="btn-check" id="btncheck%s1" name="delete\%s" value="Delete" >
                                    <label class="btn btn-outline-danger bi bi-trash-fill" style="margin-left: 23px" for="btncheck%s1" ></label>


                                </div>
                            </li>
                        </ul>',
            $sections->partName,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id,
            $sections->id
        );
    }

    public static function selectField($sectionDetail){
        return sprintf('<option value="%d">%s</option>',
        $sectionDetail->id,
        $sectionDetail->partName
        );
    }

    public static function doctorCard($doctorDetail){
        return sprintf(' <div class="col-lg-6 mt-4">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="%s" class="" alt=""></div>
              <div class="member-info">
                <h4>%s</h4>
                <span>%s</span>
                <p>%s</p>
                <p>MEID: %s</p>
              </div>
            </div>
          </div>',
        $doctorDetail->profileImage,
        $doctorDetail->name,
        DbModel::findOne(["id" => $doctorDetail->partId], "hospital_parts")->partName,
        $doctorDetail->history,
        $doctorDetail->doctorateId
        );
    }


    public static function doctorCardPlusVisit($doctorDetail){
        return sprintf(' <div class="col-lg-12 mt-3">
            <div class="member d-flex justify-content-between">
              <div class="pic"><img src="%s" class="" alt=""></div>
              <div class="member-info">
                <h4>%s</h4>
                <span>%s</span>
                <p>%s</p>
                <p>MEID: %s</p>
              </div>
              <div class="">
                  <button class="btn btn-primary px-5" name="visit" value="%s">visit</button>
              </div>
            </div>
          </div>',
            $doctorDetail->profileImage,
            $doctorDetail->name,
            DbModel::findOne(["id" => $doctorDetail->partId], "hospital_parts")->partName,
            $doctorDetail->history,
            $doctorDetail->doctorateId,
            $doctorDetail->id
        );
    }

    public function doctorsList($doctor){
        return sprintf(' <tr class="fw-normal">
                                <th class="border-0">
                                    <img src="%s"
                                         class="shadow-1-strong rounded-circle" alt="avatar 1"
                                         style="width: 55px; height: auto;">
                                    <span class="ms-2">%s</span>
                                </th>
                                <td class="border-0 align-middle">%s</td>
                                <td class="border-0 align-middle">
                                    <h6 class="mb-0"><span class="">%s</span></h6>
                                </td>
                            </tr>',
                $doctor->profileImage,
                $doctor->name,
                DbModel::findOne(["id" => $doctor->partId], "hospital_parts")->partName,
                $doctor->doctorateId
        );
    }


    public function patientsList($patient){
        return sprintf(' <tr class="fw-normal">
                                <th class="border-0">
                                    <img src="%s"
                                         class="shadow-1-strong rounded-circle" alt="avatar 1"
                                         style="width: 55px; height: auto;">
                                    <span class="ms-2">%s</span>
                                </th>
                                <td class="border-0 align-middle">
                                    <h6 class="mb-0"><span class="">%s</span></h6>
                                </td>
                            </tr>',
            $patient->profileImage,
            $patient->name,
            $patient->age
        );
    }

    public function setTimeField($id, $day, $error,$errorMessage, $model){

        return sprintf(" 
        <tr>
            <th scope='row'>%s</th>
            <td>%s</td>
            <td>
                <div class='col-5'>
                    <input type='number' class='form-control' id='from_%s' name='from_%s' value='%s'>
                </div>

            </td>
            <td>
                <div class='col-5'>
                    <input type='number' class='form-control %s' id='until_%s' name='until_%s' value='%s'>
                    <div class='invalid-feedback'>%s</div>
                </div>
            </td>
        </tr>",
        $id,
        $day,
        $id,
        $id,
        $model->{'from_'.$id},
        $error,
        $id,
        $id,
        $model->{'until_'.$id},
        $errorMessage
        );
    }
}