<?php

    function getHeader() {
        $links = '';
        $links .= '        <li><a href="index.php">Home</a></li>';
        $links .= '        <li><a href="index.php?gallery=true">Gallery</a></li>';
        $links .= '        <li><a href="index.php?reviews=true">Google Reviews</a></li>';
        if(isGranted()) {
        $links .= '        <li><a href="calendar.php#day_selected">CalendarStyle</a></li>';
        $links .= '        <li><a href="logout.php">Logout</a></li>';
        } 
        $displayForm = "";
        $displayForm .= '<header class="toogle-show">';
        $displayForm .= '  <div class="logo">';
        $displayForm .= '    <img src="./img/logo.png">';
        $displayForm .= '  </div>';
        $displayForm .= '  <div class="hRight">';
        $displayForm .= '    <nav>';
        $displayForm .= '      <ul>';
        $displayForm .= $links;
        $displayForm .= '      </ul>';
        $displayForm .= '    </nav>';
        $displayForm .= '  </div>';
        $displayForm .= '</header>';

        return $displayForm;
    }

    function getFormLogin()
    {
        $displayForm = "";
        $displayForm .= '<form action="login" method="post">';
        $displayForm .= '<input type="text" name="email" placeholder="Email">';
        $displayForm .= '<input type="password" name="password" placeholder="Password">';
        $displayForm .= '<input type="submit" name="login-button" value="Log In">';
        $displayForm .= '</form>';
        #$displayForm .= '<a class="new-account" href="create-account.php">Create New Account</a>';

        return $displayForm;
    }

    function getPageContent()
    {
        $displayPageContent = "";
        $displayPageContent .= '<div class="fontAcme">Welcome to Ceci\'Style!!!</div>';
        
        return $displayPageContent;
    }
?>