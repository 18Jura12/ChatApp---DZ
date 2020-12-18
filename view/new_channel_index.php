<?php require_once __DIR__ . '/_header.php'; ?> 

<form action="chat.php?rt=channel/new" method="post" id="forma">
    <b>Unesite ime novog kanala:</b>
    <input type="text" name="ime_kanala"><br>
    <button type="submit" id="nk">Napravi novi kanal</button>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>
