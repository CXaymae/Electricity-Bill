<!-- Sidebar -->
<div class="sidebar" id="mySidebar">
<div class="side-header">
    <img src="./assets/images/logo.png" width="120" height="120" alt="Swiss Collection"> 
    <h5 style="margin-top:10px;">Hello, Admin</h5>
</div>

<hr style="border:1px solid; background-color:#8a7b6d; border-color:#3B3131;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="./indexx.php" ><i class="fa fa-home"></i> Dashboard</a>
    <a href="#category"   onclick="showCategory()" ><i class="fa fa-th-large"></i> Category</a>
    
    <a href="#productsizes"   onclick="showProductSizes()" ><i class="fa fa-th-list"></i> Clients</a>    
    <a href="#products"   onclick="showProductItems()" ><i class="fa fa-th"></i> Factures</a>
    <a href="#orders" onclick="showOrders()"><i class="fa fa-list"></i> Reclamations</a>
  
  <!---->
</div>
 
<div id="main">
    <button class="openbtn" onclick="openNav()"><i class="fa fa-home"></i></button>
</div>

<div class="logout-button" onclick="logout()">Logout</div>
  </div>

  <script>
    function logout() {
      // Clear session data or perform any other necessary actions
      // For example, you can redirect the user to a login page
      window.location.href = "index.html";
    }
  </script>


