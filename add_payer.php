<?php add_payer(); ?>

<h1 class="page-header"> Add
    <small>Page</small>
</h1>

<h3 class="bg-success">
    <?php display_message(); ?>
</h3>

<div class="col-md-6 user_image_box">

    <span id="user_admin" class='fa fa-user fa-4x'></span>

</div>


<form action="" method="post" enctype="multipart/form-data">
    <div class="col-md-8">
        <!-- Image -->
        <div class="form-group">
            <label for="payer_photo">Image</label>
            <input type="file" name="file"> <br>
            <img width="200" src="../../resources/<?php echo $payer_photo; ?>" alt="">
        </div>


        <div class="form-group">
            <label for="bought">price game:</label>
            <input type="price_minus" name="price_minus" class="form-control">
        </div>

        <div class=" form-group">
            <label for="bought"> US Store </label>
            <input type="price_minus" name="us_store" class="form-control">
        </div>

        <div class=" form-group">
            <label for="code_note"> Code Backup </label>
            <textarea type="text" name="code_note" class="form-control"></textarea>
        </div>



        <div class="form-group">
            <label for="name"> Per 1 </label><br>
            <label for="name"> Name Games: </label>


            <input type="text" name="name" class="form-control">
            <input type="text" name="name2" class="form-control">
            <input type="text" name="name3" class="form-control">

            <div class="form-group">
                <label for="first_mobile"> Mobile </label>
                <input type="number" name="first_mobile" class="form-control">

            </div>

            <div class="form-group">
                <label for="serial_number">Serial Number</label>
                <input type="text" name="serial_number" class="form-control">

            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="option" name="payment_method" class="form-control">

            </div>

            <div class="form-group">
                <label for="email"> Email </label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="pass"> Password </label>
                <input type="text" name="pass" class="form-control">
            </div>

            <div class="form-group">
                <label for="price"> First-Price_bought </label>
                <input type="number" name="price" class="form-control">
            </div>



            <div class="form-group">
                <label for="Date_Time"> Date & Time </label>
                <input type="date" name="date" class="form-control">
                <input type="time" name="time" class="form-control">
            </div>


        </div>




        <div class="form-group">
            <label for="name"> Per 2 </label><br>
            <label for="name"> Name Game: </label>


            <input type="text" name="name_v" class="form-control">
            <input type=" text" name="name_v2" class="form-control">
            <input type="text" name="name_v3" class="form-control">

            <div class="form-group">
                <label for="secound_mobile"> Mobile </label>
                <input type="number" name="secound_mobile" class="form-control">
            </div>

            <div class="form-group">
                <label for="serial_number">Serial Number</label>
                <input type="text" name="serial_number2" class="form-control">
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <input type="option" name="payment_method2" class="form-control">

            </div>

            <div class="form-group">
                <label for="email"> Email </label>
                <input type="email" name="email2" class="form-control">
            </div>

            <div class="form-group">
                <label for="pass"> Password </label>
                <input type="text" name="pass" class="form-control">
            </div>

            <div class="form-group">
                <label for="price"> Second-price_bought </label>
                <input type="number" name="price_sec" class="form-control">
            </div>



            <div class="form-group">
                <label for="Date_Time"> Date & Time </label>
                <input type="date" name="date2" class="form-control">
                <input type="time" name="time2" class="form-control">
            </div>

        </div>


        <div class="form-group">
            <label for="payer_photo">Image</label>
            <input type="file" name="file">
        </div>


        <div class="form-group">
            <a id="user-id" class="btn btn-danger" href="">Delete</a>
            <input type="submit" name="add_payer" class="btn btn-primary pull-right" value="Add Payer">
        </div>


    </div>



</form>