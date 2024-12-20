<?php
/* Loads the form and url helper */	
helper(['url', 'form', 'html']);

$index_path = getenv('INDEX');

echo view('header'); 
echo view('sidebar'); 
			
echo form_open("$index_path/handleCustomerActivity/". $Customer['customerNumber']); ?>

  <p><h1>Details for Customer: <?php echo $Customer['customerNumber'] ?></p></h1> <br />
  <table width="553" border="0" cellpadding="5" cellspacing="5">
  <tr style="display: none;">
      <td width="181"><label for="customerNumber">Customer Number</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('customerNumber') ?></span>
    </td>   
      <td width="356"><input name="customerNumber" type="text" id="customerNumber" size="45" value="<?php echo $Customer['customerNumber'] ?>" /></td>
    </tr>

    <tr>
      <td width="181"><label for="customerName">Customer Name</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('customerName') ?></span>
    </td>
      <td width="356"><input name="customerName" type="text" id="customerName" size="45" value="<?php echo $Customer['customerName'] ?>" /></td>
    </tr>
    <tr>
      <td><label for="contactLastName">Contact Last Name</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('contactLastName') ?></span>
      </td>
      <td><input name="contactLastName" type="text" id="contactLastName" size="45" value="<?php echo $Customer['contactLastName'] ?>"  /></td>
    </tr>
    <tr>
      <td><label for="contactFirstName">Customer First Name</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('contactFirstName') ?></span>
      </td>
      <td><input type="text" name="contactFirstName" id="contactFirstName" size="45" value="<?php echo $Customer['contactFirstName'] ?>"  /></td>
    </tr>
    <tr>
      <td><label for="phone">Phone</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('phone') ?></span>
      </td>
      <td><input type="text" name="phone" id="phone" size="45" value="<?php echo $Customer['phone'] ?>" /></td>
    </tr>
    <tr>
      <td><label for="addressLine1">Address 1</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('addressLine1') ?></span>
      </td>
      <td><input type="text" name="addressLine1" id="addressLine1" size="45" value="<?php echo $Customer['addressLine1'] ?>"  /></td>
    </tr>
    <tr>
      <td><label for="addressLine2">Address 2</label>

      <span style="color: red;"><?= \Config\Services::validation()->getError('addressLine2') ?></span></td>
      <td><input type="text" name="addressLine2" id="addressLine2" size="45" value="<?php echo $Customer['addressLine2'] ?>" /></td>
    </tr>
    <tr>
      <td><label for="city">City</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('city') ?></span>
      </td>
      <td><input type="text" name="city" id="city" size="45" value="<?php echo $Customer['city'] ?>" /></td>
    </tr>
    <tr>
      <td><label for="state">State</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('state') ?></span>
      </td>
      <td><input type="text" name="state" id="state" size="45" value="<?php echo $Customer['state'] ?>"  /></td>
    </tr>
    <tr>
      <td><label for="postalCode">Postal Code</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('postalCode') ?></span>
      </td>
      <td><input type="text" name="postalCode" id="postalCode" size="45" value="<?php echo $Customer['postalCode'] ?>"  /></td>
    </tr>
    <tr>
      <td><label for="country">Country</label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('country') ?></span>
      </td>
      <td><input type="text" name="country" id="country" size="45" value="<?php echo $Customer['country'] ?>" /></td>
    </tr>
    <tr>
      <td><label for="creditLimit">Credit Limit </label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('creditLimit') ?></span>
      </td>
      <td><input type="text" name="creditLimit" id="creditLimit" size="45" value="<?php echo $Customer['creditLimit'] ?>"  /></td>
    </tr>
    <tr>
      <td><label for="email">Email </label>
      <span style="color: red;"><?= \Config\Services::validation()->getError('email') ?></span>
      </td>
      <td><input type="text" name="email" id="email" size="45" value="<?php echo $Customer['email'] ?>"  /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="553" border="0" cellpadding="5" cellspacing="5">
    <tr>
      <td><input type="submit" name="insert" value="Insert Customer" /></td>
      <td><input type="submit" name="update"  value="Update Customer" /></td>
      <td><input type="submit" name="delete"  value="Delete Customer" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
</form>
<?php echo view('footer'); ?>