<?php
include_once('db.php');
session_start();
$fetchticket = "SELECT TicketNo, FullName, Title, Site, TicketDate, Status FROM tbltickets";
$filterticket = mysqli_query($conn, $fetchticket);
$result = filterTable($fetchticket);
function filterTable($fetchticket){
  global $conn;
  $filter_Result = mysqli_query($conn, $fetchticket);
  return $filter_Result;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPi Service Desk Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <style>
    body{
      background-image:url(assets/background.png);
      height: 100%; 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> SPi Global Service Desk </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, <?php echo $_SESSION['FullName'] ?></a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Dashboard
              </a>
              <a href="opentickets.php" class="list-group-item"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Open Tickets <span class="badge">10</span></a>
              <a href="fileTicket.php" class="list-group-item"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Log Ticket </a>
            </div>
            
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Analyst Dashboard</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 203</h2>
                    <h4>Users</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 12</h2>
                    <h4>Pages</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 33</h2>
                    <h4>Posts</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 12,334</h2>
                    <h4>Visitors</h4>
                  </div>
                </div>
              </div>
              </div>

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Tickets Under Approval by ME</h3>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-hover">
                    <thead>
                       <tr>
                        <th>Ticket No.</th>
                        <th>Title</th>
                        <th>Full Name</th>
                        <th>Site</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                     </thead>
                     <?php while($row = mysqli_fetch_array($result)): ?>
                      <tbody>
                        <tr>
                          <td><?php echo $row['TicketNo'];?></td>
                          <td><?php echo $row['Title'];?></td>
                          <td><?php echo $row['FullName'];?></td>
                          <td><?php echo $row['Site'];?></td>
                          <td><?php echo $row['Status'];?></td>
                          <td><?php echo $row['TicketDate'];?></td>
                          <td><a href="updateTicket.php?edit=<?php echo $row['TicketNo']?>"class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></td>
                        </tr>
                      </tbody>
                    <?php endwhile;?>

                    </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright SPi Global Inc, &copy; 2018</p>
    </footer>

    <!-- Modals -->

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Page Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Page Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
