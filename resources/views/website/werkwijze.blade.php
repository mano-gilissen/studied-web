<!DOCTYPE html><!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Aug 30 2021 14:15:51 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="60b757b2ba49f67b9d32a051" data-wf-site="60ab5c331d3006ab3cefdc9f">
<head>
    <meta charset="utf-8">
    <title>Werkwijze</title>
    <meta content="De behoefte van de scholier staat bij ons centraal. Bij alles wat we doen vragen we ons af: Past dit bij wat de middelbare scholieren nodig hebben?" name="description">
    <meta content="Werkwijze" property="og:title">
    <meta content="De behoefte van de scholier staat bij ons centraal. Bij alles wat we doen vragen we ons af: Past dit bij wat de middelbare scholieren nodig hebben?" property="og:description">
    <meta content="Werkwijze" property="twitter:title">
    <meta content="De behoefte van de scholier staat bij ons centraal. Bij alles wat we doen vragen we ons af: Past dit bij wat de middelbare scholieren nodig hebben?" property="twitter:description">
    <meta property="og:type" content="website">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/webflow.css" rel="stylesheet" type="text/css">
    <link href="css/studied.webflow.css" rel="stylesheet" type="text/css">
    <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
    <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="images/webclip.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <style>
        input, textarea {
            -webkit-appearance: none;
            border-radius: 0; }
        body:hover .cursor {
            opacity:1.0;
        }
        /* Autofill background none*/
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px #ffffff inset !important;
        }
        .cursor {
            pointer-events: none;
        }
        .body {
            overflow: overlay;
        }
        .body-scrolloff {
            overflow: hidden;
        }
        .w-checkbox-input--inputType-custom.w--redirected-focus {
            box-shadow: none;
        }
        .wf--redirected-checked input[type="checkbox"]:focus + label::before {
            outline: none;
        }
        html {
            -webkit-tap-highlight-color: rgba(255,221,0,0);
        }
        .textarea {
            resize: none;
        }
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background-color: rgba(0, 0, 0, .02);
            -webkit-border-radius: 0px;
            border-radius: 0px;
        }
        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #434343;
        }
        ::selection {
            color: #1a1a1a;
            background: rgba(255,221,0, .95);
        }
        @media screen and (max-width: 991px){
            .mobile100vh {
                height: 100vh; /* Fallback for browsers that do not support Custom Properties */
                height: calc(var(--vh, 1vh) * 100);
            }
        }
        .active-text{
            color: #fff;
        }
        .active-box{
            background-color: #242424 !important;
            border-color: #242424 !important;
        }
        .circle-big {
            fill: #242424;
            transition:
                r .9s,
                fill .5s .5s;
        }
        .circle-small {
            fill: #fd0;
            transition:
                r .6s .3s,
                fill .5s .1s;
        }
        .menu-open-txt {
            color: #fff !important;
            transition:
                color .2s .5s;
        }
        /*///////////// Nice select//////////*/
        .nice-select {
            -webkit-tap-highlight-color: transparent;
            -webkit-transition: all 0.2s ease-in-out;
            transition: all 0.2s ease-in-out;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            display:block !important;
            padding: 0.25em 0;
            float: none;
            width: 100%;
            font-size: 1em;
            height: auto;
            border-radius: 0px;
            border-style: solid;
            border-width: 0 0 1px;
            border: none;
            border-bottom: 1px solid #e6e6e6;
            color: #434343;
            background-color: rgba(0,0,0,0);
            margin-bottom: 3.5em;
        }
        .nice-select:active, .nice-select.open, .nice-select:focus + span.current {
            color: #242424;
        }
        .nice-select .option.selected {
            font-weight: 400;
        }
        .nice-select .list {
            width: 100% !important;
            overflow: auto !important;
            max-height: 200px !important;
            box-shadow: none !important;
        }
        .nice-select .option:hover, .nice-select .option.focus, .nice-select .option.selected.focus {
            background-color: rgba(0,0,0,0);
            color: #fd0 ;
        }
        .nice-select .option.focus, .nice-select .option.selected.focus {
            background-color: rgba(0,0,0,0) !important;
            color: #fd0 !important;
        }
        .nice-select.open:after {
            -webkit-transform: rotate(-135deg);
            -ms-transform: rotate(-135deg);
            transform: rotate(-135deg);
        }
        .nice-select.open .list {
            opacity: 1;
            pointer-events: auto;
            -webkit-transform: scale(1) translateY(0);
            -ms-transform: scale(1) translateY(0);
            transform: scale(1) translateY(0);
        }
        .nice-select.disabled {
            border-color: #ededed;
            color: #999;
            pointer-events: none;
        }
        .nice-select.disabled:after {
            border-color: #e6e6e6;
        }
        .nice-select.wide {
            width: 100%;
        }
        .nice-select.wide .list {
            left: 0 !important;
            right: 0 !important;
        }
        .nice-select.right {
            float: right;
        }
        .nice-select.right .list {
            left: auto;
            right: 0;
        }
        .nice-select .list {
            border-radius: 0;
            background-color: white;
            box-shadow: none;
            box-sizing: border-box;
            margin-top: 0px;
            opacity: 0;
            overflow: hidden;
            padding: .5em 0px;
            pointer-events: none;
            position: absolute;
            top: 100%;
            left: 0;
            overflow-y: scroll;
            overflow-x: hidden;
            max-height: var(--list-max-height);
            -webkit-transform-origin: 50% 0;
            -ms-transform-origin: 50% 0;
            transform-origin: 50% 0;
            -webkit-transform: scale(0.75) translateY(-21px);
            -ms-transform: scale(0.75) translateY(-21px);
            transform: scale(0.75) translateY(-21px);
            -webkit-transition: all 0.2s cubic-bezier(0.5, 0, 0, 1.25), opacity 0.15s ease-out;
            transition: all 0.2s cubic-bezier(0.5, 0, 0, 1.25), opacity 0.15s ease-out;
            z-index: 9;
            -webkit-box-shadow: 5px 4px 9px 2px rgba(0,0,0,0.04) !important;
            box-shadow: 5px 4px 9px 2px rgba(0,0,0,0.04) !important;
        }
        .nice-select .list:hover .option:not(:hover) {
            background-color: transparent !important;
        }
        .nice-select .option {
            cursor: pointer;
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
            padding: 3px 1em;
            font-weight: 400;
            color: #434343;
        }
        .nice-select .option:first-child {
            display: none;
        }
        span.current {
            color: #e6e6e6;
            font-weight: 400;
        }
        .nice-select .option.disabled {
            background-color: transparent;
            color: #434343;
            opacity: .5;
            cursor: default;
        }
        .no-csspointerevents .nice-select .list {
            display: none;
        }
        .no-csspointerevents .nice-select.open .list {
            display: block;
        }
        .nice-select:after {
            border-bottom: 2px solid #e6e6e6;
            border-right: 2px solid #e6e6e6;
        }
        .w-input:focus, .w-select:focus {
            border-color: #434343 !important;
            outline: 0;
        }
        .checkbox:focus { outline: 0 !important}
        @media screen and (min-width: 1920px){
            .nice-select {
                font-size: 1.25em;
            }
        }
        /*///////////// Nice select End//////////*/
    </style>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .locaties-container {
            width: 100%;
            height: auto;
            padding: 20px 0px;
            overflow: hidden;
            margin: 0 auto;
        }
        .swiper-container {
            width: 300px;
            height: 100%;
            overflow: visible;
            margin-left: 4em;
        }
        @media screen and (max-width: 767px) {
            .swiper-container {
                margin-left: 1em;
            }
        }
        .swiper-slide {
            width: 300px;
        }
    </style>
</head>
<body class="body">
<div class="pagetransition-container mobile100vh">
    <div class="pt-textwrap">
        <div class="pt-innertxt">
            <p class="pt-text">Zet</p>
        </div>
        <div class="pt-innertxt">
            <p class="pt-text">een</p>
        </div>
        <div class="pt-innertxt">
            <p class="pt-text geel">punt</p>
        </div>
        <div class="pt-innertxt">
            <p class="pt-text">achter</p>
        </div>
        <div class="pt-innertxt">
            <p class="pt-text">je</p>
        </div>
        <div class="pt-innertxt">
            <p class="pt-text last">onvoldoendes.</p>
        </div>
    </div>
    <div class="pt-background">
        <div class="pt-backcol col1">
            <div class="backcol-inner colin1"></div>
        </div>
    </div>
</div>
<div class="menu-wrapper">
    <div class="menu">
        <div class="menu-content">
            <div class="menu-innerwrap">
                <a data-w-id="76d3e6d0-431d-bfa2-64fb-a13cdaf5dda3" href="/actueel" class="menu-linkblock pageleave">Actueel</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc8109" href="begeleiding.html" class="menu-linkblock pageleave">Begeleiding</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc810b" href="werkwijze.html" aria-current="page" class="menu-linkblock pageleave w--current">Werkwijze</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc810f" href="werk.html" class="menu-linkblock pageleave">Werk</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc8111" href="zakelijk.html" class="menu-linkblock pageleave">Zakelijk</a>
                <div class="contact-info">
                    <p class="contact-info__tag">Vragen? Bel of mail ons!</p>
                    <div class="menu-contact-info__info">
                        <a href="tel:+31600000000" class="contact-info_txt">+31 6 31 23 44 35</a>
                    </div>
                    <div class="menu-contact-info__info">
                        <a href="mailto:info@studied.nl" class="contact-info_txt">info@studied.nl</a>
                    </div>
                </div>
            </div>
            <div class="menu-extras">
                <div class="login-container">
                    <p class="login-caption" style="margin:0 1em 0 0">Naar het portaal</p>
                    <a href="/inloggen" class="main-btn menu-btn pageleave">Inloggen</a>
                </div>
            </div>
            <div class="site-name__wrap">
                <a data-w-id="0321ca4e-998a-3e99-b443-597d2349ae85" href="/home" class="home-link pageleave">Studied<span class="geel">.</span></a>
            </div>
        </div>
    </div>
    <div class="site-name__wrap">
        <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc811b" href="/home" class="home-link pageleave">Studied<span class="geel">.</span></a>
    </div>
    <div class="menu-background w-embed"><svg width="54" height="54" style="overflow: inherit !important;">
            <circle class="circle-radius" cx="50%" cy="50%" r="27" fill="#ffdd00"></circle>
        </svg></div>
    <div data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc811e" class="menu-openbtn w-embed">
        <a class="pageleave">
            <svg width="54" height="54">
                <circle cx="50%" cy="50%" r="27" fill="#ffdd00"></circle>
            </svg>
        </a>
    </div>
</div>
<div data-w-id="7f23121b-c69e-7631-6dac-58912d995d4b" class="subpage-header mobile100vh">
    <div class="scrolllottie-wrap">
        <div data-w-id="b0a07e11-b904-ce10-8718-8d942b054410" data-animation-type="lottie" data-src="documents/53892-scroll-down-mouse.json" data-loop="1" data-direction="1" data-autoplay="0" data-is-ix2-target="1" data-renderer="svg" data-default-duration="2.4638745562178235" data-duration="3.5"></div>
    </div>
    <div class="subpage-inner">
        <h2 class="inner-subtekst _2em">Werkwijze</h2>
        <h1 class="heading _7em">De behoefte van de scholier staat bij ons centraal</h1>
    </div>
</div>
<div data-w-id="c0b51b95-7ef0-7f60-17e1-83055e65e3ca" class="subpage-section track">
    <div class="camera">
        <div class="frame">
            <div class="value-item">
                <div class="value-inner">
                    <div class="value-col left">
                        <div class="value-titlewrap">
                            <p class="value-tag">Core-value #1</p>
                            <h3 class="value-header">Snel</h3>
                        </div>
                        <div class="value-bullets">
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">Kennismakings- en evaluatiegesprek zijn snel ingepland, vaak binnen 24 uur.</p>
                            </div>
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">Student-docent kunnen snel worden gewijzigd of toegevoegd.</p>
                            </div>
                            <div class="list-item value-listitem last">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">Vakken kunnen snel worden gewijzigd of toegevoegd.</p>
                            </div>
                        </div>
                    </div>
                    <div class="value-col big"><img src="images/Werkwijze-Snel.jpg" loading="eager" sizes="(max-width: 767px) 100vw, (max-width: 991px) 85vw, (max-width: 1439px) 49vw, (max-width: 1919px) 51vw, 52vw" srcset="images/Werkwijze-Snel-p-1080.jpeg 1080w, images/Werkwijze-Snel-p-1600.jpeg 1600w, images/Werkwijze-Snel-p-2000.jpeg 2000w, images/Werkwijze-Snel.jpg 2300w" alt="Student op de fiets onderweg naar bijles" class="value-image"></div>
                </div>
            </div>
            <div class="value-item">
                <div class="value-inner">
                    <div class="value-col left">
                        <div class="value-titlewrap">
                            <p class="value-tag">Core-value #2</p>
                            <h3 class="value-header">Transparant</h3>
                        </div>
                        <div class="value-bullets">
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">Het begeleidingsproces wordt afgesproken in een Plan van Aanpak en vakafspraken.</p>
                            </div>
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">Elke les heeft een lesrapport. Deze wordt gecheckt door onze managing-student en aan ouders beschikbaar gesteld.</p>
                            </div>
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">Iedere vakafspraak heeft een evaluatiemoment. Zo kunnen we  bespreken wat wel en niet werkt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="value-col big"><img src="images/Werkwijze-Transparant_2.jpg" loading="eager" sizes="(max-width: 767px) 100vw, (max-width: 991px) 85vw, (max-width: 1439px) 49vw, (max-width: 1919px) 51vw, 52vw" srcset="images/Werkwijze-Transparant_2-p-500.jpeg 500w, images/Werkwijze-Transparant_2-p-800.jpeg 800w, images/Werkwijze-Transparant_2-p-1080.jpeg 1080w, images/Werkwijze-Transparant_2-p-1600.jpeg 1600w, images/Werkwijze-Transparant_2-p-2000.jpeg 2000w, images/Werkwijze-Transparant_2.jpg 2100w" alt="Sfeerbeeld van enkele studeer middelen zoals een notitieboek en pennenmap" class="value-image tp"></div>
                </div>
            </div>
            <div class="value-item">
                <div class="value-inner">
                    <div class="value-col left">
                        <div class="value-titlewrap">
                            <p class="value-tag">Core-value #3</p>
                            <h3 class="value-header">Maatwerk</h3>
                        </div>
                        <div class="value-bullets">
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">De begeleiding wordt afgestemd op de behoefte, door middel van een Plan van Aanpak, vak afspraken, en evaluatiemomenten.</p>
                            </div>
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">De begeleiding vindt plaats op de locatie en tijd die voor de leerling beste werkt.</p>
                            </div>
                            <div class="list-item value-listitem">
                                <div class="bullet bk value-bullet"></div>
                                <p class="listitem-text value-listitem">We evalueren de behoefte kritisch en passen het begeleidingsproces zo nodig aan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="value-col big"><img src="images/Werkwijze-Maatwerk_2.jpg" loading="eager" sizes="(max-width: 767px) 100vw, (max-width: 991px) 85vw, (max-width: 1439px) 49vw, (max-width: 1919px) 51vw, 52vw" srcset="images/Werkwijze-Maatwerk_2-p-500.jpeg 500w, images/Werkwijze-Maatwerk_2-p-800.jpeg 800w, images/Werkwijze-Maatwerk_2-p-1080.jpeg 1080w, images/Werkwijze-Maatwerk_2-p-1600.jpeg 1600w, images/Werkwijze-Maatwerk_2-p-2000.jpeg 2000w, images/Werkwijze-Maatwerk_2.jpg 2001w" alt="Sfeerbeeld van een Studied notitieboekje met pen" class="value-image mw"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="subpage-section werkwijze">
    <div class="subheaderwrap">
        <h3>Werkwijze</h3>
    </div>
    <a data-w-id="1e089004-4817-3454-e981-5d36353ccedd" href="#" class="ww-section w-inline-block">
        <div class="ww-header">
            <p class="ww-number">01</p>
            <h3 class="werkwijze-heading">Aanvraag</h3>
        </div>
        <div style="width:100%;height:0px" class="ww-body">
            <div class="spacer"></div>
            <div class="ww-bodycol big">
                <p class="list-tag">Beschrijving</p>
                <p class="ww-info">Als u interesse in onze begeleiding hebt, kunt u een aanvraag indienen. We nemen dan contact met u op om de mogelijkheden te bespreken. Om uw aanvraag zo goed mogelijk te behandelen, ontvangen we graag informatie om het kennismakingsgesprek voor te bereiden</p>
            </div>
            <div class="ww-bodycol">
                <p class="list-tag">Informatie over de scholier</p>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Voor welke vakken begeleiding nodig is</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Op welke school uw zoon/dochter zit</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Op welk niveau uw zoon/dochter zit</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">In welk jaar uw zoon/dochter zit</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Welk type begeleiding u zoekt</p>
                </div>
            </div>
        </div>
    </a>
    <a data-w-id="1e0c0607-4a3b-692a-608c-55b437ddc4c9" href="#" class="ww-section w-inline-block">
        <div class="ww-header">
            <p class="ww-number">02</p>
            <h3 class="werkwijze-heading">Kennismaking</h3>
        </div>
        <div style="width:100%;height:0px" class="ww-body">
            <div class="spacer"></div>
            <div class="ww-bodycol big">
                <p class="list-tag">Beschrijving</p>
                <p class="ww-info">N.a.v. het ontvangen van de aanvraag nodigen we u en uw zoon/dochter uit voor een kennismakingsgesprek. In dit gesprek worden de mogelijkheden besproken en is er de gelegenheid om vragen te stellen. Het gesprek zal worden geleid door de managing-student. Daarnaast is er uw student-docent om kennis te maken en de begeleiding te bespreken. <br><br>Het kennismakingsgesprek duurt ongeveer 15 minuten en kan zowel online als offline plaatsvinden. Gedurende het gesprek worden door uw managing-student twee documenten opgesteld. Er wordt een Plan van Aanpak gemaakt, zo weten we altijd wat de bedoeling is. Ook worden er een of meerdere vakafspraken opgesteld. In deze afspraken staat primaire hoe vaak en waar de les zal plaatsvinden voor het betreffende vak. Beide documenten worden mogelijk nog aangepast n.a.v. de proefles. Deze kan na het opstellen van de documenten worden ingepland.</p>
            </div>
            <div class="ww-bodycol">
                <p class="list-tag">Gedurende het gesprek</p>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Ontvangst aanvraag</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Uitnodiging kennismakingsgesprek</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Opstellen plan van aanpak</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Opstellen vakafspraken</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Proefles inplannen</p>
                </div>
            </div>
        </div>
    </a>
    <a data-w-id="19e7d2bf-80db-008f-1aca-152018a0f32f" href="#" class="ww-section w-inline-block">
        <div class="ww-header">
            <p class="ww-number">03</p>
            <h3 class="werkwijze-heading">Proefles</h3>
        </div>
        <div style="width:100%;height:0px" class="ww-body">
            <div class="spacer"></div>
            <div class="ww-bodycol big">
                <p class="list-tag">Beschrijving</p>
                <p class="ww-info">Uw student-docent kijkt bij de proefles wat er moet worden gedaan voor de voorbereiding van de volgende toets. Aan de hand hiervan zal de les worden ingevuld en vervolglessen worden ingepland. <br><br>Het is belangrijk dat zowel de student-docent als de scholier vertrouwen in de begeleiding heeft. Dit wordt na afloop van de proefles gecheckt door de managing-student. Hij/zij bespreekt de proefles met de student-docent en vraagt de scholier hoe het ging en of hij/zij met de student-docent verder wilt. De bevindingen worden teruggekoppeld aan de ouders, waarna deze kunnen besluiten of de begeleiding wordt voortgezet. Dit is het moment waarop de scholier wordt ingeschreven voor onze begeleiding. </p>
            </div>
            <div class="ww-bodycol">
                <p class="list-tag">Gedurende de proefles</p>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Uitvoering proefles</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Vervolglessen inplannen</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Vertrouwen checken</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Terugkoppelen met ouders</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Inschrijven voor begeleiding</p>
                </div>
            </div>
        </div>
    </a>
    <a data-w-id="da85545a-3a12-255f-b05f-20d1e1d793c2" href="#" class="ww-section w-inline-block">
        <div class="ww-header">
            <p class="ww-number">04</p>
            <h3 class="werkwijze-heading">Begeleiding</h3>
        </div>
        <div style="width:100%;height:0px" class="ww-body">
            <div class="spacer"></div>
            <div class="ww-bodycol big">
                <p class="list-tag">Beschrijving</p>
                <p class="ww-info">Als de proefles goed is verlopen en de scholier wordt ingeschreven, start de begeleiding conform het Plan van Aanpak en de gemaakte vakafspraken. Gedurende de begeleiding heeft de scholier persoonlijk contact met de student-docent. Dit kan gewoon via WhatsApp t.b.v. het inplannen van lessen, vragen en overige zaken. <br><br>De student-docenten maken een lesrapport van iedere les. De managing-student checkt wekelijks de lesrapporten en maakt deze beschikbaar voor de ouders. Ook onderhoudt de managing-student het contact met de ouders en school. </p>
            </div>
            <div class="ww-bodycol">
                <p class="list-tag">Gedurende de begeleiding</p>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Start begeleiding</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Lessen inplannen via Whatsapp</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Elke les een rapport in het portaal</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Contact met ouders en school</p>
                </div>
            </div>
        </div>
    </a>
    <a data-w-id="0949b434-d87e-5163-9b5f-a42b759c694c" href="#" class="ww-section w-inline-block">
        <div class="ww-header">
            <p class="ww-number">05</p>
            <h3 class="werkwijze-heading">Evaluatie</h3>
        </div>
        <div style="width:100%;height:0px" class="ww-body">
            <div class="spacer"></div>
            <div class="ww-bodycol big">
                <p class="list-tag">Beschrijving</p>
                <p class="ww-info">De begeleiding wordt regelmatig geëvalueerd. Zo eindigt een vakafspraak met een evaluatiegesprek om het verdere verloop dan wel de afloop van de begeleiding te bespreken. Ook is er een vaste evaluatiegesprek t.b.v. de examentraining. Deze is namelijk integraal aan onze begeleiding en start v.a. 1 maart. De invulling hiervan wordt besproken en vastgelegd bij het evaluatiegesprek.</p>
            </div>
            <div class="ww-bodycol">
                <p class="list-tag">Evaluatie proces</p>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Regelmatige evaluaties</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Vakafspraak eindigt met evaluatiegesprek</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Vast evaluatiegesprek voor examenvoorbereiding</p>
                </div>
            </div>
        </div>
    </a>
    <a data-w-id="a2bb4b26-1bc4-ae29-5e8c-4a53ddea411a" href="#" class="ww-section last w-inline-block">
        <div class="ww-header">
            <p class="ww-number">06</p>
            <h3 class="werkwijze-heading">Einde begeleiding</h3>
        </div>
        <div style="width:100%;height:0px" class="ww-body">
            <div class="spacer"></div>
            <div class="ww-bodycol big">
                <p class="list-tag">Beschrijving</p>
                <p class="ww-info">De begeleiding kan op verschillende manieren eindigen. Als een vakafspraak afloopt, kan worden besloten de begeleiding te beëindigen. Er wordt dan geen nieuwe vakafspraak gemaakt. Vanzelfsprekend kan ook tussentijds worden opgezegd conform onze algemene voorwaarden. Voor onze eindexamenkids geldt uiteraard dat de begeleiding automatisch eindigt als ze zijn geslaagd.</p>
            </div>
            <div class="ww-bodycol">
                <p class="list-tag">Einde wanneer</p>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Geen nieuwe vakafspraak wordt gemaakt</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">Begeleiding tussentijds wordt opgezegd</p>
                </div>
                <div class="list-item">
                    <div class="bullet"></div>
                    <p class="listitem-text">De scholier slaagt</p>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="subpage-section top-bottom locaties">
    <div class="location-headwrap">
        <h3 class="locaties-head">Locaties</h3>
    </div>
    <div data-duration-in="400" data-duration-out="400" class="tabs w-tabs">
        <div class="tabs-menu w-tab-menu">
            <a data-w-tab="Hoofdkantoor" class="l-tabhead w-inline-block w-tab-link">
                <div class="tab-text">Hoofdkantoor</div>
            </a>
            <a data-w-tab="Vestigingen" class="l-tabhead w-inline-block w-tab-link">
                <div class="tab-text">Vestigingen</div>
            </a>
            <a data-w-tab="Leslocaties" class="l-tabhead w-inline-block w-tab-link w--current">
                <div class="tab-text">Leslocaties</div>
            </a>
        </div>
        <div class="w-tab-content">
            <div data-w-tab="Hoofdkantoor" class="l-tab w-tab-pane">
                <div class="tab-container">
                    <div class="tab-column small b3m">
                        <p class="black-par l-par">Het hoofdkantoor is gevestigd in Maastricht aan de Capucijnenstraat 21-C03. Vanuit hier worden de managing-students aangestuurd.</p>
                        <p class="black-par bold b-25">Maastricht</p>
                        <p class="black-par b-25">Capucijnenstraat 21-C03</p>
                        <a href="#" class="crew-link">+31 (0) 6 13 65 46 15</a>
                        <a href="#" class="crew-link">maastricht@studied.nl</a>
                    </div>
                    <div class="tab-column big cities">
                        <div class="crew-block"><img src="images/Hoofdkantoor_Bas.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Hoofdkantoor_Bas-p-500.jpeg 500w, images/Hoofdkantoor_Bas.jpg 750w" alt="Directeur Bas Jennissen" class="crew-image">
                            <div class="crew-info">
                                <p class="black-par bold b-25">Bas Jennissen</p>
                                <p class="black-par b-25 jobtitle">Directeur</p>
                                <a href="mailto:b.jennissen@studied.nl" class="crew-link">b.jennissen@studied.nl</a>
                            </div>
                        </div>
                        <div class="crew-block"><img src="images/Hoofdkantoor_Megan.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Hoofdkantoor_Megan-p-500.jpeg 500w, images/Hoofdkantoor_Megan.jpg 750w" alt="Vice-Directeur Megan Verbeek" class="crew-image">
                            <div class="crew-info">
                                <p class="black-par bold b-25">Megan Verbeek</p>
                                <p class="black-par b-25 jobtitle">Vice-Directeur</p>
                                <a href="mailto:m.verbeek@studied.nl" class="crew-link">m.verbeek@studied.nl</a>
                            </div>
                        </div>
                        <div class="crew-block"><img src="images/Hoofdkantoor_Randy.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Hoofdkantoor_Randy-p-500.jpeg 500w, images/Hoofdkantoor_Randy.jpg 749w" alt="Marketeer Randy Hamilton" class="crew-image">
                            <div class="crew-info">
                                <p class="black-par bold b-25">Randy Hamilton</p>
                                <p class="black-par b-25 jobtitle">Marketing &amp; Communicatie</p>
                                <a href="mailto:r.hamilton@studied.nl" class="crew-link">r.hamilton@studied.nl</a>
                            </div>
                        </div>
                        <div class="crew-block"><img src="images/Hoofdkantoor_Robin.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Hoofdkantoor_Robin-p-500.jpeg 500w, images/Hoofdkantoor_Robin.jpg 751w" alt="Content Creator Robin Custers" class="crew-image">
                            <div class="crew-info">
                                <p class="black-par bold b-25">Robin Custers</p>
                                <p class="black-par b-25 jobtitle">Content Creator</p>
                                <a href="mailto:r.custers@studied.nl" class="crew-link">r.custers@studied.nl</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="locaties-container">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="crew-block"><img src="images/Hoofdkantoor_Bas.jpg" loading="lazy" sizes="(max-width: 991px) 180px, 100vw" srcset="images/Hoofdkantoor_Bas-p-500.jpeg 500w, images/Hoofdkantoor_Bas.jpg 750w" alt="Directeur Bas Jennissen" class="crew-image">
                                    <div class="crew-info">
                                        <p class="black-par bold b-25">Bas Jennissen</p>
                                        <p class="black-par b-25 jobtitle">Directeur</p>
                                        <a href="mailto:b.jennissen@studied.nl" class="crew-link">b.jennissen@studied.nl</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="crew-block"><img src="images/Hoofdkantoor_Megan.jpg" loading="lazy" sizes="(max-width: 991px) 180px, 100vw" srcset="images/Hoofdkantoor_Megan-p-500.jpeg 500w, images/Hoofdkantoor_Megan.jpg 750w" alt="Vice-Directeur Megan Verbeek" class="crew-image">
                                    <div class="crew-info">
                                        <p class="black-par bold b-25">Megan Verbeek</p>
                                        <p class="black-par b-25 jobtitle">Vice-Directeur</p>
                                        <a href="mailto:m.verbeek@studied.nl" class="crew-link">m.verbeek@studied.nl</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="crew-block"><img src="images/Hoofdkantoor_Randy.jpg" loading="lazy" sizes="(max-width: 991px) 180px, 100vw" srcset="images/Hoofdkantoor_Randy-p-500.jpeg 500w, images/Hoofdkantoor_Randy.jpg 749w" alt="Marketeer Randy Hamilton" class="crew-image">
                                    <div class="crew-info">
                                        <p class="black-par bold b-25">Randy Hamilton</p>
                                        <p class="black-par b-25 jobtitle">Marketing &amp; Communicatie</p>
                                        <a href="mailto:r.hamilton@studied.nl" class="crew-link">r.hamilton@studied.nl</a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="crew-block"><img src="images/Hoofdkantoor_Robin.jpg" loading="lazy" sizes="(max-width: 991px) 180px, 100vw" srcset="images/Hoofdkantoor_Robin-p-500.jpeg 500w, images/Hoofdkantoor_Robin.jpg 751w" alt="Content Creator Robin Custers" class="crew-image">
                                    <div class="crew-info">
                                        <p class="black-par bold b-25">Robin Custers</p>
                                        <p class="black-par b-25 jobtitle">Content Creator</p>
                                        <a href="mailto:r.custers@studied.nl" class="crew-link">r.custers@studied.nl</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-w-tab="Vestigingen" class="l-tab w-tab-pane">
                <div class="tab-container">
                    <div class="tab-column small hztl">
                        <p class="black-par l-par">Studied. is actief in en rondom Amsterdam, Eindhoven, Maastricht, Nijmegen, Rotterdam, Tilburg &amp; Utrecht. Iedere locatie heeft een eigen team student-docenten o.l.v. een managing-student. De managing-student beheert de locatie.</p>
                    </div>
                    <div class="tab-column big cities">
                        <div id="w-node-d6d0b99d-0311-47e7-ff47-546ebd269250-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Utrecht.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Utrecht-p-500.jpeg 500w, images/Vestiging_Utrecht.jpg 750w" alt="Sfeerbeeld van Utrecht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Amsterdam</p>
                            </div>
                        </div>
                        <div id="w-node-_55ec8ec2-ae08-737f-84c8-9f419e6e5ca9-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Eindhoven.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Eindhoven-p-500.jpeg 500w, images/Vestiging_Eindhoven.jpg 751w" alt="Sfeerbeeld van Eindhoven" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Eindhoven</p>
                            </div>
                        </div>
                        <div id="w-node-b37dc1be-2bc3-4fc0-8ee2-e12c2b7048d7-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Maastricht.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Maastricht-p-500.jpeg 500w, images/Vestiging_Maastricht.jpg 749w" alt="Sfeerbeeld van Maastricht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Maastricht</p>
                            </div>
                        </div>
                        <div id="w-node-_8dd3a6b3-4f8f-faab-e4ba-d0334a552bd0-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Nijmegen.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Nijmegen-p-500.jpeg 500w, images/Vestiging_Nijmegen.jpg 653w" alt="Sfeerbeeld van Nijmegen" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Nijmegen</p>
                            </div>
                        </div>
                        <div id="w-node-_8afd3f52-5192-72e4-eeea-00719fc3c1ab-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Rotterdam.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Rotterdam-p-500.jpeg 500w, images/Vestiging_Rotterdam.jpg 518w" alt="Sfeerbeeld van Rotterdam" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Rotterdam</p>
                            </div>
                        </div>
                        <div id="w-node-_199be967-a952-b4cc-5bc7-95c581da8989-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Tilburg.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Tilburg-p-500.jpeg 500w, images/Vestiging_Tilburg.jpg 751w" alt="Sfeerbeeld van Tilburg" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Tilburg</p>
                            </div>
                        </div>
                        <div id="w-node-_550d4310-7bbf-8e4f-bd45-fba8362d8a3a-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Vestiging_Utrecht.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Vestiging_Utrecht-p-500.jpeg 500w, images/Vestiging_Utrecht.jpg 750w" alt="Sfeerbeeld van Utrecht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Utrecht</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="locaties-container">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Utrecht.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Utrecht-p-500.jpeg 500w, images/Vestiging_Utrecht.jpg 750w" alt="Sfeerbeeld van Utrecht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Amsterdam</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Eindhoven.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Eindhoven-p-500.jpeg 500w, images/Vestiging_Eindhoven.jpg 751w" alt="Sfeerbeeld van Eindhoven" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Eindhoven</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Maastricht.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Maastricht-p-500.jpeg 500w, images/Vestiging_Maastricht.jpg 749w" alt="Sfeerbeeld van Maastricht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Maastricht</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Nijmegen.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Nijmegen-p-500.jpeg 500w, images/Vestiging_Nijmegen.jpg 653w" alt="Sfeerbeeld van Nijmegen" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Nijmegen</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Rotterdam.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Rotterdam-p-500.jpeg 500w, images/Vestiging_Rotterdam.jpg 518w" alt="Sfeerbeeld van Rotterdam" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Rotterdam</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Tilburg.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Tilburg-p-500.jpeg 500w, images/Vestiging_Tilburg.jpg 751w" alt="Sfeerbeeld van Tilburg" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Tilburg</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Vestiging_Utrecht.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Vestiging_Utrecht-p-500.jpeg 500w, images/Vestiging_Utrecht.jpg 750w" alt="Sfeerbeeld van Utrecht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Utrecht</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div data-w-tab="Leslocaties" class="l-tab w-tab-pane w--tab-active">
                <div class="tab-container">
                    <div class="tab-column small">
                        <p class="black-par l-par">Er wordt les gegeven waar dit nodig is. Dit kan bij u thuis, op school, de universiteit, de bibliotheek of op een van onze leslocaties. De mogelijkheden worden besproken bij het kennismakingsgesprek.<br><br>Neem gerust <a href="#" class="intext-link">contact</a> met ons op en plan een kennismakingsgesprek in met een van onze team-members</p>
                    </div>
                    <div class="tab-column big cities">
                        <div id="w-node-_44d16e3c-e8ad-a0ba-699b-e552393781d3-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Leslocatie_Eigen_2.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Leslocatie_Eigen_2-p-500.jpeg 500w, images/Leslocatie_Eigen_2.jpg 751w" alt="De Studied vlag buiten het kantoor" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Onze leslocatie</p>
                            </div>
                        </div>
                        <div id="w-node-e0f6bb08-43a2-0fd4-84a3-9487a4055005-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Leslocatie_ThuisBijScholier.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Leslocatie_ThuisBijScholier-p-500.jpeg 500w, images/Leslocatie_ThuisBijScholier.jpg 751w" alt="Scholier volgt thuis op de bank via Teams de bijles" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Bij scholier thuis</p>
                            </div>
                        </div>
                        <div id="w-node-_8ab316fc-c5b7-c714-bb90-089cdbac57a8-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Leslocatie_ThuisBijDocent.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Leslocatie_ThuisBijDocent-p-500.jpeg 500w, images/Leslocatie_ThuisBijDocent.jpg 749w" alt="1-op-1 begeleiding bij de student-docent op locatie" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Bij student-docent thuis</p>
                            </div>
                        </div>
                        <div id="w-node-_8caa1346-2945-096f-d880-84cb95284549-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Leslocatie_Universiteit.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Leslocatie_Universiteit-p-500.jpeg 500w, images/Leslocatie_Universiteit.jpg 719w" alt="Sfeerbeeld van de Universiteit Maastricht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Universiteit</p>
                            </div>
                        </div>
                        <div id="w-node-_1d9b9115-42c4-8817-b237-122524c3715c-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Leslocatie_Biblitheek.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Leslocatie_Biblitheek-p-500.jpeg 500w, images/Leslocatie_Biblitheek.jpg 540w" alt="Sfeerbeeld van Bibliotheek in Centre Ceramique" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Bibliotheek</p>
                            </div>
                        </div>
                        <div id="w-node-ab97bdab-3759-cc0f-ecef-c93a7a05cb49-9d32a051" class="location-block">
                            <div class="image-placeholder"><img src="images/Leslocatie_Digitaal.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 15vw, (max-width: 1919px) 180px, 216px" srcset="images/Leslocatie_Digitaal-p-500.jpeg 500w, images/Leslocatie_Digitaal.jpg 751w" alt="Student-docent geeft een digitaal collega via Teams" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                            <div class="city-info">
                                <p class="black-par">Digitaal</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="locaties-container">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Leslocatie_Eigen_2.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Leslocatie_Eigen_2-p-500.jpeg 500w, images/Leslocatie_Eigen_2.jpg 751w" alt="De Studied vlag buiten het kantoor" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Onze leslocatie</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Leslocatie_ThuisBijScholier.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Leslocatie_ThuisBijScholier-p-500.jpeg 500w, images/Leslocatie_ThuisBijScholier.jpg 751w" alt="Scholier volgt thuis op de bank via Teams de bijles" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Bij scholier thuis</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Leslocatie_ThuisBijDocent.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Leslocatie_ThuisBijDocent-p-500.jpeg 500w, images/Leslocatie_ThuisBijDocent.jpg 749w" alt="1-op-1 begeleiding bij de student-docent op locatie" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Bij student-docent thuis</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Leslocatie_Universiteit.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Leslocatie_Universiteit-p-500.jpeg 500w, images/Leslocatie_Universiteit.jpg 719w" alt="Sfeerbeeld van de Universiteit Maastricht" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Universiteit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Leslocatie_Biblitheek.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Leslocatie_Biblitheek-p-500.jpeg 500w, images/Leslocatie_Biblitheek.jpg 540w" alt="Sfeerbeeld van Bibliotheek in Centre Ceramique" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Bibliotheek</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="location-block">
                                    <div class="image-placeholder"><img src="images/Leslocatie_Digitaal.jpg" loading="lazy" sizes="(max-width: 991px) 216px, 100vw" srcset="images/Leslocatie_Digitaal-p-500.jpeg 500w, images/Leslocatie_Digitaal.jpg 751w" alt="Student-docent geeft een digitaal collega via Teams" class="city-image"><img src="images/1.0-Placeholder.jpg" loading="lazy" alt="" class="placeholder"></div>
                                    <div class="city-info">
                                        <p class="black-par">Digitaal</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Contact-Section" class="subpage-section contactform">
    <div class="cf-container">
        <div class="cf-header">
            <h3 class="b2 bk">Nog vragen?</h3>
            <p class="cf-par bk">Nog vragen over onze werkwijze? Stuur ons een bericht en dan nemen we direct contact op!</p>
        </div>
        <div class="form-wrapper w-form">
            <form action="https://submit-form.com/xSgds62z" id="email-form" data-name="Email Form" autocomplete="off" class="cf-body"> <!-- name="email-form" -->

                <input type="hidden" name="_feedback.dark" value="false" />
                <input type="hidden" name="_feedback.language" value="nl" />
                <input type="hidden" name="_feedback.success.title" value="Je verzoek is verstuurd!" />
                <input type="hidden" name="_feedback.success.message" value="Ga terug naar waar je was:" />
                <div class="cf-selectcontainer">
                    <div class="cf-title">
                        <div class="cf-title__number bk">
                            <p class="cf-number">01</p>
                        </div>
                        <p class="cf-sechead bk">Onderwerp</p>
                    </div>
                    <div class="cf-innerwrap"><label class="w-checkbox cf-select">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Werkwijze" name="Werkwijze" data-name="Werkwijze" style="opacity:0;position:absolute;z-index:-1"><span for="Werkwijze" class="cf-select__text w-form-label">Werkwijze</span>
                        </label><label class="w-checkbox cf-select">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Locaties" name="Locaties" data-name="Locaties" style="opacity:0;position:absolute;z-index:-1"><span for="Locaties" class="cf-select__text w-form-label">Locaties</span>
                        </label></div>
                    <div class="cf-innerwrap"><label class="w-checkbox cf-select">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Aanvragen" name="Aanvragen" data-name="Aanvragen" style="opacity:0;position:absolute;z-index:-1"><span for="Aanvragen" class="cf-select__text w-form-label">Aanvragen</span>
                        </label><label class="w-checkbox cf-select">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Anders" name="Anders" data-name="Anders" style="opacity:0;position:absolute;z-index:-1"><span for="Anders" class="cf-select__text w-form-label">Anders</span>
                        </label></div>
                </div>
                <div class="cf-main">
                    <div class="cf-title">
                        <div class="cf-title__number bk">
                            <p class="cf-number">02</p>
                        </div>
                        <p class="cf-sechead bk">Jouw gegevens</p>
                    </div>
                    <div class="cf-colwrap">
                        <div class="cf-column left"><label for="Voornaam-2" class="cf-fieldlabel">Voornaam</label><input type="text" class="cf-textfield w-input" autocomplete="off" maxlength="256" name="Voornaam-2" data-name="Voornaam 2" placeholder="Jouw voornaam" id="Voornaam-2" required=""></div>
                        <div class="cf-column right"><label for="Achternaam-2" class="cf-fieldlabel">Achternaam</label><input type="text" class="cf-textfield w-input" autocomplete="off" maxlength="256" name="Achternaam-2" data-name="Achternaam 2" placeholder="Jouw Achternaam" id="Achternaam-2"></div>
                    </div>
                    <div class="cf-colwrap">
                        <div class="cf-column left"><label for="Email-2" class="cf-fieldlabel">Email</label><input type="email" class="cf-textfield w-input" autocomplete="off" maxlength="256" name="Email-2" data-name="Email 2" placeholder="Jouw email adres" id="Email-2" required=""></div>
                        <div class="cf-column right"><label for="Telefoon-2" class="cf-fieldlabel">Telefoonnummer</label><input type="tel" class="cf-textfield w-input" autocomplete="off" maxlength="256" name="Telefoon-2" data-name="Telefoon 2" placeholder="Jouw telefoonnummer" id="Telefoon-2"></div>
                    </div>
                    <div class="cf-colwrap">
                        <div class="cf-column left"><label for="email-3" class="cf-fieldlabel">Stad</label><select id="field-3" name="field-3" data-name="Field 3" required="" class="w-select">
                                <option value="Geen stad geselecteerd">Selecteer een stad</option>
                                <option value="Hoofdkantoor">Hoofdkantoor</option>
                                <option value="Amsterdam">Amsterdam</option>
                                <option value="Eindhoven">Eindhoven</option>
                                <option value="Maastricht">Maastricht</option>
                                <option value="Nijmegen">Nijmegen</option>
                                <option value="Rotterdam">Rotterdam</option>
                                <option value="Tilburg">Tilburg</option>
                                <option value="Utrecht">Utrecht</option>
                            </select></div>
                        <div class="cf-column right"></div>
                    </div><label for="Email-2" class="cf-fieldlabel">Email</label><textarea placeholder="Jouw bericht" maxlength="5000" id="field-2" name="field-2" required="" autocomplete="off" class="textarea w-input"></textarea><input type="submit" value="Versturen" data-wait="Even geduld..." class="cf-submit w-button">
                </div>
            </form>
            <div class="success-message w-form-done">
                <div>Dank voor je bericht! We zullen het zo snel mogelijk in behandeling nemen.</div>
            </div>
            <div class="error-message w-form-fail">
                <div>Oei! Er is iets misgegaan met versturen, probeer het later nog eens.</div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="footer-innerwrap">
        <div class="footer-col">
            <p class="footer-tag">Hoofdkantoor</p>
            <div class="footer-innercol">
                <p class="footer-p">Capucijnenstraat 21-C03</p>
                <p class="footer-p">6211RN, Maastricht</p>
                <a href="mailto:info@studied.nl" class="footer-link">info@studied.nl</a>
                <a href="tel:+31(6)13654615" class="footer-link">+31 (6) 13 65 46 15</a>
            </div>
        </div>
        <div class="footer-col">
            <p class="footer-tag">Informatie</p>
            <div class="footer-innercol">
                <div class="footer-linkwrap">
                    <a href="documents/Studied_AVW_2021.pdf" target="_blank" class="footer-link">Algemene voorwaarden</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="documents/Studied_Privacyverklaring_2021.pdf" target="_blank" class="footer-link">Privacyverklaring</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="documents/Studied_brochure_2021.pdf" target="_blank" class="footer-link">Brochure</a>
                </div>
            </div>
        </div>
        <div class="footer-col">
            <p class="footer-tag">Ga naar</p>
            <div class="footer-innercol">
                <div class="footer-linkwrap">
                    <a href="/actueel" class="footer-link">Actueel</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="begeleiding.html" class="footer-link">Begeleiding</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="werkwijze.html" aria-current="page" class="footer-link w--current">Werkwijze</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="werk.html" class="footer-link">Werk</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="zakelijk.html" class="footer-link">Zakelijk</a>
                </div>
            </div>
        </div>
        <div class="footer-col big">
            <div class="footer-row">
                <p class="footer-tag">Schrijf je in voor de nieuwsbrief</p>
                <div class="footer-innercol">
                    <div class="footer-formblock w-form">
                        <form action="https://submit-form.com/Z4XCkyvu" id="wf-form-Newsletter" name="wf-form-Newsletter" data-name="Newsletter" data-hover="false" class="footer-form"><input type="email" class="footer-textfield w-input" autocomplete="off" maxlength="256" name="Nieuwsbrief-Email" data-name="Nieuwsbrief Email" placeholder="Jouw email adres" data-hover="false" id="Nieuwsbrief-Email" required=""><input type="submit" value="Inschrijven" data-wait="Even geduld..." data-hover="false" class="cf-submit footer w-button">

                            <input type="hidden" name="_feedback.dark" value="false" />
                            <input type="hidden" name="_feedback.language" value="nl" />
                            <input type="hidden" name="_feedback.success.title" value="Bedankt voor je inschrijving!" />
                            <input type="hidden" name="_feedback.success.message" value="Ga terug naar waar je was:" />
                        </form>
                        <div class="w-form-done">
                            <div>Bedankt voor de inschrijving!</div>
                        </div>
                        <div class="w-form-fail">
                            <div>Oops! Er ging iets mis tijdens het versturen.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-row last" style="display: flex">
                <div style="margin-right: 20px;">
                    <p class="footer-tag">Volg ons</p>
                    <div class="footer-innercol socials">
                        <a href="https://www.instagram.com/studied.nl/" target="_blank" class="social-btn w-inline-block">
                            <div class="html-embed w-embed"><svg id="instagram" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewbox="0 0 24 24">
                                    <path id="Path_239" fill="#fff" data-name="Path 239" d="M16.85,0H7.15A7.158,7.158,0,0,0,0,7.15v9.7A7.158,7.158,0,0,0,7.15,24h9.7A7.158,7.158,0,0,0,24,16.85V7.15A7.158,7.158,0,0,0,16.85,0Zm4.735,16.85a4.735,4.735,0,0,1-4.735,4.735H7.15A4.735,4.735,0,0,1,2.414,16.85V7.15A4.735,4.735,0,0,1,7.15,2.414h9.7A4.735,4.735,0,0,1,21.586,7.15v9.7Z"></path>
                                    <path id="Path_240" fill="#fff" data-name="Path 240" d="M139.207,133a6.207,6.207,0,1,0,6.207,6.207A6.214,6.214,0,0,0,139.207,133Zm0,10A3.793,3.793,0,1,1,143,139.207,3.793,3.793,0,0,1,139.207,143Z" transform="translate(-127.207 -127.207)"></path>
                                    <circle id="Ellipse_120" fill="#fff" data-name="Ellipse 120" cx="1.487" cy="1.487" r="1.487" transform="translate(16.732 4.352)"></circle>
                                </svg>
                                <style>
                                    #instagram:hover #Path_239{
                                        fill: #fd0;
                                        transition: all .2s;
                                    }
                                    #instagram:hover #Path_240{
                                        fill: #fd0;
                                        transition: all .2s;
                                    }
                                    #instagram:hover #Ellipse_120{
                                        fill: #fd0;
                                        transition: all .2s;
                                    }
                                </style>
                            </div>
                        </a>
                        <a href="https://www.facebook.com/studied.nl/" target="_blank" class="social-btn w-inline-block">
                            <div class="html-embed w-embed"><svg class="fb-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewbox="0 0 24 24">
                                    <path fill="#fff" id="facebook" d="M20.768,0H3.236A3.234,3.234,0,0,0,0,3.234V20.766A3.234,3.234,0,0,0,3.236,24h8.647l.015-8.576H9.669a.526.526,0,0,1-.526-.524l-.011-2.764a.526.526,0,0,1,.526-.528h2.224V8.937c0-3.1,1.893-4.788,4.659-4.788H18.81a.526.526,0,0,1,.526.526V7.005a.526.526,0,0,1-.525.526H17.418c-1.5,0-1.8.715-1.8,1.763v2.313h3.3a.526.526,0,0,1,.522.588l-.328,2.764a.526.526,0,0,1-.522.464H15.638L15.623,24h5.145A3.234,3.234,0,0,0,24,20.766V3.234A3.234,3.234,0,0,0,20.768,0Z" transform="translate(-0.002)"></path>
                                </svg>
                                <style>
                                    .fb-icon:hover #facebook{
                                        fill: #fd0;
                                        transition: all .2s;
                                    }
                                </style>
                            </div>
                        </a>
                    </div>
                </div>
                <div>
                    <p class="footer-tag">Aangesloten bij</p>
                    <div class="footer-innercol socials">
                        <a href="https://www.instagram.com/studied.nl/" target="_blank" class="social-btn w-inline-block">
                            <div class="html-embed w-embed"><img id="lvsi" src="images/lvsi_logo.svg" style="height: 32px; max-width: unset">
                                <style>
                                    #lvsi:hover {
                                        fill: #fd0;
                                        transition: all .2s;
                                    }
                                </style>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-par">@Studied. Alle rechten voorbehouden</p>
        <p class="footer-par">Kvk-nummer: 71090932</p>
        <p class="footer-par">BTW-nr: 227842315B01</p>
        <p class="footer-par last">Website met <a href="https://reuring.studio" data-hover="false" target="_blank" class="reuring pageleave">Reuring</a>
        </p>
    </div>
</div>
<script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=60ab5c331d3006ab3cefdc9f" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/webflow.js" type="text/javascript"></script>
<!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
<script>
    function internalLink(myLink) {
        return (myLink.host == window.location.host);
    }
    $('a').each(function() {
        if (internalLink(this) && (this).href.indexOf('#') === -1) {
            $(this).click(function(e){
                e.preventDefault();
                var moduleURL = jQuery(this).attr("href");
                setTimeout( function() { window.location = moduleURL }, 950 );
                // Class that has page out interaction tied to click
                $('.page-transition').click();
            });
        }
    });
</script>
<script>
    // .cursor class needs to have a mouse click interaction applied
    $('a.pageleave').mouseenter(function() {
        $('.cursor').click();
    });
    $('a.pageleave').mouseleave(function() {
        $('.cursor').click();
    });
    // Check if browser is on mobile
    (function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
    let isMobile = jQuery.browser.mobile;
    if(isMobile === true){
        $('html').addClass('is-mobile');
    }
    // Custom viewheight for mobile
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
    // Delay link
    function delay (URL) {
        setTimeout( function() { window.location = URL }, 850 );
    }
    // Checkboxes add classes
    $('.cf-select__btn, .cf-select__text').on('click', function(){
        setTimeout(function(){
            $('.cf-select__btn').each(function(index){
                if($(this).hasClass('w--redirected-checked')){
                    console.log(index + 'is active')
                    $(this).addClass('active-box');
                    $(this).siblings('.cf-select__text').addClass('active-text');
                } else {
                    $(this).removeClass('active-box');
                    $(this).siblings('.cf-select__text').removeClass('active-text');
                }
            })
        }, 50);
    })
    // Fullscreen menu
    let screenWidth = $(window).width();
    let screenHeight = $(window).height();
    let screenDiagonal = 1.1 * Math.sqrt(screenWidth*screenWidth + screenHeight*screenHeight);
    let currentSize = $(".circle-radius").attr("r");
    let matrixFactor = screenDiagonal / currentSize;
    $('.menu-background').css('transition', 'transform .95s .1s');
    console.log(currentSize)
    $(".menu-openbtn").on('click', function(){
        // Closing Click
        let clicks = $(this).data('clicks');
        currentSize = '27';
        console.log(currentSize)
        if(clicks){
            $('.menu-background').css('transform', 'matrix(1,0,0,1,0,0)');
            $(".circle-radius").addClass("circle-small");
            if($(".circle-radius").hasClass('circle-small')){
                $(".circle-radius").removeClass("circle-big");
                $('.home-link').removeClass('menu-open-txt');
                $('.body').removeClass('body-scrolloff');
                $('.menu-background').css('transition', 'transform .95s .2s');
            }
        }else{
            $('.menu-background').css('transform', 'matrix('+ matrixFactor +',0,0,'+ matrixFactor +',0,0)');
            $(".circle-radius").addClass("circle-big");
            if($(".circle-radius").hasClass('circle-big')){
                $(".circle-radius").removeClass("circle-small");
                $('.home-link').addClass('menu-open-txt');
                $('.body').addClass('body-scrolloff');
            }
        }
        $(this).data('clicks', !clicks);
    })
    $(window).resize( function(){
        screenWidth = $(window).width();
        screenHeight = $(window).height();
        screenDiagonal = 1.1 * Math.sqrt(screenWidth*screenWidth + screenHeight*screenHeight)
        matrixFactor = screenDiagonal / currentSize;
        if($(".circle-radius").hasClass('circle-big')){
            $('.menu-background').css('transform', 'matrix('+ matrixFactor +',0,0,'+ matrixFactor +',0,0)')
                .css('transition', 'transform .95s');
        }
    })
    //Nice select
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    ///////// SWIPER ///////////
    const swiper = new Swiper('.swiper-container', {
        grabCursor: true,
        slidesPerView: 1,
        loop: false,
        observeParent: true,
        observer: true,
    });
    $('.w-tab-link').on("click",function(){
        setTimeout(function(){
            Swiper('.swiper-container', {
                grabCursor: true,
                slidesPerView: 1,
                loop: false,
                observeParent: true,
                observer: true,
            });
        } ,150)
    });
    ///////// SWIPER END ///////////
</script>
</body>
</html>
