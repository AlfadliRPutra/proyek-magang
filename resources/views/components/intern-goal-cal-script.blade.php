@push('scripts')
    <script>
        // Calendar functions
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        const kegiatan = [{
                date: '2024-09-05',
                title: 'Acara'
            },
            {
                date: '2024-09-15',
                title: 'Caring Pelanggan'
            },
            {
                date: '2024-09-16',
                title: 'Tugas Projek'
            },
            {
                date: '2024-09-25',
                title: 'Code Review'
            },
            {
                date: '2024-09-26',
                title: 'Project Deadline'
            }
        ];

        function showCalendar(month, year) {
            const calendarDays = document.getElementById("calendarDays");
            calendarDays.innerHTML = ""; // Clear the calendar before rendering
            const monthYear = document.getElementById("monthYear");
            const firstDay = new Date(year, month).getDay(); // Get the first day of the month
            const daysInMonth = 32 - new Date(year, month, 32).getDate(); // Get total days in the month

            // Set the header to the current month and year
            monthYear.innerHTML = new Date(year, month).toLocaleString('id-ID', {
                month: 'long',
                year: 'numeric'
            });

            // Add empty cells for days before the 1st of the month
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                calendarDays.appendChild(emptyCell);
            }

            // Loop through all the days in the month
            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                const dayCell = document.createElement('div');
                dayCell.classList.add('day');
                dayCell.innerHTML = day; // Display the day

                // Loop through the kegiatan array and find matching events for this date
                kegiatan.forEach(event => {
                    if (event.date === date) {
                        dayCell.innerHTML += `<div class="event">${event.title}</div>`;
                    }
                });

                // Add the day cell to the calendar
                calendarDays.appendChild(dayCell);
            }
        }

        // Show the previous month
        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            showCalendar(currentMonth, currentYear);
        }

        // Show the next month
        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            showCalendar(currentMonth, currentYear);
        }

        // Initially show the current month when the page loads
        showCalendar(currentMonth, currentYear);
    </script>
@endpush
