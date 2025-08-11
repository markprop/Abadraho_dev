<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="col-xl-12">
    <div class="row">

        <form class="form mt-5" method="POST" action="/import-areas" enctype="multipart/form-data">
            @csrf

            <div class="col-xl-12">
                <div class="row">

                    <div class="col-xl-6">
                        <div class="form-group fv-plugins-icon-container">
                            <label style="font-size: 20px">Import Areas ( .csv Format )</label>
                            <input type="file" class="form-control form-control-lg" name="projects" id="projects">
                            @error('projects')
                            <span class="form-text text-muted">Please upload the project document in .csv format. {{ $errors->first('project_doc') }}</span>
                            @enderror
                            <div class="fv-plugins-message-container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
