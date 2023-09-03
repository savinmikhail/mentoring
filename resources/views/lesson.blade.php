<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Codeboard Online IDE</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
        .split-screen-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        .theory-container {
            flex: 1;
            padding: 20px;
            max-height: 800px;
            overflow-y: auto;
            width: 40%;
        }
        .split-screen-container {
            box-shadow: 15px 15px 0px 0px rgba(77,189,198,0.2);
        }


    </style>
</head>
<body>
@include('layout.navbar')
<div class="split-screen-container">


    <div class="theory-container scrollable">
        <p>{!!$lesson->text!!}</p>
    </div>
    <div class="editor-container">
        <div class="header"> PHP Online IDE </div>
        <form id="csrf">
            @csrf
            <div class="editor" id="editor">{{$lesson->code}}</div>
        </form>
        <div class="button-container">
            <button class="btn border" onclick="runCode()"> Запустить </button>

            @if(!$lesson->manual_test)
                <button class="btn border" onclick="runTests()"> Проверить тесты </button>
            @endif
            @if($lesson->manual_test)
                <button class="btn border" onclick="send()"> Отправить на проверку </button>
            @endif
        </div>


        <div class="shell-output"></div>
        <div class="tests-output"></div>

    </div>

</div>
<div class="button-container">
    @if($lesson->id-1 !== 0)
        <a href="{{ route('showLesson', ['id' => $lesson->id-1]) }}" class="btn"> Предыдущий </a>
    @endif
        <?php
            use Illuminate\Support\Facades\DB;
            if(DB::table('lessons')->where('id', $lesson->id+1)->exists()):
        ?>
            <a href="{{ route('showLesson', ['id' => $lesson->id+1]) }}" class="btn"> Следующий </a>
<?php endif ?>


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
    function executeAction(action) {
        $.ajax({
            url: "/com",
            method: "POST",
            data: {
                "id": {{$lesson->id}},
                code: editor.getSession().getValue(),
                action: action, // Pass the action parameter
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                if (action === "tests") {
                    $(".tests-output").text(response.tests.toString());
                } else if (action === "code") {
                    $(".shell-output").text(response.shell.toString());
                } else if (action === "send") {
                    $(".tests-output").text(response.tests.toString());
                }
            }
        });
    }

    function runTests() {
        executeAction("tests");
    }

    function runCode() {
        executeAction("code");
    }
    function send() {
        executeAction("send");
    }



</script>

</body>
</html>