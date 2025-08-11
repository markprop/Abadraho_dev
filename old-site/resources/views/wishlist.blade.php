@extends('layouts.header')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')
@section('content')
<section class="our-dashbord dashbord bgc-f7">
    <div class=" container-fluid ">
        <div class="row">
            <div class="col-sm-12 maxw100flex-992">
                
                <div class="mb10">
                    <div class="breadcrumb_content style2">
                        <h3>
                        Wishlist
                        </h3>
                    </div>
                    @if(Session::has('success'))
						<div class="alert alert-success">
							{{ Session::get('success') }}
						</div>
					@endif
                </div>
                
             <div class="my-content">
                <div class="my_dashboard_review">
                     <div class="mb40">
                         <div class="property_table">
                            <div class="table-responsive mt0">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                        <th scope="col">Listing Title</th>
                                        <th scope="col">Date published</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($wishlist as $item)
                                    @if(isset($item->projects))
                                    <tbody>
                                        <tr>
                                           <th scope="row">
                                            <input type="hidden" value="{{$item->id}}"> 
                                                <div class="feat_property list favorite_page style2">
                                                    <div class="thumb">
                                                        <img class="img-whp" src="/{{$item->projects->project_cover_img}}" alt="">
                                                            <div class="thmb_cntnt">
                                                                <ul class="tag mb0">
                                                                    <li class="list-inline-item dn"></li>
                                                                    <li class="list-inline-item"><a href="{{URL::to('/')}}/project/{{ $item->projects->slug }}">{{$item->projects->progress}}</a></li>
                                                                </ul>
                                                            </div>
                                                    </div>
                                                    <div class="details">
                                                        <div class="tc_content">
                                                            <h4>{{$item->projects->name}}</h4>
                                                            <p><span class="flaticon-placeholder"></span> {{$item->projects->address}}</p>
                                                            <a class="fp_price text-thm" href="{{URL::to('/')}}/project/{{ $item->projects->slug }}">
                                                            Starting from Rs. {{ \App\Http\Controllers\FrontEnd\ProjectController::convertCurrency((int) $item->projects->min_price) }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                <ul class="view_edit_delete_list mb0">
                                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><a href="{{URL::to('/')}}/project/{{ $item->projects->slug }}"><span class="flaticon-view"></span></a></li>
                                                    <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><a href="/user/wishlist/{{ $item->id }}/delete" type="btn" class=""><span class="flaticon-garbage"></span></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        <div class="mbp_pagination">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer')

<script>
    $(document).ready(function(){

        $('.wishlist-remove-btn').click(function (e) { 
            e.preventDefault();
            
        });

        $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }

        });

        var Clickedthis = $(this);
        var wishlist_id = $(Clickedthis).closest('.wishlist-content').find('.wishlist_id').val();
        alert($wishlist_id);


});
</script>


@endsection