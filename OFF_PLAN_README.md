# Off-Plan Properties Page

## Overview
The Off-Plan page provides a comprehensive view of all off-plan (pre-construction) properties with an interactive Mapbox map visualization. This page is designed to replicate the functionality shown in the reference image with modern UI/UX.

## Features

### 1. Project Listing
- **Sidebar Layout**: Left sidebar displays project cards in a scrollable list
- **Project Cards**: Each card shows:
  - Project image
  - Project name and location
  - Price range
  - Progress status (Presale, EOI, etc.)
  - Completion date
  - Property features (bedrooms, type, etc.)
  - Bonus indicators for special offers

### 2. Interactive Map
- **Mapbox Integration**: Right side displays an interactive map
- **Project Markers**: Each project is marked on the map with custom markers
- **Hover Effects**: Hovering over project cards highlights corresponding map markers
- **Click Interactions**: Clicking project cards flies to the location on the map
- **Map Controls**: Reset view and toggle between street/satellite view

### 3. Advanced Filtering
- **Search Bar**: Real-time search through project names and locations
- **Filter Options**:
  - With Bonus (special offers)
  - Sale Status (progress stages)
  - Price Range (min/max)
  - Area/Location
  - Unit Type
  - Bedrooms
  - Developer/Builder
- **Filter Toggle**: Collapsible filter section for mobile devices

### 4. Responsive Design
- **Mobile-First**: Optimized for mobile and tablet devices
- **Flexible Layout**: Sidebar and map stack vertically on smaller screens
- **Touch-Friendly**: All interactions work on touch devices

## Technical Implementation

### Controller
- **File**: `app/Http/Controllers/FrontEnd/OffPlanController.php`
- **Methods**:
  - `index()`: Main page with project listing and filters
  - `getProjectsForMap()`: AJAX endpoint for map data updates
  - `applyFilters()`: Private method for filtering logic

### Routes
- **Main Page**: `/off-plan` (GET)
- **Map Data**: `/off-plan/map-data` (GET) - for AJAX updates

### View
- **File**: `resources/views/off-plan/index.blade.php`
- **Layout**: Extends `layouts.master`
- **Styling**: Custom CSS for modern UI
- **JavaScript**: Interactive map and hover effects

### Database Integration
- **Projects**: Fetches from `projects` table with relationships
- **Filters**: Uses `areas`, `progress`, `project_types`, `builders`, `tags` tables
- **Pagination**: Laravel pagination for large datasets

## Configuration

### Mapbox Setup
1. Get a Mapbox access token from [mapbox.com](https://mapbox.com)
2. Add to your `.env` file:
   ```
   MAPBOX_ACCESS_TOKEN=your_token_here
   ```
3. If no token is provided, a default token will be used (limited functionality)

### Environment Variables
The page uses the following environment variables:
- `MAPBOX_ACCESS_TOKEN`: Your Mapbox API token

## Usage

### For Users
1. Navigate to `/off-plan` or click "Off-Plan" in the main navigation
2. Use the search bar to find specific projects
3. Apply filters to narrow down results
4. Hover over project cards to see map highlights
5. Click project cards to view details on the map
6. Use map controls to change view or reset position

### For Developers
1. **Adding New Filters**: Modify the `applyFilters()` method in the controller
2. **Customizing Styling**: Update the CSS in the view file
3. **Map Customization**: Modify the Mapbox configuration in the JavaScript section
4. **Adding New Project Data**: Update the `projectsForMap` array structure

## Browser Support
- Modern browsers with ES6 support
- Mapbox GL JS compatibility
- Responsive design for all screen sizes

## Performance Considerations
- **Lazy Loading**: Map markers are created only when needed
- **Pagination**: Large project lists are paginated
- **Efficient Queries**: Database queries are optimized with proper relationships
- **Caching**: Consider implementing caching for frequently accessed data

## Future Enhancements
- **Real-time Updates**: WebSocket integration for live project updates
- **Advanced Analytics**: User interaction tracking
- **Export Functionality**: Export filtered results
- **Comparison Tool**: Compare multiple projects
- **Favorites System**: Save favorite projects
- **Advanced Map Features**: Clustering, heat maps, custom styles

## Troubleshooting

### Common Issues
1. **Map Not Loading**: Check Mapbox token configuration
2. **No Projects Showing**: Verify database has projects with `status = 1`
3. **Filters Not Working**: Check if related tables have data
4. **Mobile Layout Issues**: Test responsive breakpoints

### Debug Mode
Enable Laravel debug mode to see detailed error messages:
```
APP_DEBUG=true
```

## Support
For technical support or feature requests, contact the development team.
