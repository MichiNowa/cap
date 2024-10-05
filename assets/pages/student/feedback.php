<?php
if ($user->role !== 'student') {
  redirect($user->role === 'superadmin'
    ? "/schoolyear"
    : "/dashboard");
}
?>

<style>
  * {
    font-size: 16px;
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
      <h4 class="mt-3 mb-3">CLIENT'S COUNSELING FEEDBACK</h4>
    </div>
  </div>
  <form action="">
    <p class="">
      This form allows you an oppurnity to provide feedback to your counselor after your session/s have finished.
      This will help your counselor's professional development as well as helping to improve the service offered
      to others. <strong>YOU DO NOT need to identify yourself</strong>. Please place a mark in the box which
      mostly closely corresponds how you feel about each statement
    </p>
    <div class="container justify-content-center">
      <div class="row">
        <div class="col" style="margin-left:auto; margin-right:auto; max-width:fit-content;">
          <p><b>Rating Scale:</b> <br>
            &nbsp;4- Strongly Agree <br>
            &nbsp;3- Somewhat Agree <br>
            &nbsp;2- Somewhat Disagree <br>
            &nbsp;1- Strongly Disagree</p>
        </div>
      </div>
    </div>

    <div class="row mt-4 justify-content-center" style="margin:auto;">
      <div class="col table-responsive">
        <table class="table table-light align-middle">
          <tr>
            <td><b>A. Working Relationship With Your Counselor</b></td>
            <td><b>Rating</b></td>
          </tr>
          <tr>
            <td>
              1. My counselor listened to me effectively.
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              2. My counselor understood things from my point of view.
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              3. My counselor focused on what was important to me.
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              4. My counselor accepted what i said without judging me.
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              5. My counselor showed warmth toward me
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              6. My counselor fostered a safe and trusting environment.
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              7. My counselor began and finished our session/s on time
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              8. My counselor followed my lead during our session/s whenever that was appropriate
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              9. My counselor provided leadership during our session/s when if that was appropriate
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              10. My counselor challenge me when/if that was appropriate
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <b>B. Result of Working With Your Counselor</b>
            </td>
            <td>
              <b>Rating</b>
            </td>
          </tr>
          <tr>
            <td>
              11. The session/s with my counselor helped me with whatever originally led me to seek
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              12. Any changes which might have occurred in me as a result of my counseling have been
              positive and welcome.
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">4</option>
                  <option value="">3</option>
                  <option value="">2</option>
                  <option value="">1</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <b>C. Overall Satisfaction</b>
            </td>
          </tr>
          <tr>
            <td colspan="">
              13. My overall level of satisfaction with the service provided by my counselor is:
            </td>
            <td>
              <div class="select-wrapper">
                <select name="" id="" class="form-control">
                  <option value="" selected disabled>Rate</option>
                  <option value="">Very Satisfied</option>
                  <option value="">Somewhat Satisfied</option>
                  <option value="">Somewhat Dissatisfied</option>
                  <option value="">Strongly Dissatisfied</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="">
              14. Based on my experience, I would recommend my counselor to others
            </td>
            <td>
              <input type="checkbox" name="yes" id="yes" class="yes">
              <label>Yes</label> &nbsp;
              <input type="checkbox" name="no" id="no" class="no">
              <label>No</label>
            </td>
          </tr>
          <tr>
            <th colspan="2">
              D. Other Comments
            </th>
          </tr>
          <tr>
            <td colspan="2" class="">
              <div class="">Please use the space below for any other comments you would like to bring to your
                counselor's attention. (If there are any matter which you specifically would not have
                wanted to discuss with your counselor in person your counselor would be especially glad
                to know of these). If you include your name in this section, it will be treated as
                <strong>CONFIDENTIAL</strong>.
              </div>
              <br>
              <input type="text" name="" id="" class="form-control">

            </td>
          </tr>
        </table>
      </div>
    </div>


    <br>
    <div class="row text-center">
      <div class="col">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
    <br>
  </form>
</div>