 <?php
    if (isset($_POST['sub'])) {
        require 'partials/_dbcon.php';
        $getusername = $_POST['getusername'];
        $getemail = $_POST['getemail'];
        $getpass = $_POST['getpass'];
        $conpass = $_POST['conpass'];

        $sql = "select username from signup where username = '$getusername'";
        $sqlres = mysqli_query($connect, $sql);
        $rowcount = mysqli_num_rows($sqlres);

        if ($rowcount != 0) {

            echo "<p>User name is not available. Try another one</p>";
        }
        if ($getpass != $conpass) {
            echo "Confirm password properly";
        }
        $hash =password_hash($getpass,PASSWORD_DEFAULT);
       
            if (($rowcount == 0) && ($getpass == $conpass)) {
                echo "You have successfully signed up.";
            
                $gotologin = "<a href='login.php'>Log in.</a>";
            }
                echo $gotologin;
           
        function validateUsername($getusername) {
            // Check if the username is not empty
            if (empty($getusername)) {
                return false;
            }
        
            // Check the length of the username
            $minLength = 3;
            $maxLength = 20;
            $usernameLength = strlen($getusername);
            if ($usernameLength < $minLength || $usernameLength > $maxLength) {
                return false;
            }
        
            // Check if the username contains only alphanumeric characters, underscores, and hyphens
            if (!preg_match("/^[a-zA-Z0-9_-]+$/", $getusername)) {
                return false;
            }
        
            return true;
        }
        
        if (validateUsername($getusername)) {
          
            $sql = "insert into signup (username,email,password) values ('$getusername','$getemail','$hash')";
            $sqlres = mysqli_query($connect, $sql);
    
        } else {
            // The username is not valid, handle the error
            echo "specail characters,white space  is not valid <br>";
            echo"please enter a valid username";
        }

    }
    ?>
 </div>
 </div>


 </body>

 </html>