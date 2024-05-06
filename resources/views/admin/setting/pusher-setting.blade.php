
    <div class="tab-pane fade" id="list-setting" role="tabpanel" aria-labelledby="pusher-setting">
        <div class="card border">
            <div class="card-body">
                <form action="{{route('admin.pusher-setting.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Puhser App Id</label>
                        <input type="text" class="form-control" name="pusher_app_id" value="{{ $pusherSetting?->pusher_app_id }}">
                    </div>

                    <div class="form-group">
                        <label>Puhser Key</label>
                        <input type="text" class="form-control" name="pusher_key" value="{{ $pusherSetting?->pusher_key }}">
                    </div>

                    <div class="form-group">
                        <label>Puhser Secret</label>
                        <input type="text" class="form-control" name="pusher_secret" value="{{ $pusherSetting?->pusher_secret }}">
                    </div>

                    <div class="form-group">
                        <label>Puhser Cluster</label>
                        <input type="text" class="form-control" name="pusher_cluster" value="{{ $pusherSetting?->pusher_cluster }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

