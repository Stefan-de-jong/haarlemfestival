<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
    Customers:<br>
<?php
if (isset($data['msg'])){
    echo $data['msg'];
}
if (isset($data["customers"])){
    $users = $data["customers"];
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
                <?php echo $user->getLastname();?>
            </td>
            <td>
                <?php echo $user->getEmail();?>
            </td>
            <td>
                <form class="vieweditform" action="<?php echo URLROOT."/CMS/customer";?>" method="GET">
                    <input type="submit" value="view/edit">
                    <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                </form>
            </td>
            <td>
                <?php if ($_SESSION["CMSrole"]==="SUPERADMIN" or $_SESSION["CMSrole"] === 'ADMIN'){ ?>
                    <form class="deleteform" action="<?php echo URLROOT."/CMS/deleteCustomer";?>" method="POST">
                        <input type="submit" value="delete">
                        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php }echo "</table>";} ?>