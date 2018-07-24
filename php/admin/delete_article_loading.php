<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "corentin_dupont";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM article ORDER BY Date_Article";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        
        $articleID = $row["Id_Article"];
        $articleTitle = $row["Nom_Article"];
        
        $articleImage = null;
        
        $sql = "SELECT * FROM contenu_article WHERE Id_Article = ".$row["Id_Article"]." ORDER BY Ordre_Contenu_Article";
        
        $result2 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result2) > 0) {
            $alreadyGetFirstImage = false;
            while($row2 = mysqli_fetch_assoc($result2)) {
                if($row2["Type_Contenu_Article"] == 'image' && !$alreadyGetFirstImage){
                    $alreadyGetFirstImage=true;
                    $articleImage = $row2["Texte_Contenu_Article"];
                }
            }
        }
        
        echo   '<article class="article" id="'.$articleID.'">
                    <h2>'.$articleTitle.'</h2>
                    <div class="articleBody">
                        <div class="articleImageBlock">
                            <img src="'.$articleImage.'"/>
                        </div>
                    </div>
                    <div class="transparentDeleteLayer">
                        <div class="background"></div>
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 486.4 486.4" style="enable-background:new 0 0 486.4 486.4;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M446,70H344.8V53.5c0-29.5-24-53.5-53.5-53.5h-96.2c-29.5,0-53.5,24-53.5,53.5V70H40.4c-7.5,0-13.5,6-13.5,13.5
                                        S32.9,97,40.4,97h24.4v317.2c0,39.8,32.4,72.2,72.2,72.2h212.4c39.8,0,72.2-32.4,72.2-72.2V97H446c7.5,0,13.5-6,13.5-13.5
                                        S453.5,70,446,70z M168.6,53.5c0-14.6,11.9-26.5,26.5-26.5h96.2c14.6,0,26.5,11.9,26.5,26.5V70H168.6V53.5z M394.6,414.2
                                        c0,24.9-20.3,45.2-45.2,45.2H137c-24.9,0-45.2-20.3-45.2-45.2V97h302.9v317.2H394.6z"/>
                                    <path d="M243.2,411c7.5,0,13.5-6,13.5-13.5V158.9c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v238.5
                                        C229.7,404.9,235.7,411,243.2,411z"/>
                                    <path d="M155.1,396.1c7.5,0,13.5-6,13.5-13.5V173.7c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v208.9
                                        C141.6,390.1,147.7,396.1,155.1,396.1z"/>
                                    <path d="M331.3,396.1c7.5,0,13.5-6,13.5-13.5V173.7c0-7.5-6-13.5-13.5-13.5s-13.5,6-13.5,13.5v208.9
                                        C317.8,390.1,323.8,396.1,331.3,396.1z"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                </article>';
        
    }
} else {
    
}

mysqli_close($conn);

?>