<?php require_once __DIR__ . '/log_in_header.php'; ?> 

<form action="chat.php?rt=users/regValidate" method="post" id="forma">
    <b>Unesite korisničko ime:</b>
    <input type="text" name="usname"><br>
    <b>Unesite lozinku:</b>
    <input type="password" name="pass"><br>
    <b>Unesite email:</b>
    <input type="email" name="mail">
    <button type="submit">Registriraj se!</button> <br>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>
