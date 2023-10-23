<!-- ======= Counts Section ======= -->
<section id="counts" class="counts">


    <?php
    //import database
    include('db/dbconfig.php');

    $patientrow = $database->query("select  * from  patient;");
    $doctorrow = $database->query("select  * from  doctor;");
    $specialities = $database->query("select  * from  specialties;");


    ?>
    <div class="container">

        <div class="row">

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="fas fa-user-md"></i>
                    <span data-purecounter-start="0" data-purecounter-end="  <?php echo $doctorrow->num_rows ?>"
                          data-purecounter-duration="1" class="purecounter"></span>
                    <p>Doctors</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                <div class="count-box">
                    <i class="far fa-hospital"></i>
                    <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1"
                          class="purecounter"></span>
                    <p>Departments</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="fas fa-flask"></i>
                    <span data-purecounter-start="0" data-purecounter-end="  <?php echo $specialities->num_rows ?>"
                          data-purecounter-duration="1" class="purecounter"></span>
                    <p>Specialities</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="fas fa-award"></i>
                    <span data-purecounter-start="0" data-purecounter-end="  <?php echo $patientrow->num_rows ?>"
                          data-purecounter-duration="1" class="purecounter"></span>
                    <p>Patients</p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Counts Section -->