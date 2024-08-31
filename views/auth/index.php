{{ include('layouts/header.php', {title:'Login'})}}
        <section class="section-flex-center-100">
                <form class="form-auth" method="post">
                    <h2>Login</h2>
                    <div>
                        <label>Username</label>
                        <input type="email" name="username" value="{{ user.username}}">
                        {% if errors.username is defined %}
                            <span class="error">{{ errors.username }}</span>
                        {% endif %}
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" value="{{ user.password}}">
                        {% if errors.password is defined %}
                            <span class="error">{{ errors.password }}</span>
                        {% endif %}
                    </div>
                    <div class="reserve-submit">
                        <input type="submit" value="Login">
                    </div>
                </form>
        </section>
{{ include('layouts/footer.php')}}