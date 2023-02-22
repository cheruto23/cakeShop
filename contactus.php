<?php include('partials-frontend/menu.php'); ?>

    <form action="#">
       
        <table style="width:100%;max-width:550px;border:0;" cellpadding="8" cellspacing="0">
        <tr> <td>
        <label for="Name">Name*:</label>
        </td> <td>
        <input name="Name" type="text" maxlength="60" style="width:100%;max-width:250px;" />
        </td> </tr> <tr> <td>
          <br>
        <label for="PhoneNumber">Phone number:</label>
        </td> <td>
        <input name="PhoneNumber" type="text" maxlength="43" style="width:100%;max-width:250px;" />
        </td> </tr> <tr> <td>
          <br>
        <label for="FromEmailAddress">Email address*:</label>
        </td> <td>
        <input name="FromEmailAddress" type="text" maxlength="90" style="width:100%;max-width:250px;" />
        </td> </tr> <tr> <td>
          <br>
        <label for="Comments">Comments*:</label>
        </td> <td>
        <textarea name="Comments" rows="7" cols="40" style="width:100%;max-width:350px;"></textarea>
        </td> </tr> <tr> <td>
          <br>
        * - required fields
        </td> <td>
          <br>
        <input name="skip_Submit" type="submit" value="Submit" />
        </td> </tr>
        </table>
        </form>

        <?php include('partials-frontend/footer.php') ?>