{{ include('layouts/header.php', {title:'Page not Found'})}}


<div class="error_container">
    <div class="error_text">
        <div class="error_container_title">
            Error
        </div>
        
        <div class="error_container_subtitle">
            {{ msg }}
        </div>
        <div class="error_container_btn">
            <a href="{{base}}/home" class="header-box_btn deals-link">Return to main page</a>
        </div>
    </div>
    <div class="error_img">
        
    </div>
</div>


{{ include('layouts/footer.php')}}