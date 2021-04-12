<!DOCTYPE html>
<html>



<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">



    <title>Studied</title>



    <style>

        * {
            box-sizing:                         border-box;
            margin: 						    0;
            padding: 						    0;
        }

        html, body {
            background-color:                   black;
            -webkit-font-smoothing:             antialiased;
        }

        .wrap {
            height:                             100vh;
            display:                            grid;
            grid-template-rows:                 1fr auto 1fr;
            grid-template-columns:              1fr auto 1fr;
            grid-template-areas:                ". . ."
                                                ". dot ."
                                                ". . .";
        }

        .dot {
            grid-area:                          dot;
            width:                              60px;
            height:                             60px;
            border-radius:                      30px;
            background:                         #FFDD00;
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
