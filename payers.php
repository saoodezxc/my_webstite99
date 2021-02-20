<div class="col-lg-12">


    <h1 class="page-header">
        budget
    </h1>


    <p>
    <h3 class="bg-success"><?php display_message(); ?></h3>
    </p>

    <a href="index.php?add_payer" class="btn btn-primary">Add</a>

    <div>


        <thead>

            <div class="col-lg-4 col-md-5" style="float:right">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-money fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php echo isset($_SESSION['item_totals']) ? $_SESSION['item_totals'] : $_SESSION['item_totals'] = "0"; ?>SR
                                </div>

                                <div>Total Payed</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-5" style="float:right">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-credit-card fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php echo isset($_SESSION['item_totals_minus']) ? $_SESSION['item_totals_minus'] : $_SESSION['item_totals_minus'] = "0"; ?>SR
                                </div>

                                <div>Total Earn</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-5" style="float:right">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-credit-card fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php echo isset($_SESSION['item_totals_mon']) ? $_SESSION['item_totals_mon'] : $_SESSION['item_totals_mon '] = "0"; ?>SR
                                </div>

                                <div>money in</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </thead>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>username</th>
                    <th>product name</th>
                    <th>Serial Device</th>
                    <th>Mobile & Email & Pass</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Total</th>

                    <th>Code backup</th>

                    <th>Edit</th>
                    <th>Delete</th>


                </tr>
            </thead>
            <div class="row">
                <?php display_payers(); ?>

            </div>


        </table>

        <!--End of Table-->


    </div>


</div>