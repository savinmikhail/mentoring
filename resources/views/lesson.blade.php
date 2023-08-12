<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codeboard Online IDE</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
@include('layout.navbar')
<div class="split-screen-container">
    <div class="theory-container">

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
                "id": {{$lesson->id}},
                code: editor.getSession().getValue(),
                "_token": "{{ csrf_token() }}",
            },

            success: function(response) {
                try {
                    console.log(response.shell);
                    console.log(JSON.parse(response));
                    $(".shell-output").text(response.shell.toString());
                    $(".tests-output").text(response.tests.toString());
                    $(".tests-output").text(JSON.parse(response.message));
                } catch (error) {
                    console.log("An error occurred while parsing JSON:", error);

                    // Display the error message from the response
                    var errorResponse = JSON.parse(response); // Try parsing JSON again
                    var errorMessage = errorResponse.message;
                    $(".shell-output").text("Error: " + errorMessage);
                    // console.log("An error occurred while parsing JSON:", error);
                    // var responseLines = response.split('{');
                    // var limitedResponseShell = responseLines.slice(0, 1).join('\n');
                    // $(".shell-output").text(limitedResponseShell);
                    //  console.log(response);

                    // var responseLine = response.split('"');
                    // var limitedResponseTests = responseLine.slice(3, 4).join('\n');
                    // console.log(limitedResponseTests);
                    // $(".tests-output").text(limitedResponseTests);
                }
            }
        });
    }
</script>

</body>
</html>