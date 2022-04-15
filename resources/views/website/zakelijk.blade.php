<!DOCTYPE html><!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Aug 30 2021 14:15:51 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="60d59ddb12e1d1a3ef689917" data-wf-site="60ab5c331d3006ab3cefdc9f">
<head>
    <meta charset="utf-8">
    <title>Zakelijk</title>
    <meta content="We werken graag samen met andere organisaties. Zo sponsoren we jaarlijks sportteams, de laatste schooldag, en het gala van onze bijleskids." name="description">
    <meta content="Zakelijk" property="og:title">
    <meta content="We werken graag samen met andere organisaties. Zo sponsoren we jaarlijks sportteams, de laatste schooldag, en het gala van onze bijleskids." property="og:description">
    <meta content="Zakelijk" property="twitter:title">
    <meta content="We werken graag samen met andere organisaties. Zo sponsoren we jaarlijks sportteams, de laatste schooldag, en het gala van onze bijleskids." property="twitter:description">
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
            width: 260px;
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
            width: 216px;
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
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc8109" href="/begeleiding" class="menu-linkblock pageleave">Begeleiding</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc810b" href="/werkwijze" class="menu-linkblock pageleave">Werkwijze</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc810f" href="/werk" class="menu-linkblock pageleave">Werk</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc8111" href="/zakelijk" aria-current="page" class="menu-linkblock pageleave w--current">Zakelijk</a>
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
<div data-w-id="c2de0dec-576d-a397-908e-154e9d8e3d2e" class="subpage-header mobile100vh">
    <div class="scrolllottie-wrap">
        <div data-w-id="b0a07e11-b904-ce10-8718-8d942b054410" data-animation-type="lottie" data-src="documents/53892-scroll-down-mouse.json" data-loop="1" data-direction="1" data-autoplay="0" data-is-ix2-target="1" data-renderer="svg" data-default-duration="2.4638745562178235" data-duration="3.5"></div>
    </div>
    <div class="subpage-inner">
        <p class="inner-subtekst _2em">Zakelijk</p>
        <h1 class="heading _7em">We werken graag samen met andere organisaties.</h1>
    </div>
</div>
<div class="subpage-section top-bottom scholen">
    <div class="zakelijk-titlewrap">
        <h3 class="bk scholen-title">Scholen</h3>
    </div>
    <div class="scholen-colwrap dekstop">
        <div class="scholen-col left desktop">
            <div class="scholen-info">
                <p class="black-par">Scholen kunnen een beroep doen op onze diensten. Zo kunnen we privélessen faciliteren voor leerlingen, groepslessen organiseren voor toetsweken of collegeprogramma’s maken voor de eindexamenkandidaten. Neemt u contact met ons op, dan bespreken we de mogelijkheden.</p>
            </div>
            <div class="scholen-second-info">
                <div class="_w-info">
                    <p class="black-par warning-tag">Let op:</p>
                    <p class="black-par b2em b0">We sluiten geen vaste contracten met scholen, want dit sluit niet aan bij de behoefte van de scholier; dit druist in tegen de idealen van ons instituut. Wel voeren we afzonderlijke opdrachten uit.</p>
                </div>
            </div>
        </div>
        <div class="scholen-col desktop">
            <div class="scholen-imagewrap"><img src="images/Zakelijk_Scholen.jpg" loading="lazy" sizes="(max-width: 991px) 100vw, (max-width: 1439px) 52vw, (max-width: 1919px) 64vw, 59vw" srcset="images/Zakelijk_Scholen-p-500.jpeg 500w, images/Zakelijk_Scholen-p-800.jpeg 800w, images/Zakelijk_Scholen.jpg 1000w" alt="An outside view of a high school" class="scholen-image"></div>
        </div>
    </div>
    <div class="scholen-colwrap phone">
        <div class="scholen-col phone">
            <div class="scholen-info">
                <p class="black-par bigpar">Scholen kunnen een beroep doen op onze diensten. Zo kunnen we privélessen faciliteren voor leerlingen, groepslessen organiseren voor toetsweken of collegeprogramma’s maken voor de eindexamenkandidaten. Neemt u contact met ons op, dan bespreken we de mogelijkheden.</p>
            </div>
            <div class="scholen-imagewrap"><img src="images/Zakelijk_Scholen.jpg" loading="lazy" sizes="(max-width: 479px) 92vw, (max-width: 767px) 95vw, (max-width: 991px) 85vw, 100vw" srcset="images/Zakelijk_Scholen-p-500.jpeg 500w, images/Zakelijk_Scholen-p-800.jpeg 800w, images/Zakelijk_Scholen.jpg 1000w" alt="An outside view of a high school" class="scholen-image"></div>
        </div>
        <div class="scholen-col phone">
            <div class="scholen-second-info">
                <div class="_w-info">
                    <p class="black-par warning-tag">Let op:</p>
                    <p class="black-par b2em b0">We sluiten geen vaste contracten met scholen, want dit sluit niet aan bij de behoefte van de scholier; dit druist in tegen de idealen van ons instituut. Wel voeren we afzonderlijke opdrachten uit.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="subpage-section top-bottom partners">
    <div class="zakelijk-titlewrap partners-title">
        <h3 class="bk scholen-title">Onze partners</h3>
    </div>
    <div class="partners-info mobile">
        <p class="black-par">We zetten ons netwerk in om zo goed mogelijk bij de behoefte van de middelbare scholier aan te sluiten. Daarnaast werken we jaarlijks samen met sportteams en de LSD-commissie. Check hier onze partners óf bericht ons voor een samenwerking.</p>
    </div>
    <div class="partners-colwrap">
        <div class="partners-col left desktop">
            <div class="partners-info">
                <p class="black-par">We zetten ons netwerk in om zo goed mogelijk bij de behoefte van de middelbare scholier aan te sluiten. Daarnaast werken we jaarlijks samen met sportteams en de LSD-commissie. Check hier onze partners óf bericht ons voor een samenwerking.</p>
            </div>
        </div>
        <div class="partners-col desktop">
            <div class="partner-gridwrap">
                <div class="w-layout-grid partners-logogrid">
                    <a href="https://rijschoolmarcelmingels.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/marcelmingels.svg" loading="lazy" alt="Logo van Rijschool Marcel Mingels" class="partners-image"></a>
                    <a href="https://vormklever.studio" target="_blank" class="logo-linkblock w-inline-block"><img src="images/vormklever.png" loading="lazy" alt="Logo van Vormklever" class="partners-image"></a>
                    <a href="https://www.reuring.studio" target="_blank" class="logo-linkblock w-inline-block"><img src="images/reuring.svg" loading="lazy" alt="Logo van Studio Reuring" class="partners-image"></a>
                    <a href="https://pitersbelastingadviseurs.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/pitersbelastingadviseurs.svg" loading="lazy" alt="Logo van Piters Belastingadviseurs" class="partners-image"></a><img src="images/codeforge.svg" loading="lazy" alt="Logo van Code Forge" class="partners-image code-forge">
                    <a href="https://msrvsaurus.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/saurus.svg" loading="lazy" alt="Logo van MSRV Saurus" class="partners-image"></a>
                    <a href="https://www.circumflex.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/circumflex.svg" loading="lazy" alt="Logo van Studentenvereniging Circumflex" class="partners-image"></a>
                    <a href="https://laurentstevens.com" target="_blank" class="logo-linkblock w-inline-block"><img src="images/LaurentStevens.svg" loading="lazy" alt="Logo van Laurent Stevens" class="partners-image"></a>
                    <a href="https://www.milanpotten.com/" target="_blank" class="logo-linkblock w-inline-block"><img src="images/MilanPotten.svg" loading="lazy" alt="Logo van Milan Potten" class="partners-image"></a>
                </div>
            </div>
        </div>
        <div class="locaties-container">
            <div class="swiper-container">
                <div class="swiper-wrapper partner-logos">
                    <div class="swiper-slide">
                        <a href="https://rijschoolmarcelmingels.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/marcelmingels.svg" loading="lazy" alt="Logo van Rijschool Marcel Mingels" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://vormklever.studio" target="_blank" class="logo-linkblock w-inline-block"><img src="images/vormklever.png" loading="lazy" alt="Logo van Vormklever" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.reuring.studio" target="_blank" class="logo-linkblock w-inline-block"><img src="images/reuring.svg" loading="lazy" alt="Logo van Studio Reuring" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://pitersbelastingadviseurs.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/pitersbelastingadviseurs.svg" loading="lazy" alt="Logo van Piters Belastingadviseurs" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide"><img src="images/codeforge.svg" loading="lazy" alt="Logo van Code Forge" class="partners-image code-forge"></div>
                    <div class="swiper-slide">
                        <a href="https://msrvsaurus.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/saurus.svg" loading="lazy" alt="Logo van MSRV Saurus" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.circumflex.nl" target="_blank" class="logo-linkblock w-inline-block"><img src="images/circumflex.svg" loading="lazy" alt="Logo van Studentenvereniging Circumflex" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.laurentstevens.com" target="_blank" class="logo-linkblock w-inline-block"><img src="images/LaurentStevens.svg" loading="lazy" alt="Logo van Laurent Stevens" class="partners-image"></a>
                    </div>
                    <div class="swiper-slide">
                        <a href="https://www.milanpotten.com/" target="_blank" class="logo-linkblock w-inline-block"><img src="images/MilanPotten.svg" loading="lazy" alt="Logo van Milan Potten" class="partners-image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="subpage-section top-bottom bk testimonials">
    <div class="t-wrap">
        <div class="testimonials-headwrap">
            <h3 class="b2">Testimonials</h3>
            <p class="mw-450">We vinden het belangrijk te horen hoe ouders, bijleskids, student-docenten en partners ons ervaren. Deze ervaringen delen we graag met u. Onderstaand vindt u een overzicht van de ontvangen testimonials.</p>
        </div>
        <div data-duration-in="400" data-duration-out="400" class="tabs w-tabs">
            <div class="t-tabs_menu w-tab-menu">
                <a data-w-tab="Ouders" class="l-tabhead bk w-inline-block w-tab-link">
                    <div class="tab-text">Ouders</div>
                </a>
                <a data-w-tab="BIjleskids" class="l-tabhead bk w-inline-block w-tab-link">
                    <div class="tab-text">Bijleskids</div>
                </a>
                <a data-w-tab="Student-docenten" class="l-tabhead bk w-inline-block w-tab-link">
                    <div class="tab-text">Student-docenten</div>
                </a>
                <a data-w-tab="Partners" class="l-tabhead bk w-inline-block w-tab-link w--current">
                    <div class="tab-text">Partners</div>
                </a>
            </div>
            <div class="tabs-content w-tab-content">
                <div data-w-tab="Ouders" class="testimonials-tab w-tab-pane">
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Esther</p>
                                            <p class="t-name">Adam</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg tevreden over de persoonlijke begeleiding. Goede ondersteuning op maat en fijne begeleiders.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mireille</p>
                                            <p class="t-name">Custers-Colson</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Zeer goede begeleiding! Aanrader!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Sandra</p>
                                            <p class="t-name">Ausems-Sikking</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Goede persoonlijke begeleiding en ze luisteren goed naar problemen van de leerling.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Lou</p>
                                            <p class="t-name">Debeij</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Flexibel, to the point en afgestemd op behoefte! Zeer aan te bevelen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Ellen</p>
                                            <p class="t-name">Manos-Groothuis</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Goede begeleiding, duidelijke afspraken, vriendelijk, kortom: zeer aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Femke</p>
                                            <p class="t-name">Janssen - Hoogmolen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Onze dochter heeft veel gehad aan de bijlessen van Studied. Resultaat was een eindexamenlijst prachtige voldoendes!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow dpn w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider mobile w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Esther</p>
                                            <p class="t-name">Adam</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg tevreden over de persoonlijke begeleiding. Goede ondersteuning op maat en fijne begeleiders.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Sandra</p>
                                            <p class="t-name">Ausems-Sikking</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Goede persoonlijke begeleiding en ze luisteren goed naar problemen van de leerling.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Ellen</p>
                                            <p class="t-name">Manos-Groothuis</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Goede begeleiding, duidelijke afspraken, vriendelijk, kortom: zeer aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mireille</p>
                                            <p class="t-name">Custers-Colson</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Zeer goede begeleiding! Aanrader!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Lou</p>
                                            <p class="t-name">Debeij</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Flexibel, to the point en afgestemd op behoefte! Zeer aan te bevelen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Femke</p>
                                            <p class="t-name">Janssen - Hoogmolen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Onze dochter heeft veel gehad aan de bijlessen van Studied. Resultaat was een eindexamenlijst prachtige voldoendes!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="t-slider_cnwrap">
                            <div class="custom-nav_inner">
                                <div class="slide-numbers">
                                    <p class="cn-number">1</p>
                                    <p class="cn-number">1</p>
                                    <p class="cn-number">1</p>
                                    <p class="cn-number">1</p>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <p class="total-slides">5</p>
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                </div>
                <div data-w-tab="BIjleskids" class="testimonials-tab w-tab-pane">
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mick</p>
                                            <p class="t-name">Daenen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ze gaan goed op alles in en leggen duidelijk uit. Raad het zeker iedereen aan!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Felize</p>
                                            <p class="t-name">Lemmens</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik ben super tevreden met de hulp die ik heb gekregen. Ik raad het iedereen zeker aan!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Noah</p>
                                            <p class="t-name">Bartels</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Een fijn bijlesinstituut met goede studenten-docenten!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Laura</p>
                                            <p class="t-name">de Vries</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik heb veel gehad aan Julia&#x27;s wekelijkse bijlessen. Ik ben met meer zelfvertrouwen mijn pre-master ingegaan!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Nadine</p>
                                            <p class="t-name">Hogenboom</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg goede hulp gehad voor mijn M&amp;O toets.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Dahnée</p>
                                            <p class="t-name">Crolla</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele fijne ervaring mee! Mijn punten zijn sinds de begeleiding alleen maar omhooggegaan. Een aanrader dus!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Laurèn</p>
                                            <p class="t-name">Heckers</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele goed begeleiding gehad! Open communicatie en persoonlijke begeleiding die bij mij aansloot! Simpelweg aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Rémi</p>
                                            <p class="t-name">Hoeksel</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De docenten zijn heel aardig en het is ook leuk om samen met hen te leren.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Sophie</p>
                                            <p class="t-name">Janssen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Altijd super fijne bijlessen! Enorm veel gehad aan de bijlessen met Bas en Sofie.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Jaap</p>
                                            <p class="t-name">Ebbelink</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Met Studied is de overgang van TL naar Havo een stuk makkelijker verlopen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Sarah</p>
                                            <p class="t-name">Derwort</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Goede bijles en flexibele tijden. Heeft zeker geholpen!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Eefje</p>
                                            <p class="t-name">Schrijvers</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Mega fijne en handige bijlessen gekregen twee jaar lang van leuke docenten. Zeker aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Lauren</p>
                                            <p class="t-name">de Graaf</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De bijlessen waren altijd super fijn! Er wordt goed rekening gehouden met je planning. Zeker een aanrader!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Friso</p>
                                            <p class="t-name">Debeij</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik heb een hele goede ervaring gehad bij Studied. De lessen waren fijn en met zichtbaar resultaat.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Juliette</p>
                                            <p class="t-name">Jooya</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne en nuttige bijlessen gehad bij Studied. Zeker aan te raden als je bijles nodig hebt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Jesse</p>
                                            <p class="t-name">Assmann</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Je kunt zelf kiezen wanneer en hoe laat je je bijles wilt met leuke gemotiveerde studenten!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Sanne</p>
                                            <p class="t-name">Thiemann</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Studied heeft mij erg goed geholpen bij de voorbereiding op mijn examens. De stof wordt goed uitgelegd!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Naoual</p>
                                            <p class="t-name">Ezzoubai</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De begeleiding was netjes en heel erg persoonlijk. Een super organisatie met enorm sterke communicatie!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Josefien</p>
                                            <p class="t-name">Coolen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Persoonlijke aandacht, het samen oefenen geeft meer inzicht in het onderwerp.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Bas</p>
                                            <p class="t-name">Hanrats</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne persoonlijke begeleiding en hulp bij moeilijke vraagstukken&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Annabel</p>
                                            <p class="t-name">Montulet</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne bijlesleraren die goede bijles geven. Zeker aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mila</p>
                                            <p class="t-name">Van Vollehoven</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Er wordt heel goed en rustig uitgelegd. Ook flexibel met tijdsafspraken.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Nikkie</p>
                                            <p class="t-name">Vanderbroeck</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Super goede bijles gehad! Echt een aanrader!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Marilene</p>
                                            <p class="t-name">van den Akker</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele fijne begeleiding!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider mobile w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Lauren</p>
                                            <p class="t-name">de Graaf</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De bijlessen waren altijd super fijn! Er wordt goed rekening gehouden met je planning. Zeker een aanrader!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Juliette</p>
                                            <p class="t-name">Jooya</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne en nuttige bijlessen gehad bij Studied. Zeker aan te raden als je bijles nodig hebt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Sanne</p>
                                            <p class="t-name">Thiemann</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Studied heeft mij erg goed geholpen bij de voorbereiding op mijn examens. De stof wordt goed uitgelegd!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Friso</p>
                                            <p class="t-name">Debeij</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik heb een hele goede ervaring gehad bij Studied. De lessen waren fijn en met zichtbaar resultaat.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Juliette</p>
                                            <p class="t-name">Jooya</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne en nuttige bijlessen gehad bij Studied. Zeker aan te raden als je bijles nodig hebt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Naoual</p>
                                            <p class="t-name">Ezzoubai</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De begeleiding was netjes en heel erg persoonlijk. Een super organisatie met enorm sterke communicatie!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Josefien</p>
                                            <p class="t-name">Coolen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Persoonlijke aandacht, het samen oefenen geeft meer inzicht in het onderwerp.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Annabel</p>
                                            <p class="t-name">Montulet</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne bijlesleraren die goede bijles geven. Zeker aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Nikkie</p>
                                            <p class="t-name">Vanderbroeck</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Super goede bijles gehad! Echt een aanrader!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Bas</p>
                                            <p class="t-name">Hanrats</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne persoonlijke begeleiding en hulp bij moeilijke vraagstukken&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mila</p>
                                            <p class="t-name">Van Vollehoven</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Er wordt heel goed en rustig uitgelegd. Ook flexibel met tijdsafspraken.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Marilene</p>
                                            <p class="t-name">van den Akker</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele fijne begeleiding!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mick</p>
                                            <p class="t-name">Daenen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ze gaan goed op alles in en leggen duidelijk uit. Raad het zeker iedereen aan!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Noah</p>
                                            <p class="t-name">Bartels</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Een fijn bijlesinstituut met goede studenten-docenten!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Nadine</p>
                                            <p class="t-name">Hogenboom</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg goede hulp gehad voor mijn M&amp;O toets.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Felize</p>
                                            <p class="t-name">Lemmens</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik ben super tevreden met de hulp die ik heb gekregen. Ik raad het iedereen zeker aan!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Laura</p>
                                            <p class="t-name">de Vries</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik heb veel gehad aan Julia&#x27;s wekelijkse bijlessen. Ik ben met meer zelfvertrouwen mijn pre-master ingegaan!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Dahnée</p>
                                            <p class="t-name">Crolla</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele fijne ervaring mee! Mijn punten zijn sinds de begeleiding alleen maar omhooggegaan. Een aanrader dus!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Laurèn</p>
                                            <p class="t-name">Heckers</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele goed begeleiding gehad! Open communicatie en persoonlijke begeleiding die bij mij aansloot! Simpelweg aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Sophie</p>
                                            <p class="t-name">Janssen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Altijd super fijne bijlessen! Enorm veel gehad aan de bijlessen met Bas en Sofie.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Sarah</p>
                                            <p class="t-name">Derwort</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Goede bijles en flexibele tijden. Heeft zeker geholpen!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Rémi</p>
                                            <p class="t-name">Hoeksel</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De docenten zijn heel aardig en het is ook leuk om samen met hen te leren.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Jaap</p>
                                            <p class="t-name">Ebbelink</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Met Studied is de overgang van TL naar Havo een stuk makkelijker verlopen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Eefje</p>
                                            <p class="t-name">Schrijvers</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Mega fijne en handige bijlessen gekregen twee jaar lang van leuke docenten. Zeker aan te raden!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                </div>
                <div data-w-tab="Student-docenten" class="testimonials-tab w-tab-pane">
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Evine</p>
                                            <p class="t-name">Appelman</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Werken bij Studied is heel leuk! Ik kan de scholieren helpen Bas is een fijne werkgever.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Esther</p>
                                            <p class="t-name">Lekner</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De communicatie is heel duidelijk en je wordt altijd gekoppeld aan scholieren waarmee het klikt!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Cyan</p>
                                            <p class="t-name">Kort</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg fijn werken, vooral omdat het mogelijk is zelf je uren te bepalen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Aïsha</p>
                                            <p class="t-name">Clement</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg flexibel. Ik kan werken wanneer ik tijd heb en kiezen hoeveel bijleskids ik begeleid.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Caro</p>
                                            <p class="t-name">Theunisz</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne werkervaring! Bas heeft vanaf het begin vertrouwen in mij getoond en mij begeleid waar nodig.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Jip</p>
                                            <p class="t-name">Bremer</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijn werken, vrij en flexibel.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Helen</p>
                                            <p class="t-name">Wychgel</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De structuur van het bedrijf en de goede communicatie tussen alle betrokkenen maken het fijn werk.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Isabelle</p>
                                            <p class="t-name">Porskamp</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Prima en makkelijk werk met duidelijke communicatie.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Bas</p>
                                            <p class="t-name">Laarakker</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Relaxte, gezellige sfeer en leuk werk met de bijleskids.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Rebecca</p>
                                            <p class="t-name">Baijer</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Leuk werk!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Emma</p>
                                            <p class="t-name">Spaargaren</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik vind het heel leuk werk. Ook merk ik dat ik zelf veel leer van het les geven.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Sofie</p>
                                            <p class="t-name">de Wit</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Leuke werksfeer, flexibele werktijden en goede communicatie!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Julia</p>
                                            <p class="t-name">Steijn</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Het persoonlijke contact met de bijleskids is fijn. Er ontstaat vriendschap bij het vertrouwen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Rawaz</p>
                                            <p class="t-name">Sharaf</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Het bijles geven is erg leerzaam en leuk. Je wordt goed begeleid en krijgt verantwoordelijkheid.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Marjam</p>
                                            <p class="t-name">Iskander</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Je bouwt een persoonlijke band op met de bijleskids en er wordt goed gecommuniceerd.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Silvie</p>
                                            <p class="t-name">Braat</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Prettig en persoonlijk werk! Alles is goed geregeld. Je precies wat er van je verwacht wordt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Meggie</p>
                                            <p class="t-name">Xu</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg fijn en doelgericht werken, met name door de kennismakingsgesprekken!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Véronique</p>
                                            <p class="t-name">Doré</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Het is een fijne samenwerking. Leuk en leerzaam!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider mobile w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Rawaz</p>
                                            <p class="t-name">Sharaf</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Het bijles geven is erg leerzaam en leuk. Je wordt goed begeleid en krijgt verantwoordelijkheid.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Silvie</p>
                                            <p class="t-name">Braat</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Prettig en persoonlijk werk! Alles is goed geregeld. Je precies wat er van je verwacht wordt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Véronique</p>
                                            <p class="t-name">Doré</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Het is een fijne samenwerking. Leuk en leerzaam!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Evine</p>
                                            <p class="t-name">Appelman</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Werken bij Studied is heel leuk! Ik kan de scholieren helpen Bas is een fijne werkgever.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Cyan</p>
                                            <p class="t-name">Kort</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg fijn werken, vooral omdat het mogelijk is zelf je uren te bepalen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Caro</p>
                                            <p class="t-name">Theunisz</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijne werkervaring! Bas heeft vanaf het begin vertrouwen in mij getoond en mij begeleid waar nodig.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Esther</p>
                                            <p class="t-name">Lekner</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De communicatie is heel duidelijk en je wordt altijd gekoppeld aan scholieren waarmee het klikt!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Aïsha</p>
                                            <p class="t-name">Clement</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg flexibel. Ik kan werken wanneer ik tijd heb en kiezen hoeveel bijleskids ik begeleid.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Jip</p>
                                            <p class="t-name">Bremer</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Fijn werken, vrij en flexibel.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Helen</p>
                                            <p class="t-name">Wychgel</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De structuur van het bedrijf en de goede communicatie tussen alle betrokkenen maken het fijn werk.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Bas</p>
                                            <p class="t-name">Laarakker</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Relaxte, gezellige sfeer en leuk werk met de bijleskids.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Emma</p>
                                            <p class="t-name">Spaargaren</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik vind het heel leuk werk. Ook merk ik dat ik zelf veel leer van het les geven.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Isabelle</p>
                                            <p class="t-name">Porskamp</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Prima en makkelijk werk met duidelijke communicatie.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Rebecca</p>
                                            <p class="t-name">Baijer</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Leuk werk!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Sofie</p>
                                            <p class="t-name">de Wit</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Leuke werksfeer, flexibele werktijden en goede communicatie!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Julia</p>
                                            <p class="t-name">Steijn</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Het persoonlijke contact met de bijleskids is fijn. Er ontstaat vriendschap bij het vertrouwen.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Marjam</p>
                                            <p class="t-name">Iskander</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Je bouwt een persoonlijke band op met de bijleskids en er wordt goed gecommuniceerd.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Meggie</p>
                                            <p class="t-name">Xu</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Erg fijn en doelgericht werken, met name door de kennismakingsgesprekken!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                </div>
                <div data-w-tab="Partners" class="testimonials-tab w-tab-pane w--tab-active">
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Marcel</p>
                                            <p class="t-name">Mingels</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Bas is een geweldige, bevlogen en slimme ondernemer die staat voor wat zijn organisatie aanbiedt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mano</p>
                                            <p class="t-name">Gilissen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik ervaar Studied als een betrouwbare partner en dienstverlener met veel aandacht voor detail.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Florian</p>
                                            <p class="t-name">Bonfrère</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De samenwerking verloopt altijd soepel en ik ervaar Studied als en betrouwbare partner.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Laurent</p>
                                            <p class="t-name">Stevens</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ontzettend leuk team om mee samen te werken. Studied is een jong en professioneel bedrijf.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Philippe</p>
                                            <p class="t-name">Piters</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Benieuwd naar de volgende stappen die Studied gaat zetten!&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Milan</p>
                                            <p class="t-name">Potten</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele fijne en duidelijke communicatie waarbij we met beide partijen tot een goed eindresultaat zijn gekomen.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow dpn w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
                    </div>
                    <div data-animation="slide" data-disable-swipe="1" data-duration="500" class="t-slider mobile w-slider">
                        <div class="t-slidermask w-slider-mask">
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Marcel</p>
                                            <p class="t-name">Mingels</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Bas is een geweldige, bevlogen en slimme ondernemer die staat voor wat zijn organisatie aanbiedt.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Florian</p>
                                            <p class="t-name">Bonfrère</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;De samenwerking verloopt altijd soepel en ik ervaar Studied als en betrouwbare partner.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Philippe</p>
                                            <p class="t-name">Piters</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Benieuwd naar de volgende stappen die Studied gaat zetten!&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide w-slide">
                                <div class="t-tabwrap mobile-grid">
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Mano</p>
                                            <p class="t-name">Gilissen</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ik ervaar Studied als een betrouwbare partner en dienstverlener met veel aandacht voor detail.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template">
                                        <div class="t-who">
                                            <p class="t-surname">Laurent</p>
                                            <p class="t-name">Stevens</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Ontzettend leuk team om mee samen te werken. Studied is een jong en professioneel bedrijf.&quot;</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-template last">
                                        <div class="t-who">
                                            <p class="t-surname">Milan</p>
                                            <p class="t-name">Potten</p>
                                        </div>
                                        <div class="t-what">
                                            <p class="t-quote">&quot;Hele fijne en duidelijke communicatie waarbij we met beide partijen tot een goed eindresultaat zijn gekomen.&quot;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="left-arrow w-slider-arrow-left">
                            <div class="w-icon-slider-left"></div>
                        </div>
                        <div class="right-arrow w-slider-arrow-right">
                            <p class="swipe">Bekijk meer</p><img src="images/WhiteArrow.svg" loading="lazy" alt="">
                        </div>
                        <div class="slide-nav w-slider-nav w-round"></div>
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
            <p class="cf-par bk">Nog vragen over een samenwerking? Stuur ons een bericht en dan nemen we direct contact op!</p>
        </div>
        <div class="form-wrapper w-form">
            <form action="https://submit-form.com/xSgds62z" id="email-form" data-name="Email Form" autocomplete="off" class="cf-body"> <!-- name="email-form" -->

                <div class="g-recaptcha" data-sitekey="6Lf_HAMdAAAAAAd_W2EK30A8Yz71TmZxacFIjkbH"></div>
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
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Scholen" name="Scholen" data-name="Scholen" style="opacity:0;position:absolute;z-index:-1"><span for="Scholen" class="cf-select__text w-form-label">Scholen</span>
                        </label><label class="w-checkbox cf-select">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Partners" name="Partners" data-name="Partners" style="opacity:0;position:absolute;z-index:-1"><span for="Partners" class="cf-select__text w-form-label">Partners</span>
                        </label></div>
                    <div class="cf-innerwrap"><label class="w-checkbox cf-select">
                            <div class="w-checkbox-input w-checkbox-input--inputType-custom cf-select__btn"></div><input type="checkbox" id="Samenwerken" name="Samenwerken" data-name="Samenwerken" style="opacity:0;position:absolute;z-index:-1"><span for="Samenwerken" class="cf-select__text w-form-label">Samenwerken</span>
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
                    <a href="/begeleiding" class="footer-link">Begeleiding</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="/werkwijze" class="footer-link">Werkwijze</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="/werk" class="footer-link">Werk</a>
                </div>
                <div class="footer-linkwrap">
                    <a href="/zakelijk" aria-current="page" class="footer-link w--current">Zakelijk</a>
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
                        <a href="https://lvsi.nl/instituut/studied/" target="_blank" class="social-btn w-inline-block">
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
