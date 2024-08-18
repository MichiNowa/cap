

<style>
    * {
        font-size: 16px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table td {
        white-space: nowrap;
    }

    @media (max-width: 768px) {

        .table td,
        .table th {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }
    }

    .select-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: none;
        padding-right: 30px;
        width: 100%;
    }

    .select-wrapper::after {
        content: '\25BC';
        position: absolute;
        top: 50%;
        right: 10px;
        pointer-events: none;
        transform: translateY(-50%);
        font-size: 16px;
        color: #555;
    }
</style>


<!-- CONTENT -->
<div class="container justify-content-center box">
    <div class="row text-center">
        <div class="col">
            <h4 class="mt-3 mb-3" style="text-decoration:underline;">STUDENT PERSONAL INFORMATION SHEET</h4>
        </div>
    </div>
    <form action="">
        <div class="row">
            <div class="col">
                <table>
                    <tr>
                        <th><br></th>
                    </tr>
                    <tr>
                        <td>
                            <label for="formFile" class="form-label"><small>2x2 Picture Wearing SMCC
                                    Uniform (JPG/PNG)</small></label>
                            <input class="form-control" type="file" id="formFile">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <!-- <h2>name</h2> -->
                <table>
                    <th>
                        <u>For Basic Education</u>
                    </th>
                    <th>
                        <br><br>
                    </th>
                    <tr>
                        <td>
                            Grade/Year Level:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Level</option>
                                    <option value="">Grade 7</option>
                                    <option value="">Grade 8</option>
                                    <option value="">Grade 9</option>
                                    <option value="">Grade 10</option>
                                    <option value="">Grade 11</option>
                                    <option value="">Grade 12</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            School Year:
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select School Year</option>
                                    <option value="">2024-2025</option>
                                    <option value="">2025-2026</option>
                                    <option value="">2026-2027</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table>
                    <th>
                        <u>For College Department</u>
                    </th>
                    <th>
                        <br><br>
                    </th>
                    <tr>
                        <td>
                            <label for="">Semester: </label>
                            <input type="checkbox" name="" id="">
                            <label for="">1st </label>
                            <input type="checkbox" name="" id="">
                            <label for="">2nd </label>
                            <input type="checkbox" name="" id="">
                            <label for="">Summer </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Academic Year: </label>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Year</option>
                                    <option value="">2024-2025</option>
                                    <option value="">2025-2026</option>
                                    <option value="">2026-2027</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Program: </label>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Program</option>
                                    <option value="">BSIT</option>
                                    <option value="">BSCS</option>
                                    <option value="">BLIS</option>
                                </select>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Department: </label>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Department</option>
                                    <option value="">CCIS</option>
                                    <option value="">CTHM</option>
                                    <option value="">CBM</option>
                                </select>
                            </div>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col"><br></div>
        </div>


        <div class="row text-center">
            <div class="col">
                <input type="text" name="" id="surame" required class="form-control"><br>
                <label for=""><i>Surname</i></label>
            </div>
            <div class="col">
                <input type="text" name="" id="" required class="form-control"><br>
                <label for=""><i>Given Name</i></label>
            </div>
            <div class="col">
                <input type="text" name="" id="" required class="form-control"><br>
                <label for=""><i>Middle Name</i></label>
            </div>
            <div class="col">
                <input type="text" name="" id="" class="form-control"><br>
                <label for=""><i>Auxilliary Name (Sr,Jr,I,II,III,etc.)</i></label>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <br>
            </div>
        </div>



        <div class="row">
            <div class="col table-responsive">
                <table class="table table-light">
                    <tr>
                        <td><label for="gender-select">Gender</label></td>
                        <td>
                            <div class="select-wrapper">
                                <select name="gender" id="gender-select" class="form-control">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </td>
                        <td><label for="age">Age</label></td>
                        <td><input type="number" name="age" id="age" class="form-control"></td>
                        <td><label for="blood-type-select">Blood Type</label></td>
                        <td>
                            <div class="select-wrapper">
                                <select name="bloodtype" id="bloodtype-select" class="form-control">
                                    <option value="" selected disabled>Select Blood Type</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="height">Height (cm.)</label></td>
                        <td><input type="number" name="height" id="height" class="form-control"></td>
                        <td><label for="weight">Weight (kg.)</label></td>
                        <td><input type="number" name="weight" id="weight" class="form-control"></td>
                        <td><label for="civilstatus-select">Civil Status</label></td>
                        <td>
                            <div class="select-wrapper">
                                <select name="civilstatus" id="civilstatus-select" class="form-control">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="">Legally Separated</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>



        <div class="row">
            <div class="col"><br></div>
        </div>

        <div class="row">
            <div class="col table-responsive">
                <table class="table table-light">
                    <tr>
                        <td><label for="">Home Address</label></td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                        <td><label for="">Citizenship</label></td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="">Date of Birth</label></td>
                        <td><input type="date" name="" id="" class="form-control"></td>
                        <td><label for="">Contact No.</label></td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td><label for="">Religion</label></td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <tr>
                        <th rowspan="3" class="text-center">In Case of Emergency, Please Notify: </th>
                        <td>Name: </td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Relationship: </td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Contact No.: </td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <h4>PARENTAL BACKGROUND</h4>

                    <tr>
                        <td colspan="2">
                            <b>Father's Information</b>
                        </td>
                        <td colspan="2">
                            <b> Mother's Information</b>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            Surname
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            Surname
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            First Name
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            First Name
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Middle Name
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            Middle Name
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact No.
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            Contact No.
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Occupation
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            Occupation
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>

                    <tr>
                        <td class="">
                            Type of Employee <br>
                            <i>(Please mark (✓) any of the following, which is applicable)</i>
                        </td>

                        <td class="">
                            <input type="checkbox" name="" id="" class="">
                            <label for="">Goverment</label>

                            &emsp;<input type="checkbox" name="" id="" class="">
                            <label for="" class="">Entreprenuer</label>

                            &emsp;<input type="checkbox" name="" id="" class="">
                            <label for="">Private</label>

                            &emsp;<input type="checkbox" name="" id="" class="">
                            <label for="">NGO</label>

                            <br><input type="checkbox" name="" id="" class="">
                            <label for="">Self-Employed</label>

                            &emsp;<input type="checkbox" name="" id="" class="">
                            <label for="">OFW</label>

                            &emsp;<input type="checkbox" name="" id="-" class="">
                            <label for="">Others, pls specify</label>
                            <input type="text" name="" id="" class="form-control">

                        </td>
                        <td>
                            Type of Employee <br>
                            <i>(Please mark (✓) any of the following, which is applicable)</i>
                        </td>
                        <td class="">

                            <input type="checkbox" name="" id="-" class="">
                            <label for="">Goverment</label>

                            &emsp;<input type="checkbox" name="" id="-" class="">
                            <label for="" class="">Entrepreneur</label>

                            &emsp;<input type="checkbox" name="" id="-" class="">
                            <label for="">Private</label>

                            &emsp;<input type="checkbox" name="" id="-" class="">
                            <label for="">NGO</label>

                            <br><input type="checkbox" name="" id="-" class="">
                            <label for="">Self-Employed</label>

                            &emsp;<input type="checkbox" name="" id="-" class="">
                            <label for="">OFW</label>

                            &emsp;<input type="checkbox" name="" id="-" class="">
                            <label for="">Others, pls specify</label>
                            <input type="text" name="" id="-" class="form-control">
                    </tr>
                    <tr>
                        <td>
                            <i>Highest Education Attainment</i>
                        </td>
                        <td>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="">Primary School</option>
                                    <option value="">Junior High School</option>
                                    <option value="">Senior Highschool</option>
                                    <option value="">Vocational or TESDA (Diploma)</option>
                                    <option value="">Undergraduate (Bachelor’s Degree)</option>
                                    <option value="">Postgraduate (Master’s Degree)</option>
                                    <option value="">Doctoral (PhD)</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <i>Highest Education Attainment</i>
                        </td>
                        <td>
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Option</option>
                                    <option value="">Primary School</option>
                                    <option value="">Junior High School</option>
                                    <option value="">Senior Highschool</option>
                                    <option value="">Vocational or TESDA (Diploma)</option>
                                    <option value="">Undergraduate (Bachelor’s Degree)</option>
                                    <option value="">Postgraduate (Master’s Degree)</option>
                                    <option value="">Doctoral (PhD)</option>
                                </select>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i> Parent's Present Address</i>
                        </td>
                        <td class="" colspan="3">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Parent's Marital Status: </b><br>(Please mark (✓) any of the following, which is
                            applicable)
                        </td>
                        <td class="" colspan="3">

                            <input type="checkbox" name="" id="" class="" required>
                            <label for="">Married in Church</label>

                            &emsp;<input type="checkbox" name="" id="" class="" required>
                            <label for="">Mother Remarried</label>

                            &emsp;<input type="checkbox" name="" id="" class="" required>
                            <label for="">Father Remarried</label>

                            &emsp;<input type="checkbox" name="" id="" class="" required>
                            <label for="">Single Parents</label>

                            &emsp;<input type="checkbox" name="" id="" class="" required>
                            <label for="">Married Civilly</label>

                            &emsp;<input type="checkbox" name="" id="" class="" required>
                            <label for="">Father Remarried</label>

                            &emsp;<input type="checkbox" name="" id="" class="" required>
                            <label>If Separated, with whom do you stay: </label>
                            <input type="text" name="" id="" class="" required>
                        </td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <h4>EDUCATIONAL ATTAINMENT</h4>

                    <tr>
                        <th>

                        </th>
                        <th colspan="">
                            Name Of School
                        </th>
                        <th>
                            Year Graduated
                        </th>
                        <th>
                            Honor/s Received
                        </th>
                    </tr>

                    <tr>
                        <td>
                            Doctoral Degree

                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" colspan="">
                            <i>Program:</i>
                        </td>
                        <td colspan="3">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Masteral Degree
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" colspan="">
                            <i>Program:</i>
                        </td>
                        <td colspan="3">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            College
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end" colspan="">
                            <i>Degree:</i>
                        </td>
                        <td colspan="3">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tech-Voc
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            High School
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            ALS
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Elementary
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <tr>
                        <th>
                            Who is supporting your studies in SMCC?
                        </th>
                    </tr>

                    <tr>
                        <td>
                            <input type="checkbox" name="" id="">
                            <label for="">Mother</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Father</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Both Parents</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Self-supporting</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Working Student</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Lola/Lolo</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Aunt/Uncle</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Brother/Sister</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Educational Plan</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">NGO</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Private</label>

                            &emsp;<input type="checkbox" name="" id="">
                            <label for="">Foreign</label>

                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">

                    <tr>
                        <td>
                            <b>
                                Name of Sister/Brother
                            </b>
                        </td>
                        <td>
                            <b>
                                Age
                            </b>
                        </td>
                        <td>
                            <b>
                                Occupation
                            </b>
                        </td>
                        <td>
                            <b>
                                Educational Attainment
                            </b>
                        </td>
                    </tr>


                    <tr>
                        <td class="">
                            1. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            2. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            3. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            4. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            5. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            6. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            7. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            8. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            9. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            10. <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <tr>
                        <td>
                            Number of Person living at home
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            No. of Children in the family
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    <tr>
                        <td>
                            Is your homelife:
                        </td>
                        <td>
                            <input type="checkbox" name="" id="" class="">
                            <label>Very Happy</label>
                            <input type="checkbox" name="" id="" class="">
                            <label>Pleasant</label>
                            <br><input type="checkbox" name="" id="" class="">
                            <label>Bearable</label>
                            <input type="checkbox" name="" id="" class="">
                            <label>Unhappy</label>
                        </td>
                        <td>
                            Do you work at home?
                            <input type="checkbox" name="yes" id="yes" class="yes">
                            <label>Yes</label>
                            <input type="checkbox" name="no" id="no" class="no">
                            <label>No</label>
                        </td>
                        <td>
                            What/s work?
                            <input type="text" name="work" id="work" class="form-control">

                        </td>

                    </tr>
                    <tr>
                        <td colspan="">
                            What type of discipline is being implemented at home?
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td class="">
                            Who handles discipline at home?
                        </td>
                        <td>
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            What time do you sleep?
                        </td>
                        <td class="">
                            <input type="text" name="" id="" class="form-control" required>
                        </td>
                        <td>
                            Do you have friends? <input type="checkbox" name="yes" id="">
                            <label for="">Yes</label>
                        </td>
                        <td class="">
                            if yes, why do you
                            choose him/her
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <h4>INTERESTS</h4>
                    <tr>
                        <td>List down your present hobbies/interests</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>What do you enjoy more than anything else?</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>What organization/s do you belong in and out of school?</td>
                        <td><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <h4>HEALTH HISTORY</h4>
                    <tr>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Frequent Colds</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Pneumonia</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Heart Disease</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Kidney Infection</label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Chicken Pox</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Cough</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Polio</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Epilepsy</label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Migraine</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Sore Throats</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Ear Infection</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Asthma</label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Sore Eyes</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Measles</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Typhoid Fever</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Restlessness</label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Poor Sleeping Habit</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Vision Difficulties</label>
                        </td>
                        <td colspan="2"><input type="checkbox" name="" id="">
                            <label for="">Others Pls. Specify</label>
                            <input type="text" name="" id="" class="form-control">
                        </td>
                    </tr>

                </table>

                <div class="row mt-4">
                    <div class="col table-responsive">
                        <table class="table table-light align-middle">
                            <tr>
                                <td>Do you exhibit certain mannerisms? (Please Specify) </td>
                                <td><input type="text" name="" id="" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Do you have any past operations? (Please Specify) </td>
                                <td><input type="text" name="" id="" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Do you have any allergies? (Please Specify) </td>
                                <td><input type="text" name="" id="" class="form-control"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col table-responsive">
                <table class="table table-light align-middle">
                    <h4>INDIGENOUS PEOPLE'S ACT</h4>
                    <p><b><small>Pursuent to: (a) Indigenous People's Act (RA. 8371); (b) Magna Carta for Disabled
                                Person (RA.
                                7277);
                                and (c) Solo Parents Welfare act of 2000 (RA. 8972), Please answer the
                                following:</small></b></p>
                    <tr>
                        <td>a. Are you a member of any indigenous group?</td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Yes</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end">If "YES", please specify: </td>
                        <td colspan="2"><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>b. Are you differently abled?</td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Yes</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end">If "YES", please specify: </td>
                        <td colspan="2"><input type="text" name="" id="" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>c. Are you a solo parent?</td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">Yes</label>
                        </td>
                        <td><input type="checkbox" name="" id="">
                            <label for="">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-end">If "YES", please specify: </td>
                        <td colspan="2"><input type="text" name="" id="" class="form-control"></td>
                    </tr>

                </table>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <p><small>
                        Note: If there is anything that you would like to share with your Guidance Counselor, which
                        you think need assistance, feel free to write in a separate sheet of paper, Rest assured
                        that
                        everything would be kept under confidentiality and respect.
                    </small></p>
                <br><br>
                <div class="row">
                    <div class="col float-start"></div>
                    <div class="col float-end">
                        <p>I certify that the foreign information is true and correct, made in good faith and verified
                            by me to the best of my knowledge and belief</p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col float-start"></div>
                    <div class="col float-end">
                        <label for="formFile2" class="form-label"><small>Student's Digital Signature
                                (JPG/PNG)</small></label>
                        <input class="form-control" type="file" id="formFile2">
                    </div>
                </div>
                <br>
            </div>
        </div>


        <div class="row text-center">
            <div class="col">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <br>

    </form>
</div>


<!-- 
    <div class="input-group mb-3" style="width:90%;">
                                <input type="number" class="form-control">
                                <span class="input-group-text">cm.</span>
                            </div>
 -->

<!-- <div class="row text-center">
            <div class="col table-responsive">
                <table class="table table-light justify-content-center table-borderless">
                    <tr>
                        <td><input type="text" name="" id="" class="nameinput"></td>
                        <td><input type="text" name="" id="" class="nameinput"></td>
                        <td><input type="text" name="" id="" class="nameinput"></td>
                        <td><input type="text" name="" id="" class="nameinput"></td>
                    </tr>
                    <tr>
                        <td><i>Surname</i></td>
                        <td><i>Given Name</i></td>
                        <td><i>Middle Name</i></td>
                        <td><i>Auxilliary Name (Sr,Jr,I,II,III, etc)</i></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col"><input type="text" name="" id="" class="txtun"></div>
            <div class="col"><input type="text" name="" id="" class="txtun"></div>
            <div class="col"><input type="text" name="" id="" class="txtun"></div>
            <div class="col"><input type="text" name="" id="" class="txtun"></div>
        </div>
        <div class="row">
            <div class="col"><i>Surname</i></div>
            <div class="col"><i>Given Name</i></div>
            <div class="col"><i>Middle Name</i></div>
            <div class="col"><i>Auxilliary Name (Sr,Jr,I,II,III, etc)</i></div>
        </div> 
    
                            wrapper guide for select
                            <div class="select-wrapper">
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select Option</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                            </div>

                            table guide
                            <div class="row mt-4">
                                <div class="col table-responsive">
                                    <table class="table table-light align-middle">
                    
                                    </table>
                                </div>
                            </div>
    
    -->