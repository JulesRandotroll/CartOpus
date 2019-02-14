<!DOCTYPE html>

<meta charset="utf-8">
    <div align = "center" class="col-sm-8 sidenav">
        <table cellpadding="6" cellspacing="1" style="width:70%" border="1">
        
            <tr>
                <th>Nom Action</th>
            </tr>
            
            <body>
                <?php foreach ($lesActions As $uneAction):
                    echo '<tr>';
                    echo '<td><h4>Nom Action : '.$uneAction['NOMACTION'].' </h4></td></br>';
                    echo'</tr>';
                endforeach ?>
            
            </body>
        </table>
    </div>