@extends('layouts.public')

@section('meta')
<title>Trang chủ — {{ setting('company_name') }}</title>
<meta name="description" content="{{ setting('meta_description_default') }}">
@endsection

@section('content')
<x-public.hero />
<x-public.about-teaser />
<x-public.core-competencies :services="$services" />
<x-public.recent-projects :projects="$projects" />
<x-public.industry-insights :posts="$posts" />
<x-public.cta-banner />
<x-public.contact-mini />
@endsection
