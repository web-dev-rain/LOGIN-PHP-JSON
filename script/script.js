function _i(id){
    return document.getElementById(id);
}

function hidemsg(){
    window.setTimeout(function(){
        _i("msg").style.display = "none";
    },4000);
}

function fetch(){
    let data = new FormData();
    data.append('fetch','yes');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            _i("result").innerHTML = "";
            _i("result").innerHTML = xhr.responseText;
        }
    };
    xhr.open('POST','ajax.php');
    xhr.send(data);
}

function addnew(){
    let data = new FormData();
    data.append('add','yes');
    data.append('login',_i("login").innerHTML);
    data.append('password',_i("password").innerHTML);
    data.append('email',_i("email").innerHTML);
    data.append('username',_i("username").innerHTML);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            fetch();
            _i("msg").style.display = "block";
            _i("msg").innerHTML = xhr.responseText;
        }
    };
    xhr.open('POST','ajax.php');
    xhr.send(data);
    hidemsg();
}

function edit(id){
    let data = new FormData();
    var login = "login" + id;
    var password = "password" + id;
    var email = "email" + id;
    var username = "username" + id;
    data.append('edit','yes');
    data.append('id',id);
    data.append('login',_i(login).innerHTML);
    data.append('password',_i(password).innerHTML);
    data.append('email',_i(email).innerHTML);
    data.append('username',_i(username).innerHTML);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            fetch();
            _i("msg").style.display = "block";
            _i("msg").innerHTML = xhr.responseText;
        }
    };
    xhr.open('POST','ajax.php');
    xhr.send(data);
    hidemsg();
}

function del(id){
    let data = new FormData();
    data.append('del','yes');
    data.append('id',id);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4){
            fetch();
            _i("msg").style.display = "block";
            _i("msg").innerHTML = xhr.responseText;
        }
    };
    xhr.open('POST','ajax.php');
    xhr.send(data);
    hidemsg();
}

function cancelnew(){
    _i("login").innerHTML = "";
    _i("password").innerHTML = "";
    _i("email").innerHTML = "";
    _i("username").innerHTML = "";
}