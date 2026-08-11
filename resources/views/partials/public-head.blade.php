{{--
    Shared <head> for the new public showcase pages.
    Expects: $title, $description, optionally $ogImage (defaults below).
--}}
<meta charset="utf-8">
<title>{{ $title }}</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ url()->current() }}">

<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset($ogImage ?? 'img/social-preview.svg') }}">
<meta property="og:site_name" content="Block Scholar">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ asset($ogImage ?? 'img/social-preview.svg') }}">

<link href="/img/favicon.ico" rel="icon">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet">
