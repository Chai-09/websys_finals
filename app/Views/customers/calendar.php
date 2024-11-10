<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Calendar </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/CSS/Customers/Style_Calendar.css">
    <link rel="icon" href="assets/Favicons/calendar.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .loader {
            width: 48px;
            height: 48px;
            margin: auto;
            position: relative;
        }
        
        .loader:before {
            content: '';
            width: 48px;
            height: 5px;
            background: #f0808050;
            position: absolute;
            top: 60px;
            left: 0;
            border-radius: 50%;
            animation: shadow324 0.5s linear infinite;
        }
        
        .loader:after {
            content: '';
            width: 100%;
            height: 100%;
            background: #f08080;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 4px;
            animation: jump7456 0.5s linear infinite;
        }
        
        @keyframes jump7456 {
            15% {
            border-bottom-right-radius: 3px;
            }
        
            25% {
            transform: translateY(9px) rotate(22.5deg);
            }
        
            50% {
            transform: translateY(18px) scale(1, .9) rotate(45deg);
            border-bottom-right-radius: 40px;
            }
        
            75% {
            transform: translateY(9px) rotate(67.5deg);
            }
        
            100% {
            transform: translateY(0) rotate(90deg);
            }
        }
        
        @keyframes shadow324 {
        
            0%,
            100% {
            transform: scale(1, 1);
            }
        
            50% {
            transform: scale(1.2, 1);
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4"> Select Date and Time </h2>
                
                <!-- Back Button to User Page -->
                <div class="text-center mb-3">
                    <button onclick="window.location.href='<?= base_url('user') ?>'" class="btn btn-secondary btn-sm"> Go Back </button>
                </div>

                <!-- Shows the Name of Chosen Worker -->
                <h4> Selected Worker: <?= htmlspecialchars($workerName ?? 'Not selected') ?> </h4>

                <!-- Shows the Available Time Selections -->
                <div class="row">
                    <div class="col-md-6">
                        <br> <h4> Select Time: </h4> <br>
                        <div id="time-options">
                            <button class="time-button" style="padding: 8px" data-time="09:00 AM"> 09:00 AM </button> 
                            <button class="time-button" style="padding: 8px" data-time="10:00 AM"> 10:00 AM </button> 
                            <button class="time-button" style="padding: 8px" data-time="11:00 AM"> 11:00 AM </button> <br> <br>
                            <button class="time-button" style="padding: 8px" data-time="12:00 PM"> 12:00 PM </button> 
                            <button class="time-button" style="padding: 8px" data-time="01:00 PM"> 01:00 PM </button>
                            <button class="time-button" style="padding: 8px" data-time="02:00 PM"> 02:00 PM </button> <br> <br> <br>
                        </div>
                    </div>

                    <div class="col-md-6 calendar">
                        <br> <h3 class="text-center" id="calendar-title"></h3>
                        <div class="d-flex justify-content-between mb-3">
                            <button class="btn btn-outline-primary btn-sm" id="prev-month"> Previous </button>
                            <button class="btn btn-outline-primary btn-sm" id="next-month"> Next </button>
                        </div>
                        
                        <!-- Shows the Calendar - ryk -->
                        <table class="table table-bordered-none text-center">
                            <thead>
                                <tr>
                                    <th> Sun </th>
                                    <th> Mon </th>
                                    <th> Tue </th>
                                    <th> Wed </th>
                                    <th> Thu </th>
                                    <th> Fri </th>
                                    <th> Sat </th>
                                </tr>
                            </thead>
                            <tbody id="calendar-body"></tbody>
                        </table>
                    </div>
                </div>

                <form id="appointmentForm" action="<?= base_url('receipts') ?>" method="POST">
                    <input type="hidden" name="selectedDate" id="selectedDate">
                    <input type="hidden" name="selectedTime" id="selectedTime">
                    <input type="hidden" name="workerId" value="<?= esc($workerId ?? '') ?>">
                    <input type="hidden" name="workerName" value="<?= htmlspecialchars($workerName ?? '') ?>"> <!-- Hidden Input for Name of Worker -->
                    <button type="submit" class="btn btn-primary mt-3"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>       

<br><br><br><br><br><br><br>
<div class="loader"></div>

<script>
    const calendarTitle = document.getElementById('calendar-title');
    const calendarBody = document.getElementById('calendar-body');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let selectedCell = null;
    let selectedTimeButton = null;

    function renderCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();

        calendarBody.innerHTML = '';
        calendarTitle.innerHTML = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

        // Disables the "Previous" Button when Viewing the Current Month and Year
        if (year === today.getFullYear() && month === today.getMonth()) {
            prevMonthBtn.disabled = true;
        } else {
            prevMonthBtn.disabled = false;
        }

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

                    const cellDate = new Date(year, month, date);
                    if (cellDate < today) {
                        cell.classList.add('disabled');
                    } else {
                        cell.addEventListener('click', () => {
                            if (selectedCell) {
                                selectedCell.classList.remove('selected');
                            }
                            cell.classList.add('selected');
                            selectedCell = cell;
                            document.getElementById('selectedDate').value = `${year}-${month + 1}-${cell.innerHTML}`;
                        });
                    }
                    date++;
                }
                row.appendChild(cell);
            }
            calendarBody.appendChild(row);
        }
    }

    // Handles the Button for Time Selection
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

    // Prevents Form Submission if the User Doesn't Select a Date and Time
    document.getElementById('appointmentForm').addEventListener('submit', (e) => {
        const selectedDate = document.getElementById('selectedDate').value;
        const selectedTime = document.getElementById('selectedTime').value;

        if (!selectedDate || !selectedTime) {
            e.preventDefault();
            alert('Please select both date and time to continue!');
        }
    });

    // Navigation to the Previous Month
    prevMonthBtn.addEventListener('click', () => {
        if (currentMonth > 0) {
            currentMonth--;
        } else {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    // Navigation to the Next Month
    nextMonthBtn.addEventListener('click', () => {
        if (currentMonth < 11) {
            currentMonth++;
        } else {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });

    renderCalendar(currentMonth, currentYear);
</script>


</body>
</html>
