<div class="row">
<h1 class="page-header">
   All Products

</h1>
<h3 class="bg-success" style="text-align: center;"><?php display_message(); ?></h3>
<table class="table table-hover">

    <thead>

      <tr>
           <th>Id</th>
           <th>Image</th>
           <th>Title</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Edit</th>
           <th>Delete</th>

      </tr>
    </thead>

    <tbody>
    <?php get_products_in_admin(); ?>
  </tbody>

</table>
</div>

