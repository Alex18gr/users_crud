<div class="container">
    <div class="row">
        <div class="col">
            <h1>
                Καταχώρηση νέου χρήστη διαχειριστικού
            </h1>
        </div>
    </div>
    <hr>
    <!--  The table used to view all the user data  -->
    <div class="row">
        <div class="col-lg-10">
            <table id="users" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <!-- the name of the user-->
                    <th>Όνομα</th>
                    <!-- Username -->
                    <th>Όνομα Χρήστη</th>
                    <!-- Roles in text -->
                    <th>Δικαιώματα</th>
                    <!-- has the value 1 if the user is active-->
                    <th>Ενεργός</th>
                    <!-- Extra helping column for editing and deleting actions -->
                    <th>Ενέργειες</th>
                </tr>
                </thead>
                <tbody>
                <!-- Prints the data for all the users at the columns -->
                <?php
                foreach($users as $user)
                {
                    echo '<tr><td>'. $user->name . '</td><td>' . $user->username . '</td><td>' . $user->role_string . '</td><td>' . $user->is_active .
                        '</td><td>' . '<a href="' . base_url('editUser/') . $user->id . '">Επεξαργασία</a><br><a href="#" onclick="deleteModal(`'.
                         $user->name .'`,` '. base_url('deleteUser/'.$user->id) . '`)">Διαγραφή</a>' .
                        '</td></tr>';
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


<!-- Modal for deleting the User -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Διαγραφή Χρήστη</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                Είστε σίγουροι ότι θέλετε να διαγράψετε τον χρήστη <span id="usernameSpan"></span>;
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a id="deleteBtn" href="#" role="button" class="btn btn-danger">Διαγραφή</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ακύρωση</button>
            </div>

        </div>
    </div>
</div>
