<script><?php readfile(__DIR__ . '\..\dist\PasswordGenJS\master.js') ?></script>
<script>
    console.log('Default generated password: ' + new PasswordGen().password);
    console.log('8 Character long password: ' + new PasswordGen().setLength(8).password);
    console.log('Setting the keyspace manually: ' + new PasswordGen().setKeyspace('abcdefghijklmnopqrstuvwxyz').password);
    console.log('Generating a different keyspace password: ' + new PasswordGen().generateKeyspace('lu').password);
</script>