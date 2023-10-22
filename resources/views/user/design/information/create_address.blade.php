@extends('user.layout')
@section('title')
   Thêm địa chỉ của {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="form_information">
        <div class="container_information">
            <div class="title">Thêm địa chỉ</div>
            <div class="content">
                    <form action="{{ url('information/do-create' . $user->id) }}" method="POST" >
                        @csrf
                        <div class="user-details">
                            <div class="input-box" style="width: 100%">
                                <span class="details">Chọn tỉnh/thành phố</span>
                               <select class="form-control" style="width: 100%" id="show-province" onchange="province(value)">
                                   <option selected disabled>

                                   </option>
                               </select>
                            </div>
                            <div class="input-box" style="width: 100%">
                                <span class="details">Chọn huyện</span>
                                <select class="form-control" style="width: 100%; height: 45px" id="show-district" onchange="district(value)">
                                    <option selected disabled>

                                    </option>
                                </select>
                            </div>
                            <div class="input-box" style="width: 100%">
                                <span class="details">Chọn xã</span>
                                <select class="form-control" style="width: 100%" id="show-commune" >
                                    <option selected disabled>

                                    </option>
                                </select>
                            </div>
                            <div class="input-box" style="width: 100%;">
                                <span class="details">Địa chỉ</span>
                                <input type="text" name="address" style="width: 82%">
                            </div>
                        </div>
                    </form>
                <button type="submit" class="primary_button">  Thêm địa chỉ
                </button>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    @include('user.design.information.script')
@endsection
