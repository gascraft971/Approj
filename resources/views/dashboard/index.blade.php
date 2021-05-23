@section("title", "Dashboard")
@extends("layouts.dashboard")

@section("content")
<link href="{{ asset("css/dashboard/index.css") }}" rel="stylesheet"/>
<link href="{{ asset("css/dashboard/categories.css") }}" rel="stylesheet"/>
@include("partials.errors")

<?php
$sections = [
    ["Main page", "window", "main"], 
    ["Pages", "file-earmark-richtext", "pages"], 
    ["Products", "cart4", "products"], 
    ["Look & Feel", "easel", "themes"], 
    ["Earn Money", "cash-stack", "money"], 
    ["Navigation", "signpost-2", "navigation"]
];
?>

<main>

    <aside id="sidebar" class="bg-light shadow-sm">
        <!-- Site overview bit -->
        <div class="site-overview d-block">
            <div class="btn btn-block btn-light sidebar-logo" data-ripple-duration="0s">
                <img src="https://gn-labs.000webhostapp.com/approj/uploads/images/logo-example.jpg"/>
                <div class="site-info">
                    <span class="site-title">Blog Name</span>
                    <hr/>
                    <span class="site-plan">FREE</span>
                </div>
            </div>
        </div>
        
        <!-- Options -->
        <ul class="settings-sections d-block">
            @foreach ($sections as $section)
            <li>
                <a href="#{{ $section[2] }}" data-sidebar-item="{{ $section[2] }}">
                    <button class="btn btn-block btn-light shadow-0" data-ripple-duration="0s">
                        <i class="bi-{{ $section[1] }}" style="font-size: 2.7em; font-weight: 100;"></i>
                        <span>{{ $section[0] }}</span>
                    </button>
                </a>
            </li>
            @endforeach
        </ul>
        
        <!-- Quick commands -->
        <div class="quick-commands btn-group" role="group">
            @foreach([["tools", "site-settings"], ["graph-up", "site-stats"], ["eye", "site-view-options"]] as $classes)
            <a href="#{{ $classes[1] }}" class="btn btn-light btn-sm" data-ripple-duration="0s" data-sidebar-item="{{ $classes[1] }}">
                <i class="bi-{{ $classes[0] }}" style="font-size: 2em;"></i>
            </a>
            @endforeach
        </div>
    </aside>

    <nav class="navbar navbar-dark bg-dark" id="collapsed-menu">
        <div class="container-fluid p-1">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" aria-controls="#sidebar" aria-expanded="false" aria-label="Toggle navigation sidebar">
                <i class="bi-list" style="font-size: 2rem;"></i>
            </button>
            
            <!-- Navbar brand -->
            <a class="navbar-brand mr-auto" href="#">Pages</a>
        </div>
    </nav>
    <!-- Navbar -->

    <div id="setting-page">
        <div id="loading-spinner">
            <svg class="text-primary" aria-label="Chargement..." width="68.75" height="100" viewBox="0 0 55 80" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                <g transform="matrix(1 0 0 -1 0 80)">
                    <rect width="10" height="20" rx="3">
                        <animate attributeName="height" begin="0s" dur="4.3s" values="20;45;57;80;64;32;66;45;64;23;66;13;64;56;34;34;2;23;76;79;20" calcMode="linear" repeatCount="indefinite"></animate>
                    </rect>
                    <rect x="15" width="10" height="80" rx="3">
                        <animate attributeName="height" begin="0s" dur="2s" values="80;55;33;5;75;23;73;33;12;14;60;80" calcMode="linear" repeatCount="indefinite"></animate>
                    </rect>
                    <rect x="30" width="10" height="50" rx="3">
                        <animate attributeName="height" begin="0s" dur="1.4s" values="50;34;78;23;56;23;34;76;80;54;21;50" calcMode="linear" repeatCount="indefinite"></animate>
                    </rect>
                    <rect x="45" width="10" height="30" rx="3">
                        <animate attributeName="height" begin="0s" dur="2s" values="30;45;13;80;56;72;45;76;34;23;67;30" calcMode="linear" repeatCount="indefinite"></animate>
                    </rect>
                </g>
            </svg>
        </div>
        <div id="selected-setting" class="d-none"></div>
    </div>

</main>

<script src="{{ asset("js/dashboard/index.js") }}"></script>
<script src="{{ asset("js/dashboard/categories.js") }}"></script>
@endsection