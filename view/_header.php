<!DOCTYPE html>
<html lang="en">
<head style="background-color:green;">
    <meta charset="UTF-8">
    
    <title>Chat</title>
    <style>
    
    #toolbar, #nk, #k {

        border: 2px solid red;
        border-radius: 5px;
        border-style: inset;
        background-color:red;
        margin:auto;
        padding: 2px 5px 2px;
        color:yellow;

    }

    #k {

        align: center;

    }

    body {

        background-color: lightgreen;

    }

    hr {

        border: 1px dashed red;
        border-style: inset;

    }

    a {

        color:yellow;
        text-decoration: none;

    }

    #datum {

        text-align: right;
        color: darkgreen;
        text-shadow: 2px 2px 5px red;

    }

    #poruke {

        background-color: rgba(0, 80, 0, 0.8);
        border-radius: 5px;
        margin: auto;

    }

    #kanali {

        background-color: rgba(255, 0, 0, 0.7);
        border-radius: 5px;
        margin:auto;
        text-align: center;

    }

    #nova {

        margin:auto;
        text-align: center;

    }

    #naslov1 {

        background-color: rgba(0, 80, 0, 0.8);
        border-radius: 5px;
        margin: auto;
        text-align: center;

    }

    #naslov2 {

        background-color: rgba(255, 0, 0, 0.7);
        border-radius: 5px;
        margin: auto;
        text-align: center;

    }

    #gumb {

        border: 2px solid black;
        background-color: red;
        color:yellow;
        border-radius: 50%;

    }

    #zaglavlje {

        background-color: rgba(0, 80, 0, 0.8);
        border-radius: 5px;
        border-style: outset;
        padding: 10px 10px 10px;
        border: 2px solid darkred;
        color: yellow;

    }

    input[type=text] {

        border: 2px solid red;
        border-radius: 5px;
        padding: 2px;

    }

    input[type=text]:focus {

        border: 2px solid red;
        border-radius: 5px;
        background-color: rgba(255, 255, 0, 0.7);
        padding: 2px;

    }

    #forma {

        display: block;
        padding: 10%;

    }

    #tekst {

        display: block;
        border: 2px solid black;
        border-radius: 10px;
        max-width: 800px;
        max-height: 400px;
        width: 800px;
        height: 100%;
        margin: 3px;
        word-break: break-all;
        background-color: lightgreen;

    }

    input[type=text].npor {

        width: 400px;
        transition: width 0.4s ease-in-out;

    }

    input[type=text]:focus.npor {

        width: 50%;

    }

    #user {

        align: center;
        text-shadow: 2px 2px 5px red;

    }
    
    </style>
    <div id="zaglavlje">
    <h1>Chat</h1>
    <h3><i>Prijavljeni ste kao <b><?php echo $_SESSION['username']; ?></b></i></h3>
    </div><br>


    <table >
        <tr>
            <td><a href="chat.php?rt=channel/mine" id="toolbar"> Početna stranica</a></td>
            <td><a href="chat.php?rt=channel/all" id="toolbar"> Svi kanali</a></td>
            <td><a href="chat.php?rt=channel/new" id="toolbar"> Novi kanal</a></td>
            <td><a href="chat.php?rt=message/user" id="toolbar"> Napisane poruke</a></td>
            <td><a href="chat.php?rt=users/login" id="toolbar"> Izlogiraj se</a></td>
        </tr>
    </table>
    <hr>

</head>
<body>

    
