<div class="container">
    <div class="row">
        <div class="col">
            <h1>
                Καταχώρηση νέου χρήστη διαχειριστικού
            </h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-10">
            <table id="users" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Όνομα</th>
                    <th>Όνομα Χρήστη</th>
                    <th>Δικαιώματα</th>
                    <th>Ενεργός</th>
                    <th>Ενέργειες</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($users as $user)
                {
                    echo '<tr><td>'. $user->name . '</td><td>' . $user->username . '</td><td>' . $user->role_string . '</td><td>' . $user->is_active .
                        '</td><td>' . '<a href="#">Επεξαργασία</a><br><a href="#">Διαγραφή</a>' . '</td></tr>';
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Όνομα</th>
                    <th>Όνομα Χρήστη</th>
                    <th>Δικαιώματα</th>
                    <th>Ενεργός</th>
                    <th>Ενέργειες</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <a role="button" class="btn btn-primary" href="<?php echo site_url('home/addNewUser') ?>">Add New User</a>
        </div>
    </div>
</div>
