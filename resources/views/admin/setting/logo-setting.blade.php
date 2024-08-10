
<div class="tab-pane fade" id="setting-logo" role="tabpanel" aria-labelledby="logo-setting">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.logo-setting.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <img src="{{ asset(@$logoSetting->favicon) }}" alt="" width="150">
                    <br>
                    <label>Favicon</label>
                    <input type="file" class="form-control" name="favicon" value="">
                    <input type="hidden" name="old_favicon_logo" value="{{ @$logoSetting->favicon }}">
                </div>

                <div class="form-group">
                    <img src="{{ asset(@$logoSetting->logo) }}" alt="" width="150">
                    <br>
                    <label>Logo</label>
                    <input type="file" class="form-control" name="logo" value="">
                    <input type="hidden" class="form-control" name="old_logo" value="{{ @$logoSetting->logo }}">
                </div>

                <div class="form-group">
                    <img src="{{ asset(@$logoSetting->footer_logo) }}" alt="" width="150">
                    <br>
                    <label>Footer Logo</label>
                    <input type="file" class="form-control" name="footer_logo" value="">
                    <input type="hidden" name="old_footer_logo" value="{{ @$logoSetting->footer_logo }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

