<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">

        $(document).ready(function () {

            $('#my_form').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'pst.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function (result) {
                        $('#my_form').trigger('reset');
                        $('#info').html(result);
                        //alert(result);
                    },
                });
            });
        })
    </script>

    <title>Test</title>
</head>
<body>

<form method="post" id="my_form" enctype="multipart/form-data">
    <input type="file" name="myfile" id="myfile">
    <input type="submit">
</form>
<div id="info">

</div>

</body>
</html>