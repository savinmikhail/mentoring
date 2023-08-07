<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codeboard Online IDE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="css/style.css" >
</head>
<body >

<div class="header"> Codeboard Online IDE </div>
<form id="csrf">
    @csrf
    <div class="editor" id="editor"></div>
</form>


<div class="button-container">
    <button class="btn" onclick="executeCode()"> Run </button>
</div>

<div class="output"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/lib/ace.js"></script>
<script src="js/lib/theme-monokai.js"></script>
<script src="js/ide.js"></script>

</body>
</html>