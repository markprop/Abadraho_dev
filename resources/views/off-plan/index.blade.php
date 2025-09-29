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
    
    /* Professional Search Bar */
    .search-filter-bar {
        background: #fff;
        border-bottom: 1px solid #e0e0e0;
        padding: 30px 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .search-input-container {
        position: relative;
        max-width: 600px;
        width: 100%;
    }
    
    .search-input {
        width: 100%;
        padding: 18px 20px 18px 55px;
        border: 2px solid #e0e0e0;
        border-radius: 30px;
        font-size: 16px;
        background: #f8f9fa;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .search-input:focus {
        outline: none;
        border-color: #ec1c24;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(236, 28, 36, 0.1);
    }
    
    .search-icon {
        position: absolute;
        left: 22px;
        top: 50%;
        transform: translateY(-50%);
        color: #ec1c24;
        font-size: 18px;
    }
    
    
    /* Content Layout */
    .content-layout {
        flex: 1;
        display: flex;
        overflow: hidden;
        height: calc(100vh - 160px);
        min-height: 600px;
        position: relative;
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
        transition: width 0.3s ease;
        min-width: 300px;
        max-width: 80%;
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
        flex: 1;
        position: relative;
        background: #f0f0f0;
        height: 100%;
        overflow: hidden;
        min-width: 300px;
        transition: width 0.3s ease;
    }
    
    /* Ensure map canvas fills container properly */
    .map-container #map {
        width: 100% !important;
        height: 100% !important;
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
    
    /* Resize Handle */
    .resize-handle {
        position: absolute;
        top: 0;
        left: 65%; /* Start at 65% to match initial project-listings width */
        width: 8px;
        height: 100%;
        background: linear-gradient(180deg, #ec1c24 0%, #d9000d 100%);
        cursor: col-resize;
        z-index: 10; /* Lower than header but above content */
        transition: left 0.3s ease, width 0.3s ease, background 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translateX(-50%); /* Center the handle on the border */
        border-left: 1px solid rgba(255, 255, 255, 0.2);
        border-right: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .resize-handle:hover {
        width: 12px;
        background: linear-gradient(180deg, #d9000d 0%, #b8000a 100%);
        box-shadow: 0 0 10px rgba(236, 28, 36, 0.3);
        transform: translateX(-50%) scaleX(1.5);
    }
    
    .resize-handle:active {
        width: 12px;
        background: linear-gradient(180deg, #b8000a 0%, #9a0008 100%);
        transform: translateX(-50%) scaleX(1.5);
    }
    
    .resize-handle::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 2px;
        height: 30px;
        background: #fff;
        border-radius: 1px;
        opacity: 0.8;
    }
    
    .resize-handle::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 2px;
        height: 20px;
        background: #fff;
        border-radius: 1px;
        opacity: 0.6;
        margin-left: 3px;
    }
    
    /* Resize Handle Arrow */
    .resize-handle-arrow {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        opacity: 0.9;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    
    .resize-handle:hover .resize-handle-arrow {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1.2);
    }
    
    /* Resize Handle Tooltip */
    .resize-handle-tooltip {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 1001;
    }
    
    .resize-handle-tooltip::after {
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-left-color: rgba(0, 0, 0, 0.8);
    }
    
    .resize-handle:hover .resize-handle-tooltip {
        opacity: 1;
        visibility: visible;
    }
    
    /* Resizing State */
    .content-layout.resizing {
        user-select: none;
        cursor: col-resize;
    }
    
    .content-layout.resizing * {
        pointer-events: none;
    }
    
    .content-layout.resizing .resize-handle {
        pointer-events: all;
    }
    
    /* Mobile Responsiveness for Resize Handle */
    @media (max-width: 768px) {
        .resize-handle {
            width: 12px;
            background: linear-gradient(180deg, #ec1c24 0%, #d9000d 100%);
        }
        
        .resize-handle:hover {
            width: 16px;
        }
        
        .resize-handle-tooltip {
            display: none; /* Hide tooltip on mobile */
        }
        
        .project-listings {
            min-width: 250px;
            max-width: 90%;
        }
        
        .map-container {
            min-width: 250px;
        }
    }
    
    /* Tablet Responsiveness */
    @media (max-width: 1024px) and (min-width: 769px) {
        .resize-handle {
            width: 10px;
        }
        
        .resize-handle:hover {
            width: 14px;
        }
    }
    
    /* Smooth transitions for all resizable elements */
    .project-listings,
    .map-container {
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Enhanced visual feedback during resize */
    .content-layout.resizing .project-listings {
        box-shadow: inset 0 0 0 2px rgba(236, 28, 36, 0.2);
    }
    
    .content-layout.resizing .map-container {
        box-shadow: inset 0 0 0 2px rgba(236, 28, 36, 0.2);
    }
    
    /* Resize handle active state */
    .resize-handle:active {
        background: linear-gradient(180deg, #b8000a 0%, #9a0008 100%);
        box-shadow: 0 0 15px rgba(236, 28, 36, 0.5);
    }
    
    /* Prevent text selection during resize */
    .content-layout.resizing {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    /* Smooth grid adjustments */
    .project-grid {
        transition: grid-template-columns 0.3s ease;
    }
    
    /* Resize handle focus state for accessibility */
    .resize-handle:focus {
        outline: 2px solid #ec1c24;
        outline-offset: 2px;
    }
    
    /* Custom Mapbox Popup Styling */
    .mapboxgl-popup-content {
        padding: 0 !important;
        border-radius: 16px !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15), 0 8px 16px rgba(0,0,0,0.1) !important;
        border: 1px solid rgba(236, 28, 36, 0.1) !important;
    }
    
    /* Modern Popup Styling */
    .modern-popup .mapboxgl-popup-content {
        padding: 0 !important;
        border-radius: 12px !important;
        box-shadow: 0 15px 30px rgba(0,0,0,0.12), 0 5px 10px rgba(0,0,0,0.08) !important;
        border: 1px solid rgba(236, 28, 36, 0.1) !important;
        overflow: hidden !important;
        z-index: 1000 !important;
    }
    
    .modern-popup .mapboxgl-popup-tip {
        border-top-color: #fff !important;
        border-width: 6px !important;
    }
    
    /* Ensure popups are above markers */
    .mapboxgl-popup {
        z-index: 1000 !important;
    }
    
    .mapboxgl-popup-content {
        z-index: 1000 !important;
    }
    
    /* Ensure markers stay behind popups */
    .mapboxgl-marker {
        z-index: 100 !important;
    }
    
    .custom-marker {
        z-index: 100 !important;
    }
    
    /* Custom Marker Styling - No transforms to prevent drift */
    .custom-marker {
        will-change: box-shadow, border, filter !important;
        transition: box-shadow 0.3s ease, border 0.3s ease, filter 0.3s ease !important;
    }
    
    /* Ensure markers don't move during hover */
    .mapboxgl-marker {
        transform-origin: center center !important;
    }
    
    /* Alternative hover effect using CSS only */
    .custom-marker:hover {
        box-shadow: 0 8px 25px rgba(236, 28, 36, 0.6), 0 0 0 4px rgba(236, 28, 36, 0.3) !important;
        border-width: 4px !important;
        filter: brightness(1.1) !important;
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
    .map-control-btn:focus,
    .support-button:focus {
        outline: 2px solid #3b82f6;
        outline-offset: 2px;
    }
    
    /* Enhanced hover states */
    .nav-item:hover,
    .header-action:hover {
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
    
    /* Tablet Responsiveness */
    @media (max-width: 1024px) and (min-width: 769px) {
        .project-listings {
            width: 50%;
            min-width: 300px;
        }
        
        .map-container {
            width: 50%;
            min-width: 300px;
        }
        
        .search-input-container {
            max-width: 500px;
        }
        
        .search-input {
            font-size: 15px;
            padding: 16px 20px 16px 50px;
        }
    }
    
    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .off-plan-content {
            height: 100vh;
            overflow: hidden;
        }
        
        .content-layout {
            flex-direction: row;
            height: calc(100vh - 70px);
            min-height: calc(100vh - 70px);
        }
        
        .project-listings {
            width: 50%;
            height: 100%;
            min-height: 300px;
            padding: 15px;
            order: 1;
            overflow-y: auto;
            overflow-x: hidden;
            background: #f8f9fa;
        }
        
        .project-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .map-container {
            width: 50%;
            height: 100%;
            min-height: 300px;
            order: 2;
            position: relative;
            overflow: hidden;
        }
        
        .map-container #map {
            width: 100% !important;
            height: 100% !important;
        }
        
        .search-filter-bar {
            padding: 15px;
            position: sticky;
            top: 0;
            z-index: 100;
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .search-input-container {
            max-width: 100%;
        }
        
        .search-input {
            font-size: 16px;
            padding: 15px 20px 15px 50px;
            border-radius: 25px;
        }
        
        .search-icon {
            left: 20px;
            font-size: 18px;
        }
        
        .project-card {
            margin-bottom: 15px;
            padding: 15px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .project-image-container {
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .project-title {
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: 700;
            color: #1a1a1a;
        }
        
        .project-price {
            font-size: 20px;
            font-weight: 700;
            color: #ec1c24;
            margin: 10px 0;
        }
        
        .project-address {
            font-size: 14px;
            margin-bottom: 10px;
            color: #666;
        }
        
        .project-badges {
            top: 12px;
            left: 12px;
        }
        
        .project-badges .badge {
            font-size: 11px;
            padding: 6px 12px;
            border-radius: 15px;
        }
        
        .project-details {
            margin: 10px 0;
        }
        
        .project-details p {
            font-size: 13px;
            color: #666;
            margin: 5px 0;
        }
        
        /* Hide resize handle on mobile */
        .resize-handle {
            display: none;
        }
        
        /* Map controls positioning for mobile */
        .map-controls {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }
        
        .map-control-btn {
            width: 40px;
            height: 40px;
            font-size: 14px;
            margin-bottom: 8px;
            border-radius: 8px;
        }
    }
    
    /* Small Mobile Responsiveness */
    @media (max-width: 480px) {
        .top-header {
            padding: 10px 12px;
        }
        
        .search-filter-bar {
            padding: 12px;
        }
        
        .search-input {
            font-size: 14px;
            padding: 12px 15px 12px 45px;
        }
        
        .search-icon {
            left: 15px;
            font-size: 16px;
        }
        
        .project-listings {
            width: 50%;
            height: 100%;
            min-height: 280px;
            padding: 12px;
        }
        
        .map-container {
            width: 50%;
            height: 100%;
            min-height: 220px;
        }
        
        .project-card {
            padding: 12px;
            margin-bottom: 12px;
        }
        
        .project-image-container {
            height: 160px;
        }
        
        .project-title {
            font-size: 16px;
            margin-bottom: 6px;
        }
        
        .project-price {
            font-size: 18px;
        }
        
        .project-address {
            font-size: 12px;
            margin-bottom: 8px;
        }
        
        .project-badges {
            top: 10px;
            left: 10px;
        }
        
        .project-badges .badge {
            font-size: 10px;
            padding: 4px 8px;
        }
        
        .map-control-btn {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }
    }
    
    /* Extra Small Mobile - Stack vertically for very small screens */
    @media (max-width: 360px) {
        .content-layout {
            flex-direction: column;
        }
        
        .project-listings {
            width: 100%;
            height: 60vh;
            max-height: 60vh;
            padding: 8px;
        }
        
        .map-container {
            width: 100%;
            height: 40vh;
            max-height: 40vh;
        }
        
        .search-filter-bar {
            padding: 12px 8px;
        }
        
        .search-input {
            font-size: 13px;
            padding: 12px 15px 12px 40px;
        }
        
        .search-icon {
            left: 15px;
            font-size: 14px;
        }
        
        .project-card {
            padding: 10px;
        }
        
        .project-image-container {
            height: 140px;
        }
        
        .project-title {
            font-size: 14px;
        }
        
        .project-price {
            font-size: 15px;
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
    <!-- Professional Search Bar -->
    <div class="search-filter-bar">
        <div class="search-input-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search projects, developers, locations..." id="project-search">
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
                             alt="{{ $project->name }}" 
                             class="project-image"
                             onerror="this.src='{{ asset('images/default-project.jpg') }}'">
                        
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
    
    <!-- Resize Handle -->
    <div class="resize-handle" id="resize-handle">
        <div class="resize-handle-arrow">⟷</div>
        <div class="resize-handle-tooltip">Drag to resize</div>
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
<script>
// Temporary compatibility shim: prevent third-party overrides from breaking Mapbox
// If redefining img.src throws, swallow it for HTMLImageElement so Mapbox webp check won't crash
(function(){
    try {
        var __origDefine = Object.defineProperty;
        Object.defineProperty = function(target, prop, descriptor){
            try {
                return __origDefine.call(Object, target, prop, descriptor);
            } catch (err) {
                if (prop === 'src' && typeof HTMLImageElement !== 'undefined' && target instanceof HTMLImageElement) {
                    return target; // ignore redefinition errors on img.src
                }
                throw err;
            }
        };
    } catch(e) { /* noop */ }
})();
</script>
<link href='https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v3.6.0/mapbox-gl.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Restore native createElement to avoid global overrides that redefine img.src
    try {
        if (Document && Document.prototype && Document.prototype.createElement) {
            document.createElement = Document.prototype.createElement;
        }
    } catch (e) { /* noop */ }

    // Initialize Mapbox (defensive: don't break page if script or token missing)
    let map = null;
    try {
        if (window.mapboxgl && typeof mapboxgl.Map === 'function') {
            const token = '{{ config('services.mapbox.token') }}' || '';
            if (!token || token === 'null' || token === 'undefined') {
                console.warn('Mapbox token is empty. Set MAPBOX_ACCESS_TOKEN in .env and clear config cache.');
            }
            mapboxgl.accessToken = token;
            map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [67.0011, 24.8607], // Karachi coordinates
                zoom: 11,
                pitch: 0,
                bearing: 0
            });
            // Log map errors to help diagnose token/style issues
            map.on('error', function(e){
                console.error('Mapbox error:', e && e.error ? e.error : e);
            });
        } else {
            // Mapbox not loaded; keep map null so rest of page works
            console.warn('Mapbox GL JS not available. Map features disabled.');
        }
    } catch (err) {
        console.warn('Failed to initialize Mapbox. Continuing without map.', err);
        map = null;
    }
    
    // Add navigation controls (only if map exists)
    if (map && window.mapboxgl) {
        map.addControl(new mapboxgl.NavigationControl());
        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: { enableHighAccuracy: true },
            trackUserLocation: true
        }));
    }
    
    // Store projects data
    const projectsData = @json($projectsForMap);
    const markers = [];
    let highlightedMarker = null;
    let hoveredCard = null;
    let currentPopup = null; // Track current open popup
    
    // Debug: Log projects data to console (can be removed in production)
    // console.log('Projects data for map:', projectsData);
    // console.log('Total projects:', projectsData.length);
    
    // Function to close current popup
    function closeCurrentPopup() {
        if (currentPopup) {
            currentPopup.remove();
            currentPopup = null;
        }
        // Also close any open marker popups
        markers.forEach(marker => {
            if (marker.getPopup().isOpen()) {
                marker.getPopup().remove();
            }
        });
    }
    
    // Map resize function with proper handling
    function resizeMap() {
        if (map && typeof map.resize === 'function') {
            // Use requestAnimationFrame for smooth resizing
            requestAnimationFrame(() => {
                try {
                    map.resize();
                    // Ensure map maintains its current view and canvas size
                    const canvas = map && typeof map.getCanvas === 'function' ? map.getCanvas() : null;
                    if (canvas) {
                        canvas.style.width = '100%';
                        canvas.style.height = '100%';
                    }
                    // Force a repaint to ensure proper rendering
                    if (map && typeof map.triggerRepaint === 'function') {
                        map.triggerRepaint();
                    }
                } catch (error) {
                    console.log('Map resize handled gracefully');
                }
            });
        }
    }
    
    // Mobile-specific optimizations
        function optimizeForMobile() {
            const isMobile = window.innerWidth <= 768;
            const isSmallMobile = window.innerWidth <= 480;
            const isExtraSmallMobile = window.innerWidth <= 360;
            
            if (isMobile) {
                // Disable resize handle on mobile
                const resizeHandle = document.getElementById('resize-handle');
                if (resizeHandle) {
                    resizeHandle.style.display = 'none';
                }
                
                // Optimize map for mobile
                if (map && typeof map.getCanvas === 'function' && map.getCanvas()) {
                    map.getCanvas().style.touchAction = 'manipulation';
                    map.getCanvas().style.cursor = 'grab';
                }
                
                // Adjust project listings for mobile
                const projectListings = document.getElementById('project-listings');
                if (projectListings) {
                    if (isExtraSmallMobile) {
                        // Stack vertically for very small screens
                        projectListings.style.width = '100%';
                        projectListings.style.height = '60vh';
                        projectListings.style.maxHeight = '60vh';
                    } else {
                        // Side by side for regular mobile
                        projectListings.style.width = '50%';
                        projectListings.style.height = '100%';
                        projectListings.style.maxHeight = '100%';
                    }
                }
                
                // Adjust map container for mobile
                const mapContainer = document.querySelector('.map-container');
                if (mapContainer) {
                    if (isExtraSmallMobile) {
                        // Stack vertically for very small screens
                        mapContainer.style.width = '100%';
                        mapContainer.style.height = '40vh';
                        mapContainer.style.maxHeight = '40vh';
                    } else {
                        // Side by side for regular mobile
                        mapContainer.style.width = '50%';
                        mapContainer.style.height = '100%';
                        mapContainer.style.maxHeight = '100%';
                    }
                }
            } else {
                // Re-enable resize handle on desktop
                const resizeHandle = document.getElementById('resize-handle');
                if (resizeHandle) {
                    resizeHandle.style.display = 'block';
                }
            }
        }
    
    // Call on load and resize
    optimizeForMobile();
    window.addEventListener('resize', optimizeForMobile);
    
    // Create professional markers for each project
    function createMarkers() {
        if (!map) { return; }
        // Clear existing markers
        markers.forEach(marker => marker.remove());
        markers.length = 0;
        
        // console.log('Creating markers for', projectsData.length, 'projects');
        
        let markersCreated = 0;
        projectsData.forEach((project, index) => {
            // console.log(`Processing project ${index + 1}:`, project.name, 'Lat:', project.latitude, 'Lng:', project.longitude, 'Cover:', project.cover_image);
            
            if (project.latitude && project.longitude) {
                markersCreated++;
                // Create custom marker element with project cover image
                const markerElement = document.createElement('div');
                markerElement.className = 'custom-marker';
                markerElement.style.cssText = `
                    width: 50px;
                    height: 50px;
                    border: 3px solid white;
                    border-radius: 50%;
                    cursor: pointer;
                    box-shadow: 0 4px 15px rgba(236, 28, 36, 0.4), 0 0 0 2px rgba(236, 28, 36, 0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: box-shadow 0.3s ease, border 0.3s ease, filter 0.3s ease;
                    position: relative;
                    z-index: 1;
                    overflow: hidden;
                    background: #f0f0f0;
                    will-change: box-shadow, border, filter;
                `;
                
                // Create image element for the cover image
                const markerImage = document.createElement('img');
                markerImage.style.cssText = `
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 50%;
                    transition: opacity 0.3s ease;
                `;
                markerImage.src = project.cover_image || '{{ asset('images/default-project.jpg') }}';
                markerImage.alt = project.name;
                
                // Add loading state
                markerImage.onload = function() {
                    this.style.opacity = '1';
                };
                markerImage.style.opacity = '0.7';
                markerImage.onerror = function() {
                    // If default image also fails, show a fallback with project initial
                    this.style.display = 'none';
                    const fallbackDiv = document.createElement('div');
                    fallbackDiv.style.cssText = `
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-weight: bold;
                        font-size: 18px;
                        border-radius: 50%;
                    `;
                    fallbackDiv.textContent = project.name ? project.name.charAt(0).toUpperCase() : 'P';
                    markerElement.appendChild(fallbackDiv);
                };
                
                markerElement.appendChild(markerImage);
                
                // Add hover effect without transforms to prevent marker drift
                markerElement.addEventListener('mouseenter', function() {
                    // Use box-shadow and border changes instead of transform
                    this.style.boxShadow = '0 8px 25px rgba(236, 28, 36, 0.6), 0 0 0 4px rgba(236, 28, 36, 0.3)';
                    this.style.borderWidth = '4px';
                    this.style.zIndex = '1000';
                    this.style.filter = 'brightness(1.1)';
                });
                
                markerElement.addEventListener('mouseleave', function() {
                    var highlightedEl = (highlightedMarker && typeof highlightedMarker.getElement === 'function') ? highlightedMarker.getElement() : null;
                    if (this !== highlightedEl) {
                        this.style.boxShadow = '0 4px 15px rgba(236, 28, 36, 0.4), 0 0 0 2px rgba(236, 28, 36, 0.2)';
                        this.style.borderWidth = '3px';
                        this.style.zIndex = '1';
                        this.style.filter = 'brightness(1)';
                    }
                });
                
                // Create professional popup content inspired by reference design
                const defaultImage = '{{ asset('images/default-project.jpg') }}';
                const imageSrc = project.cover_image || defaultImage;
                
                // Format price properly
                const formatPrice = (price) => {
                    if (!price || price === 0) return 'Price on Request';
                    return `Rs. ${parseInt(price).toLocaleString()}`;
                };
                
                // Get developer name
                const developerName = project.developer || 'Developer';
                
                const popupContent = `
                    <div class="modern-popup-card" style="
                        background: #fff; 
                        border-radius: 12px; 
                        overflow: hidden; 
                        width: 280px; 
                        box-shadow: 0 20px 40px rgba(0,0,0,0.15), 0 8px 16px rgba(0,0,0,0.1);
                        border: 2px solid transparent;
                        background-image: linear-gradient(white, white), linear-gradient(135deg, #ec1c24, #d9000d, #b8000a);
                        background-origin: border-box;
                        background-clip: content-box, border-box;
                        position: relative;
                        font-family: 'Poppins', sans-serif;
                        display: flex;
                        flex-direction: column;
                    ">
                        <!-- Close Button -->
                        <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                            <button onclick="this.closest('.mapboxgl-popup').remove()" style="
                                background: rgba(0,0,0,0.7); 
                                border: none; 
                                border-radius: 50%; 
                                width: 24px; 
                                height: 24px; 
                                color: white; 
                                cursor: pointer;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 16px;
                                font-weight: bold;
                                transition: all 0.3s ease;
                                box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                            " onmouseover="this.style.background='rgba(0,0,0,0.9)'" onmouseout="this.style.background='rgba(0,0,0,0.7)'">
                                ×
                            </button>
                        </div>
                        
                        <!-- Project Image Section -->
                        <div style="
                            width: 100%; 
                            height: 120px; 
                            position: relative; 
                            overflow: hidden;
                            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                        ">
                            <img src="${imageSrc}" 
                                 style="width: 100%; height: 100%; object-fit: cover; object-position: center;" 
                                 alt="${project.name}"
                                 onerror="this.src='${defaultImage}'">
                            
                            <!-- Gradient Overlay for better text readability -->
                            <div style="
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                height: 40px;
                                background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent);
                            "></div>
                            
                            <!-- Status Badge Overlay -->
                            <div style="position: absolute; top: 8px; left: 8px;">
                                <span style="
                                    background: linear-gradient(135deg, #ec1c24 0%, #d9000d 100%); 
                                    color: white;
                                    padding: 4px 8px; 
                                    border-radius: 12px; 
                                    font-size: 9px; 
                                    font-weight: 700;
                                    text-transform: uppercase;
                                    letter-spacing: 0.5px;
                                    box-shadow: 0 2px 8px rgba(236, 28, 36, 0.4);
                                ">${project.progress || 'Presale (EOI)'}</span>
                            </div>
                        </div>
                        
                        <!-- Content Section -->
                        <div style="
                            padding: 16px; 
                            display: flex; 
                            flex-direction: column; 
                            gap: 12px;
                            flex: 1;
                        ">
                            <!-- Project Title -->
                            <h3 style="
                                margin: 0; 
                                font-size: 16px; 
                                color: #1a1a1a; 
                                font-weight: 700; 
                                line-height: 1.3;
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                            ">${project.name}</h3>
                            
                            <!-- Developer -->
                            <p style="
                                margin: 0; 
                                font-size: 12px; 
                                color: #666; 
                                font-weight: 500;
                            ">by ${developerName}</p>
                            
                            <!-- Address -->
                            <p style="
                                margin: 0; 
                                font-size: 11px; 
                                color: #888; 
                                line-height: 1.4;
                                display: -webkit-box;
                                -webkit-line-clamp: 1;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                            ">${project.address || 'Karachi, Pakistan'}</p>
                            
                            <!-- Project Details Row -->
                            <div style="display: flex; align-items: center; gap: 12px;">
                                ${project.rooms ? `
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <i class="fa fa-bed" style="color: #ec1c24; font-size: 12px;"></i>
                                    <span style="font-size: 10px; color: #666; font-weight: 500;">${project.rooms} Rooms</span>
                                </div>
                                ` : ''}
                                
                                ${project.type ? `
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <i class="fa fa-building" style="color: #ec1c24; font-size: 12px;"></i>
                                    <span style="font-size: 10px; color: #666; font-weight: 500;">${project.type}</span>
                                </div>
                                ` : ''}
                            </div>
                            
                            <!-- Price Section -->
                            <div style="
                                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); 
                                padding: 12px; 
                                border-radius: 8px; 
                                border-left: 3px solid #ec1c24;
                                margin-top: auto;
                            ">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <div>
                                        <p style="margin: 0; font-size: 9px; color: #666; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px;">Starting from</p>
                                        <p style="margin: 2px 0 0; font-size: 16px; color: #ec1c24; font-weight: 700;">${formatPrice(project.price)}</p>
                                    </div>
                                    ${project.completion_date && project.completion_date !== 'TBD' ? `
                                    <div style="
                                        background: rgba(0,0,0,0.8); 
                                        color: white; 
                                        padding: 6px 10px; 
                                        border-radius: 12px; 
                                        font-size: 10px; 
                                        font-weight: 600;
                                        text-align: center;
                                        min-width: 60px;
                                    ">
                                        <div style="font-size: 9px; margin-bottom: 2px;">${project.completion_date}</div>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                `;
                
                // Create popup with professional styling
                const popup = new mapboxgl.Popup({
                    closeButton: false, // We have custom close button
                    closeOnClick: false,
                    offset: 25,
                    maxWidth: '280px',
                    className: 'modern-popup'
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
                markerElement.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    console.log('Marker clicked for project:', project.name);
                    
                    // Close current popup if any
                    closeCurrentPopup();
                    
                    // Set current popup and open it using marker's popup
                    currentPopup = popup;
                    marker.togglePopup();
                    
                    console.log('Popup should be open now');
                    
                    // Find and highlight corresponding project card
                    const projectCard = document.querySelector(`[data-project-id="${project.id}"]`);
                    if (projectCard) {
                        // Remove previous highlights
                        document.querySelectorAll('.project-card.highlighted').forEach(card => {
                            card.classList.remove('highlighted');
                        });
                        
                        // Highlight current card
                        projectCard.classList.add('highlighted');
                        
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
        
        // console.log(`Successfully created ${markersCreated} markers out of ${projectsData.length} projects`);
    }
    
    // Initialize markers only after map is ready
    if (map) {
        if (map.loaded && map.loaded()) {
            createMarkers();
        } else {
            map.once('load', createMarkers);
        }
    }
    
    // Close popup when clicking on map
    if (map) {
        map.on('click', function(e) {
            closeCurrentPopup();
        });
    }
    
    // Professional project card hover effects
    document.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            hoveredCard = this;
            const projectId = this.dataset.projectId;
            const marker = markers.find(m => m.projectData && m.projectData.id == projectId);
            
            if (marker) {
                // Highlight marker without transforms to prevent drift
                const markerEl = marker.getElement();
                
                // Apply highlight using box-shadow and border changes
                markerEl.style.boxShadow = '0 8px 25px rgba(42, 196, 234, 0.6), 0 0 0 4px rgba(42, 196, 234, 0.3)';
                markerEl.style.borderWidth = '4px';
                markerEl.style.borderColor = '#2ac4ea';
                markerEl.style.zIndex = '1000';
                markerEl.style.filter = 'brightness(1.1)';
                markerEl.style.transition = 'box-shadow 0.3s ease, border 0.3s ease, filter 0.3s ease';
                
                // Open popup with smooth animation
                if (marker.getPopup()) {
                    marker.getPopup().addTo(map);
                }
                
                // Store highlighted marker
                highlightedMarker = marker;
            }
        });
        
        card.addEventListener('mouseleave', function() {
            hoveredCard = null;
            if (highlightedMarker) {
                // Reset marker without transforms
                const markerEl = highlightedMarker.getElement();
                markerEl.style.boxShadow = '0 4px 15px rgba(236, 28, 36, 0.4), 0 0 0 2px rgba(236, 28, 36, 0.2)';
                markerEl.style.borderWidth = '3px';
                markerEl.style.borderColor = 'white';
                markerEl.style.zIndex = '1';
                markerEl.style.filter = 'brightness(1)';
                markerEl.style.transition = 'box-shadow 0.3s ease, border 0.3s ease, filter 0.3s ease';
                
                // Close popup
                highlightedMarker.getPopup().remove();
                highlightedMarker = null;
            }
        });
        
        card.addEventListener('click', function() {
            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);
            
            if (!isNaN(lat) && !isNaN(lng)) {
                // Close current popup
                closeCurrentPopup();
                
                // Smooth fly to project location
                if (map && typeof map.flyTo === 'function') {
                    map.flyTo({
                        center: [lng, lat],
                        zoom: 15,
                        pitch: 0,
                        bearing: 0,
                        speed: 1.2
                    });
                }
                
                // Highlight the marker and open popup
                const projectId = this.dataset.projectId;
                const marker = markers.find(m => m.projectData && m.projectData.id == projectId);
                if (marker) {
                    currentPopup = marker.getPopup();
                    if (marker.togglePopup) { marker.togglePopup(); }
                }
            }
        });
    });
    
    // Map controls with professional styling
    document.getElementById('reset-view').addEventListener('click', function() {
        if (map && typeof map.flyTo === 'function') {
            map.flyTo({
                center: [67.0011, 24.8607],
                zoom: 11,
                pitch: 0,
                bearing: 0,
                speed: 1.2
            });
        }
    });
    
    let isSatellite = false;
    document.getElementById('toggle-satellite').addEventListener('click', function() {
        isSatellite = !isSatellite;
        if (map && typeof map.setStyle === 'function') {
            map.setStyle(isSatellite ? 'mapbox://styles/mapbox/satellite-v9' : 'mapbox://styles/mapbox/streets-v12');
        }
        this.innerHTML = isSatellite ? '<i class="fa fa-map"></i> Street' : '<i class="fa fa-satellite"></i> Satellite';
        this.classList.toggle('active');
    });
    
    // Professional search functionality
    const projectSearchInput = document.getElementById('project-search');
    projectSearchInput.addEventListener('input', function() {
        const searchTerm = (this.value || '').toLowerCase().trim();
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
    // Prefill from q in URL and trigger once now that listener exists
    try {
        const urlParams = new URLSearchParams(window.location.search);
        const initialQuery = urlParams.get('q');
        if (initialQuery) {
            projectSearchInput.value = initialQuery;
            projectSearchInput.dispatchEvent(new Event('input', { bubbles: true }));
        }
    } catch (e) {}
    
    
    // Support button interaction
    document.querySelector('.support-button').addEventListener('click', function() {
        alert('Support feature coming soon!');
    });
    
    // Resize Handle Functionality
    const resizeHandle = document.getElementById('resize-handle');
    const projectListings = document.getElementById('project-listings');
    const contentLayout = document.querySelector('.content-layout');
    let isResizing = false;
    let startX = 0;
    let startWidth = 0;
    
    // Mouse events for resize handle
    resizeHandle.addEventListener('mousedown', function(e) {
        isResizing = true;
        startX = e.clientX;
        startWidth = projectListings.offsetWidth;
        
        // Add resizing class to prevent text selection
        contentLayout.classList.add('resizing');
        
        // Prevent default behavior
        e.preventDefault();
        e.stopPropagation();
    });
    
    // Mouse move event for resizing
    document.addEventListener('mousemove', function(e) {
        if (!isResizing) return;
        
        const deltaX = e.clientX - startX;
        const newWidth = startWidth + deltaX;
        const containerWidth = contentLayout.offsetWidth;
        
        // Calculate percentage based on new width
        const newPercentage = (newWidth / containerWidth) * 100;
        
        // Set minimum and maximum constraints
        const minPercentage = 25; // 25% minimum
        const maxPercentage = 80; // 80% maximum
        
        if (newPercentage >= minPercentage && newPercentage <= maxPercentage) {
            projectListings.style.width = newPercentage + '%';
            
            // Update resize handle position to stay between panels
            resizeHandle.style.left = newPercentage + '%';
            
            // Trigger map resize after a short delay to ensure smooth rendering
            setTimeout(() => {
                resizeMap();
            }, 10);
        }
        
        e.preventDefault();
    });
    
    // Mouse up event to stop resizing
    document.addEventListener('mouseup', function(e) {
        if (isResizing) {
            isResizing = false;
            contentLayout.classList.remove('resizing');
            
            // Save the current width to localStorage for persistence
            const currentPercentage = (projectListings.offsetWidth / contentLayout.offsetWidth) * 100;
            localStorage.setItem('projectListingsWidth', currentPercentage.toString());
            
            // Final map resize to ensure proper rendering
            setTimeout(() => {
                resizeMap();
            }, 50);
        }
    });
    
    // Touch events for mobile devices
    resizeHandle.addEventListener('touchstart', function(e) {
        isResizing = true;
        startX = e.touches[0].clientX;
        startWidth = projectListings.offsetWidth;
        contentLayout.classList.add('resizing');
        e.preventDefault();
    });
    
    document.addEventListener('touchmove', function(e) {
        if (!isResizing) return;
        
        const deltaX = e.touches[0].clientX - startX;
        const newWidth = startWidth + deltaX;
        const containerWidth = contentLayout.offsetWidth;
        const newPercentage = (newWidth / containerWidth) * 100;
        
        const minPercentage = 25;
        const maxPercentage = 80;
        
        if (newPercentage >= minPercentage && newPercentage <= maxPercentage) {
            projectListings.style.width = newPercentage + '%';
            resizeHandle.style.left = newPercentage + '%';
            
            // Trigger map resize for touch events
            setTimeout(() => {
                resizeMap();
            }, 10);
        }
        
        e.preventDefault();
    });
    
    document.addEventListener('touchend', function(e) {
        if (isResizing) {
            isResizing = false;
            contentLayout.classList.remove('resizing');
            
            const currentPercentage = (projectListings.offsetWidth / contentLayout.offsetWidth) * 100;
            localStorage.setItem('projectListingsWidth', currentPercentage.toString());
            
            // Final map resize for touch events
            setTimeout(() => {
                resizeMap();
            }, 50);
        }
    });
    
    // Load saved width on page load
    const savedWidth = localStorage.getItem('projectListingsWidth');
    if (savedWidth) {
        const widthPercentage = parseFloat(savedWidth);
        if (widthPercentage >= 25 && widthPercentage <= 80) {
            projectListings.style.width = widthPercentage + '%';
            resizeHandle.style.left = widthPercentage + '%';
            
            // Trigger map resize after loading saved width
            setTimeout(() => {
                resizeMap();
            }, 100);
        }
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        // Recalculate resize handle position on window resize
        const currentPercentage = (projectListings.offsetWidth / contentLayout.offsetWidth) * 100;
        resizeHandle.style.left = currentPercentage + '%';
        
        // Trigger map resize on window resize
        setTimeout(() => {
            resizeMap();
        }, 100);
    });
    
    // Keyboard accessibility for resize handle
    resizeHandle.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
            e.preventDefault();
            
            const containerWidth = contentLayout.offsetWidth;
            const currentWidth = projectListings.offsetWidth;
            const currentPercentage = (currentWidth / containerWidth) * 100;
            
            let newPercentage = currentPercentage;
            if (e.key === 'ArrowLeft') {
                newPercentage = Math.max(25, currentPercentage - 5); // Decrease by 5%
            } else if (e.key === 'ArrowRight') {
                newPercentage = Math.min(80, currentPercentage + 5); // Increase by 5%
            }
            
            projectListings.style.width = newPercentage + '%';
            resizeHandle.style.left = newPercentage + '%';
            
            // Trigger map resize for keyboard navigation
            setTimeout(() => {
                resizeMap();
            }, 10);
            
            // Save the new width
            localStorage.setItem('projectListingsWidth', newPercentage.toString());
        }
    });
    
    // Make resize handle focusable for keyboard navigation
    resizeHandle.setAttribute('tabindex', '0');
    resizeHandle.setAttribute('role', 'separator');
    resizeHandle.setAttribute('aria-label', 'Resize panels');
    resizeHandle.setAttribute('aria-valuemin', '25');
    resizeHandle.setAttribute('aria-valuemax', '80');
});
</script>
@endsection
