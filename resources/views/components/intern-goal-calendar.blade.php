@push('scripts')
    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        const activities = @json(
            $goalsToday->concat($goalsDone)->map(function ($goal) {
                return ['date' => $goal->created_at->format('Y-m-d'), 'title' => $goal->description];
            }));

        function showCalendar(month, year) {
            const calendarDays = document.getElementById("calendarDays");
            calendarDays.innerHTML = "";
            const monthYear = document.getElementById("monthYear");
            const firstDay = new Date(year, month).getDay();
            const daysInMonth = 32 - new Date(year, month, 32).getDate();

            monthYear.innerHTML = new Date(year, month).toLocaleString('en-US', {
                month: 'long',
                year: 'numeric'
            });

            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                calendarDays.appendChild(emptyCell);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                const dayCell = document.createElement('div');
                dayCell.classList.add('day');
                dayCell.innerHTML = day;

                activities.forEach(event => {
                    if (event.date === date) {
                        dayCell.innerHTML += `<div class="event">${event.title}</div>`;
                    }
                });

                calendarDays.appendChild(dayCell);
            }
        }

        function prevMonth() {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear--;
            } else {
                currentMonth--;
            }
            showCalendar(currentMonth, currentYear);
        }

        function nextMonth() {
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear++;
            } else {
                currentMonth++;
            }
            showCalendar(currentMonth, currentYear);
        }

        showCalendar(currentMonth, currentYear);
    </script>
@endpush
