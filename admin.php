<!DOCTYPE html>
<html>
<head>
  <!-- <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.16/css/dataTables.bootstrap.css"/> -->
  <!-- <script type="text/javascript" src="datatables/jQuery-3.2.1/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="datatables/DataTables-1.10.16/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="datatables/DataTables-1.10.16/js/dataTables.bootstrap4.js"></script> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <!-- <link rel="stylesheet" href="assets/css/main.css"/> -->
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css"/>
 
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.0.0/jq-3.2.1/dt-1.10.16/datatables.min.js"></script>


  <title></title>
</head>
<body>
  <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>State</th>
                <th>Time</th>
                <th>Notes</th>
                <th>IP</th>
                <th>Coordinate</th>
                <th>Accuracy</th>
                <th>File</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>State</th>
                <th>Time</th>
                <th>Notes</th>
                <th>IP</th>
                <th>Coordinate</th>
                <th>Accuracy</th>
                <th>File</th>
            </tr>
        </tfoot>
        <tbody>
          <?php
                include 'db_config.php';
                $sql = "SELECT * FROM record ";
                $result = mysqli_query($my_db,$sql);
                if (mysqli_num_rows($result) > 0){
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['state']."</td>";

                    $a = $row['time'];
                    $a = strtotime($a);
                    $b  = strtotime("+8 hours",$a);
                    $time = date("Y-m-d H:i:s", $b);
                    echo "<td>".$time."</td>";

                    //echo "<td>".$row['time']."</td>";
                    echo "<td>".$row['notes']."</td>";
                    echo "<td>".$row['ip']."</td>";
                    if (strlen($row['geolocation']) < 4){
                      echo "<td>使用者不提供</td>";
                    }
                    else {
                      echo "<td><a href=https://www.google.com.tw/maps/place/".$row['geolocation'].">查看地圖</a></td>";
                    }
                    
                    echo "<td>".$row['accuracy']."</td>";
                    echo "<td>x</td>";
                    echo "</tr>";

                  }
                }
                  ?>
        </tbody>
    </table>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {

        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }

    } );
} );
</script>
<!-- 
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
        "ajax": 'arrays.txt'
    } );
} );
</script>
 -->