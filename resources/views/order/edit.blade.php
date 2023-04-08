 @extends('layouts.app')

 @section('title')
Orders
@endsection
@section('breadcrumb')
Edit order
@endsection
 @section('content')

 @if ($errors->any())
 <br>
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
 @endif

 <!-- if end user -->
 @role('end-user')
 <form method="POST" action="{{route('orders.update',$order->id)}}" style="margin: 40px;" enctype="multipart/form-data">
     @csrf
     @method('PUT')

     @if (session('error'))
     <div role="alert" class="fw-bold fs-5 mb-3 text-center text-danger">{{ session('error') }}</div>
     @endif

     <div class="mb-3">
         <label for="exampleFormControlInput1" class="form-label">Prescriptions</label>
         <input name="Prescriptions[]" type="file" accept=".jpg,.png" multiple="multiple" class="form-control" id="exampleFormControlInput1" />
     </div>
     <div class="mb-3">
         <label class="form-label">Is your order insured?</label>
         <div class="form-check">
             <input class="form-check-input" type="radio" name="radio" id="yes_radio" value="1">
             <label class="form-check-label" for="yes_radio">
                 Yes
             </label>
         </div>
         <div class="form-check">
             <input class="form-check-input" type="radio" name="radio" id="no_radio" value="0" checked>
             <label class="form-check-label" for="no_radio">
                 No
             </label>
         </div>
     </div>
     <div class="mb-3">
         <label class="form-label">Delivery address</label>
         <select name="address" class="form-control">
             @foreach($addresses as $address)
             <option value="{{$address->id}}">{{$address->area()->first()->st_name}}, {{$address->st_name}}, {{$address->building_no}}, {{$address->floor_no}}, {{$address->flat_no}}</option>
             @endforeach
         </select>
     </div>

     <button type="submit" class="btn btn-success">Update order</button>
 </form>
 @endrole

 @role('pharmacy')
 <!-- if pharmacy -->
 <form method="POST" action="{{route('orders.update', $order->id)}}" style="margin: 40px;" enctype="multipart/form-data">
     @csrf
     @method('PUT')

     @if (session('error'))
     <div role="alert" class="fw-bold fs-5 mb-3 text-center text-danger">{{ session('error') }}</div>
     @endif
     <div class="form-group">
         <label>Select medicines</label>
         <select class="select2 form-control" name='meds[]' multiple="multiple" data-placeholder="Select medicines" style="width: 100%;">
             @foreach($medicines as $medicine)
             <option value="{{$medicine->id}}">{{$medicine->name}}</option>
             @endforeach
         </select><br>
         <div class="form-group">
             <label>Quantity</label>
             <div class="input-group" id="input-container">
                 <!-- input fields will be dynamically added/removed here -->
             </div>
         </div>
     </div>
     <button type="submit" class="btn btn-success">Update order</button>
 </form>
 @endrole

 <!-- if doctor -->
 @role('doctor')
 <form method="POST" action="{{route('orders.update',$order->id)}}" style="margin: 40px;" enctype="multipart/form-data">
     @csrf
     @method('PUT')

     @if (session('error'))
     <div role="alert" class="fw-bold fs-5 mb-3 text-center text-danger">{{ session('error') }}</div>
     @endif

     <div class="mb-3">
         <label class="form-label">Status</label>
         <select name="status" class="form-control">
             <option value="confirmed">confirmed</option>
             <option value="delivered">delivered</option>
             <option value="cancelled">cancelled</option>
         </select>
     </div>
     <button type="submit" class="btn btn-success">Update order</button>
 </form>
 @endrole

 @role('admin')
 <form method="POST" action="{{route('orders.update',$order->id)}}" style="margin: 40px;" enctype="multipart/form-data">
     @csrf
     @method('PUT')

     @if (session('error'))
     <div role="alert" class="fw-bold fs-5 mb-3 text-center text-danger">{{ session('error') }}</div>
     @endif
@if($order->status=='new'||$order->status=='waitingCustConfirmation'||$order->status=='processing')
     <div class="mb-3">
         <label for="exampleFormControlInput1" class="form-label">Prescriptions</label>
         <input name="Prescriptions[]" type="file" accept=".jpg,.png" multiple="multiple" class="form-control" id="exampleFormControlInput1" />
     </div>
     <div class="mb-3">
         <label class="form-label">Is your order insured?</label>
         <div class="form-check">
             <input class="form-check-input" type="radio" name="radio" id="yes_radio" value="1">
             <label class="form-check-label" for="yes_radio">
                 Yes
             </label>
         </div>
         <div class="form-check">
             <input class="form-check-input" type="radio" name="radio" id="no_radio" value="0" checked>
             <label class="form-check-label" for="no_radio">
                 No
             </label>
         </div>
     </div>
     <div class="mb-3">
         <label class="form-label">Delivery address</label>
         <select name="address" class="form-control">
             @foreach($addresses as $address)
             <option value="{{$address->id}}">{{$address->area()->first()->st_name}}, {{$address->st_name}}, {{$address->building_no}}, {{$address->floor_no}}, {{$address->flat_no}}</option>
             @endforeach
         </select>
     </div>
     @endif
     @if($order->status=='waitingCustConfirmation')
     <div class="form-group">
         <label>Select medicines</label>
         <select class="select2 form-control" name='meds[]' multiple="multiple" data-placeholder="Select medicines" style="width: 100%;">
             @foreach($medicines as $medicine)
             <option value="{{$medicine->id}}">{{$medicine->name}}</option>
             @endforeach
         </select><br>
         <div class="form-group">
             <label>Quantity</label>
             <div class="input-group" id="input-container">
                 <!-- input fields will be dynamically added/removed here -->
             </div>
         </div>
     </div>
     @endif
     <button type="submit" class="btn btn-success">Update order</button><br>
 </form><br>
 @endrole

 @endsection