<x-intern-layout-app>
    @section('title', 'Ketidakhadiran')

    <x-intern-layout-header judul="Pengajuan Izin"></x-intern-layout-header>

    <!-- Icon below header -->
    <div class="text-center my-4">
        <i class="fas fa-bullseye text-danger" style="font-size: 5rem; cursor: pointer;" id="goalsIcon"
            onclick="openGoalsModal()"></i>
    </div>

    <!-- Modal for goals -->
    <div class="modal fade" id="goalsModal" tabindex="-1" aria-labelledby="goalsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="goalsModalLabel">Set Goals Hari Ini</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="goalsForm" action="{{ route('intern.goal.store') }}" method="POST">
                        @csrf <!-- Laravel CSRF protection -->
                        <!-- Textbox for goals hari ini -->
                        <div class="mb-3">
                            <label for="goalsText" class="form-label">Goals Hari Ini</label>
                            <input type="text" class="form-control" id="goalsText" name="description"
                                placeholder="Masukkan goals hari ini" required>
                        </div>

                        <!-- Dropdown for status -->
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select class="form-select" id="statusSelect" name="status" required>
                                <option value="In Progress">In Progress</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        {{-- Goals Hari Ini --}}
        <div class="card">
            <div class="card-header">
                <span>Goals Hari Ini <span class="text-primary"
                        id="goalCountToday">({{ $goalsToday->count() }})</span></span>
            </div>

            <div class="card-body">
                @if ($goalsToday->isEmpty())
                    <p>Tidak ada goals untuk hari ini.</p>
                @else
                    @php $goal = $goalsToday->first(); @endphp <!-- Get the first (and only) goal -->
                    <p class="d-flex align-items-center justify-content-between">
                        <span>
                            {{ $goal->description }} - Status:
                        </span>
                    <div class="d-flex align-items-center">
                        <select class="form-select form-select-sm ms-2" id="statusSelect"
                            onchange="saveStatus({{ $goal->id }})">
                            <option value="In Progress" {{ $goal->status == 'In Progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="Done" {{ $goal->status == 'Done' ? 'selected' : '' }}>Done</option>
                        </select>
                        <button class="btn btn-primary btn-sm ms-2"
                            onclick="saveStatus({{ $goal->id }})">Simpan</button>
                    </div>
                    </p>
                @endif
            </div>
        </div>


        {{-- Goals Done --}}
        <div class="card mt-3">
            <div class="card-header">
                <span>Goals Selesai <span class="text-danger"
                        id="goalCountDone">({{ $goalsDone->count() }})</span></span>
            </div>
            <div class="card-body">
                @if ($goalsDone->isEmpty())
                    <p>Tidak ada goals selesai.</p>
                @else
                    <ul>
                        @foreach ($goalsDone as $goal)
                            <li>{{ $goal->description }} - Status: {{ $goal->status }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Include the calendar component -->
    <x-intern-goal-calendar></x-intern-goal-calendar>
    <div class="container mt-5">
        <div class="calendar">
            <div class="calendar-header d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" onclick="prevMonth()">&#8592;</button>
                <h3 id="monthYear"></h3>
                <button class="btn btn-primary" onclick="nextMonth()">&#8594;</button>
            </div>
            <div class="calendar-body">
                <div class="day-names">
                    <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span>
                    <span>Thu</span><span>Fri</span><span>Sat</span>
                </div>
                <div class="days" id="calendarDays"></div>
            </div>
        </div>

        <style>
            .calendar {
                max-width: 100%;
                margin: auto;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 8px;
            }

            .calendar-header {
                text-align: center;
                margin-bottom: 20px;
            }

            .day-names {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                font-weight: bold;
                text-align: center;
            }

            .days {
                display: grid;
                grid-template-columns: repeat(7, 1fr);
                grid-gap: 5px;
            }

            .day {
                height: 100px;
                text-align: center;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
                position: relative;
            }

            .day .event {
                background-color: #e0f7fa;
                border-radius: 4px;
                padding: 5px;
                font-size: 12px;
                position: absolute;
                bottom: 5px;
                left: 5px;
                right: 5px;
                text-align: center;
            }
        </style>

        <script>
            let currentMonth = new Date().getMonth();
            let currentYear = new Date().getFullYear();

            // Combine today's goals and done goals into events for the calendar
            const kegiatan = @json(
                $goalsToday->concat($goalsDone)->map(function ($goal) {
                    return ['date' => $goal->created_at->format('Y-m-d'), 'title' => $goal->description];
                }));

            function showCalendar(month, year) {
                const calendarDays = document.getElementById("calendarDays");
                calendarDays.innerHTML = "";
                const monthYear = document.getElementById("monthYear");
                const firstDay = new Date(year, month).getDay();
                const daysInMonth = 32 - new Date(year, month, 32).getDate();

                monthYear.innerHTML = new Date(year, month).toLocaleString('id-ID', {
                    month: 'long',
                    year: 'numeric'
                });

                // Adding empty cells for days before the 1st
                for (let i = 0; i < firstDay; i++) {
                    const emptyCell = document.createElement('div');
                    calendarDays.appendChild(emptyCell);
                }

                // Loop through all days in the month
                for (let day = 1; day <= daysInMonth; day++) {
                    const date = `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                    const dayCell = document.createElement('div');
                    dayCell.classList.add('day');
                    dayCell.innerHTML = day;

                    // Loop through kegiatan array to find matching events
                    kegiatan.forEach(event => {
                        if (event.date === date) {
                            dayCell.innerHTML += `<div class="event">${event.title}</div>`;
                        }
                    });

                    calendarDays.appendChild(dayCell);
                }
            }

            function prevMonth() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                showCalendar(currentMonth, currentYear);
            }

            function nextMonth() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                showCalendar(currentMonth, currentYear);
            }

            showCalendar(currentMonth, currentYear);
        </script>
    </div>


    <script>
        // Function to open the modal
        function openGoalsModal() {
            $('#goalsModal').modal('show'); // Show modal when clicked
            document.getElementById('goalsForm').reset(); // Reset form when opening modal
        }

        // Function to save the updated status
        function saveStatus(goalId) {
            const statusSelect = document.getElementById('statusSelect').value;

            fetch(`{{ route('intern.goal.update', '') }}/${goalId}`, { // Use route helper for updating goal
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for PUT requests
                    },
                    body: JSON.stringify({
                        status: statusSelect,
                    }),
                })
                .then(response => {
                    if (response.ok) {
                        alert('Status berhasil diperbarui ke ' + statusSelect);
                    } else {
                        throw new Error('Failed to update the status');
                    }
                })
                .catch(error => {
                    console.error('Error updating status:', error);
                });
        }
    </script>
</x-intern-layout-app>
