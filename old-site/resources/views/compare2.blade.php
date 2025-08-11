@extends('layouts.master')
@section('meta_keywords', '')
@section('meta_description', '')
@section('meta_title', '')

@section('content')

    <select id="projects">
        @foreach($projects as $project)
            <option value="{!! $project->id !!}">{!! $project->name !!}</option>
        @endforeach
    </select>

    <select id="types"></select>

    <button id="add_to_compare" class="btn btn-primary">Add to Compare</button>

    <div id="results"></div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#projects').on('change', function () {
                $.get({
                    url: `/gettypes/${$(this).val()}`,
                    error: function (err) {
                        console.log("Error", err);
                    },
                    success: function (res) {
                        $('#types').empty();
                        res.types.map(function (type) {
                            $('#types').append(`<option value="${type.unit_type_id}">${type.title}</option>`)
                        })
                    },
                });
            })


            $('#add_to_compare').click(function () {
                $.post({
                    url: `/get_project_compare`,
                    data: {
                        _token: '{!! csrf_token() !!}',
                        project: $('#projects').val(),
                        type: $('#types').val()
                    },
                    error: function (err) {
                        console.log("Error", err);
                    },
                    success: function (res) {
                        $('#results').append(`<p>${JSON.stringify(res)}</p>`)
                    },
                });
            });
        })
    </script>
@endsection
