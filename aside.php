<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Scrum master</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
    <header>
        <div id="mainHeader" style="display: flex; align-items: center;">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        </div>
    </header>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Projets</a>
        <a href="#">Utilisateurs</a>
        <a href="#">Sprint</a>
        <a href="#">Tâches</a>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("mainContent").style.marginLeft = "250px";
            document.getElementById("mainHeader").style.marginLeft = "250px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("mainContent").style.marginLeft = "0";
            document.getElementById("mainHeader").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
    </script>
</body>
</html>
