<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codeboard Online IDE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="split-screen-container">
    <div class="theory-container">
        <!-- Добавьте ваш контент с теорией здесь -->
        <!-- Например: -->
        <h2>PHP: Условная конструкция (if)</h2>
        <p>Задача предиката — получить ответ на вопрос, но обычно этого недостаточно и нужно выполнить определенное действие в зависимости от ответа.
            Напишем функцию, которая определяет тип переданного предложения. Для начала она будет отличать обычные предложения от вопросительных: </p>
    </div>
    <div class="editor-container">
        <div class="header"> PHP Online IDE </div>
        <form id="csrf">
            @csrf
            <div class="editor" id="editor"></div>
        </form>
        <div class="button-container">
            <button class="btn" onclick="executeCode()"> Запустить </button>
        </div>


        <div class="output"></div>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/lib/ace.js"></script>


<script >
    let editor;

    window.onload = function() {
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/twilight");
        // editor.$highlightBrackets(true);
        editor.setFontSize(26);
        editor.session.setMode("ace/mode/php");
    }

    function executeCode() {

        $.ajax({

            url: "/com",

            method: "POST",

            data: {
                code: editor.getSession().getValue(),
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                $(".output").text(response)
            }
        })

    }
</script>

</body>
</html>