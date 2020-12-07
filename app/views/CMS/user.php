<?php require APPROOT . '/views/inc/CMSHeader.php';
$editAble=$data["canEdit"];
$user=$data["user"];
?>
<table>
    <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email</td>
        <td></td>
    </tr>
    <tr>
        <form id="form" action="<?php echo URLROOT."/CMS/updateUser" ?>" method="POST">
            <td><input <?php echo $editAble?"":"disabled"; ?>  id="1" placeholder="First Name" type="text" name="fn" value="<?php echo $user->getFirstName();?>"></td>
            <td><input <?php echo $editAble?"":"disabled"; ?>  id="2" placeholder="Last Name" type="text" name="ln" value="<?php echo $user->getLastName();?>"></td>
            <td><input <?php echo $editAble?"":"disabled"; ?>  id="3" placeholder="Email" type="text" name="em" value="<?php echo $user->getEmail();?>"></td>
            <td>Role (can't upgrade to something higher than your own rank)<select <?php echo $editAble?"":"disabled"; ?> name="role" id="dropdown">
                    <option value="USER">USER</option>
                    <option value="ADMIN">ADMIN</option>
                    <option value="SUPERADMIN">SUPERADMIN</option>
                </select></td>
    <tr><input <?php echo $editAble?"":"disabled"; ?> type="hidden" name="id" value="<?php echo $user->getId();?>"></tr>
    <?php if ($editAble){ ?><td><input id="submitbutton" type="submit" value="update"></td><?php } ?>
    </form>
    <script>
        document.getElementById("dropdown").selectedIndex = ["USER", "ADMIN", "SUPERADMIN"].indexOf(
            "<?php echo $user->getRole(); ?>");
    </script>
    </tr>
</table>
<?php if ($editAble){$em = $user->getEmail(); ?><button onclick='window.location.href = "<?php echo URLROOT."/CMS/ResetPassword?email=$em";?>";'>Reset Password</button><?php } ?>


