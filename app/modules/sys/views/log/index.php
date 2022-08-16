<?php echo $this->breadcrump(); ?>
<div class="panel">
    <div class="panel-body">
        <div class="table-light table-primary" style="overflow: auto;"> 
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th colspan="4">Activity</th>
                    </tr>
                </thead>
                <?php
                $loop = 0;
                $before_id = 0;
                $after_id = 0;
                foreach ($logs as $log) {
                    if ($loop == 0) {
                        $before_id = $log->log_id;
                    }
                    $after_id = $log->log_id;

                    switch ($log->log_type) {
                        case 0:
                            echo "<tr>";
                            echo "<td rowspan='2'>" . $log->log_id . "</td>";
                            echo "<td colspan='4'>" . $log->created_time . ": <b>" . $log->user_username . "</b> membuat record baru pada tabel <strong>" . $log->log_table . "</strong>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>Primary Key:<br>" . $log->log_primary_key_field . "</td>";
                            echo "<td colspan='3'>New Record ID:<br>" . $log->log_primary_key_value . "</td>";
                            echo "</tr>";
                            break;
                        case 1:
                            echo "<tr>";
                            echo "<td rowspan='2'>" . $log->log_id . "</td>";
                            echo "<td colspan='4'>" . $log->created_time . ": <b>" . $log->user_username . "</b> merubah data <strong>" . $log->log_field . "</strong> pada tabel <strong>" . $log->log_table . "</strong></td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>Primary Key:<br>" . $log->log_primary_key_field . "</td>";
                            echo "<td>Primary Key Value:<br>" . $log->log_primary_key_value . "</td>";
                            echo "<td>Value Sebelumnya:<br>" . $log->previous_value . "</td>";
                            echo "<td>Value Baru:<br>" . $log->new_value . "</td>";
                            echo "</tr>";
                            break;
                        case 2:
                            echo "<tr>";
                            echo "<td rowspan='2'>" . $log->log_id . "</td>";
                            echo "<td colspan='4'>" . $log->created_time . ": <b>" . $log->user_username . "</b> menghapus sebuah record pada tabel <strong>" . $log->log_table . "</strong>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>Primary Key:<br>" . $log->log_primary_key_field . "</td>";
                            echo "<td colspan='3'>Deleted Record ID:<br>" . $log->log_primary_key_value . "</td>";
                            echo "</tr>";
                            break;
                    }
                    $loop++;
                }
                if (!$loop) {
                    ?>
                <tr>
                    <td colspan="5">Log Masih Kosong</td>
                </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <div class="pagination">
            <?php if ($before_id != $last_id) { ?>
            <a href="?before_id=<?php echo $before_id ?>" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Prev</a>
            <?php } ?>
            <?php if ($after_id != $first_id) { ?>
                <a href="?after_id=<?php echo $after_id ?>" class="btn btn-primary">Next <i class="fa fa-angle-double-right"></i></a>
            <?php } ?>
        </div>
    </div>
</div>