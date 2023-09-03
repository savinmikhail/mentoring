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

            @if(!$lesson->manual_check)
                <button class="btn border" onclick="runTests()"> Проверить тесты </button>
            @endif

            @if($lesson->manual_check)
                <button class="btn border" onclick="send()"> Отправить на проверку </button>
            @endif
        </div>


        <div class="shell-output"></div>
        <div class="tests-output"></div>

    </div>

</div>
<div class="button-container">
{{--    @if( auth()->user()->role === 'ADMIN')--}}
{{--        <button class="btn border" onclick="editLesson()">  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">--}}
{{--                <path d="M30.133 1.552c-1.090-1.044-2.291-1.573-3.574-1.573-2.006 0-3.47 1.296-3.87 1.693-0.564 0.558-19.786 19.788-19.786 19.788-0.126 0.126-0.217 0.284-0.264 0.456-0.433 1.602-2.605 8.71-2.627 8.782-0.112 0.364-0.012 0.761 0.256 1.029 0.193 0.192 0.45 0.295 0.713 0.295 0.104 0 0.208-0.016 0.31-0.049 0.073-0.024 7.41-2.395 8.618-2.756 0.159-0.048 0.305-0.134 0.423-0.251 0.763-0.754 18.691-18.483 19.881-19.712 1.231-1.268 1.843-2.59 1.819-3.925-0.025-1.319-0.664-2.589-1.901-3.776zM22.37 4.87c0.509 0.123 1.711 0.527 2.938 1.765 1.24 1.251 1.575 2.681 1.638 3.007-3.932 3.912-12.983 12.867-16.551 16.396-0.329-0.767-0.862-1.692-1.719-2.555-1.046-1.054-2.111-1.649-2.932-1.984 3.531-3.532 12.753-12.757 16.625-16.628zM4.387 23.186c0.55 0.146 1.691 0.57 2.854 1.742 0.896 0.904 1.319 1.9 1.509 2.508-1.39 0.447-4.434 1.497-6.367 2.121 0.573-1.886 1.541-4.822 2.004-6.371zM28.763 7.824c-0.041 0.042-0.109 0.11-0.19 0.192-0.316-0.814-0.87-1.86-1.831-2.828-0.981-0.989-1.976-1.572-2.773-1.917 0.068-0.067 0.12-0.12 0.141-0.14 0.114-0.113 1.153-1.106 2.447-1.106 0.745 0 1.477 0.34 2.175 1.010 0.828 0.795 1.256 1.579 1.27 2.331 0.014 0.768-0.404 1.595-1.24 2.458z"></path>--}}
{{--            </svg> </button>--}}

{{--    @endif--}}
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
<script>
    function editLesson(){

    }
</script>
</body>
</html>