<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Studied</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>

        html, body {
            background-color:               black;
        }

        .wrap {
            height:                         100%;
            display:                        grid;
            grid-template-rows:             1fr auto 1fr;
            grid-template-columns:          1fr auto 1fr;
            grid-template-areas:            ". . ."
                                            ". dot ."
                                            ". . .";
        }

        .dot {
            grid-area:                      dot;
            width:                          80px;
            height:                         80px;
            border-radius:                  40px;
            background:                     #FFDD00;
        }

    </style>
</head>
<body>

    <div class="wrap">

        <div class="dot">

        </div>

    </div>

</body>
</html>
