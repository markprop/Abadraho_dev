@extends('layouts.master')

@section('title', 'Off-Plan Properties - Karachi Real Estate')
@section('meta_keywords', 'off-plan properties, Karachi real estate, new developments, pre-construction')
@section('meta_description', 'Discover the latest off-plan properties in Karachi. Browse new developments, pre-construction projects, and investment opportunities.')

@section('body_class', 'off-plan-page')

@section('additional_css')
<style>
    /* Off-Plan Content Container - styles moved to master layout */
    
    /* Ensure proper layout structure */
    .off-plan-page {
        overflow-x: hidden;
    }
    
    .off-plan-page body {
        overflow-x: hidden;
        overflow-y: auto;
    }
    
    .off-plan-page .wrapper {
        overflow-x: hidden;
        overflow-y: auto;
        position: relative;
    }
    
    /* Search and Filter Bar - Abad Raho Style */
    .search-filter-bar {
        background: #fff;
        border-bottom: 1px solid #e0e0e0;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .search-input-container {
        flex: 1;
        position: relative;
    }
    
    .search-input {
        width: 100%;
        padding: 15px 20px 15px 50px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 14px;
        background: #f8f9fa;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #ec1c24;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(236, 28, 36, 0.1);
    }
    
    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #ec1c24;
        font-size: 16px;
    }
    
    .filter-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        background: #fff;
        color: #484848;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }
    
    .filter-btn:hover {
        border-color: #ec1c24;
        background: #f8f9fa;
        color: #ec1c24;
        transform: translateY(-2px);
    }
    
    .filter-btn.active {
        background: #ec1c24;
        border-color: #ec1c24;
        color: #fff;
        box-shadow: 0 4px 8px rgba(236, 28, 36, 0.3);
    }
    
    .filter-btn i {
        font-size: 12px;
    }
    
    /* Content Layout */
    .content-layout {
        flex: 1;
        display: flex;
        overflow: hidden;
        height: calc(100vh - 160px);
        min-height: 600px;
    }
    
    /* Project Listings - Grid Layout with Scrolling */
    .project-listings {
        width: 65%;
        background: #fff;
        border-right: 1px solid #e0e0e0;
        padding: 20px;
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }
    
    .project-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-content: start;
    }
    
    /* Custom Scrollbar for Project Listings */
    .project-listings::-webkit-scrollbar {
        width: 8px;
    }
    
    .project-listings::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .project-listings::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
        border-radius: 4px;
    }
    
    .project-listings::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #d9000d 0%, #b8000a 100%);
    }
    
    .project-card {
        padding: 0;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }
    
    .project-card.highlighted {
        background: #fff5f5;
        border: 2px solid #ec1c24;
        box-shadow: 0 8px 25px rgba(236, 28, 36, 0.3);
    }
    
    .project-image-container {
        position: relative;
        width: 100%;
        height: 180px;
        overflow: hidden;
    }
    
    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .project-card:hover .project-image {
        transform: scale(1.05);
    }
    
    .project-badges {
        position: absolute;
        top: 12px;
        left: 12px;
        right: 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-presale {
        background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
        box-shadow: 0 2px 8px rgba(236, 28, 36, 0.3);
    }
    
    .badge-completion {
        background: linear-gradient(135deg, #2ac4ea 0%, #1a9cb8 100%);
        box-shadow: 0 2px 8px rgba(42, 196, 234, 0.3);
    }
    
    .developer-logo {
        position: absolute;
        bottom: 12px;
        left: 12px;
        width: 45px;
        height: 45px;
        background: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        color: #ec1c24;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 2px solid #ec1c24;
    }
    
    .project-card-content {
        padding: 16px;
    }
    
    .project-title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin: 0 0 6px 0;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .project-location {
        font-size: 13px;
        color: #666;
        margin: 0 0 8px 0;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .project-price {
        font-size: 18px;
        font-weight: 700;
        color: #ec1c24;
        margin: 0 0 8px 0;
    }
    
    .project-rooms {
        font-size: 12px;
        color: #666;
        margin: 0 0 6px 0;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    
    .project-rooms i {
        color: #ec1c24;
        font-size: 11px;
    }
    
    .project-id {
        font-size: 11px;
        color: #999;
        margin: 0 0 6px 0;
    }
    
    .project-marketed {
        font-size: 11px;
        color: #666;
        margin: 0 0 6px 0;
    }
    
    .bonus-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 8px 16px;
        background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
        color: #fff;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
        margin-top: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 8px rgba(236, 28, 36, 0.3);
    }
    
    .bonus-badge i {
        font-size: 10px;
    }
    
    /* Map Container - Right Side Layout */
    .map-container {
        width: 35%;
        position: relative;
        background: #f0f0f0;
        height: 100%;
        overflow: hidden;
    }
    
    #map {
        width: 100%;
        height: 100%;
    }
    
    .map-controls {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .map-control-btn {
        background: #fff;
        border: 2px solid #e0e0e0;
        padding: 10px 16px;
        border-radius: 25px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        color: #484848;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: 'Poppins', sans-serif;
    }
    
    .map-control-btn:hover {
        background: #ec1c24;
        border-color: #ec1c24;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(236, 28, 36, 0.3);
    }
    
    .map-control-btn.active {
        background: #ec1c24;
        border-color: #ec1c24;
        color: #fff;
    }
    
    .support-button {
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
        color: #fff;
        border: none;
        padding: 15px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        box-shadow: 0 6px 15px rgba(236, 28, 36, 0.3);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Poppins', sans-serif;
    }
    
    .support-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(236, 28, 36, 0.4);
    }
    
    /* Custom Mapbox Popup Styling */
    .mapboxgl-popup-content {
        padding: 0 !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }
    
    .mapboxgl-popup-tip {
        border-top-color: #fff !important;
    }
    
    .mapboxgl-popup-close-button {
        background: rgba(0, 0, 0, 0.1) !important;
        color: #6b7280 !important;
        border-radius: 50% !important;
        width: 24px !important;
        height: 24px !important;
        font-size: 14px !important;
        line-height: 1 !important;
        right: 8px !important;
        top: 8px !important;
    }
    
    .mapboxgl-popup-close-button:hover {
        background: rgba(0, 0, 0, 0.2) !important;
        color: #374151 !important;
    }
    
    /* Smooth scrolling for project listings */
    .project-listings {
        scroll-behavior: smooth;
    }
    
    .project-listings::-webkit-scrollbar {
        width: 6px;
    }
    
    .project-listings::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    
    .project-listings::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    
    .project-listings::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Loading state for project cards */
    .project-card.loading {
        opacity: 0.6;
        pointer-events: none;
    }
    
    /* Professional focus states */
    .search-input:focus,
    .filter-btn:focus,
    .map-control-btn:focus,
    .support-button:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
    
    /* Enhanced hover states */
    .nav-item:hover,
    .header-action:hover,
    .filter-btn:hover {
        transform: translateY(-1px);
    }
    
    .project-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Professional animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .project-card {
        animation: fadeInUp 0.3s ease-out;
    }
    
    /* Responsive Design */
    @media (max-width: 1024px) {
        .project-listings {
            width: 60%;
        }
        
        .map-container {
            width: 40%;
        }
        
        .filter-buttons {
            flex-wrap: wrap;
        }
        
        .filter-btn {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
    
    @media (max-width: 768px) {
        .content-layout {
            flex-direction: column;
            height: auto;
            min-height: auto;
        }
        
        .project-listings {
            width: 100%;
            height: 400px;
            padding: 15px;
        }
        
        .project-grid {
            grid-template-columns: 1fr;
        }
        
        .map-container {
            width: 100%;
            height: 400px;
        }
        
        .search-filter-bar {
            flex-direction: column;
            gap: 12px;
            padding: 15px;
        }
        
        .filter-buttons {
            justify-content: center;
        }
        
        .project-card {
            margin-bottom: 15px;
        }
    }
    
    @media (max-width: 480px) {
        .top-header {
            padding: 12px 16px;
        }
        
        .search-filter-bar {
            padding: 16px;
        }
        
        .project-card {
            padding: 16px;
        }
        
        .project-image-container {
            height: 160px;
        }
        
        .project-title {
            font-size: 16px;
        }
        
        .project-price {
            font-size: 18px;
        }
    }
    
    /* Additional Abad Raho specific styles */
    .project-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #ec1c24 0%, #2ac4ea 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .project-card:hover::before {
        opacity: 1;
    }
    
    .project-card.highlighted::before {
        opacity: 1;
    }
    
    /* Loading animation for project cards */
    .project-card.loading {
        position: relative;
        overflow: hidden;
    }
    
    .project-card.loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(236, 28, 36, 0.1), transparent);
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    /* Enhanced scrollbar for project listings */
    .project-listings::-webkit-scrollbar {
        width: 8px;
    }
    
    .project-listings::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .project-listings::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
        border-radius: 4px;
    }
    
    .project-listings::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #d9000d 0%, #b8000a 100%);
    }
</style>

@section('content')
<!-- Off-Plan Content - Between Header and Footer -->
<div class="off-plan-content">
    <!-- Search and Filter Bar -->
    <div class="search-filter-bar">
        <div class="search-input-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search & filters" id="project-search">
        </div>
        <div class="filter-buttons">
            <button class="filter-btn active" data-filter="bonus">
                <i class="fa fa-gift"></i>
                With bonus
                </button>
            <button class="filter-btn" data-filter="sale-status">
                Sale Status
                <i class="fa fa-chevron-down"></i>
                </button>
            <button class="filter-btn" data-filter="price">
                Price
                <i class="fa fa-chevron-down"></i>
            </button>
            <button class="filter-btn" data-filter="area">
                Area
                <i class="fa fa-chevron-down"></i>
            </button>
            <button class="filter-btn" data-filter="unit-type">
                Unit type
                <i class="fa fa-chevron-down"></i>
            </button>
            <button class="filter-btn" data-filter="dev-status">
                Dev Status
                <i class="fa fa-chevron-down"></i>
            </button>
            <button class="filter-btn" data-filter="bedrooms">
                Bedrooms
                <i class="fa fa-chevron-down"></i>
            </button>
        </div>
        </div>
        
    <!-- Projects Count Display -->
    <!-- <div style="background: #fff; padding: 10px 20px; border-bottom: 1px solid #e0e0e0; color: #666; font-size: 14px;">
        <strong>{{ $projects->total() }}</strong> off-plan projects found
        </div> -->
        
    <!-- Content Layout -->
    <div class="content-layout">
        <!-- Project Listings -->
        <div class="project-listings" id="project-listings">
            <div class="project-grid">
            @if($projects->count() > 0)
                @foreach($projects as $project)
                    <div class="project-card" 
                         data-project-id="{{ $project->id }}"
                         data-lat="{{ $project->latitude }}"
                         data-lng="{{ $project->longitude }}"
                         data-price="{{ $project->units->min('total_unit_amount') ?? $project->discount_price ?? 0 }}"
                         data-property-id="{{ $project->property_id ?? '' }}"
                         data-rooms="{{ $project->rooms ?? '' }}"
                         data-progress="{{ $project->progress ?? '' }}">
                        
                        <div class="project-image-container">
                        <img src="{{ asset($project->project_cover_img ?? 'images/default-project.jpg') }}" 
                             alt="{{ $project->name }}" class="project-image">
                        
                            <div class="project-badges">
                                @if($project->progress)
                                    <span class="badge badge-presale">{{ $project->progress }}</span>
                                @else
                                    <span class="badge badge-presale">Presale (EOI)</span>
                                @endif
                                
                                @if($project->added_time)
                                    <span class="badge badge-completion">{{ \Carbon\Carbon::parse($project->added_time)->format('M Y') }}</span>
                                @else
                                    <span class="badge badge-completion">Q4 2027</span>
                                @endif
                            </div>
                            
                            <div class="developer-logo">
                                @if($project->owners && $project->owners->first() && $project->owners->first()->builder)
                                    {{ substr($project->owners->first()->builder->full_name, 0, 3) }}
                                @else
                                    DEV
                                @endif
                            </div>
                            </div>
                            
                            <div class="project-card-content">
                                <h3 class="project-title">{{ $project->name ?? 'Project Name' }}</h3>
                                
                                <p class="project-location">
                                    @if($project->address)
                                        {{ Str::limit($project->address, 30) }}
                                    @elseif($project->location && $project->location->name)
                                        {{ $project->location->name }}
                                    @else
                                        Karachi
                                    @endif
                                    
                                    @if($project->owners && $project->owners->first() && $project->owners->first()->builder)
                                        • by {{ Str::limit($project->owners->first()->builder->full_name, 20) }}
                                    @else
                                        • by Developer
                                    @endif
                                </p>
                                
                                @if($project->rooms)
                                <p class="project-rooms">
                                    <i class="fa fa-bed"></i> {{ $project->rooms }} Rooms
                                </p>
                                @endif
                                
                                <div class="project-price">
                                    @php
                                        $minPrice = 0;
                                        if($project->units && $project->units->count() > 0) {
                                            $minPrice = $project->units->min('total_unit_amount');
                                        } elseif($project->discount_price) {
                                            $minPrice = $project->discount_price;
                                        }
                                        
                                        // Convert to PKR if price exists
                                        if($minPrice > 0) {
                                            $priceInPKR = \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $minPrice);
                                        } else {
                                            $priceInPKR = '0';
                                        }
                                    @endphp
                                    @if($minPrice > 0)
                                        Starting from Rs. {{ $priceInPKR }}
                                    @else
                                        Price on Request
                                    @endif
                                </div>
                                
                                @if($project->property_id)
                                <p class="project-id">
                                    <small>ID: {{ $project->property_id }}</small>
                                </p>
                                @endif
                                
                                @if($project->ProjectVoucher && $project->ProjectVoucher->is_active)
                                <div class="bonus-badge">
                                    <i class="fa fa-gift"></i>
                                    Bonus Available
                                </div>
                                @endif
                                
                                @if($project->marketed_by)
                                <p class="project-marketed">
                                    <small>Marketed by: {{ $project->marketed_by }}</small>
                                </p>
                                @endif
                            </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 60px 20px; color: #666; grid-column: 1 / -1;">
                    <i class="fa fa-home" style="font-size: 64px; margin-bottom: 20px; color: #ec1c24;"></i>
                    <h3 style="color: #333; margin-bottom: 10px;">No projects found</h3>
                    <p>Try adjusting your filters to see more results.</p>
                </div>
            @endif
            </div>
            
            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="pagination-wrapper" style="margin: 20px 0; text-align: center; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    
    <!-- Map Container -->
    <div class="map-container">
            <div id="map"></div>
        
        <!-- Map Controls -->
        <div class="map-controls">
            <button class="map-control-btn" id="reset-view">
                    <i class="fa fa-home"></i>
                    Reset View
            </button>
            <button class="map-control-btn" id="toggle-satellite">
                    <i class="fa fa-satellite"></i>
                    Satellite
                </button>
            </div>
            
            <!-- Support Button -->
            <button class="support-button">
                <i class="fa fa-comments"></i>
                Support
            </button>
        </div>
    </div>
</div>
@endsection

@section('additional_js')
<!-- Mapbox CSS and JS -->
<link href='https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Mapbox
    mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN') }}';
    
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [67.0011, 24.8607], // Karachi coordinates
        zoom: 11,
        pitch: 0,
        bearing: 0
    });
    
    // Add navigation controls
    map.addControl(new mapboxgl.NavigationControl());
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: { enableHighAccuracy: true },
        trackUserLocation: true
    }));
    
    // Store projects data
    const projectsData = @json($projectsForMap);
    const markers = [];
    let highlightedMarker = null;
    let hoveredCard = null;
    
    // Create professional markers for each project
    function createMarkers() {
        // Clear existing markers
        markers.forEach(marker => marker.remove());
        markers.length = 0;
        
        projectsData.forEach((project, index) => {
            if (project.latitude && project.longitude) {
                // Create custom marker element with Abad Raho styling
                const markerElement = document.createElement('div');
                markerElement.className = 'custom-marker';
                markerElement.style.cssText = `
                    width: 36px;
                    height: 36px;
                    background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
                    border: 3px solid white;
                    border-radius: 50%;
                    cursor: pointer;
                    box-shadow: 0 4px 15px rgba(236, 28, 36, 0.4);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: bold;
                    font-size: 14px;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    position: relative;
                    z-index: 1;
                    transform-origin: center center;
                `;
                markerElement.innerHTML = '🏢';
                
                // Add hover effect with Abad Raho colors
                markerElement.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.3)';
                    this.style.boxShadow = '0 8px 20px rgba(236, 28, 36, 0.5)';
                    this.style.zIndex = '1000';
                });
                
                markerElement.addEventListener('mouseleave', function() {
                    if (this !== highlightedMarker?.getElement()) {
                        this.style.transform = 'scale(1)';
                        this.style.boxShadow = '0 4px 15px rgba(236, 28, 36, 0.4)';
                        this.style.zIndex = '1';
                    }
                });
                
                // Create professional popup content using Abad Raho card pattern
                const popupContent = `
                    <div class="popup-card" style="background: #fff; border-radius: 12px; overflow: hidden; width: 300px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); border: 2px solid #ec1c24;">
                        <img src="${project.cover_image || '/images/default-project.jpg'}" 
                             class="popup-cover" 
                             style="width: 100%; height: 150px; object-fit: cover; border-radius: 0;" 
                             alt="${project.name}">
                        <div class="popup-body" style="padding: 16px;">
                            <div class="popup-badge" style="background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">${project.progress || 'Presale (EOI)'}</div>
                            <h3 class="popup-title" style="margin: 0 0 8px; font-size: 18px; color: #333; font-weight: 700; line-height: 1.3;">${project.name}</h3>
                            <p class="popup-address" style="margin: 0 0 8px; font-size: 14px; color: #666;">${project.address || 'Karachi, Pakistan'}</p>
                            ${project.rooms ? `<p class="popup-rooms" style="margin: 0 0 8px; font-size: 12px; color: #666;"><i class="fa fa-bed" style="color: #ec1c24; margin-right: 4px;"></i>${project.rooms} Rooms</p>` : ''}
                            <p class="popup-price" style="margin: 0; font-size: 20px; color: #ec1c24; font-weight: 700;">Starting from Rs. ${project.price ? project.price.toLocaleString() : '0'}</p>
                            ${project.property_id ? `<p class="popup-id" style="margin: 4px 0 0; font-size: 11px; color: #999;">ID: ${project.property_id}</p>` : ''}
                        </div>
                    </div>
                `;
                
                // Create popup with professional styling
                const popup = new mapboxgl.Popup({
                    closeButton: true,
                    closeOnClick: false,
                    offset: 25,
                    maxWidth: '300px'
                }).setHTML(popupContent);
                
                // Create marker
                const marker = new mapboxgl.Marker(markerElement)
                    .setLngLat([project.longitude, project.latitude])
                    .setPopup(popup)
                    .addTo(map);
                
                // Store marker with project data
                marker.projectData = project;
                markers.push(marker);
                
                // Add click event to marker
                markerElement.addEventListener('click', function() {
                    // Find and highlight corresponding project card
                    const projectCard = document.querySelector(`[data-project-id="${project.id}"]`);
                    if (projectCard) {
                        // Remove previous highlights
                        document.querySelectorAll('.project-card.highlighted').forEach(card => {
                            card.classList.remove('highlighted');
                        });
                        
                        // Highlight current card
                        projectCard.classList.add('highlighted');
                        // Removed auto-scroll behavior for better user experience
                        
                        // Fly to location
                        map.flyTo({
                            center: [project.longitude, project.latitude],
                            zoom: 15,
                            pitch: 0,
                            bearing: 0,
                            speed: 1.2
                        });
                    }
                });
            }
        });
    }
    
    // Initialize markers
    createMarkers();
    
    // Professional project card hover effects
    document.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            hoveredCard = this;
            const projectId = this.dataset.projectId;
            const marker = markers.find(m => m.projectData && m.projectData.id == projectId);
            
            if (marker) {
                // Highlight marker with smooth animation using Abad Raho colors
                const markerEl = marker.getElement();
                
                // Store original position and size
                const originalTransform = markerEl.style.transform;
                const originalBackground = markerEl.style.background;
                const originalBoxShadow = markerEl.style.boxShadow;
                const originalZIndex = markerEl.style.zIndex;
                
                // Apply highlight with proper positioning
                markerEl.style.transform = 'scale(1.3)';
                markerEl.style.background = 'linear-gradient(135deg, #2ac4ea 0%, #1a9cb8 100%)';
                markerEl.style.boxShadow = '0 8px 20px rgba(42, 196, 234, 0.6)';
                markerEl.style.zIndex = '1000';
                markerEl.style.transition = 'all 0.3s ease';
                
                // Open popup with smooth animation
                marker.getPopup().addTo(map);
                
                // Store highlighted marker
                highlightedMarker = marker;
                
                // Ensure marker stays at its coordinate position
                const lngLat = marker.getLngLat();
                marker.setLngLat(lngLat);
            }
        });
        
        card.addEventListener('mouseleave', function() {
            hoveredCard = null;
            if (highlightedMarker) {
                // Reset marker with smooth animation using Abad Raho colors
                const markerEl = highlightedMarker.getElement();
                markerEl.style.transform = 'scale(1)';
                markerEl.style.background = 'linear-gradient(135deg, #ec1c24 0%, #d9000d 100%)';
                markerEl.style.boxShadow = '0 4px 15px rgba(236, 28, 36, 0.4)';
                markerEl.style.zIndex = '1';
                markerEl.style.transition = 'all 0.3s ease';
                
                // Ensure marker stays at its coordinate position
                const lngLat = highlightedMarker.getLngLat();
                highlightedMarker.setLngLat(lngLat);
                
                // Close popup
                highlightedMarker.getPopup().remove();
                highlightedMarker = null;
            }
        });
        
        card.addEventListener('click', function() {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            
            if (!isNaN(lat) && !isNaN(lng)) {
                // Smooth fly to project location
                map.flyTo({
                    center: [lng, lat],
                    zoom: 15,
                    pitch: 0,
                    bearing: 0,
                    speed: 1.2
                });
                
                // Highlight the marker
                const projectId = this.dataset.projectId;
                const marker = markers.find(m => m.projectData && m.projectData.id == projectId);
                if (marker) {
                    marker.getPopup().addTo(map);
                }
            }
        });
    });
    
    // Map controls with professional styling
    document.getElementById('reset-view').addEventListener('click', function() {
        map.flyTo({
            center: [67.0011, 24.8607],
            zoom: 11,
            pitch: 0,
            bearing: 0,
            speed: 1.2
        });
    });
    
    let isSatellite = false;
    document.getElementById('toggle-satellite').addEventListener('click', function() {
        isSatellite = !isSatellite;
        map.setStyle(isSatellite ? 'mapbox://styles/mapbox/satellite-v9' : 'mapbox://styles/mapbox/streets-v12');
        this.innerHTML = isSatellite ? '<i class="fa fa-map"></i> Street' : '<i class="fa fa-satellite"></i> Satellite';
        this.classList.toggle('active');
    });
    
    // Professional search functionality
    document.getElementById('project-search').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const projectCards = document.querySelectorAll('.project-card');
        
        projectCards.forEach(card => {
            const title = card.querySelector('.project-title').textContent.toLowerCase();
            const location = card.querySelector('.project-location').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || location.includes(searchTerm)) {
                card.style.display = 'block';
                card.style.opacity = '1';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
            }
        });
    });
    
    // Filter button interactions
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Toggle active state
            if (this.dataset.filter === 'bonus') {
        this.classList.toggle('active');
            } else {
                // For dropdown filters, just show active state
        this.classList.toggle('active');
            }
        });
    });
    
    // Support button interaction
    document.querySelector('.support-button').addEventListener('click', function() {
        alert('Support feature coming soon!');
    });
});
</script>
@endsection
