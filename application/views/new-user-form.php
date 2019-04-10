<html>
<head>
    <title>Νέος Χρήστης</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.css");?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("public/css/datatables.min.css") ?>"/>
</head>
<body>


<div class="container">

    <div class="row">
        <div class="col-xs-12">
            <h1>Δημιουργία Χρήστη Διαχειριστικού</h1>
        </div>
    </div>
    <hr>

    <!--  Message to confirm that the user created successfully  -->
    <?php if (isset($success)) {

        ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo 'Ο χρήστης δημιουργήθηκε επιτυχώς!'; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }?>


    <div class="row">
        <div class="col-lg-8">
            <!--  The form for adding the user -->
            <?php echo form_open(base_url('home/addNewUser')); ?>
            <div class="form-check">
                <input name="isActive" type="checkbox" class="form-check-input" id="isActive" value="1">
                <label class="form-check-label" for="isActive">Ενεργός</label>
            </div>
            <div class="form-group">
                <label for="fullName">Ονοματεπώνυμο:</label>
                <input name="fullName" type="text" class="form-control" id="fullName" placeholder="Ονοματεπώνυμο">
            </div>
            <div class="form-group">
                <label for="username">Όνομα χρήστη:</label>
                <input name="username" type="text" class="form-control" id="username" placeholder="Όνομα χρήστη">
            </div>
            <div class="form-group">
                <label for="password">Κωδικός:</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Κωδικός">
            </div>
            <div class="form-group">
                <label for="passwordConf">Επανάληψη κωδικού:</label>
                <input type="password" class="form-control" id="passwordConf" name="passwordConf" placeholder="Επανάληψη κωδικού">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <label>Δικαιώματα: </label>

            <!-- All the rolled that have been received from the database are displayed with checkboxes here -->
            <?php foreach ($all_roles_list as $role) {

            ?>

            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="<?php echo 'role_'.$role->id ?>" name="<?php echo 'role_'.$role->id ?>">
                    <?php echo $role->name ?>
                </label>
            </div>

            <?php
            }?>
            <input type="hidden" id="usrId" name="usrId" value="">
            <div class="row"  style="margin-top: 15px;">
                <button type="submit" class="btn btn-secondary">Ενημέρωση</button>
                <a href="<?php echo base_url() ?>" class="btn btn-info" role="button" style="margin-left: 8px;">Λίστα Χρηστών</a>
            </div>
            </form>

            <!--  The validation error displayed here when there are  -->
            <?php if (validation_errors() != false) {

             ?>
            <div class="alert alert-danger" role="alert">
                <?php echo validation_errors(); ?>
            </div>
            <?php
            }?>

        </div>

    </div>


</div>
<?php
//foreach($_POST as $key=>$post_data){
//    echo "You posted:" . $key . " = " . $post_data . "<br>";
//}
//
//$nums = array(1,2,3,4,5,6);
//foreach ($nums as $num) {
//    if (in_array('role_'.$num, $_POST)) {
//        echo "Has role ".$num;
//    } else {
//        echo "NOT has role ".$num;
//    }
//    echo "<br>";
//}

?>
<script type="text/javascript" src="<?php echo base_url("public/js/jquery-3.3.1.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("public/js/bootstrap.js"); ?>"></script>
</body>
</html>