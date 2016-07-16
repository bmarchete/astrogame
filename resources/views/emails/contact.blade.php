<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Contato do Astrogame</h2>
    <div>
        <p>Nome: {{ $request->name }}</p>
        <p>Email: {{ $request->email }}</p>
        <p>Mensagem:</p>
        <p>{{ $request->mensagem }}</p>
    </div>
</body>
</html>
