<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="general-settings">
   <div class="card border">
       <div class="card-body">
           <form action="{{route('admin.general-setting.update')}}" method="POST">
               @csrf
               @method('PUT')
               <div class="form-group">
                   <label>Site Name</label>
                   <input type="text" class="form-control" name="site_name" value="{{@$generalSetting->site_name}}">
               </div>
               <div class="form-group">
                   <label>Layout</label>
                   <select name="layout" class="form-control" id="">
                       <option {{@$generalSetting->layout == 'LTR' ? 'selected' : ''}} value="LTR">LTR</option>
                       <option {{@$generalSetting->layout == 'RTL' ? 'selected' : ''}} value="RTL">RTL</option>
                   </select>
               </div>
               <div class="form-group">
                   <label>Contact Email</label>
                   <input type="email" class="form-control" name="contact_email" value="{{@$generalSetting->contact_email}}">
               </div>
               <div class="form-group">
                   <label>Default Currency Name </label>
                   <select id="" class="form-control select2" name="currency_name">
                       <option value="">Select</option>
                       @foreach(config('settings.currency_list') as $currency)
                           <option {{@$generalSetting->currency_name == $currency ? 'selected' : ''}}
                                   value="{{$currency}}">{{$currency}}</option>
                       @endforeach
                   </select>
               </div>
               <div class="form-group">
                   <label>Currency Icon</label>
                   <input type="text" class="form-control" name="currency_icon" value="{{@$generalSetting->currency_icon}}">
               </div>
               <div class="form-group">
                   <label>Timezone</label>
                   <select class="form-control select2" name="timezone" id="">
                       <option value="">Select</option>
                       @foreach(config('settings.time_zone') as $key => $timezone)
                           <option {{@$generalSetting->time_zone == $key ? 'selected' : ''}}
                                   value="{{$key}}">{{$key}}</option>
                       @endforeach
                   </select>
               </div>
               <button type="submit" class="btn btn-primary">Save</button>
           </form>
       </div>
   </div>
</div>
