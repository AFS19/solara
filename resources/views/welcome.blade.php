@extends('layouts.site')

@section('content')
    @include('site.partials.hero')
    @include('site.partials.showcase')
    @include('site.partials.ingredients')
    @include('site.partials.how-to-use')
    @include('site.partials.testimonials')
    @include('site.partials.faq')
    @include('site.partials.cta')
@endsection
