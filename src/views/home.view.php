<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        Welcome
        <?php echo $data['name']; ?>
    </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        $(document).ready(function () {
            $("h1").css("color", "#0088ff");
        });
    </script>
</head>

<body>
    <h1>
        <?php echo $data['id']; ?>:
        <?php echo $data['name']; ?>
    </h1>
</body>

</html>