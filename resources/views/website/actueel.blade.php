<!DOCTYPE html><!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Aug 30 2021 14:15:51 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="60c0f2715984ae4475822b3c" data-wf-site="60ab5c331d3006ab3cefdc9f">
<head>
    <meta charset="utf-8">
    <title>Actueel</title>
    <meta content="We zijn een groeiend en actief bedrijf, lees hier alles over het laatste nieuws van Studied!" name="description">
    <meta content="Actueel" property="og:title">
    <meta content="We zijn een groeiend en actief bedrijf, lees hier alles over het laatste nieuws van Studied!" property="og:description">
    <meta content="Actueel" property="twitter:title">
    <meta content="We zijn een groeiend en actief bedrijf, lees hier alles over het laatste nieuws van Studied!" property="twitter:description">
    <meta property="og:type" content="website">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Webflow" name="generator">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/webflow.css') }}s" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/studied.webflow.css') }}" rel="stylesheet" type="text/css">
    <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
    <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
    <link href="/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="/images/webclip.png" rel="apple-touch-icon">
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
    <style>
        .home-link {
            color: #242424;
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
                <a data-w-id="76d3e6d0-431d-bfa2-64fb-a13cdaf5dda3" href="http://188.166.40.70/actueel" aria-current="page" class="menu-linkblock pageleave w--current">Actueel</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc8109" href="begeleiding.html" class="menu-linkblock pageleave">Begeleiding</a>
                <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc810b" href="werkwijze.html" class="menu-linkblock pageleave">Werkwijze</a>
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
                    <p class="login-caption">Naar het portaal</p>
                    <a href="/inloggen" class="main-btn menu-btn pageleave">Inloggen</a>
                </div>
            </div>
            <div class="site-name__wrap">
                <a data-w-id="0321ca4e-998a-3e99-b443-597d2349ae85" href="home.html" class="home-link pageleave">Studied<span class="geel">.</span></a>
            </div>
        </div>
    </div>
    <div class="site-name__wrap">
        <a data-w-id="4c17008c-8cec-bf04-ab47-0e03fffc811b" href="home.html" class="home-link pageleave">Studied<span class="geel">.</span></a>
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
<div data-w-id="7f23121b-c69e-7631-6dac-58912d995d4b" class="subpage-header white mobile100vh">
    <div class="scrolllottie-wrap">
        <div data-w-id="b0a07e11-b904-ce10-8718-8d942b054410" data-animation-type="lottie" data-src="documents/53892-scroll-down-mouse.json" data-loop="1" data-direction="1" data-autoplay="0" data-is-ix2-target="1" data-renderer="svg" data-default-duration="2.4638745562178235" data-duration="3.5"></div>
    </div>
    <div class="subpage-inner">
        <h1 class="heading _7em black">Blijf op de hoogte van onze laatste ontwikkelingen</h1>
    </div>
</div>

@php $articles = \App\Models\Article::orderBy(\App\Http\Support\Model::$BASE_CREATED_AT, 'DESC')->get(); @endphp

<div class="articles-section">
    <div class="articles-50-50">
        <div class="article-container">
            <a href="article.html" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[0]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" sizes="(max-width: 991px) 100vw, 50vw" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname">{{ $articles[0]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <div class="intro-textwrap">
                        <h6 class="article-heading">{{ $articles[0]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                        <p class="black-par">{{ $articles[0]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    </div>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[0]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[0]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="article-container">
            <a href="#" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[1]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname">{{ $articles[1]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <div class="intro-textwrap">
                        <h6 class="article-heading">{{ $articles[1]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                        <p class="black-par">{{ $articles[1]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    </div>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[1]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[1]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="article-100">
        <div class="article-container art100">
            <a data-w-id="7955b2f5-642d-e0b5-3a8a-a44a0bf3064b" href="#" class="article-100left pageleave w-inline-block"><img src="images/{{ $articles[2]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" sizes="(max-width: 991px) 100vw, 50vw" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname">{{ $articles[2]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="article-100right">
                <div class="art100-info big">
                    <div class="intro-textwrap">
                        <h6 class="article-heading big">{{ $articles[2]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                        <p class="art-intro">{{ $articles[2]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                        <p class="black-par">{{ $articles[2]->{\App\Http\Support\Model::$ARTICLE_PARAGRAPH_1} }}</p>
                    </div>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[2]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[2]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="articles-25-25-50">
        <div class="article-container small">
            <a href="#" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[3]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" sizes="(max-width: 991px) 100vw, 25vw" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname small">{{ $articles[3]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <div class="intro-textwrap">
                        <h6 class="article-heading">{{ $articles[3]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                        <p class="black-par">{{ $articles[3]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    </div>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[3]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[3]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="article-container small">
            <a href="#" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[4]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname small">{{ $articles[4]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <div class="intro-textwrap">
                        <h6 class="article-heading">{{ $articles[4]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                        <p class="black-par">{{ $articles[4]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    </div>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[4]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[4]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="article-container">
            <a href="#" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[5]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" sizes="(max-width: 991px) 100vw, 50vw" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname">{{ $articles[5]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <div class="intro-textwrap">
                        <h6 class="article-heading">{{ $articles[5]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                        <p class="black-par">{{ $articles[5]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    </div>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[5]->{\App\Http\Support\Model::$BASE_ID}]) }}"  class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[5]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="articles-50-50">
        <div class="article-container">
            <a href="#" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[6]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname">{{ $articles[6]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <h6 class="article-heading">{{ $articles[6]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                    <p class="black-par">{{ $articles[6]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[6]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[6]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="article-container">
            <a href="#" class="article-top pageleave w-inline-block"><img src="images/{{ $articles[7]->{\App\Http\Support\Model::$ARTICLE_BACKGROUND} }}" loading="lazy" class="article-image">
                <div class="image-overlay">
                    <h5 class="article-bigname">{{ $articles[7]->{\App\Http\Support\Model::$ARTICLE_TITLE} }}</h5>
                </div>
            </a>
            <div class="atricle-bottom">
                <div class="article-info" style="width: 100%">
                    <h6 class="article-heading">{{ $articles[7]->{\App\Http\Support\Model::$ARTICLE_SUBTITLE} }}</h6>
                    <p class="black-par">{{ $articles[7]->{\App\Http\Support\Model::$ARTICLE_INTRO} }}</p>
                    <div class="info-bottom">
                        <a href="{{ route('website.article', ['id' => $articles[7]->{\App\Http\Support\Model::$BASE_ID}]) }}" class="main-btn pageleave w-button">Lees meer</a>
                        <p class="article-date bk">{{ \App\Http\Support\Format::datetime($articles[7]->{\App\Http\Support\Model::$BASE_CREATED_AT}, \App\Http\Support\Format::$DATETIME_ARTICLE) }}</p>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>
