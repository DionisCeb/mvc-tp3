    {{ include('layouts/header.php', {title:'Le Journal de bord'})}}
    
    <section class="admin-interface">
        <div class="admin-container">
            <h1>Le Journal de bord</h1>
            <section class="canvas flex-center">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <div>
                    <h3>Stats:</h3>
                    <canvas id="myChart" width="1200"></canvas>
                </div>
            </section>
            <table>
                <thead>
                    <tr>
                        <th>Adresse IP</th>
                        <th>Date</th>
                        <th>Nom d'utilisateur</th>
                        <th>Est connecté ?</th>
                        <th>Page visitée</th>
                    </tr>
                </thead>
                <tbody>
                    {% for activity in activities %}
                    <tr>
                        <td>{{ activity.ip }}</td>
                        <td>{{ activity.date }}</td>
                        <td>{{ activity.username }}</td>
                        {% if  guest %}
                            <td>non - visiteur</td>
                        {% else %}
                            <td>Oui - connecté</td>
                        {% endif %}
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
    <script>
         var ctx = document.getElementById('myChart').getContext('2d');
        
        // Parse the JSON data safely
        var chartData = JSON.parse('{{ chartData|raw|e('js') }}');
        
        // Check the structure of chartData
        console.log(chartData);

        // Process the data
        var dates = [];
        var pages = {};
        var series = {};

        chartData.forEach(entry => {
            const { date, page, count } = entry;
            
            // Add date to labels if not already present
            if (!dates.includes(date)) {
                dates.push(date);
            }

            // Initialize page entries if not already present
            if (!pages[date]) {
                pages[date] = {};
            }
            pages[date][page] = count;
        });

        var datasets = Object.keys(pages[dates[0]]).map(page => ({
            label: page,
            data: dates.map(date => pages[date][page] || 0),
            backgroundColor: getRandomColor(),
        }));

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
    {{ include('layouts/footer.php')}}