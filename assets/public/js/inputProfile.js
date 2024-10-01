$(document).ready(function() {
  var photoFormUrl = null;
  $("#formFile").on("change", function() {
    const file = this.files[0];
    if (file) {
      if (photoFormUrl) {
        URL.revokeObjectURL(photoFormUrl);
      }
      photoFormUrl = URL.createObjectURL(file);
      $("#form-photo-display").empty();
      const $img = $("<img>").attr('src', photoFormUrl).attr('alt', 'photo').addClass('tw-object-contain tw-aspect-square tw-w-[100px] tw-h-[100px] tw-mx-auto');
      $("#form-photo-display").append($img);
    }
  })

  $("form#profile-form input[type='radio'][name='education']").on('change', function() {
    if (this.value === 'basic') {

      $("select#formSemester").val('');
      $("select#formSemester").attr('disabled', true);
      $("select#formSemester").attr('required', false);
      
      $('select#formAcademicYear').val('');
      $('select#formAcademicYear').attr('disabled', true);
      $('select#formAcademicYear').attr('required', false);
      
      $('select#formDepartment').val('');
      $('select#formDepartment').attr('disabled', true);
      $('select#formDepartment').attr('required', false);
      
      $('select#formCourse').val('');
      $('select#formCourse').attr('disabled', true);
      $('select#formCourse').attr('required', false);

      $('select#formGradeLevel').attr('disabled', false);
      $('select#formGradeLevel').attr('required', true);
      
      $('select#formSchoolYear').attr('disabled', false);
      $('select#formSchoolYear').attr('required', true);

    } else if (this.value === 'college') {

      $('select#formGradeLevel').val('');
      $('select#formGradeLevel').attr('disabled', true);
      $('select#formGradeLevel').attr('required', false);
      
      $('select#formSchoolYear').val('');
      $('select#formSchoolYear').attr('disabled', true);
      $('select#formSchoolYear').attr('required', false);

      $("select#formSemester").attr('disabled', false);
      $("select#formSemester").attr('required', true);

      $('select#formAcademicYear').attr('disabled', false);
      $('select#formAcademicYear').attr('required', true);
      
      $('select#formDepartment').attr('disabled', false);
      $('select#formDepartment').attr('required', true);
      
      $('select#formCourse').attr('disabled', false);
      $('select#formCourse').attr('required', true);

    } else {

      $('select#formGradeLevel').val('');
      $('select#formGradeLevel').attr('disabled', true);
      
      $('select#formSchoolYear').val('');
      $('select#formSchoolYear').attr('disabled', true);

      $('select#formSemester').val('');
      $('select#formSemester').attr('disabled', true);
      
      $('select#formAcademicYear').val('');
      $('select#formAcademicYear').attr('disabled', true);
      
      $('select#formDepartment').val('');
      $('select#formDepartment').attr('disabled', true);
      
      $('select#formCourse').val('');
      $('select#formCourse').attr('disabled', true);

    }
  })

  $('select#formDepartment').append(Object.keys(DEPARTMENTSANDCOURSES).map((dept) => $('<option>').val(dept).text(dept)))
  $('select#formDepartment').on('change', function() {
    $('select#formCourse').append(DEPARTMENTSANDCOURSES?.[$('select#formDepartment').val()]?.map((course) => $('<option>').val(course).text(course)));
  })  
})