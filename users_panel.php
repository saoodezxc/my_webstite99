<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>



<!-- SECOND ROW WITH TABLES-->

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Users Panel</h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive" style="background-color: black; color:aliceblue">
                    <table class="table table-bordered table-hover table-striped">
                        <tr>
                        </tr>

                        </tbody>


                        </thead>
                    </table>
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Id #</th>
                                <th>username</th>
                                <th>Date & Time</th>


                            </tr>
                </div>

                </thead>
                <tbody>
                    <tr>
                        <?php users_panel();?>
                    </tr>
                </tbody>

                </table>
            </div>
            <div class="text-right">
                <a href="/public/admin/index.php?payers">View Or Edit Profile <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>


</div>
<!-- /.row -->