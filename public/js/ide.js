let editor;

window.onload = function() {
    editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
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