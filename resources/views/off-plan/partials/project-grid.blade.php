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
