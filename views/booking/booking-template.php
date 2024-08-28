<!DOCTYPE html>
<html>
<head>
    <style>
        .confirmation-print-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .confirmation-print-box div {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .confirmation-print-box div:last-child {
            border-bottom: none;
        }

        .confirmation-print-box p {
            font-weight: bold;
            color: brown;
            margin: 0;
            font-size: 16px;
        }

        .confirmation-print-box span {
            font-weight: bold;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="confirmation-print-box">
        <div><p><strong>Booking ID:</strong> <span>{{booking_id}}</span></p></div>
        <div><p><strong>Client Name:</strong> <span>{{client_name}} {{client_surname}}</span></p></div>
        <div><p><strong>Client Email:</strong> <span>{{client_email}}</span></p></div>
        <div><p><strong>Client Phone:</strong> <span>{{client_phone}}</span></p></div>
        <div><p><strong>Car Make:</strong> <span>{{car_make}}</span></p></div>
        <div><p><strong>Car Model:</strong> <span>{{car_model}}</span></p></div>
        <div><p><strong>Car Color:</strong> <span>{{car_color}}</span></p></div>
        <div><p><strong>Check-in Date:</strong> <span>{{check_in_date}}</span></p></div>
        <div><p><strong>Check-in Time:</strong> <span>{{check_in_time}}</span></p></div>
        <div><p><strong>Check-out Date:</strong> <span>{{check_out_date}}</span></p></div>
        <div><p><strong>Check-out Time:</strong> <span>{{check_out_time}}</span></p></div>
    </div>
</body>
</html>
