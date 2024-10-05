$(document).ready(function () {
  // make all input radio pointer cursor
  $("input[type=radio]").each(function() {
    if (!$(this).hasClass("tw-cursor-pointer")) {
      $(this).addClass("tw-cursor-pointer");
    }
    const id = $(this).attr("id");
    if (id) {
      const $label = $("label[for=" + id + "]");
      if (!$label.hasClass("tw-cursor-pointer")) {
        $label.addClass("tw-cursor-pointer");
      }
    }
  });
  $("input[type=checkbox]").each(function() {
    if (!$(this).hasClass("tw-cursor-pointer")) {
      $(this).addClass("tw-cursor-pointer");
    }
    const id = $(this).attr("id");
    if (id) {
      const $label = $("label[for=" + id + "]");
      if (!$label.hasClass("tw-cursor-pointer")) {
        $label.addClass("tw-cursor-pointer");
      }
    }
  });
  //
  var photoFormUrl = null;
  $("#formFile").on("change", function () {
    const file = this.files[0];
    if (file) {
      if (photoFormUrl) {
        URL.revokeObjectURL(photoFormUrl);
      }
      photoFormUrl = URL.createObjectURL(file);
      $("#form-photo-display").empty();
      const $img = $("<img>")
        .attr("src", photoFormUrl)
        .attr("alt", "photo")
        .addClass(
          "tw-object-contain tw-aspect-square tw-w-[100px] tw-h-[100px] tw-mx-auto"
        );
      $("#form-photo-display").append($img);
    }
  });

  $("form#profile-form input[type='radio'][name='education']").on(
    "change",
    function () {
      if (this.value === "basic") {
        $("select#formSemester").val("");
        $("select#formSemester").prop('disabled', true);
        $("select#formSemester").attr("required", false);

        $("select#formAcademicYear").val("");
        $("select#formAcademicYear").prop('disabled', true);
        $("select#formAcademicYear").attr("required", false);

        $("select#formDepartment").val("");
        $("select#formDepartment").prop('disabled', true);
        $("select#formDepartment").attr("required", false);

        $("select#formCourse").val("");
        $("select#formCourse").prop('disabled', true);
        $("select#formCourse").attr("required", false);

        $("select#formGradeLevel").prop('disabled', false);
        $("select#formGradeLevel").attr("required", true);

        $("select#formSchoolYear").prop('disabled', false);
        $("select#formSchoolYear").attr("required", true);
      } else if (this.value === "college") {
        $("select#formGradeLevel").val("");
        $("select#formGradeLevel").prop('disabled', true);
        $("select#formGradeLevel").attr("required", false);

        $("select#formSchoolYear").val("");
        $("select#formSchoolYear").prop('disabled', true);
        $("select#formSchoolYear").attr("required", false);

        $("select#formSemester").prop('disabled', false);
        $("select#formSemester").attr("required", true);

        $("select#formAcademicYear").prop('disabled', false);
        $("select#formAcademicYear").attr("required", true);

        $("select#formDepartment").prop('disabled', false);
        $("select#formDepartment").attr("required", true);

        $("select#formCourse").prop('disabled', false);
        $("select#formCourse").attr("required", true);
      } else {
        $("select#formGradeLevel").val("");
        $("select#formGradeLevel").prop('disabled', true);

        $("select#formSchoolYear").val("");
        $("select#formSchoolYear").prop('disabled', true);

        $("select#formSemester").val("");
        $("select#formSemester").prop('disabled', true);

        $("select#formAcademicYear").val("");
        $("select#formAcademicYear").prop('disabled', true);

        $("select#formDepartment").val("");
        $("select#formDepartment").prop('disabled', true);

        $("select#formCourse").val("");
        $("select#formCourse").prop('disabled', true);
      }
    }
  );

  $("select#formDepartment").append(
    Object.keys(DEPARTMENTSANDCOURSES).map((dept) =>
      $("<option>").val(dept).text(dept)
    )
  );
  $("select#formDepartment").on("change", function () {
    $("select#formCourse").append(
      DEPARTMENTSANDCOURSES?.[$("select#formDepartment").val()]?.map((course) =>
        $("<option>").val(course).text(course)
      )
    );
  });
  $("input[type=radio][name=father_employee_type]").on("change", function() {
    if ($(this).attr("id") === "formFatherEmpType6") {
      $(this).attr("name", null);
      $("input#formFatherEmpTypeSpecify").attr("name", "father_employee_type").prop('disabled', false).prop('required', true);
    } else {
      $("input[type=radio]#formFatherEmpType6").attr("name", "father_employee_type")  ;
      $(this).prop("checked", true);
      $("input#formFatherEmpTypeSpecify").val('').attr("name", null).prop('disabled', true).prop('required', false);
    }
  });
  $("input[type=radio][name=mother_employee_type]").on("change", function() {
    if ($(this).attr("id") === "formMotherEmpType6") {
      $(this).attr("name", null);
      $("input#formMotherEmpTypeSpecify").attr("name", "mother_employee_type").prop('disabled', false).prop('required', true);
    } else {
      $("input[type=radio]#formMotherEmpType6").attr("name", "mother_employee_type")  ;
      $(this).prop("checked", true);
      $("input#formMotherEmpTypeSpecify").val('').attr("name", null).prop('disabled', true).prop('required', false);
    }
  });
  $("input[type=radio][name=parent_marital_status]").on("change", function() {
    if ($(this).attr("id") === "formParentMaritalStatus6") {
      $(this).attr("name", null);
      $("input#formParentMaritalStatusSpecify").attr("name", "parent_marital_status").prop('disabled', false).prop('required', true);
    } else {
      $("input[type=radio]#formParentMaritalStatus6").attr("name", "parent_marital_status");
      $(this).prop("checked", true);
      $("input#formParentMaritalStatusSpecify").val('').attr("name", null).prop('disabled', true).prop('required', false);
    }
  });
  $("select#formNoOfSiblings").on("change", function () {
    const noOfSiblings = Number.parseInt($(this).val());
    $("tbody#siblings-rows").empty()
    const columns = ["name", "age", "occupation", "educational_attainment"];
    if (noOfSiblings == 0 || isNaN(noOfSiblings)) {
      const $tr = $("<tr>");
      for (col of columns) {
        const $td = $("<td>")
          .append(
            $("<input>")
              .attr("type", col == "age" ? "number" : "text")
              .prop('disabled', true)
              .addClass("form-control")
          );
        $tr.append($td);
      }
      $("tbody#siblings-rows").append($tr);
    } else {
      for (let i = 0; i < noOfSiblings; i++) {
        const $tr = $("<tr>");
        for (col of columns) {
          const $td = $("<td>")
            .append(
              $("<input>")
              .attr("type", col == "age" ? "number" : "text")
                .attr("name", `siblings[${i}][${col}]`)
                .attr("id", `formSiblings[${i}][${col}]`)
                .attr("required", true)
                .addClass("form-control")
            )
          $tr.append($td);
        }
        $("tbody#siblings-rows").append($tr);
      }
    }
  });
  $("input[type=radio][name=workathome]").on("change", function () {
    if ($(this).val() === "Yes") {
      $("input#formWork").prop('disabled', false).prop('required', true);
    } else {
      $("input#formWork").prop('disabled', true).prop('required', false).val('');
    }
  });
  $("input[type=radio][name=have_friends]").on("change", function () {
    if ($(this).val() === "Yes") {
      $("input#formWhyFriend").prop('disabled', false).prop('required', true);
    } else {
      $("input#formWhyFriend").prop('disabled', true).prop('required', false).val('');
    }
  });
  $("input[type=checkbox]#formHistoryOthers").on("change", function() {
    if (this.checked) {
      $("input#formHistoryOthersSpecify").prop('disabled', false).prop('required', true);
    } else {
      $("input#formHistoryOthersSpecify").prop('disabled', true).prop('required', false).val('');
    }
  });
  $("input[type=radio][name=indigenous_group]").on("change", function () {
    if ($(this).val() === "Yes") {
      $("input#formIndigenousGroupSpecify").prop('disabled', false).prop('required', true);
    } else {
      $("input#formIndigenousGroupSpecify").prop('disabled', true).prop('required', false).val('');
    }
  });
  $("input[type=radio][name=differently_abled]").on("change", function () {
    if ($(this).val() === "Yes") {
      $("input#formDifferentlyAbledSpecify").prop('disabled', false).prop('required', true);
    } else {
      $("input#formDifferentlyAbledSpecify").prop('disabled', true).prop('required', false).val('');
    }
  });
  $("input[type=radio][name=solo_parent]").on("change", function () {
    if ($(this).val() === "Yes") {
      $("input#formSoloParentSpecify").prop('disabled', false).prop('required', true);
    } else {
      $("input#formSoloParentSpecify").prop('disabled', true).prop('required', false).val('');
    }
  });
});
