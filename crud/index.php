<?php
require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="index.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<body class="bg-light">
  <div class="container bg-light text-white p-1 rounded my-2">
    <button type="button" class="button btn btn-success p-0" data-bs-toggle="modal" data-bs-target="#addfooditems">
    <i class="bi bi-plus-lg"></i>Add Food Items
    </button>
  </div>
<div class="container mt-5 bg-success p-0">
 <table class="table table-hover text-center">
  <thead class="bg-info text-dark">
    <tr>
      <th width="10%" scope="col" class="rounded-start">Sr No.</th>
      <th width="15%" scope="col">image</th>
      <th width="10%" scope="col">name</th>
      <th width="35%" scope="col">description</th>
      <th width="20%" scope="col" class="rounded-end">price</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = "SELECT * FROM 'products'";
      $result = mysqli_query($con,$query);
      $i=1;
      while($fetch=mysqli_fetch_assoc($result))
      {
        echo<<<product
         <tr>
             <th scope="row">$i</th>
             <td>$fetch[image]</td>
             <td>$fetch[name]</td>
             <td>$fetch[description]</td>
             <td>$fetch[price]</td>
             <td>
                <a>Edit</a>
                <button>Delete</button>
            </td>
         </tr>
        product;
       $i++;       

      }
    ?> 
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
  </tbody>
 </table>
</div>
  <div class="modal fade" id="addfooditems" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> -->
    <div class="modal-dialog">
        <form action="crud.php"  method="POST" enctype="multipart/form-data">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title text-dark">Add Food Items</h5>
                </div>

                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" class="form-control" placeholder="Username" name="name" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">Price</span>
                        <input type="number" class="form-control" placeholder="Username" name="number" min="1" required>
                    </div>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text">Description</span>
                        <textarea class="form-control" name="desc" required></textarea>
                    </div>

                    <div class="input-group mb-3">
                       <label class="input-group-text">Image</label>
                       <input type="file" class="form-control" name="image" accept=".jpg,.png,.svg" required>
                    </div>
                </div>

             <div class="modal-footer">
               <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-success" name="addproduct">Add</button>
             </div>
           </div>
        </form>
    </div>
   </div>
</body>
</html>