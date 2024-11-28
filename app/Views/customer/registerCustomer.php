<?php
/* Loads the form and url helper */	
helper(['url']);
 
$index_path = getenv('INDEX');

echo view('header'); 
echo view('sidebar'); 

//possibly use form helper and table library for this task.
// stay open
?>
<?php echo form_open("$index_path/CustomerController/registerCustomer");?>

  <h1><p>Register You Details</p></h1> <br />
  <table width="553" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td width="181"><label for="companyName">Company Name</label> 
      <span style="color: red;"><?= \Config\Services::validation()->getError('companyName') ?></span>
    </td>
      </td>
      <td width="356"><input name="companyName" type="text" id="companyName" size="45"/></td>
    </tr>
    <tr>
      <td><label for="contactLastName">Contact Last Name</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('contactLastName') ?></span>
    </td>
      <td><input name="contactLastName" type="text" id="contactLastName" size="45"/></td>
    </tr>
    <tr>
      <td><label for="contactFirstName">Customer First Name</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('contactFirstName') ?></span>
    </td>
      <td><input type="text" name="contactFirstName" id="contactFirstName" size="45"/></td>
    </tr>
    <tr>
      <td><label for="phone">Phone</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('phone') ?></span>
    </td>
      <td><input type="text" name="phone" id="phone" size="45" /></td>
    </tr>
    <tr>
      <td><label for="addressLine1">Address 1</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('addressLine1') ?></span>
    </td>
      <td><input type="text" name="addressLine1" id="addressLine1" size="45"/></td>
    </tr>
    <tr>
      <td><label for="addressLine2">Address 2</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('addressLine2') ?></span>
    </td>
      <td><input type="text" name="addressLine2" id="addressLine2" size="45"/></td>
    </tr>
    <tr>
      <td><label for="city">City</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('city') ?></span>
    </td>
      <td><input type="text" name="city" id="city" size="45"/></td>
    </tr>
    <tr>
      <td><label for="state">State</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('state') ?></span>
    </td>
      <td><input type="text" name="state" id="state" size="45"/></td>
    </tr>
    <tr>
      <td><label for="postalCode">Postal Code</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('postalCode') ?></span>
    </td>
      <td><input type="text" name="postalCode" id="postalCode" size="45"/></td>
    </tr>
    <tr>
      <td><label for="country">Country</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('country') ?></span>
    </td>
      <td><input type="text" name="country" id="country" size="45"/></td>
    </tr>
    <tr>
      <td><label for="email">Email</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('email') ?></span>
    </td>
      <td><input type="text" name="email" id="email" size="45"/></td>
    </tr>
    
    <tr>
      <td><label for="password">Password</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('password') ?></span>
    </td>
      <td><input type="text" name="password" id="password" size="45"/></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="553" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td><input type="submit" name="register" id="register" value="Register" /></td>
      <td><input type="reset" name="reset" id="reset" value="Reset" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;  </p>
</form>
<?php echo view('footer'); ?>