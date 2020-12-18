<?php require_once __DIR__ . '/log_in_header.php'; ?>

<form action="chat.php?rt=users/validate" method="post" id="forma">
    <b>Unesite korisničko ime:</b>
    <input type="text" name="username"><br>
    <b>Unesite lozinku:</b>
    <input type="password" name="password">
    <button type="submit">Ulogiraj se!</button> <br>
    <b>Nemate račun? <a href="chat.php?rt=users/register">Registrirajte se!</a></b>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>
