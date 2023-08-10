<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codeboard Online IDE</title>
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}" />--}}

    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
@include('layout.navbar')
<div class="split-screen-container">
    <div class="theory-container">

        <!-- Добавьте ваш контент с теорией здесь -->
        <!-- Например: -->
        <h2>{{$lesson->title}}</h2>
        <p>{{$lesson->text}}</p>

        <img src="/images/{{$lesson->image}}.png" width="300">

    </div>
    <div class="editor-container">
        <div class="header"> PHP Online IDE </div>
        <form id="csrf">
            @csrf
            <div class="editor" id="editor">{{$lesson->code}}</div>
        </form>
        <div class="button-container">
            <button class="btn" onclick="executeCode()"> Запустить </button>
        </div>

        <div class="shell-output"></div>
        <div class="tests-output"></div>

    </div>

</div>
<div class="button-container">
    @if($lesson->id-1 !== 0)
    <a href="{{ route('showLesson', ['id' => $lesson->id-1]) }}" class="btn"> Предыдущий </a>
    @endif
    <a href="{{ route('showLesson', ['id' => $lesson->id+1]) }}" class="btn"> Следующий </a>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../js/lib/ace.js"></script>


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
                {{--"id" : {{$lesson->id}},--}}
                code: editor.getSession().getValue(),
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                console.log(response);
                var jsonDataStart = response.indexOf('{'); // Find the start of JSON
                var jsonDataEnd = response.lastIndexOf('}'); // Find the end of JSON


                if (jsonDataStart !== -1 && jsonDataEnd !== -1) {
                    var jsonData = response.substring(jsonDataStart, jsonDataEnd + 1); // Extract JSON
                    try {
                        var parsedData = JSON.parse(jsonData); // Parse JSON
                        console.log(parsedData.shell);
                        console.log(parsedData.tests);
                        $(".shell-output").text(parsedData.shell.toString());
                        $(".tests-output").text(parsedData.tests.toString());
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                } else {
                    // Handle non-JSON response
                    var intStart = response.indexOf('int(');
                    var intEnd = response.indexOf(')');

                    if (intStart !== -1 && intEnd !== -1) {
                        var intValue = response.substring(intStart + 4, intEnd);
                        console.log("Value:", intValue);
                        // Do something with intValue
                    } else {
                        console.error("JSON data not found in response");
                    }
                }
            }

        });
    }
</script>

</body>
</html>