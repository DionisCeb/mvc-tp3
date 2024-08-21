{{ include('layouts/header.php', {title:'Create User'})}}
    <section class="section-flex-center-100">
        <form class="form-auth" method="post">
            <h2>New User</h2>
            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ user.name}}">
                {% if errors.name is defined %}
                    <span class="error">{{ errors.name }}</span>
                {% endif %}
            </div>
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

            <div>
                <label>Email</label>
                    <input type="email" name="email" value="{{ user.email}}">
                {% if errors.email is defined %}
                    <span class="error">{{ errors.email }}</span>
                {% endif %}
            </div>
            <div>
                <label>Privilege</label>
                <select name="privilege_id">
                        <option value="">Select Privilege</option>
                        {% for privilege in privileges %}
                        <option value="{{privilege.id}}" {% if privilege.id==user.privilege_id %} selected {% endif %}>{{privilege.privilege}}</option>
                        {% endfor %}
                        <option value="4">abc</option>
                    </select>
                {% if errors.privilege_id is defined %}
                    <span class="error">{{ errors.privilege_id }}</span>
                {% endif %}
            </div>
            
            <div class="reserve-submit">
                <input type="submit" class="btn" value="Save">
            </div>
        </form>
    </section>
{{ include('layouts/footer.php')}}

