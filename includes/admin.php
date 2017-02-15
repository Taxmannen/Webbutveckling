<?php
session_start();

if(isset($_SESSION['admin'])){
    include '../includes/config.php';
    $sql = 'SELECT * FROM users';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <html>
        <head>
            <style>
                table {
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                }
                td, th {
                    width: 10%;
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
                tr:nth-child(even) {
                    background-color: #dddddd;
                }
            </style>
    </head>
    <body>
        <form action='redirect_function_admin.php' method='POST'>
        <?php
            foreach ($result as $output){
                echo "<table>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roll</th>
                        <th>HashedPw</th>
                        <th>Adress</th>
                        <th>PostNr</th>
                        <th>city</th>
                        <th>phoneNumber</th>
                    </tr>
                    <br>
                    <tr>
                        <td>$output[id]</td>
                        <td>$output[name]</td>
                        <td>$output[email]<input type='checkbox' name='id' value='$output[id]'></td>
                        <td>$output[role]</td>
                        <td>$output[hashedPw]</td>
                        <td>$output[adress]</td>
                        <td>$output[zipcode]</td>
                        <td>$output[city]</td>
                        <td>$output[phoneNumber]</td>
                    </tr>   
            </table>";
            }
            ?>
        <input type='submit' name='del_subm_btn' value='delete'>
        <input type='submit' name='cre_subm_btn' value='create'>
        <input type='submit' name='upd_subm_btn' value='update'></form>

        <form method="POST" action="logout.inc.php">
            <input type='submit' name='logout' value='logout'>
        </form>
    </body>
</html>
 <?php
}
else{
    echo "Du har ingen behörighet till denna sidan!";
    header("Refresh:5 ../index.html");
}
 ?>