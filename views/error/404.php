{{ include('layouts/header.php', {title:'Page not Found'})}}


<div class="error_container">
    <div class="error_text">
        <div class="error_container_title">
            Error - 404
        </div>
        
        <div class="error_container_subtitle">
            Sorry the page not found
        </div>
        <div class="error_container_btn">
            <a href="{{base}}/home" class="header-box_btn deals-link">Return to main page</a>
        </div>
    </div>
    <div class="error_img">
        <img src="{{asset}}img/404/404.avif" alt="error_img">
    </div>
</div>


{{ include('layouts/footer.php')}}