<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { background-color: #1C1C1C; font-family: 'Courier New'; }
        .card { background-color: #2a2a2a; color: #FFFFFF; top: 20%; margin: -50px 0 0 -50px; border-radius: 35px; }
        .calendar td.clickable { cursor: pointer; transition: background-color 0.2s ease; }
        .calendar td.clickable:hover { background-color: #f0f8ff; }
        .calendar td.selected { background-color: #28a745 !important; color: #ffffff; }

        .time-button {
            background-color: white;
            border: 1px solid #ccc;
            color: black;
            margin: 5px;
        }
        .time-button.selected {
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">Select Date and Time</h2>
                
                <!-- Back button to user.php - ryk -->
                <div class="text-center mb-3">
                    <button onclick="window.location.href='<?= base_url('user') ?>'" class="btn btn-secondary btn-sm">Go Back</button>
                </div>

                <!-- Shows chosen worker name - ryk -->
                <h4>Selected Worker: <?= htmlspecialchars($_GET['workerName'] ?? 'Not selected') ?></h4>

                <!-- Shows time - ryk -->
                <div class="row">
                    <div class="col-md-6">
                        <br> <h4>Select Time:</h4> <br>
                        <div id="time-options">
                            <button class="time-button" style="padding: 8px" data-time="09:00 AM">09:00 AM</button> 
                            <button class="time-button" style="padding: 8px" data-time="10:00 AM">10:00 AM</button> 
                            <button class="time-button" style="padding: 8px" data-time="11:00 AM">11:00 AM</button> <br> <br>
                            <button class="time-button" style="padding: 8px" data-time="12:00 PM">12:00 PM</button> 
                            <button class="time-button" style="padding: 8px" data-time="01:00 PM">01:00 PM</button>
                            <button class="time-button" style="padding: 8px" data-time="02:00 PM">02:00 PM</button> <br> <br> <br>
                        </div>
                    </div>

                    <div class="col-md-6 calendar">
                        <br> <h3 class="text-center" id="calendar-title"></h3>
                        <div class="d-flex justify-content-between mb-3">
                            <button class="btn btn-outline-primary btn-sm" id="prev-month">Previous</button>
                            <button class="btn btn-outline-primary btn-sm" id="next-month">Next</button>
                        </div>
                        <!-- Shows the calendar - ryk -->
                        <table class="table table-bordered-none text-center">
                            <thead>
                                <tr>
                                    <th>Sun</th>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                </tr>
                            </thead>
                            <tbody id="calendar-body"></tbody>
                        </table>
                    </div>
                </div>

                <form id="appointmentForm" action="<?= base_url('roleDashboard/receipts') ?>" method="POST">
                    <input type="hidden" name="selectedDate" id="selectedDate">
                    <input type="hidden" name="selectedTime" id="selectedTime">
                    <input type="hidden" name="workerName" value="<?= htmlspecialchars($_GET['workerName'] ?? '') ?>"> <!-- Hidden input for worker name -->
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const calendarTitle = document.getElementById('calendar-title');
    const calendarBody = document.getElementById('calendar-body');
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let selectedCell = null;
    let selectedTimeButton = null;

    function renderCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        calendarBody.innerHTML = '';
        calendarTitle.innerHTML = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

        let date = 1;
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                if (i === 0 && j < firstDay) {
                    cell.innerHTML = '';
                } else if (date > daysInMonth) {
                    break;
                } else {
                    cell.innerHTML = date;
                    cell.classList.add('clickable');

                    cell.addEventListener('click', () => {
                        if (selectedCell) {
                            selectedCell.classList.remove('selected');
                        }
                        cell.classList.add('selected');
                        selectedCell = cell;
                        document.getElementById('selectedDate').value = `${year}-${month + 1}-${cell.innerHTML}`; //pota eto lang naman problem
                    });

                    date++;
                }
                row.appendChild(cell);
            }
            calendarBody.appendChild(row);
        }
    }

    //Gets selected or clicked time - ryk
    const timeButtons = document.querySelectorAll('.time-button');
    timeButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (selectedTimeButton) {
                selectedTimeButton.classList.remove('selected');
            }
            button.classList.add('selected');
            selectedTimeButton = button;
            document.getElementById('selectedTime').value = button.getAttribute('data-time');
        });
    });

    //Added form handling for date and time submission - geb
    document.getElementById('appointmentForm').addEventListener ('submit', (e) => {
        const selectedDate = document.getElementById('selectedDate').value;
        const selectedTime = document.getElementById('selectedTime').value;
       
        if  (!selectedDate || !selectedTime){
              e.preventDefault()
            alert('Please select a proper date and time to proceed!');
        }

        
    });

    //goes to previous month - ryk
    document.getElementById('prev-month').addEventListener('click', () => {
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        currentYear = (currentMonth === 11) ? currentYear - 1 : currentYear;
        renderCalendar(currentMonth, currentYear);
    });

    //goes to next month - ryk
    document.getElementById('next-month').addEventListener('click', () => {
        currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
        currentYear = (currentMonth === 0) ? currentYear + 1 : currentYear;
        renderCalendar(currentMonth, currentYear);
    });

    renderCalendar(currentMonth, currentYear);
</script>

</body>
</html>
