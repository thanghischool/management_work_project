<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('pages/card.css')}}">
    <link rel="stylesheet" href="{{asset('pages/fontawesome-free-6.5.1-web/css/all.min.css')}}">
</head>
<body>
    <div class="popup">
        <p>{{Auth::user()->name}}</p>
        <p>{{Auth::user()->email}}</p>
        <p>{{Auth::user()->id}}</p>
        <p>{{ session('id_user') }}</p>
        <a href="{{route('logout')}}" >logut</a>
        <button class="open-modal-btn">Card</button>
        <div class="modal hide">
            <div class="modal__inner">
                    <div>
                        <div class="modal__header"> 
                            <i class="fa-solid fa-window-maximize fa-lg" style="color: #000000;"></i>
                            <div class="name">
                                <h4 contenteditable="true" class="asd" >NameCard</h4>
                                <p>Trong danh sánh ...</p>
                            </div>
                            
                            <i class="fa-solid fa-xmark fa-lg" style="color: #000000; cursor: pointer;"></i>
                        </div>
                        <div class="modal__body">
                            <div class="content">
                            <div class="slide">
                                <div class="slide-header">
                                    <div class="name">
                                        <i class="fa-solid fa-bars fa-lg" style="color: #000000;"></i>   
                                        <h4>Describe</h4>
                                    </div>  
                                </div>
                                <div class="slide-body">
                                    <textarea name="" id="" cols="50" rows="4" placeholder="Thêm mô tả chi tiết ..."></textarea>
                                </div>       
                            </div>
                            <div class="slide">
                                <div class="slide-header">
                                    <div class="name">
                                        <i class="fa-solid fa-clipboard-check fa-lg"></i>          
                                        <h4>To do list</h4>
                                    </div>      
                                    <button class="btnn">Delete</button>
                                    
                                </div>
                                <div class="slide-body">
                                    <div class="check">
                                        <input type="checkbox" checked="checked">
                                        <p class="check-content">Thắng code phần chức năng của Workspace như sau show dữ liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn các tính năng liên quan đến workspace như mời bạn tham gia vào 1 group th</p>
                                    </div>
                                    <div class="check">
                                        <input type="checkbox" checked="checked">
                                        <p class="check-content">Thắng code phần chức năng của Workspace như sau show dữ liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn các tính năng liên quan đến workspace như mời bạn tham gia vào 1 group th</p>
                                    </div>
                                    <div class="check">
                                        <input type="checkbox" checked="checked">
                                        <p class="check-content">Thắng code phần chức năng của Workspace như sau show dữ liệu ra workspace view, thêm sửa xóa 1 workspace. ngoài ra còn các tính năng liên quan đến workspace như mời bạn tham gia vào 1 group th</p>
                                    </div>
                                    <button class="btnn">Add</button>                                                                                            
                                </div>
                            </div>
                            <div class="slide">
                                <div class="slide-header">
                                    <div class="name">
                                        <i class="fa-solid fa-list fa-lg" style="color: #000000;"></i>
                                        <h4>Activity</h4>
                                    </div>
                                    <button class="btnn">Show</button>
                                </div>
                                <div class="slide-body">
                                    <textarea name="" id="" cols="50" rows="2"></textarea>
                                </div>
                        
                            </div>
                            </div>
                            <div class="activity">
                                <button class="btnn">chuc nang</button> <br>
                                <button class="btnn">chuc nang</button> <br>
                                <button class="btnn">chuc nang</button> <br>
                                <button class="btnn">chuc nang</button> <br>
                                <button class="delcard btnn">Delete Card</button> <br>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal__footer"></div>
            </div>
            
        </div>
      </div>
       
</body>

    <script src="{{asset('pages/card.js')}}"></script>
</html>