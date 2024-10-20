<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>Document</title>
<style>
    /* General header styling */
.header {
    background-color: #fff; /* خلفية بيضاء */
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1); /* ظل خفيف */
    padding:  0; /* المساحة حول العناصر داخل الناف بار */
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 999; /* حتى يبقى الناف بار فوق كل العناصر */
}

/* Styling for the logo */
.header__logo img {
    max-width: 100%; /* اجعل الشعار يستجيب لحجم الحاوية */
    height: auto; /* تجنب تشويه الصورة */
}

/* Center the menu */
.header__menu {
    display: flex;
    justify-content: center; /* تمركز الروابط في الوسط */
}

.header__menu ul {
    display: flex; /* تنسيق القائمة كـ inline items */
    list-style: none;
    margin: 0;
    padding: 0;
}

.header__menu ul li {
    margin: 0 20px; /* المسافة بين الروابط */
}

.header__menu ul li a {
    text-decoration: none; /* إزالة التسطير */
    font-weight: bold; /* جعل النص سميك */
    color: #000; /* لون النص الأسود */
    padding: 10px 15px; /* مسافة حول الروابط */
    text-transform: uppercase; /* النص بالأحرف الكبيرة */
}

.header__menu ul li a:hover {
    color: #951406; /* تغيير اللون عند التمرير */
}

.header__menu ul li.active a {
    color: #0b0a09; /* لون خاص للصفحة النشطة */
}

/* Dropdown styling */
.header__menu ul li ul.dropdown {
    display: none; /* إخفاء القائمة الفرعية */
    position: absolute;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

.header__menu ul li:hover ul.dropdown {
    display: block; /* إظهار القائمة الفرعية عند التمرير */
}

.header__menu ul li ul.dropdown li {
    margin: 0;
}

.header__menu ul li ul.dropdown li a {
    padding: 10px 20px; /* مسافة إضافية حول الروابط في القائمة الفرعية */
    color: #000;
}

/* Right section styling (search, cart, login, etc.) */
.header__right {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.header__right__auth a {
    margin-right: 20px;
    font-weight: bold;
    color: #000;
}

.header__right__widget {
    display: flex;
    list-style: none;
}

.header__right__widget li {
    margin-left: 15px;
    position: relative;
}

.header__right__widget li .icon_heart_alt,
.header__right__widget li .icon_bag_alt {
    font-size: 20px;
    color: #000;
}

.header__right__widget li .tip {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: #d4af7a;
    color: #fff;
    font-size: 12px;
    border-radius: 50%;
    padding: 2px 5px;
}

</style>
</head>
<body>
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2">
                    <div class="header__logo">
                        <img src="{{ asset('img/fofologo.png') }}" alt="fofoLogo" style="width: auto; height: 50px;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ url('/') }}">Home</a></li>


                        </ul>
                    </nav>

                </div>


    </header>
    @yield('content')

</body>
</html>
