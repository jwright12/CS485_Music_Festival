<?php
	if(isset($_GET['id'])){

		$id = $_GET['id'];
            printf("
                  <h1>Admin Overview</h1>
                  <br>
                  <table class=\"table\">
                  <thead>
                  <tr>
                        <th scope=\"col\">
                              <form action=\"manage_artist.php?id=$id\" method=\"post\">
                                    <input type=\"hidden\" name=\"id\" value=\"$id\"> 
                                    <button type=\"submit\" class=\"btn btn-primary\">Register Artist</button>
                              </form>
                        </th>
                        <th scope=\"col\">
                              <form action=\"festival_management.php?id=$id\" method=\"post\">
                                    <input type=\"hidden\" name=\"id\" value=\"$id\"> 
                                    <button type=\"submit\" class=\"btn btn-primary\">Festival Management</button>
                              </form>
                        </th>
                  </tr>
                  </thead>
            </table>
		");

	} else {
		printf("
            <h2>Admin Login</h2>
                
            <form method=\"post\" action=\"\">
                <div class=\"mb-3\">
                        <label for=\"username\" class=\"form-label\"><b>Username</b></label>
                        <input type=\"text\" class=\"form-control\" name=\"username\">
                </div>
                <div class=\"mb-3\">
                        <label for=\"password\" class=\"form-label\"><b>Password</b></label>
                        <input type=\"password\" class=\"form-control\" name=\"password\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary\">Login</button>
            </form>
		");
	}
?>