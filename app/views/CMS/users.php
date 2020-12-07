<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
    CMS Users:<br>
    <?php
if (isset($data['msg'])){
    echo $data['msg'];
}
if (isset($data["users"])){
$users = $data["users"];
foreach($users as $user){
?>
    <tr>
      <td>
        <?php echo $user->getId();?>
      </td>
      <td>
        <?php echo $user->getFirstname();?>
      </td>
      <td>
        <?php echo $user->getLastName();?>
      </td>
      <td>
        <?php echo $user->getEmail();?>
      </td>
      <td>
        <?php echo $user->getRole();?>
      </td>
      <td>
        <form class="vieweditform" action="<?php echo URLROOT."/CMS/user";?>" method="GET">
          <input type="submit" value="view/edit">
          <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
        </form>
      </td>
      <td>
        <?php if ($_SESSION["CMSrole"]==="SUPERADMIN"){ ?>
        <form class="deleteform" action="<?php echo URLROOT."/CMS/deleteUser";?>" method="POST">
          <input type="submit" value="delete">
          <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
        </form>
        <?php } ?>
      </td>
    </tr>
    <?php }echo "</table>";} ?>