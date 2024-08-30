    {{ include('layouts/header.php', {title:'Le Journal de bord'})}}
    <section class="admin-interface">
        <div class="admin-container">
            <h1>{{title}}</h1>
            <table>
                <thead>
                    <tr>
                        <th>Adresse IP</th>
                        <th>Date</th>
                        <th>Nom d'utilisateur</th>
                        <th>Page visitée</th>
                    </tr>
                </thead>
                <tbody>
                    {% for activity in activities %}
                    <tr>
                        <td>{{ activity.ip }}</td>
                        <td>{{ activity.date }}</td>
                        <td>{{ activity.username }}</td>
                        <td>{{ activity.page }}</td>
                    </tr>
                    {% else %}
                    <tr>
                        <td colspan="4">Aucune activité enregistrée</td>
                    </tr>
                    {% endfor %}
                </tbody>
            </table>
        </div>
    </section>
    {{ include('layouts/footer.php')}}